<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Nexmo\Laravel\Facade\Nexmo;
use PhpParser\Node\Expr\Cast\Int_;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    //

    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }

    public function show($user){

        $id = base64_decode($user);
        $user_data = User::find($id);

        return view('users.profile', [
            'user'=>$user_data,
            'roles'=>Role::all(),
        ]);
    }
    public function userIndex(){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            $users = User::all();
            return view('users.index', [
                'users' => $users,
                'roles' => Role::all(),
            ]);
        }
    }

    public function userCreate(){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else{
            return view('users.create');
        }

    }

    public function userStore(){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            request()->validate([
                'username' => ['required', 'string', 'max:20', 'alpha_dash', 'unique:users'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'digits:9', 'unique:users'],
                'gender' => ['required', 'notIn:0'],
                'birthday'=> ['required'],
                'password' => ['confirmed'],
                'address' => ['required', 'string', 'max:255'],
                'role1' => ['required', 'in:1,2,3'],
                'role2' => ['sometimes'],
                'role3' => ['sometimes'],
            ]);
            $current = Carbon::now();
            $country_code = '+255';
            $phone_number = $country_code.request('phone_number');
            $user = User::create([
                'username' => request('username'),
                'firstname' => Str::ucfirst(request('firstname')),
                'lastname' => Str::ucfirst(request('lastname')),
                'email' => request('email'),
                'phone_number' => $phone_number,
                'gender' => request('gender'),
                'date_of_birth' => date("Y-m-d", strtotime(request('birthday'))),
                'password' => Hash::make(request('password')),
                'address' => Str::ucfirst(request('address')),
                'reset_at' => $current->addDays(365),
            ]);
            $user->roles()->attach(request('role1'));

            if (request('role2') != 0) {
                $user->roles()->attach(request('role2'));
            }
            if (request('role3') != 0) {
                $user->roles()->attach(request('role3'));
            }
            Session::flash('created_user', 'The User was Successfully Created');
//        User::sendWelcomeEmail($user);
            $expiresAt = now()->addMinutes(5);

            $user->sendWelcomeNotification($expiresAt);

            Nexmo::message()->send([
                'to'   => $phone_number,
                'from' => '+255767887898',
                'text' => 'Thank you for joining the Fléx loyalty program!'
            ]);
            return back();
        }


    }
    public function tellerIndex(){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {

            $users = User::whereHas('roles', function ($q) {
                $q->where('id', '2');
            })->get();
            return view('tellers.index', [
                'users' => $users,
                'roles' => Role::all(),
            ]);
        }
    }

    public function tellerCreate(){
        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            return view('tellers.create');
        }
    }

    public function tellerStore(){
        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            request()->validate([
                'username' => ['required', 'string', 'max:20', 'alpha_dash', 'unique:users'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'digits:9', 'unique:users'],
                'birthday'=> ['required'],
                'gender' => ['required', 'notIn:0'],
                'password' => ['confirmed'],
                'address' => ['required', 'string', 'max:255'],
            ]);
            $current = Carbon::now();
            $country_code = '+255';
            $phone_number = $country_code.request('phone_number');
            $user = User::create([
                'username' => request('username'),
                'firstname' => Str::ucfirst(request('firstname')),
                'lastname' => Str::ucfirst(request('lastname')),
                'email' => request('email'),
                'phone_number' => $phone_number,
                'gender' => request('gender'),
                'date_of_birth' => date("Y-m-d", strtotime(request('birthday'))),
                'password' => Hash::make(request('password')),
                'address' => Str::ucfirst(request('address')),
                'reset_at' => $current->addDays(365),

            ]);
            $user->roles()->attach('2');
            Session::flash('created_teller', 'Teller was Successfully Created');
            $expiresAt = now()->addMinutes(5);

            $user->sendWelcomeNotification($expiresAt);

            Nexmo::message()->send([
                'to'   => $phone_number,
                'from' => '+255767887898',
                'text' => 'Thank you for joining the Fléx loyalty program!'
            ]);
            return back();
        }
    }

    public function customerCreate(){
        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            return view('customers.create');
        }
    }

    public function customerStore(){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            request()->validate([
                'username' => ['required', 'string', 'max:20', 'alpha_dash', 'unique:users'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'digits:9', 'unique:users'],
                'birthday'=> ['required'],
                'gender' => ['required', 'notIn:0'],
                'password' => ['confirmed'],
                'address' => ['required', 'string', 'max:255'],
            ]);
            $current = Carbon::now();
            $country_code = '+255';
            $phone_number = $country_code.request('phone_number');
            $user = User::create([
                'username' => request('username'),
                'firstname' => Str::ucfirst(request('firstname')),
                'lastname' => Str::ucfirst(request('lastname')),
                'email' => request('email'),
                'phone_number' => $phone_number,
                'gender' => request('gender'),
                'date_of_birth' => date("Y-m-d", strtotime(request('birthday'))),
                'password' => Hash::make(request('password')),
                'address' => Str::ucfirst(request('address')),
                'reset_at' => $current->addDays(365),

            ]);
            $user->roles()->attach('3');
            Session::flash('created_customer', 'Customer was Successfully Created');
            $expiresAt = now()->addMinutes(5);

            $user->sendWelcomeNotification($expiresAt);

            Nexmo::message()->send([
                'to'   => $phone_number,
                'from' => '+255767887898',
                'text' => 'Thank you for joining the Fléx loyalty program!'
            ]);
            return back();
        }
    }


    public function customerIndex(){

        $users = User::whereHas('roles', function($q){
            $q->where('id', '3');
        })->get();
        return view('customers.index',[
            'users'=>$users,
            'roles'=>Role::all(),
        ]);
    }

    public function update(User $user){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            $inputs = request()->validate([
                'username' => ['required', 'string', 'max:20', 'alpha_dash'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'gender' => ['required', 'notIn:0'],
//            'password'=> ['confirmed'],
                'address' => ['required', 'string', 'max:255'],
            ]);

            $user->username = $inputs['username'];
            $user->firstname = Str::ucfirst($inputs['firstname']);
            $user->lastname = Str::ucfirst($inputs['lastname']);
            $user->email = $inputs['email'];
            $user->gender = $inputs['gender'];
//        $user->password = Hash::make($inputs['password']);
            $user->address = Str::ucfirst($inputs['address']);

            if ($user->isDirty('username') or
                $user->isDirty('firstname') or
                $user->isDirty('lastname') or
                $user->isDirty('email') or
                $user->isDirty('gender') or
                $user->isDirty('address')
            ) {
                $user->update();
                Session::flash('updated_user', 'User was successfully updated!');
                return back();
            }
            if ($user->isClean('username') or
                $user->isClean('firstname') or
                $user->isClean('lastname') or
                $user->isClean('email') or
                $user->isClean('gender') or
                $user->isClean('address')
            ) {
                session()->flash('updated_not', 'No changes made!');
                return back();
            }
        }
    }

    public function attach(User $user){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            $user->roles()->attach(request('role'));
            return back();
        }
    }

    public function detach(User $user){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            $user->roles()->detach(request('role'));
            return back();
        }
    }

    public function destroy(Request $request){

        if(Gate::denies('isAdmin')){
            abort(401);
        }
        else {
            //dd($request->all());
            //$user->delete();
            try {
                User::destroy($request->user_id);
                session()->flash('user_deleted', 'The user has been deleted');
                return back();
            } catch (Exception $exception) {
                session()->flash('user_deleted', 'error');
                return back();
            }
        }

    }

    public function checkReset(){
        $users = User::all();

        foreach ($users as $user){
            if (Carbon::now()->eq($user->reset_at)){
                $user->points = 0;
                $user->gift_value = 0;
                $user->reset_at = Carbon::now()->addDays(365);
            }
        }
    }

}
