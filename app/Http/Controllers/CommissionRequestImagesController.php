<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommissionRequestImage;

class CommissionRequestImagesController extends Controller
{
    public function create(Request $request)
    {
        foreach($request->images as $image) 
        {
            CommissionRequestImage::create([
                'image' => $image,
                'commission_request_id' => $request->commission_request_id
            ]);
        }
        return response()->json(['message' => 'Request images added']);
    }
}
