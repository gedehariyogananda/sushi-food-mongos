<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DishController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/set-pembeli', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/set-pembeli/datas', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/list-food', [DishController::class, 'index'])->name('food.index');
Route::get('/list-drink', [DishController::class, 'indexMinuman'])->name('minuman.index');

Route::post('/list-food/store', [DishController::class, 'store'])->name('food.store');
Route::delete('/list-food/delete', [DishController::class, 'destroy'])->name('food.destroy');

Route::get('/list-food/checkout', [CheckoutController::class, 'checkout'])->name('checkout.checkout');
Route::patch('/list-food/checkout/success', [CheckoutController::class, 'success'])->name('checkout.update');
Route::delete('/list-food/checkout/{id}/delete', [CheckoutController::class, 'destroy'])->name('checkout.destroy');
