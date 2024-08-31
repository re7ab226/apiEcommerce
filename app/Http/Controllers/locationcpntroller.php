<?php

namespace App\Http\Controllers;

use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LocationResource;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;

class locationcpntroller extends Controller
{


public function index(){
    $location=location::paginate(10);
//    return response()->json($location,200);

return LocationResource::collection( $location);
}

public function show($id){
    $location=location::find($id);
    if(!$location){
        return response()->json(['message'=>"not location found"]);
        
    }
    $userId = Auth::id();
    if (!$userId) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }
    if ($location->user_id !== $userId) {
        return response()->json(['error' => 'You are not authorized to delete this location'], 403);
    }

    return new LocationResource($location);

    // return response()->json($location);

}

public function create(StoreLocationRequest $request)
{
    $userId = Auth::id(); 
    if (!$userId) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    $validated = $request->validated();

    $location = Location::create(array_merge($validated, [
        'user_id' => $userId,
        
    ]));

    return new LocationResource($location);
}

public function update($id, UpdateLocationRequest $request)
{
    $userId = Auth::id();
    if (!$userId) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }
   $request->validated();

    $location = Location::find($id);
    if (!$location) {
        return response()->json(['error' => 'Location not found'], 404);
    }

    if ($location->user_id !== $userId) {
        return response()->json(['error' => 'You are not authorized to update this location'], 403);
    }

      // $location->update(array_merge($validated, [
    // ]));

    return new LocationResource($location);



}
public function delete($id)
{
    $location = Location::find($id);
    if (!$location) {
        return response()->json(['message' => 'Location not found'], 404);
    }

    $userId = Auth::id();
    if (!$userId) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }
    if ($location->user_id !== $userId) {
        return response()->json(['error' => 'You are not authorized to delete this location'], 403);
    }

    $location->delete();
    return response()->json(['message' => 'Location deleted successfully'], 200);
}

}
