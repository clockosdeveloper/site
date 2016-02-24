<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \App\Http\Middleware\Languages::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'manager' => \App\Http\Middleware\RedirectIfNotManager::class,
        'profile' => \App\Http\Middleware\MustFillProfiles::class,
        'check' => \App\Http\Middleware\CheckProfile::class,
        'sponsor' => \App\Http\Middleware\CheckSponsor::class,
        'add_outcome' => \App\Http\Middleware\CanAddOutcome::class,
        'check_outcome' => \App\Http\Middleware\CanCheckOutcome::class,
        'edit_document' => \App\Http\Middleware\CanEditDoc::class,
        'add_permission' => \App\Http\Middleware\CanEditDoc::class,
    ];
}
