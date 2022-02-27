<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function requests() 
    {
        return $this->hasMany(CommissionRequest::class, 'user_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'user_id');
    }

    public function alreadySentOffer($requestId)
    {
        return $this->offers()->where(['commission_request_id' => $requestId])->exists();
    }
}
