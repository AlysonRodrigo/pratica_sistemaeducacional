<?php

namespace Cookie\Providers;

use Cookie\Models\Admin;
use Cookie\Models\Student;
use Cookie\Models\Teacher;
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
        'Cookie\Model' => 'Cookie\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::define('admin', function ($user){
            return $user->userable instanceof Admin;
        });

        \Gate::define('teacher', function($user){
            return $user->userable instanceof Teacher;
        });

        \Gate::define('student', function($user){
            return $user->userable instanceof Student;
        });
    }
}
