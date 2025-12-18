<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Store extends Model implements HasMedia
{
    use InteractsWithMedia;
    
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
}
