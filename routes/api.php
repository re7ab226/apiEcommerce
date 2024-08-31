<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\categorycontroller;
use App\Http\Controllers\locationcpntroller;
use App\Http\Controllers\order_productscontroller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\productcontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);

 



});
//brands Route
Route::get('/brands', [brandController::class, 'index']);
Route::get('/brands/{id}', [BrandController::class, 'show']);
Route::post('/brands', [BrandController::class, 'create']);
Route::post('/brands/{id}', [BrandController::class, 'update']);
Route::delete('/brands/{id}', [BrandController::class, 'delete']);

//category Route
Route::get('/category', [categorycontroller::class, 'index']);
Route::get('/category/{id}', [categorycontroller::class, 'show']);
Route::post('/category', [categorycontroller::class, 'create']);
Route::post('/category/{id}', [categorycontroller::class, 'update']);
Route::delete('/category/{id}', [categorycontroller::class, 'delete']);


//location Route
Route::get('/location', [locationcpntroller::class, 'index']);
Route::get('/location/{id}', [locationcpntroller::class, 'show']);
Route::post('/location', [locationcpntroller::class, 'create']);
Route::post('/location/{id}', [locationcpntroller::class, 'update']);
Route::delete('/location/{id}', [locationcpntroller::class, 'delete']);


// product Route
Route::get('/product', [productcontroller::class, 'index']);
Route::get('/product/{id}', [productcontroller::class, 'show']);
Route::post('/product', [productcontroller::class, 'create']);
Route::post('/product/{id}', [productcontroller::class, 'update']);
Route::delete('/product/{id}', [productcontroller::class, 'delete']);
//Oreder Routes


Route::get('/order', [OrderController::class, 'index']);
Route::get('/order/{id}', [OrderController::class, 'show']);
Route::post('/order', [OrderController::class, 'create']);
Route::post('/order/{id}', [OrderController::class, 'update']);
Route::delete('/order/{id}', [OrderController::class, 'delete']);
Route::get('/userOrder/{id}', [OrderController::class, 'get_user_order']);
//Items Routes


Route::get('/item', [order_productscontroller::class, 'index']);
Route::get('/item/{id}', [order_productscontroller::class, 'show']);
Route::post('/item', [order_productscontroller::class, 'create']);
Route::post('/item/{id}', [order_productscontroller::class, 'update']);
Route::delete('/item/{id}', [order_productscontroller::class, 'delete']);
