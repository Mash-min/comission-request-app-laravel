<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Http\Requests\OfferRequestValidation;

class OffersController extends Controller
{
    public function create(OfferRequestValidation $request)
    {
        if(!$request->user()->alreadySentOffer($request->commission_request_id)) {
            $offer = $request->user()->offers()->create($request->all());
            return response()->json(['message' => 'Offer sent', 'offer' => $offer]);
        } else {
            return response()->json(['message' => 'You already sent an offer']);
        }
    }

    public function delete($id)
    {
        Offer::findOrFail($id)->delete();
        return response()->json(['message' => 'Offer canceled']);
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::with('user')->with('images')->findOrFail($id);
        $offer->update($request->all());
        return response()->json([
            'offer' => $offer
        ]);
    }

    public function find($id)
    {
        $offer = Offer::findOrFail($id);
        return response()->json(['offer' => $offer]);
    }

}
