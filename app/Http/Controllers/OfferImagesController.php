<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfferImage;

class OfferImagesController extends Controller
{
    public function create(Request $request)
    {
        // return $request->all();
        foreach($request->images as $image)
        {
            OfferImage::create([
                'image' => $image,
                'offer_id' => $request->offer_id
            ]);
        }
        return response()->json(['message' => 'Offer image added']);
    }
}
