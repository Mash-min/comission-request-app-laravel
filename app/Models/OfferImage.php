<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferImage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'slug',
        'image',
        'offer_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($offerImage) {
            $offerImage->slug = 'offer-image-'.rand().$offerImage->id.time();
        });
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }


}
