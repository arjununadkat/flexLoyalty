<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use \Spatie\WelcomeNotification\ReceivesWelcomeNotification;
use Spatie\WelcomeNotification\WelcomeNotification;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded= [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendWelcomeNotification(Carbon $validUntil)
    {
        $this->notify(new WelcomeNotification($validUntil));
    }

    public function markAsInitialPasswordSet()
    {
        $this->welcome_valid_until = null;
        $this->save();

        return $this;
    }

    public static function sendWelcomeEmail($user)
    {
        $token = app('auth.password.broker')->createToken($user);

        // Send email
        Mail::send('emails.welcome', ['user' => $user, 'token' => $token], function ($m) use ($user) {
            $m->from('unadkat.arjun@gmail.com', 'Your App Name');

            $m->to($user->email, $user->name)->subject('Welcome to APP');
        });
    }


    public function roles(){

        return $this->belongsToMany(Role::class);

    }

    public function userHasRole($role_name){

        foreach ($this->roles as $role){
            if(Str::lower($role_name)==Str::lower($role->name))
                return true;
        }
        return false;
    }

    public function transactions(){

        return $this->hasMany(Transaction::class);
    }


}
