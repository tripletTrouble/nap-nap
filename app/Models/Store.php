<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[ScopedBy(UserScope::class)]
class Store extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;
    
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function settings()
    {
        return $this->hasMany(StoreSetting::class);
    }
}
