<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
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
                $user->save();
                $teller->points_given += request('redeemable_points');
                $teller->gift_value_given += str_replace(',', '', request('redeemable_gift_value'));
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

        Transaction::destroy($request->transaction_id);
        session()->flash('transaction_deleted', 'The transaction has been deleted');
        return redirect()->route('transactions.index');

    }
    public function show(Transaction $transaction){

        return view('transactions.show', [
            'transaction'=>$transaction,
            'project'=>Project::latest()->first()
        ]);
    }

    public function update(Transaction $transaction){
        $inputs = request()->validate([
            'customer'=> ['required'],
            'firstname'=> ['required'],
            'mode_of_payment'=> ['required', 'notIn:0'],
            'spending_amount'=> ['required'],
            'points'=> ['required'],
            'gift_value'=> ['required'],
            'teller_id'=> ['required'],
            'redeemable_gift_value'=> ['required'],
            'redeemable_points'=> ['required'],
            'amount_payable'=> ['required'],
        ]);

        $newspend = str_replace(',','',$inputs['spending_amount']) - $transaction->spending_amount;
        $newpoints = $inputs['points'] - $transaction->points;
        $newgift_value = $inputs['gift_value'] - $transaction->gift_value;
        $newredeemable_gift_value = str_replace(',','',$inputs['redeemable_gift_value']) - $transaction->redeemable_gift_value;
        $newredeemable_points = $inputs['redeemable_points'] - $transaction->redeemable_points;


        $transaction->user_id = $inputs['customer'];
        $transaction->firstname = Str::ucfirst($inputs['firstname']);
        $transaction->mode_of_payment = $inputs['mode_of_payment'];
        $transaction->spending_amount = str_replace(',', '', $inputs['spending_amount']);
        $transaction->points = $inputs['points'];
        $transaction->gift_value = $inputs['gift_value'];
        $transaction->teller_id = $inputs['teller_id'];
        $transaction->redeemable_gift_value = str_replace(',', '', $inputs['redeemable_gift_value']);
        $transaction->redeemable_points = $inputs['redeemable_points'];
        $transaction->amount_payable = str_replace(',', '', $inputs['amount_payable']);

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
            $transaction->update();

            $user = User::find($inputs['customer']);

            $user->spending_amount += $newspend;
            $user->points += $newpoints - $newredeemable_points;
            $user->gift_value += $newgift_value - $newredeemable_gift_value;


            $user->save();
            Session::flash('updated_transaction', 'Transaction was successfully updated!');
            return back();
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
    }

}
