<?php

namespace App\Observers;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\Store;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $store = Store::create([
            'name' => $user->name . "'s Store",
            'code' => '000',
        ]);

        $role = Role::where('name', RoleEnum::USER->value)->first();

        $user->roles()->attach($role->id);
        $user->stores()->attach($store->id);
    }
}
