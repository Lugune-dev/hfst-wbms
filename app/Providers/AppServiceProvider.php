<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            if ($event->user instanceof \App\Models\User) {
                \App\Models\ActivityLog::record(
                    'LOGIN',
                    "Mtumiaji {$event->user->name} ameingia kwenye mfumo kupitia " . request()->path(),
                    $event->user
                );
            }
        });

        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Logout::class, function ($event) {
            if ($event->user instanceof \App\Models\User) {
                \App\Models\ActivityLog::record(
                    'LOGOUT',
                    "Mtumiaji {$event->user->name} ametoka kwenye mfumo",
                    $event->user
                );
            }
        });

        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Failed::class, function ($event) {
            \App\Models\ActivityLog::record(
                'LOGIN_FAILED',
                "Jaribio la kuingia halikufaulu kwa barua pepe: " . ($event->credentials['email'] ?? 'N/A'),
                $event->user
            );
        });

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}

