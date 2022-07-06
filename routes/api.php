<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\OrdersController;
use App\Http\Controllers\API\GalleryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('imageUpload',[GalleryController::class,'imageUpload']);
Route::resource('products', ProductController::class);
Route::resource('gallery', GalleryController::class);


Route::middleware('auth:api')->group( function () {
    Route::resource('categories', CategoriesController::class);
    Route::resource('orders', OrdersController::class);
    Route::post('logout', [RegisterController::class, 'logout']);
    Route::get('/validate-token', function (Request $request) {return response()->json(['authenticated' => true]);});
});
