<?php

namespace App\Models\Scopes;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        /**
         * @var User
         */
        $user = auth()->user();

        if ($user && !$user->roles()->where('name', RoleEnum::ADMIN)->exists()) {
            $builder->where('user_id', $user->id);
            return;
        }
    }
}
