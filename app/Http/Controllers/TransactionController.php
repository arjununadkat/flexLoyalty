<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Transaction;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    //
    public function index(){

        $transactions = Transaction::all();
        return view('transactions.index',[
            'transactions'=>$transactions
        ]);
    }

    public function userShow(User $user){

        $user_id = $user->id;
        $transactions = Transaction::where('user_id', $user_id)->get();
        return view('transactions.index',[
            'transactions'=>$transactions
        ]);

    }
    public function tellerShow(User $user){

        $user_id = $user->id;
        $transactions = Transaction::where('teller_id', $user_id)->get();
        return view('transactions.index',[
            'transactions'=>$transactions
        ]);

    }



    public function create(){
        return view('transactions.create',[
            'users'=>User::all(),
            'project'=>Project::latest()->first()
        ]);
    }

    public function store(Request $request){

        request()->validate([
            'customer'=> ['required'],
            'firstname'=> ['required'],
            'mode_of_payment'=> ['required', 'notIn:0'],
            'spending_amount'=> ['required'],
            'points'=> ['required'],
            'gift_value'=> ['required'],
            'teller_id'=> ['required'],
            'amount_payable'=> ['required'],

        ]);

        $redeemable_gift_value = str_replace(',', '', request('redeemable_gift_value'));
        $redeemable_points = intval(request('redeemable_points'));

        $user = User::find(request('customer'));
        $teller = User::find(request('teller_id'));
        $userpoints = $user->points;
        if ($userpoints<$redeemable_points){
            Session::flash('enough_points', 'Insufficient Points!');
            return back();
        }elseif ($userpoints>=$redeemable_points OR $userpoints == 0){
            $transaction = Transaction::create([
                'user_id'=>request('customer'),
                'firstname'=>Str::ucfirst(request('firstname')),
                'mode_of_payment'=>request('mode_of_payment'),
                'spending_amount'=>str_replace(',', '', request('spending_amount')),
                'points'=>request('points'),
                'gift_value'=>request('gift_value'),
                'teller_id'=>request('teller_id'),
//            'redeemable_gift_value'=>str_replace(',', '', request('redeemable_gift_value')),
//            'redeemable_points'=>request('redeemable_points'),
                'amount_payable'=>str_replace(',', '', request('amount_payable')),
            ]);

            $user->transactions_number += 1;
            $user->spending_amount += str_replace(',', '', request('spending_amount'));
            $teller->received_amount += str_replace(',', '', request('amount_payable'));
            $teller->transactions_made += 1;

            if (!empty($request->input('redeemable_gift_value'))){
                $transaction->redeemable_gift_value = $redeemable_gift_value;
                $transaction->redeemable_points = $redeemable_points;
                $transaction->save();
                $user->points += (request('points') - request('redeemable_points'));
                $user->gift_value += (request('gift_value') - str_replace(',', '', request('redeemable_gift_value')));
                $user->points_redeemed += request('redeemable_points');
                $user->gift_value_redeemed += str_replace(',', '', request('redeemable_gift_value'));
                $user->save();
                $teller->discounted_points += request('redeemable_points');
                $teller->discounted_gift_value += str_replace(',', '', request('redeemable_gift_value'));
                $teller->save();
            }
            else{
                $user->points += request('points');
                $user->gift_value += request('gift_value');
                $user->save();
                $teller->save();
            }
            Session::flash('created_transaction', 'The Transaction was Successfully Created');
            return back();
        }
    }

    public function fetchCustomer(Request $request){
        if ($request->ajax()){
            $customer = User::find($request->id);
            return $customer;
        }
    }

    public function destroy(Request $request){
        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            $val = $request->transaction_id;


            $transaction = Transaction::where('id', $val)->first();
            $customer = User::where('id', $transaction->user_id)->first();
            $teller = User::where('id', $transaction->teller_id)->first();

            $customer->spending_amount -= $transaction->spending_amount;
            $customer->points -= $transaction->points;
            $customer->gift_value -= $transaction->gift_value;
            $customer->transactions_number -= 1;

            $teller->received_amount -= $transaction->amount_payable;
            $teller->transactions_made -= 1;

            if (!is_null($transaction->redeemable_points)) {

                $teller->points_redeemed -= $transaction->redeemable_points;
                $teller->gift_value_redeemed -= $transaction->redeemable_gift_value;
                $customer->points += $transaction->redeemable_points;
                $customer->gift_value += $transaction->redeemable_gift_value;
            }

            $customer->save();
            $teller->save();

            Transaction::destroy($request->transaction_id);
            session()->flash('transaction_deleted', 'The transaction has been deleted');
            return redirect()->route('transactions.index');
        }

    }
    public function show($transaction){

        $id = base64_decode($transaction);

        $transaction_data = Transaction::find($id);

        return view('transactions.show', [
            'transaction'=>$transaction_data,
            'project'=>Project::latest()->first()
        ]);
    }

    public function update(Transaction $transaction){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            $inputs = request()->validate([
                'customer'=> ['required'],
                'firstname'=> ['required'],
                'mode_of_payment'=> ['required', 'notIn:0'],
                'spending_amount'=> ['required'],
                'points'=> ['required'],
                'gift_value'=> ['required'],
                'teller_id'=> ['required'],
                'amount_payable'=> ['required'],
                'redeemable_gift_value'=>['sometimes'],
                'redeemable_points'=>['sometimes']
            ]);

            $user = User::find($inputs['customer']);
            $teller = User::find(request('teller_id'));
            $userpoints = $user->points;
            $newspend = str_replace(',','',$inputs['spending_amount']) - $transaction->spending_amount;
            $newamountpayable = str_replace(',','',$inputs['amount_payable']) - $transaction->amount_payable;

            $newpoints = $inputs['points'] - $transaction->points;
            $newgift_value = $inputs['gift_value'] - $transaction->gift_value;

            $teller_points_redeemed = $teller->points_redeemed;
            $teller_gift_value_redeemed = $teller->gift_value_redeemed;
            $transaction->user_id = $inputs['customer'];
            $transaction->firstname = Str::ucfirst($inputs['firstname']);
            $transaction->mode_of_payment = $inputs['mode_of_payment'];
            $transaction->spending_amount = str_replace(',', '', $inputs['spending_amount']);
            $transaction->points = $inputs['points'];
            $transaction->gift_value = $inputs['gift_value'];
            $transaction->teller_id = $inputs['teller_id'];
            $transaction->amount_payable = str_replace(',', '', $inputs['amount_payable']);
            $user->spending_amount += $newspend;
            $teller->received_amount += $newamountpayable;


            if($transaction->isDirty('customer') OR
                $transaction->isDirty('firstname') OR
                $transaction->isDirty('mode_of_payment') OR
                $transaction->isDirty('spending_amount') OR
                $transaction->isDirty('points') OR
                $transaction->isDirty('gift_value') OR
                $transaction->isDirty('teller_id') OR
                $transaction->isDirty('redeemable_gift_value') OR
                $transaction->isDirty('redeemable_points') OR
                $transaction->isDirty('amount_payable')

            ){
                $redeemable_points = $inputs['redeemable_points'];
                if ($userpoints<$redeemable_points){
                    Session::flash('enough_points', 'Insufficient Points!');
                    return back();
                }
                elseif ($userpoints>=$redeemable_points OR $userpoints == 0){
                    if (!empty(request()->redeemable_gift_value)){
                        $newredeemable_gift_value = str_replace(',','',$inputs['redeemable_gift_value']) - $transaction->redeemable_gift_value;
                        $newredeemable_points = $inputs['redeemable_points'] - $transaction->redeemable_points;

                        $transaction->redeemable_gift_value = str_replace(',', '', $inputs['redeemable_gift_value']);
                        $transaction->redeemable_points = $inputs['redeemable_points'];
                        $transaction->update();

                        $user->points += $newpoints - $newredeemable_points;
                        $user->gift_value += $newgift_value - $newredeemable_gift_value;
                        $user->save();
                        $teller->points_redeemed += $newredeemable_points;
                        $teller->gift_value_redeemed += $newredeemable_gift_value;
                        $teller->save();
                        Session::flash('updated_transaction', 'Transaction was successfully updated!');
                        return back();
                    }
                    else{
                        $transaction->update();
                        $user->points += $newpoints;
                        $user->gift_value += $newgift_value;
                        $user->save();
                        $teller->points_redeemed += $newpoints;
                        $teller->gift_value_redeemed += $newgift_value;
                        $teller->save();
                        Session::flash('updated_transaction', 'Transaction was successfully updated!');
                        return back();
                    }
                }

            }
            if($transaction->isClean('customer') OR
                $transaction->isClean('firstname') OR
                $transaction->isClean('mode_payment') OR
                $transaction->isClean('spending_amount') OR
                $transaction->isClean('points') OR
                $transaction->isClean('gift_value') OR
                $transaction->isClean('teller_id') OR
                $transaction->isClean('redeemable_gift_value') OR
                $transaction->isClean('redeemable_points') OR
                $transaction->isClean('amount_payable')

            ){
                session()->flash('updated_not','No changes made!');
                return back();
            }
            return back();

        }


    }

}
