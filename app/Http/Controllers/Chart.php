<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class Chart extends Controller
{
    //
    public function index()
    {



//        $users = User::select(DB::raw("COUNT(*) as count"))
//            ->whereYear('created_at', date('Y'))
//            ->groupBy(DB::raw("Month(created_at)"))
//            ->pluck('count');
//
//        $months = User::select(DB::raw("Month(created_at) as month"))
//            ->whereYear('created_at', date('Y'))
//            ->groupBy(DB::raw("Month(created_at)"))
//            ->pluck('month');
//
//        $items = array(0,0,0,0,0,0,0,0,0,0,0,0);
//        foreach ($months as $index => $month)
//        {
//            $items[$month - 1]=$users[$index];
//        }

        $users = User::select(DB::raw("COUNT(*) as users"),DB::raw("DATE_FORMAT(created_at,'%M') month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at,'%M')"))
            ->orderby('created_at','asc')
            ->get();

        $first_c = [];
        $first_v = [];
        foreach ($users as $index => $user){
            //x-axis
            array_push($first_c,$user->month,);
            //y-axis
            array_push($first_v,array($index,(0 +$user->users)));
        }
//        dd($first_v);

        $rd_values = Transaction::select(DB::raw("SUM(redeemable_gift_value) as value"),
            DB::raw("DATE_FORMAT(created_at,'%M') month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at,'%M')"))
            ->orderby('created_at','asc')
            ->get();

//        dd($rd_values);

        $second_c = [];

        $second_v = [];
        foreach ($rd_values as $index => $rd_value){
            //x-axis
            array_push($second_c,$rd_value->month,);
            //y-axis
//            array_push($second_v,$rd_value->value);
            array_push($second_v,array($index,(0 +$rd_value->value)));
//            $second_v[$index] = 0+$rd_value->value;
        }

//        dd($second_v);

        $spending_amounts = Transaction::select(DB::raw("SUM(spending_amount) as sa"),
            DB::raw("DATE_FORMAT(created_at,'%M') month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at,'%M')"))
            ->orderby('created_at','asc')
            ->get();

        $third_c = [];

        $third_v = [];
        foreach ($spending_amounts as $index => $s_a){
            //x-axis
            array_push($third_c,$s_a->month,);
            //y-axis
            array_push($third_v,array($index,(0+$s_a->sa)));
        }

        $transactions_made = Transaction::select(DB::raw("COUNT(*) as transactions_count"),
            DB::raw("DATE_FORMAT(created_at,'%M') month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at,'%M')"))
            ->orderby('created_at','asc')
            ->get();

//        dd($transactions_made);
        $fourth_c = [];

        $fourth_v = [];
        foreach ($transactions_made as $index => $t_made){
            //x-axis
            array_push($fourth_c,$t_made->month,);
            //y-axis
            array_push($fourth_v,array($index,(0+$t_made->transactions_count)));
        }
//        dd($fourth_c);


        $teller_transactions_made = Transaction::select(DB::raw("COUNT(*) as transactions_count")
            ,'teller_id')
            ->groupBy(DB::raw("teller_id"))
            ->get();

        $fifth_c = [];
        $fifth_v = [];
        foreach ($teller_transactions_made as $index => $value){
            //x-axis
            array_push($fifth_c,$value->user['firstname'],);
            //y-axis
            array_push($fifth_v,array($index,(0 + $value->transactions_count)));
        }


        $teller_received_amount= Transaction::select(DB::raw("SUM(amount_payable) as amount_received")
            ,'teller_id')
            ->groupBy(DB::raw("teller_id"))
            ->get();

//        dd($teller_received_amount);

        $sixth_c = [];
        $sixth_v = [];
        foreach ($teller_received_amount as $index => $value){
            //x-axis
            array_push($sixth_c,$value->user['firstname'],);
            //y-axis
            array_push($sixth_v,array($index,(0+$value->amount_received)));
        }
//    dd($data_c1);


        $user = User::whereHas(
            'roles', function($q){
            $q->where('name', 'Customer');
        }
        )->get();
        $customers = $user->count();

        $user2 = User::whereHas(
            'roles', function($q){
            $q->where('name', 'Teller');
        }
        )->get();

        $tellers = $user2->count();
        $user3 = User::all();

        $project = Project::latest()->first();
//        dd($project);
        $project_days = $project->created_at;
        $now = Carbon::now();
        $diff = $project_days->diffInDays($now);
//        dd($project_days);


        $number_of_users = $user3->count();

        $trans = Transaction::all();
        $number_of_transactions = $trans->count();
//dd(json_decode($users));
        return view('index', compact('users',
            'first_c','first_v',
            'second_c','second_v',
            'third_c','third_v',
            'fourth_c','fourth_v',
            'fifth_c','fifth_v',
            'sixth_c','sixth_v'))
            ->with('customers', $customers)
            ->with('tellers', $tellers)
            ->with('number_of_users',$number_of_users)
            ->with('rd_values', $rd_values)
            ->with('spending_amount', $spending_amounts)
            ->with('transactions_made', $transactions_made)
            ->with('teller_transactions_made', $teller_transactions_made)
            ->with('number_of_transactions', $number_of_transactions)
            ->with('diff', $diff)
            ->with('teller_amount_received', $teller_received_amount);
    }

}
