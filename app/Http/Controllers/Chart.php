<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class Chart extends Controller
{
    //
    public function index()
    {



        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');

        $months = User::select(DB::raw("Month(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');

        $items = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach ($months as $index => $month)
        {
            $items[$month - 1]=$users[$index];
        }

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

        $userss = $user3->count();


        return view('index', compact('items'))->with('customers', $customers)->with('tellers', $tellers)->with('userss',$userss);
    }

}
