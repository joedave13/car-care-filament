<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarStore extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'city_id',
        'is_open',
        'is_full',
        'address',
        'customer_service_name',
        'customer_service_phone',
        'customer_service_avatar',
    ];

    protected function casts(): array
    {
        return [
            'city_id' => 'integer',
            'is_open' => 'boolean',
            'is_full' => 'boolean'
        ];
    }
}
