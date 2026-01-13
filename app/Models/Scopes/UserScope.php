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
            if (method_exists($model, 'users')) {
                $builder->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('users.id', $user->id);
                });
            } else {
                // If the model does not have a 'users' relationship, restrict all results
                $builder->whereHas('user', function (Builder $query) use ($user) {
                    $query->where('users.id', $user->id);
                });
            }
        }
    }
}
