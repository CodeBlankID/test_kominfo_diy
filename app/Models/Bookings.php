<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    /** @use HasFactory<\Database\Factories\BookingsFactory> */
    use HasFactory;
    protected $fillable = [
        'id',
        'room_id',
        'user_id',
        'title',
        'start_time',
        'end_time',
        'status',
    ];
    protected function casts() : array
    {
        return [
        ];
    }

    public function peristiwa()
    {
        return $this->belongsTo( Peristiwa::class, "peristiwa_id" );
    }

    public function payload_option()
    {
        return $this->hasMany( Payload_option::class, "payload_id" );
    }
}
