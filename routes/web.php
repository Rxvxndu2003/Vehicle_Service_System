<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\Appointment;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AddressController;

Route::get('/addresses/create', function() {
    return view('pages.address');
})->name('addresses.create');

Route::get('addresses', [AddressController::class, 'getUserAddresses'])->name('addresses.index');
Route::post('addresses', [AddressController::class, 'store'])->name('addresses.store');
Route::get('addresses/{id}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
Route::put('addresses/{id}', [AddressController::class, 'update'])->name('addresses.update');
Route::delete('addresses/{id}', [AddressController::class, 'destroy'])->name('addresses.destroy');


Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{order}', [PaymentController::class, 'process'])->name('payment.process');

Route::get('/order-confirmation/{order}', [PaymentController::class, 'confirmation'])->name('order.confirmation');

Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');


Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
});

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');


Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

Route::get('/fetch-products', [ProductController::class, 'fetchProducts'])->name('products.fetch');

route::get('/',[TemplateController::class,'index']);
route::get('/about',[TemplateController::class,'index1']);
route::get('/service',[TemplateController::class,'index2']);
route::get('/contact',[TemplateController::class,'index3']);
route::get('/products',[TemplateController::class,'index4']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


