<?php

namespace App\Http\Middleware;

use Closure;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class Languages{
    public function handle($request, Closure $next)
    {
        if (Session::has('applocale')) {
            \App::setLocale(Session::get('applocale'));
            Carbon::setLocale(Session::get('applocale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            \App::setLocale(Config::get('app.fallback_locale'));
            Carbon::setLocale(Config::get('app.fallback_locale'));
        }
        return $next($request);
    }
}
