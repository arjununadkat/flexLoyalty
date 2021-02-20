<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //

    public function show(User $user){

        return view('users.profile', [
            'user'=>$user,
            'roles'=>Role::all(),
        ]);
    }
    public function userIndex(){

        $users = User::all();
        return view('users.index',[
            'users'=>$users,
            'roles'=>Role::all(),
        ]);
    }

    public function userCreate(){
        return view('users.create');
    }

    public function userStore(){

        request()->validate([
            'username'=> ['required', 'string', 'max:20', 'alpha_dash', 'unique:users'],
            'firstname'=> ['required', 'string', 'max:255'],
            'lastname'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'max:255', 'unique:users'],
            'gender'=> ['required', 'notIn:0'],
            'password'=> ['confirmed'],
            'address'=> ['required', 'string', 'max:255'],
            'role1'=> ['required','in:1,2,3'],
            'role2'=> ['sometimes'],
            'role3'=> ['sometimes'],
        ]);
        $user = User::create([
            'username'=>request('username'),
            'firstname'=>Str::ucfirst(request('firstname')),
            'lastname'=>Str::ucfirst(request('lastname')),
            'email'=>request('email'),
            'gender'=>request('gender'),
            'password'=>Hash::make(request('password')),
            'address'=>Str::ucfirst(request('address')),

        ]);
        $user->roles()->attach(request('role1'));

        if(request('role2')!=0) {
            $user->roles()->attach(request('role2'));
        }
        if(request('role3')!=0) {
            $user->roles()->attach(request('role3'));
        }
        Session::flash('created_user', 'The User was Successfully Created');
        return back();
    }
    public function tellerIndex(){

        $users = User::whereHas('roles', function($q){
            $q->where('name', 'Teller');
        })->get();
        return view('tellers.index',[
            'users'=>$users,
            'roles'=>Role::all(),
        ]);
    }

    public function tellerCreate(){
        return view('tellers.create');
    }

    public function tellerStore(){

        request()->validate([
            'username'=> ['required', 'string', 'max:20', 'alpha_dash', 'unique:users'],
            'firstname'=> ['required', 'string', 'max:255'],
            'lastname'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'max:255', 'unique:users'],
            'gender'=> ['required', 'notIn:0'],
            'password'=> ['confirmed'],
            'address'=> ['required', 'string', 'max:255'],
        ]);
        $user = User::create([
            'username'=>request('username'),
            'firstname'=>Str::ucfirst(request('firstname')),
            'lastname'=>Str::ucfirst(request('lastname')),
            'email'=>request('email'),
            'gender'=>request('gender'),
            'password'=>Hash::make(request('password')),
            'address'=>Str::ucfirst(request('address')),

        ]);
        $user->roles()->attach('2');
        Session::flash('created_teller', 'Teller was Successfully Created');
        return back();
    }

    public function customerCreate(){
        return view('customers.create');
    }

    public function customerStore(){

        request()->validate([
            'username'=> ['required', 'string', 'max:20', 'alpha_dash', 'unique:users'],
            'firstname'=> ['required', 'string', 'max:255'],
            'lastname'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'max:255', 'unique:users'],
            'gender'=> ['required', 'notIn:0'],
            'password'=> ['confirmed'],
            'address'=> ['required', 'string', 'max:255'],
        ]);
        $user = User::create([
            'username'=>request('username'),
            'firstname'=>Str::ucfirst(request('firstname')),
            'lastname'=>Str::ucfirst(request('lastname')),
            'email'=>request('email'),
            'gender'=>request('gender'),
            'password'=>Hash::make(request('password')),
            'address'=>Str::ucfirst(request('address')),

        ]);
        $user->roles()->attach('3');
        Session::flash('created_customer', 'Customer was Successfully Created');
        return back();
    }


    public function customerIndex(){

        $users = User::whereHas('roles', function($q){
            $q->where('name', 'Costumer');
        })->get();
        return view('customers.index',[
            'users'=>$users,
            'roles'=>Role::all(),
        ]);
    }

    public function update(User $user){
        $inputs = request()->validate([
            'username'=> ['required', 'string', 'max:20', 'alpha_dash'],
            'firstname'=> ['required', 'string', 'max:255'],
            'lastname'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email', 'max:255'],
            'gender'=> ['required', 'notIn:0'],
//            'password'=> ['confirmed'],
            'address'=> ['required', 'string', 'max:255'],
        ]);

        $user->username = $inputs['username'];
        $user->firstname = Str::ucfirst($inputs['firstname']);
        $user->lastname = Str::ucfirst($inputs['lastname']);
        $user->email = $inputs['email'];
        $user->gender = $inputs['gender'];
//        $user->password = Hash::make($inputs['password']);
        $user->address = Str::ucfirst($inputs['address']);

        if($user->isDirty('username') OR
            $user->isDirty('firstname') OR
            $user->isDirty('lastname') OR
            $user->isDirty('email') OR
            $user->isDirty('gender') OR
            $user->isDirty('address')
        ){
            $user->update();
            Session::flash('updated_user', 'User was successfully updated!');
            return back();
        }if($user->isClean('username') OR
            $user->isClean('firstname') OR
            $user->isClean('lastname') OR
            $user->isClean('email') OR
            $user->isClean('gender') OR
            $user->isClean('address')
        ){
            session()->flash('updated_not','No changes made!');
            return back();
        }
    }

    public function attach(User $user){

        $user->roles()->attach(request('role'));
        return back();
    }

    public function detach(User $user){

        $user->roles()->detach(request('role'));
        return back();
    }
}