<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'type',
        'capacity',
        'price_per_night',
        'description',
        'amenities',
        'is_available'
    ];

    protected $casts = [
        'amenities' => 'array',
        'is_available' => 'boolean',
        'price_per_night' => 'decimal:2'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isAvailableForDates($checkIn, $checkOut)
    {
        if (!$this->is_available) {
            return false;
        }

        $checkIn = Carbon::parse($checkIn)->startOfDay();
        $checkOut = Carbon::parse($checkOut)->endOfDay();

        return !$this->reservations()
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in_date', '<=', $checkOut)
                      ->where('check_out_date', '>=', $checkIn);
                });
            })
            ->where('status', '!=', 'cancelled')
            ->exists();
    }
} 