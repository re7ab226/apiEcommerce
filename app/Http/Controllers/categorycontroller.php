<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class categorycontroller extends Controller
{

    public function index()
{
    $category=category::paginate(10);
    return response()->json($category,200);
}
public function show($id){
    $category=category::find($id);
    if(!$category){
        return response()->json(['message'=>'no categoru found'],200);
    }
    return response()->json($category,200);
}


public function create(Request $request)
{
    try {
        $validation = $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'nullable|image',
        ]);

        $imagePath = 'default_image_path.jpg';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            // \Log::info("Image stored at: $imagePath"); // Debugging
        } else {
            // \Log::info("Using default image path: $imagePath"); // Debugging
        }

        $category = new Category();
        $category->name = $validation['name'];
        $category->image = $imagePath;
        $category->save();

        return response()->json(['message' => 'Category is added'], 201);
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function update($id, Request $request)
{
    try {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'images' => 'nullable|image'
        ]);

        // Find the category by ID
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Handle image upload
        $imagePath = $category->images; // Retain the old image path if no new image is uploaded
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imagePath = $image->store('images', 'public'); // Store image in 'public/images' directory
        }

        // Update the category
        $category->name = $validated['name'];
        $category->image = $imagePath;
        $category->save();

        return response()->json(['message' => 'Category is updated'], 200);
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500); // Include error message
    }
}
public function delete($id){
    $category=category::find($id);
    if(!$category){
        return response()->json(['message'=>'no categoru found'],200);
    }
    $category->delete();
    return response()->json(['message' => 'Category is deleted'], 200);
}
}