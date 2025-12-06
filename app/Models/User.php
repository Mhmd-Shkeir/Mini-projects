<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'role',
        'email',
        'password',
        'user_token',
        'is_verified',
        'token_expiry_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'user_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'password' => 'hashed',
        'is_verified' => 'boolean',
        'token_expiry_date' => 'datetime',
        'date_of_birth' => 'date',
    ];

    /**
     * Get the user's age.
     */
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? \Carbon\Carbon::parse($this->date_of_birth)->age : null;
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a regular user.
     */
    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * The model's booted method.
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            // ensure user_token and token_expiry_date are set when creating
            if (empty($user->user_token)) {
                $user->user_token = bin2hex(random_bytes(16));
            }
            if (empty($user->token_expiry_date)) {
                $user->token_expiry_date = now()->addDays(3);
            }
        });
    }
}
