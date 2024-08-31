<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrederItemRequest;
use App\Http\Requests\StoreOrederRequest;
use App\Http\Resources\order_productsResource;
use App\Models\order_products;
use Illuminate\Http\Request;

class order_productscontroller extends Controller
{

    public function index()
    {
        $items = order_products::paginate(10);
        return order_productsResource::collection($items);
    }
    public function show($id){
        $item = order_products::find($id);
        return new order_productsResource($item);

    }
    public function create(StoreOrederItemRequest $request)
    {
        $validatedData = $request->validated();
    
        $orderProduct = order_products::create($validatedData);
    
        return new order_productsResource($orderProduct);
    }
    public function update($id,StoreOrederItemRequest $request)
    
    {
                    $orderProduct=order_products::find($id);
                    if(!$orderProduct){
                        return response()->json(['message'=>'no orederItems found']);
    }
                $validatedData = $request->validated();
                $orderProduct->update($validatedData);
                return new order_productsResource($orderProduct);
}

        public function delete($id){

            $orderProduct=order_products::find($id);
            if(!$orderProduct){
                return response()->json(['message'=>'no orederItems found']);
}
                    $orderProduct->delete();
                    return response()->json(['message'=>'the order delered sussfully']);
        }
        

}
