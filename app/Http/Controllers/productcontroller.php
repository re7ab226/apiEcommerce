<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest ;
use App\Http\Requests\UpdateProductRequest;


class productcontroller extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return ProductResource::collection($products);
    }

public function show($id){
    $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'No product found'], 404);
        }
        return new ProductResource($product);

}


public function create(StoreProductRequest $request)
{

    $validated = $request->validated();

    $imagePath = 'default_image_path.jpg';
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');
    }
    $product = Product::create(array_merge($validated, ['image' => $imagePath]));

    return new ProductResource($product);
}

public function update($id, UpdateProductRequest $request)
    {

        $validated = $request->validated();
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'No product found'], 404);
        }

        $imagePath = $product->image; 
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
        }

        $product->update(array_merge($validated, ['image' => $imagePath]));

        return new ProductResource($product);
    }
    
public function delete($id){
$product=product::find($id);
if(!$product){
    return response()->json(['message'=>'no product foud']);
}
$product->delete;
return response()->json(['message'=>'the producr is deleted']);
}
}