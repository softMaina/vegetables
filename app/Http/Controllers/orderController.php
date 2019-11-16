<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class orderController extends Controller
{

  public function addToCart(Request $request){
    $product = $request;

    if(!$product){
      abort(404);
    }

    $cart = session()->get('cart');

    if(!$cart){
      // $cart = [$item];
      session()->put('cart',$cart);
      return response()->json(['success'=>$cart]);
    }
    return response('body');
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
