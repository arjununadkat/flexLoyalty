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
            'mode_of_payment'=> ['required'],
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

        //dd($request->all());
        //$user->delete();
        Transaction::destroy($request->transaction_id);
        session()->flash('transaction_deleted', 'The transaction has been deleted');
        return back();

    }

//    public function destroy(Transaction $transaction){
//
//        //dd($request->all());
//        //$user->delete();
//        try {
//            Transaction::destroy($transaction->id);
//            $transaction->delete();
//            session()->flash('transaction_deleted', 'The transaction has been deleted');
//            return back();
//        }catch (Exception $exception){
//            session()->flash('transaction_deleted', 'error');
//            return back();
//        }
//
//    }

}
