<?php

namespace App\Providers;

use App\Models\permission;
use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user){
            if($user->is_admin()){
                return true;
            }
        });
        foreach (permission::all() as $permission) {
        Gate::define($permission->name , function($user)use($permission){
            if($user->is_staff()){
                return $user->hasPermission($permission);
            }
        });
        }
    }
}
