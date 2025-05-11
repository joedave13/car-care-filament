<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarStorePhoto extends Model
{
    protected $fillable = [
        'car_store_id',
        'photo'
    ];

    protected function casts(): array
    {
        return [
            'car_store_id' => 'integer'
        ];
    }

    public function carStore(): BelongsTo
    {
        return $this->belongsTo(CarStore::class);
    }
}
