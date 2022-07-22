<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('sendTestMail', function (){
    \Illuminate\Support\Facades\Mail::to('xeemax2.0@gmail.com')->send(new \App\Mail\Query(' ZEESHAN AHMAD',"HEY THERE"));
});
Route::get('/{path}', \App\Http\Controllers\FrontendController::class)
    ->where('path', '^(?!dashboard|admin|api|nova-api|pusher|nova-vendor).*');
