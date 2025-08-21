<?php

namespace App\Providers;
use App\Events\UserLoginEvent;
use App\Listeners\UserLoginListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
    UserLoginEvent::class => [
        UserLoginListener::class,
    ],
];
}
