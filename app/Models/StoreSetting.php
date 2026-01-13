<?php

namespace App\Models;

use App\Enums\StoreSettingEnum;
use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy(StoreScope::class)]
class StoreSetting extends Model
{
    protected $fillable = [
        'store_id',
        'key',
        'value',
    ];

    public function casts() {
        return [
            'key' => StoreSettingEnum::class,
        ];
    }
}
