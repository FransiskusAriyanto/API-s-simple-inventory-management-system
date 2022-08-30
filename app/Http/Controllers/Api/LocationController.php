<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'location_code' => 'required|string|unique:locations', //merupakan gabungan dari product_code dan warehouse_code yang diambil pada (frontend)
            'quantity' => 'required|integer',
        ]);
        $location = Location::create($request->all());
        return response()->json([
            'Data' => new LocationResource($location),
            'Message' => 'new location has been created',
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        $request->validate([
            'location_code' => 'required',
            'quantity' => 'required',
        ]);
        $location->update($request->all());
        return response()->json([
            'Data' => new LocationResource($location),
            'Message' => 'location with id' .$location->id. ' has been updated',
        ], 201);
    }
    public function show($id)
    {
        $location = Location::find($id);
        return response()->json([
            'Data' => new LocationResource($location),
        ], 200);
    }
    public function shows()
    {
        $location = Location::get();
        return response()->json([
            'Data' => new LocationResource($location),
        ], 200);
    }
}
