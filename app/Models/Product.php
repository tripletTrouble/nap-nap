<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy(StoreScope::class)]
class Product extends Model
{
    protected $fillable = [
        'store_id',
        'name',
        'description',
        'price',
        'unit',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
