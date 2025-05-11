<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarService extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'icon',
        'photo',
        'duration_in_hour'
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'duration_in_hour' => 'integer'
        ];
    }
}
