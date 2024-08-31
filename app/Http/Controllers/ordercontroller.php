<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StoreOrederRequest;
use App\Models\location;
use App\Models\order_products;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // public function index()
    // {
    //     $orders=Order::with('User')->paginate(10);
    //     return response()->json($orders, 200);
    // }
  

    public function index()
{
    $orders = Order::with(['user', 'item.product'])->paginate(10);

    if ($orders->isNotEmpty()) {
        foreach ($orders as $order) {
            foreach ($order->item as $order_item) {
                $order_item->product_name = $order_item->product->name ?? 'Product not found';
            }
        }

        return response()->json($orders, 200);
    } else {
        return response()->json(['message' => 'No orders to view'], 404);
    }
}






#show
    // public function show($id){
    //     $order = Order::with('user')->find($id);
    //     if(! $order){
    //         return response()->json(['message'=>'the order not found']);
    //     }
    //     return response()->json($order,200);

    // }



    public function show($id)
    {
        $order_items = order_products::where('order_id', $id)->get();
        
        if ($order_items->isNotEmpty()) {
            foreach ($order_items as $order_item) {
                $product = Product::where('id', $order_item->product_id)->pluck('name')->first();
                $order_item->product_name = $product;
            }
            return response()->json($order_items, 200);
        } else {
            return response()->json(['message' => 'No orders to view'], 404);
        }
    }
    





#create
public function create(StoreOrederRequest $request)
{
    if (!Auth::check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $location = Location::where('user_id', Auth::id())->first();
    
    $validated = $request->validated();
    
    $validated['user_id'] = Auth::id();
    $validated['location_id'] = $location ? $location->id : null;
    $order = Order::create($validated);

    return new OrderResource($order);
}

    #Update
    public function update($id,StoreOrederRequest $request){
        $validated = $request->validated();
        $order=Order::find($id);
        if(!$order){
            return response()->json(['message'=>'no order found']);
        }
        $order->update($validated);

        return new OrderResource($order);


    }


    public function get_user_order($id)
    {
        $orders = Order::where('user_id', $id)
            ->with(['item.product' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->get();
    
        if ($orders->isNotEmpty()) {
            foreach ($orders as $order) {
                foreach ($order->item as $order_item) {
                    $order_item->product_name = $order_item->product->name ?? 'Product not found';
                }
            }
            return response()->json($orders, 200);
        } else {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }
    }
    

    #####Delted
    public function delete($id){
        
        $order=Order::find($id);
        if(! $order){
            return response()->json(['message'=>'no order found']);

        }
        $order->delete();
        return response()->json(['message'=>'the order deleted sussfully']);

    }
}
