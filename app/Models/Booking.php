<?php

namespace App\Models;

use App\Enums\TransactionPaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
            'price' => 'integer',
            'booking_fee' => 'integer',
            'vat' => 'integer',
            'grand_total' => 'integer',
            'payment_status' => TransactionPaymentStatus::class
        ];
    }

    public function carStore(): BelongsTo
    {
        return $this->belongsTo(CarStore::class);
    }

    public function carService(): BelongsTo
    {
        return $this->belongsTo(CarService::class);
    }
}
