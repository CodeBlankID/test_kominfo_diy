<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rooms extends Model
{
    /** @use HasFactory<\Database\Factories\RoomsFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'capacity',
        'is_active',
    ];
    protected function casts() : array
    {
        return [
        ];
    }
}
