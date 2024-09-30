<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceCenterController;
use App\Http\Controllers\AddressController;

Route::get('/services', [ServiceController::class, 'index']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);

Route::get('/fetch-products', [ProductController::class, 'fetchProducts'])->name('products.fetch');
Route::get('/product-details/{id}', [ProductController::class, 'show'])->name('products.show');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
});

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
});

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/service-centers', [ServiceCenterController::class, 'index']);
    Route::get('/services', [ServiceController::class, 'index']);
});

Route::post('/addresses/store', [AddressController::class, 'store']);
Route::get('/addresses', [AddressController::class, 'getUserAddresses']);
Route::get('/addresses/{id}/edit', [AddressController::class, 'edit']);