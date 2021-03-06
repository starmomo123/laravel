<?php

namespace App\Providers;

use App\AdminPermission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permisisons=AdminPermission::all();
        foreach ($permisisons as $permission){
            //注册一个门卫，来保卫权限
            Gate::define($permission->name,function($user) use($permission){
                return $user->hasPermission($permission);
            });
        }
        //
    }
}
