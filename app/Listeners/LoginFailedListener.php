<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Hash;
use IlluminateAuthEventsFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Inertia\Inertia;

class LoginFailedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(Failed $event): void
    {
        $credentials = $event->credentials;
        $user = User::withTrashed()->where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            session()->flash('error', value: 'Akun Anda ditangguhkan. Silakan hubungi administrator untuk informasi lebih lanjut.');
        }
    }
}
