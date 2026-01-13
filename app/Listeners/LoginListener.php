<?php

namespace App\Listeners;

use App\Enums\RoleEnum;
use App\Models\Store;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LoginListener
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        /**
         * @var User
         */
        $user = $event->user;

        if (!$user->roles()->where('name', RoleEnum::ADMIN)->exists()) {
            /**
             * @var Store
             */
            $store = $user->stores()->with('settings')->first();

            if ($store) {
                // Set store in session
                session(['store' => $store]);
            }

            // Set role in session
            session(['role' => 'user']);
            return;
        }

        session(['role' => 'admin']);
        return;
    }
}
