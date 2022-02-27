<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommissionRequest;
use App\Http\Requests\CommissionRequestValidation;

class CommissionRequestsController extends Controller
{
    public function create(CommissionRequestValidation $request)
    {
        $commisionRequest = $request->user()->requests()->create($request->all());
        $collection = collect($commisionRequest);
        $collection->put('offers', []);
        $collection->put('user', $commisionRequest->user()->first());
        return response()->json([
            'request' => $collection
        ]);
    }

    public function delete($id)
    {
        CommissionRequest::findOrFail($id)->delete();
        return response()->json(['message' => 'Request deleted']);
    }

    public function update(CommissionRequestValidation $request, $id)
    {
        $commisionRequest = CommissionRequest::findOrFail($id);
        $commisionRequest->update($request->all());
        $collection = collect($commisionRequest);
        $collection->put('offers', $commisionRequest->offers()->get());
        $collection->put('user', $commisionRequest->user()->first());
        
        return response()->json([
            'request' => $collection, 
            'message' => 'Request updated'
        ]);
    }

    public function find($id)
    {
        $commisionRequest = CommissionRequest::with('images')
                                             ->with('user')
                                             ->with('offers')                                    
                                             ->findOrFail($id);
        return response()->json([
            'request' => $commisionRequest,
            'user' => $commisionRequest->user()->first()
        ]);
    }

    public function all()
    {
        $commisionRequests = CommissionRequest::orderBy('created_at', 'DESC')
                                              ->with('offers.images')   
                                              ->with('offers.user')  
                                              ->with('images')         
                                              ->with('user')                          
                                              ->paginate(20);
        return response()->json(['requests' => $commisionRequests]);
    }

    public function offers($id)
    {
        $commisionRequest = CommissionRequest::findOrFail($id);
        $offers = $commisionRequest->offers()
                                   ->orderBy('created_at', 'DESC')
                                   ->with('user')
                                   ->with('images')
                                   ->get();
        return response()->json(['offers' => $offers]);
    }

    public function viewRequest($slug)
    {
        $commisionRequest = CommissionRequest::where(['slug' => $slug])
                                             ->with('user')
                                             ->with('images')
                                             ->with('offers')
                                             ->firstOrFail();
        return response()->json(['request' => $commisionRequest]);
    }

    public function search($data) 
    {
        $commissionRequests = CommissionRequest::where('title', 'like', '%'.$data.'%')
                                                ->orWhere(['price' => $data])
                                                ->with('user')
                                                ->with('images')
                                                ->with('offers')
                                                ->paginate(10);
        return response()->json(['requests' => $commissionRequests]);
    }
}
