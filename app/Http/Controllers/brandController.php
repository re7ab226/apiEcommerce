<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class brandController extends Controller
{
    public function index(){
        $brands=brand::paginate(10);
        return response()->json($brands,200);
   }


   public function show($id){
     if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    $brands=brand::find($id);
    if(!$brands){
        return response()->json(['message' => 'Brand not found'], 404);

    }
    else{
        return response()->json($brands,200);

    }



   }

    public function create(Request $request){


        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        try {
            $validation = $request->validate([
                'name' => 'required|unique:brands,name'  // إضافة اسم الجدول في قاعدة البيانات
            ]);
        
            $brand = new Brand();  // اسم الفئة يجب أن يبدأ بحرف كبير
            $brand->name = $request->name;
            $brand->save();
        
            return response()->json(['message' => 'Brand is added'], 200);
        
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);  // تضمين رسالة الخطأ
        }}


        
        public function update($id, Request $request) {
            // التحقق من تسجيل الدخول
            if (!Auth::check()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        
            try {
                // التحقق من صحة البيانات
                $request->validate([
                    'name' => 'required|unique:brands,name,' . $id  // تعديل القاعدة لتفادي خطأ التحقق في حالة تحديث السجل نفسه
                ]);
        
                // تحديث السجل
                $brand = Brand::find($id);
                if (!$brand) {
                    return response()->json(['message' => 'Brand not found'], 404);
                }
        
                $brand->name = $request->name;
                $brand->save();
        
                return response()->json(['message' => 'Brand is Updated'], 200);
        
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);  // تضمين رسالة الخطأ
            }
        }

        public function delete($id){
            $brand=brand::find($id);
            if(!$brand){
                return response()->json(['message'=>'brand not found']);
            }
            $brand->delete();
            return response()->json(['message'=>'brand deleted sussfully']);
        }
    }