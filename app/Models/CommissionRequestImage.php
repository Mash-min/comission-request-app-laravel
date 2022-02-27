<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionRequestImage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'image',
        'slug',
        'commission_request_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($requestImage) {
            $requestImage->slug = 'request-image-'.rand().$requestImage->id.time();
        });
    }

    public function request()
    {
        return $this->belongsTo(CommissionRequest::class, 'commission_request_id');
    }

}
