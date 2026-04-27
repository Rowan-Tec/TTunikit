<?php

namespace App\Providers;

use App\Listeners\LogLoginActivity;
use App\Listeners\SendPasswordResetNotification;
use App\Listeners\SendWelcomeNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendWelcomeNotification::class,
        ],
        PasswordReset::class => [
            SendPasswordResetNotification::class,
        ],
        Login::class => [
            LogLoginActivity::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }
}
