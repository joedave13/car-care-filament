<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
