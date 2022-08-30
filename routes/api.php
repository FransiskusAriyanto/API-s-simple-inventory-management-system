<?php

use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function (){
    Route::get('logout', LogoutController::class);
});

Route::controller(ProductController::class)->group(function (){
    Route::post('product/create', 'store');
    Route::patch('product/update/{id}', 'update');
    Route::get('product/show/{id}', 'show');
    Route::get('product/show', 'shows');
});

Route::controller(LocationController::class)->group(function (){
    Route::post('location/create', 'store');
    Route::patch('location/update/{id}', 'update');
    Route::get('location/show/{id}', 'show');
    Route::get('location/show', 'shows');
});

Route::controller(WarehouseController::class)->group(function (){
    Route::post('warehouse/create', 'store');
    Route::patch('warehouse/update/{id}', 'update');
    Route::get('warehouse/show/{id}', 'show');
    Route::get('warehouse/show', 'shows');
});

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);