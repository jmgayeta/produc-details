<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartsController extends Controller
{

    public function createNewRecord(Request $request)
    {
        return Cart::create([
            'user_id' => $request->user_id,
            'product_image' => $request->image,
            'product_title' => $request->title,
            'product_description' => $request->description,
            'product_price' => $request->price,
            'qty' => 1,
            'size' => $request->size,
        ]);
    }

    public function updateCartRecord(Cart $cart)
    {
        $cart->qty = $cart->qty + 1;
        $cart->save();

        return $cart;
    }

    public function addToCart(Request $request)
    {
        $cart = Cart::where('user_id', $request->user_id)->where('size', $request->size)->first();
        
        if ( ! $cart ) {
            return response()->json([
                'data' => $this->createNewRecord($request),
            ], 201);
        }

        return response()->json([
            'data' => $this->updateCartRecord($cart),
        ], 200);
    }

    public function getCartItems($user_id)
    {
        return response()->json([
            'data' => Cart::where('user_id', $user_id)->get(),
        ], 200);
    }

    public function deleteCartRecord($id)
    {
        $cart = Cart::find($id);

        if ( ! $cart ) {
            return response()->json([
                'data' => 'Record not found'
            ], 404);
        }

        $cartDeleted = $cart->delete();

        return response()->json([
            'data' => $cartDeleted,
        ], 204);
    }
}
