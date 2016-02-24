<?php

namespace App\Http\Middleware;

use Closure;

class CanEditDoc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::user()->can('edit_document')) {
            return $next($request);
        }

        return redirect('/docs');
    }
}
