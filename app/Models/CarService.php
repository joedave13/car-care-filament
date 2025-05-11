<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function carStores(): BelongsToMany
    {
        return $this->belongsToMany(CarStore::class);
    }
}
