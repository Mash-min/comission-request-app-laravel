<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'slug',
        'status',
        'user_id'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($commission) {
            $commission->slug = 'request-'.rand().$commission->id.time();
        });
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'commission_request_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(CommissionRequestImage::class, 'commission_request_id');
    }
}
