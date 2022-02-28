<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfferImage;

class OfferImagesController extends Controller
{
    public function create(Request $request)
    {
        OfferImage::create([
            'image' => $request->image,
            'offer_id' => $request->offer_id
        ]);
        return response()->json(['message' => 'Offer image added']);
    }
}
