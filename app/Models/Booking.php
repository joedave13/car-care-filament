<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'code',
        'name',
        'phone',
        'car_store_id',
        'car_service_id',
        'started_date',
        'started_time',
        'price',
        'booking_fee',
        'vat',
        'grand_total',
        'payment_status',
        'payment_proof',
    ];

    protected function casts(): array
    {
        return [
            'started_date' => 'date',
            'started_time' => 'time',
            'price' => 'integer',
            'booking_fee' => 'integer',
            'vat' => 'integer',
            'grand_total' => 'integer',
        ];
    }
}
