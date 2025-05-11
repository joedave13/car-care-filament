<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function carStores(): HasMany
    {
        return $this->hasMany(CarStore::class);
    }
}
