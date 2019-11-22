<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

  public function addToCart(Request $request){
    //Initialize or define the Cart
    session()->forget('cart');
    $cart = session()->get('cart');
    $request->replace($request->except(['_token']));

    if(!$cart){
      session()->push('cart',$request->all());
    }else{
      $itemInCart = false;
      foreach ($cart as $key => $item) {
        # code...
        $item = json_decode(json_encode($item));
        if($request->input('id') == $item->id){
          $cart[$key] = $request->all();
          $itemInCart = true;
          session(['cart' => $cart]);
        }
      }
      if($itemInCart == false){
        session()->push('cart',$request->all());
      }
    }

    return response()->json(session()->get('cart'));
  }

  public function update(Request $request)
   {
       if($request->id and $request->quantity)
       {
           $cart = session()->get('cart');

           $cart[$request->id]["quantity"] = $request->quantity;

           session()->put('cart', $cart);

           session()->flash('success', 'Cart updated successfully');
       }
   }

  public function remove(Request $request){
    if($request->id){
      $cart = session()->get('cart');
    }
  }

  public function saveOrder(Request $request){
    return redirect()->back();
  }
}
