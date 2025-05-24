<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{ 
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'number_of_guests',
        'total_price',
        'status',
        'special_requests'
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'total_price' => 'decimal:2'
];

  public function user()
{
    return $this->belongsTo(User::class);
}

    public function room()
{
        return $this->belongsTo(Room::class);
}

    public function calculateTotalPrice()
    {
        $checkIn = $this->check_in_date;
        $checkOut = $this->check_out_date;
        $numberOfNights = $checkIn->diffInDays($checkOut);
        
        return $this->room->price_per_night * $numberOfNights;
    }
}
