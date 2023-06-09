<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('super', function (User $user) {
            // return $user->is_admin == true;
            return $user->role->name === 'Super Admin';
            // return $user->is_admin;
        });
        Gate::define('admin', function (User $user) {
            // return $user->is_admin == true;
            return $user->role->name === 'Admin';
            // return $user->is_admin;
        });
    }
}
