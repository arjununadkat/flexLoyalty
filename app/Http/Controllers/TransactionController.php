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

    public function create(){
        return view('transactions.create',[
            'users'=>User::all(),
            'project'=>Project::latest()->first()
        ]);
    }

    public function store(){

        request()->validate([
            'customer'=> ['required'],
            'firstname'=> ['required'],
            'mode_of_payment'=> ['required', 'notIn:0'],
            'spending_amount'=> ['required'],
            'points'=> ['required'],
            'gift_value'=> ['required'],
            'teller_id'=> ['required'],

        ]);
        Transaction::create([
            'user_id'=>request('customer'),
            'firstname'=>Str::ucfirst(request('firstname')),
            'mode_of_payment'=>request('mode_of_payment'),
            'spending_amount'=>str_replace(',', '', request('spending_amount')),
            'points'=>request('points'),
            'gift_value'=>request('gift_value'),
            'teller_id'=>request('teller_id'),

        ]);

        $user = User::find(request('customer'));

        $user->transactions_number += 1;
        $user->spending_amount += str_replace(',', '', request('spending_amount'));
        $user->points += request('points');
        $user->gift_value += request('gift_value');
        $user->save();

        Session::flash('created_transaction', 'The Transaction was Successfully Created');
        return back();
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
        return back();

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
        ]);

        $transaction->user_id = $inputs['customer'];
        $transaction->firstname = Str::ucfirst($inputs['firstname']);
        $transaction->mode_of_payment = $inputs['mode_of_payment'];
        $transaction->spending_amount = str_replace(',', '', $inputs['spending_amount']);
        $transaction->points = $inputs['points'];
        $transaction->gift_value = $inputs['gift_value'];
        $transaction->teller_id = $inputs['teller_id'];

        if($transaction->isDirty('customer') OR
            $transaction->isDirty('firstname') OR
            $transaction->isDirty('mode_of_payment') OR
            $transaction->isDirty('spending_amount') OR
            $transaction->isDirty('points') OR
            $transaction->isDirty('gift_value') OR
            $transaction->isDirty('teller_id')

        ){
            $transaction->update();

            $user = User::find($inputs['customer']);
            $user->spending_amount += str_replace(',', '', $inputs['spending_amount']);
            $user->points += $inputs['points'];
            $user->gift_value += $inputs['gift_value'];
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
            $transaction->isClean('teller_id')

        ){
            session()->flash('updated_not','No changes made!');
            return back();
        }
    }

}
