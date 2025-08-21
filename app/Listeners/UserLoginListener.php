<?php

namespace App\Listeners;
use App\Events\UserLoginEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserLoginMail;

class UserLoginListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLoginEvent  $event): void
    {
        $user = $event->user;
        Mail::to($user->email)->send(new UserLoginMail($user));
    }
}
