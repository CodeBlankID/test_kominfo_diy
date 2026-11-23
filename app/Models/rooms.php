<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rooms extends Model
{
    /** @use HasFactory<\Database\Factories\RoomsFactory> */
    use HasFactory;

    public $incrementing = TRUE;
    protected $fillable = [
        'id',
        'name',
        'capacity',
        'is_active',
    ];
    protected function casts() : array
    {
        return [
            "created_at" => "datetime:Y-m-d H:i:s",
            "updated_at" => "datetime:Y-m-d H:i:s",
        ];
    }

    function bookings()
    {
        return $this->belongsTo( Bookings::class);
    }

}
