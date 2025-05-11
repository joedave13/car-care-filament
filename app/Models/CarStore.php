<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function carStorePhotos(): HasMany
    {
        return $this->hasMany(CarStorePhoto::class);
    }

    public function carServices(): BelongsToMany
    {
        return $this->belongsToMany(CarService::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
