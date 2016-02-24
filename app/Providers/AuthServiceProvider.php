<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Permission;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        $gate->define('update', function($user, $item){
            return $user->owns($item);
        });

        //判断用户等级是否可以查看此任务
        $gate->define('min_level', function($user, $task){
            return ($user->level >= $task->min_level) OR ($user->id == $task->user_id) OR ($user->hasRole('ceo'));
        });

        //判断用户等级是否可以参与投票
        $gate->define('can_vote', function($user, $task){
            $permission = ((($user->level >= $task->min_level)AND($user->voting >= $task->min_vote)) OR ($user->id == $task->user_id) OR ($user->hasRole('ceo')));
            return $permission;
        });

        //判断用户是否可以查看此用户的资料
        $gate->define('view_profile', function($user, $profile){
            return ($user->level >= $profile->level)
            OR ($user->id == $profile->id)
            OR ($user->hasRole('ceo'))
            OR ($user->id == $profile->sponsor_id)
            OR ($user->sponsor_id == $profile->id);
        });

    }
}
