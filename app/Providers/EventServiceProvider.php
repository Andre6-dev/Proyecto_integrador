<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        
        Illuminate\Cache\Events\CacheHit::class => [
            App\Listeners\LogCacheHit::class,
        ],
    
        Illuminate\Cache\Events\CacheMissed::class => [
            App\Listeners\LogCacheMissed::class,
        ],
    
        Illuminate\Cache\Events\KeyForgotten::class => [
            App\Listeners\LogKeyForgotten::class,
        ],
    
        Illuminate\Cache\Events\KeyWritten::class => [
            App\Listeners\LogKeyWritten::class,
        ],
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
