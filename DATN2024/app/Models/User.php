<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\CustomResetPasswordLink;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\CustomResetPasswordLinkForClient;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'address',
        'phone',
        'type',
    ];

    protected $guarded = ['id', 'password'];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->type === 1;
    }

    public function isUser()
    {
        return $this->type === 0;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function sendPasswordResetNotification($token)
    {
        if ($this->type == 1) {
            $this->notify(new CustomResetPasswordNotification($token));
        } else {
            $this->notify(new CustomResetPasswordLinkForClient($token));
        }
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
