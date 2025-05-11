<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CarServiceCarStore extends Pivot
{
    public $incrementing = true;

    protected $fillable = [
        'car_service_id',
        'car_store_id'
    ];

    protected function casts(): array
    {
        return [
            'car_service_id' => 'integer',
            'car_store_id' => 'integer'
        ];
    }
}
