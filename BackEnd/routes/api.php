<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartsController;

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

Route::middleware('cors')->post('/add-to-cart', [CartsController::class, 'addToCart'])->name('add_to_cart');
Route::middleware('cors')->get('/get-cart-items/{user_id}', [CartsController::class, 'getCartItems'])->name('get_cart_items');
Route::middleware('cors')->delete('/delete-cart-item/{id}', [CartsController::class, 'deleteCartRecord'])->name('delete_cart_item');