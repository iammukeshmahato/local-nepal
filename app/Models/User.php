<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Notifications\ResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'dob',
        'avatar',
        'otp',
        'otp_count',
        'otp_resend_time',
        'verified',
        'email_verified_at',
    ];

    public function guides()
    {
        return $this->hasMany(Guide::class); // Has many Guides
    }
    public function tourists()
    {
        return $this->hasMany(Tourist::class); // Has many Guides
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            Storage::delete('public/profiles/' . $user->avatar);
        });

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return  url('/reset-password-form') . '/' . $user->email . '/' . $token;
        });
    }
}
