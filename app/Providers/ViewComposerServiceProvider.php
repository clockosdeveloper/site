<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Notification;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('partials.nav',function($view)
        {
            //显示未读通知数目
            $notifications_number = Notification::where('user_id', \Auth::id())
                ->where('isread', false)
                ->count();

            /**
             *      头像链接
             */
            if(\Auth::check()){
                $avatar = \Auth::user()->avatar;

                if (strstr($avatar, env('STR_URL'))){   //若头像是存储在clockos中的话
                    $avatar = $avatar.'!35';          //35像素的缩略图
                }

                $view->with(compact('avatar','notifications_number'));
            }

        });


        /**
         * 高亮菜单用
         */
        view()->composer('*', function ($view) {

            $current_route_name = \Request::segment(1);
            $current_sub_route  = \Request::segment(2);

            $manage = array("check");
            if(in_array($current_route_name,$manage)){
                $current_route_name = 'manage';
            }

            $project = array("docs");
            if(in_array($current_route_name,$project)){
                $current_route_name = 'quests';
            }

            $view->with(compact('current_route_name','current_sub_route'));

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
