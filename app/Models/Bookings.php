<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
            "created_at" => "datetime:Y-m-d H:i:s",
            "updated_at" => "datetime:Y-m-d H:i:s",
        ];
    }


    public function users() : HasOne
    {
        return $this->hasOne( User::class, "id", 'user_id' );
    }
    public function rooms() : HasOne
    {
        return $this->hasOne( Rooms::class, 'id', "room_id" );
    }

}
