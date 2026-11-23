<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Hidden([ 'password', 'remember_token', "email_verified_at" ])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    protected $fillable = [
        'id',
        'name',
        'email',
        'role',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts() : array
    {
        return [
            "created_at"        => "datetime:Y-m-d H:i:s",
            "updated_at"        => "datetime:Y-m-d H:i:s",
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function rooms() : BelongsToMany
    {
        return $this->belongsToMany( User::class, "bookings" );
    }
}
