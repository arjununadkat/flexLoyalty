<?php

namespace App\Http\Controllers;


use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProjectController extends Controller
{
    //


    public function index(){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else{
            return view('projects.index');
        }

    }

    public function store(){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else{
            request()->validate([

                'currency'=>'required|not_in:0',
                'minimum_spending'=>'required',
                'gift_value'=>'required',
                'gvp'=>'required',
                'constants'=>'required',
                'benefit_value'=>'required',
            ]);

            Project::create([

                'currency_id'=>request('currency'),
                'minimum_spending'=>str_replace(',', '', request('minimum_spending')),
                'gift_value'=>str_replace(',', '', request('gift_value')),
                'gift_value_points'=>request('gvp'),
                'constant'=>request('constants'),
                'benefit_value'=>request('benefit_value'),

            ]);

            //auth()->user()->posts()->create($inputs);
            Session::flash('projectCreated', 'Project was successfully created!');

            return back();

        }
    }
}
