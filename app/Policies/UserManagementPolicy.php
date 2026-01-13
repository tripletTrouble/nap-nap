<?php

namespace App\Policies;

use App\Models\User;

class UserManagementPolicy
{
    public function manageUsers(): bool
    {
        return session('role') === 'admin';
    }    
}
