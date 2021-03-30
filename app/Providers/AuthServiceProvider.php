<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();



        /* define a admin user role */
        Gate::define('isAdmin', function($user) {
            return $user->hasRole('Admin');
        });

        /* define a teller user role */
        Gate::define('isTeller', function($user) {
            return $user->hasRole('Teller');
        });

        /* define a customer role */
        Gate::define('isCustomer', function($user) {
            return $user->hasRole('Customer');
        });
        //
    }
}
