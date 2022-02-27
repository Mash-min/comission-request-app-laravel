<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'price',
        'status',
        'slug',
        'user_id',
        'commission_request_id'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];
    
    protected static function boot()
    {
        parent::boot();
        static::creating(function($offer) {
            $offer->slug = 'offer-'.rand().$offer->id.time();
        });
    }

    public function request()
    {
        return $this->belongsTo(CommissionRequest::class, 'commission_request_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(OfferImage::class, 'offer_id');
    }
}
