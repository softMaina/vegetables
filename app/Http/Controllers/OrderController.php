<?php

namespace App\Http\Controllers;

use App\Paypal;
use App\Orders;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

  public function index(){
    $orders = Orders::all();
    return view('orders/index', compact('orders'));
  }
  public function addToCart(Request $request){
    //Initialize or define the Cart
    //session()->forget('cart');
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
      foreach ($cart as $key => $item) {
        # code...
        $item = json_decode(json_encode($item));
        if($request->input('id') == $item->id){
          //$cart[$key] = $request->all();
          unset($cart[$key]);
          
        }
      }
      session(['cart' => $cart]);
      return response()->json(session()->get('cart'));
    }
  }

  public function checkout(Request $request){
    $cart = session()->get('cart');
    $itemList = new ItemList();
    $totalAmount = 0;
    if($cart){
      $items = [];

      //SHIPPING
      session()->put('shipping',
        [
          'shippingName' => $request->input('shippingName'),
          'shippingMobile' => $request->input('shippingMobile'),
          'shippingRemarks' => $request->input('shippingRemarks'),
          'shippingEmail' => $request->input('shippingEmail'),
          'shippingAddress' => $request->input('shippingAddress')
        ]
      );

      //CART
      foreach ($cart as $key => $item) {
        $item = json_decode(json_encode($item));
        //return response()->json($item->time);
        $itemize = new Item();
        $itemize->setName($item->title)
            ->setCurrency('USD')
            ->setQuantity($item->qty)
            ->setSku($item->id) // Similar to `item_number` in Classic API
            ->setPrice(floatval($item->price));
        $totalAmount = $totalAmount + (floatval($item->price) * $item->qty);
        array_push($items,$itemize); 
      }
      session()->put('totalCart', $totalAmount);
      $itemList->setItems($items);
      return Paypal::makeCall($itemList,$totalAmount);
    }else{
      return response()->json("Cart Doesn't exist",400);
    }  
  }

  public function executePayment(Request $req){
    //dd(session()->get('shipping'));
    $apiContext = Paypal::getContext();
    $paymentId = $req->input('paymentId');
    $payment = Payment::get($paymentId, $apiContext );

    $execution = new PaymentExecution();
    $execution->setPayerId($req->input('PayerID'));

    $transaction = new Transaction();
    $amount = new Amount();
    $details = new Details();

    //$details->setShipping(2.2)
    //    ->setTax(1.3)
    //    ->setSubtotal(17.50);

    $amount->setCurrency('USD');
    $amount->setTotal(session()->get('totalCart'));
    //$amount->setDetails($details);
    $transaction->setAmount($amount);
    $execution->addTransaction($transaction);

    try {
      //code...
      $result = $payment->execute($execution, $apiContext);
      //return $result;
      try {
        $payment = Payment::get($paymentId, $apiContext);
      } catch (\Exception $ex) {
          //ResultPrinter::printError("Get Payment", "Payment", null, null, $ex);
          return ($ex);
      }
    } catch (\Throwable $th) {
      //throw $th;
      //ResultPrinter::printError("Executed Payment", "Payment", null, null, $ex);
      //exit(1);
      return ($th);
    }
    //ResultPrinter::printResult("Get Payment", "Payment", $payment->getId(), null, $payment);
    self::storeOrder($payment);
    return response()->json($payment);
  }

  public static function storeOrder($data){
    //$data = json_decode(json_encode($data));
    $data = json_decode($data,true);
    $cart = session()->get('cart');
    if($cart){
      $shippingData = session()->get('shipping');
      $ipaddress = self::getClientIp();
      //dd($data);
      foreach ($cart as $key => $item) {
        $item = json_decode(json_encode($item));
        Orders::create([
          //"customer_name" => $data['payer']['payer_info']['first_name'] ." ".$data['payer']['payer_info']['middle_name']." ".$data['payer']['payer_info']['last_name'],
          "customer_name" => $data['payer']['payer_info']['first_name'],
          "customer_address"=> $data['payer']['payer_info']['shipping_address']['line1'] .",".$data['payer']['payer_info']['shipping_address']['city'] .",".$data['payer']['payer_info']['shipping_address']['state'].",".$data['payer']['payer_info']['shipping_address']['postal_code'].",".$data['payer']['payer_info']['shipping_address']['country_code'],
          "customer_email"=> $data['payer']['payer_info']['email'],
          "phone"=> $shippingData['shippingMobile'],
          "customer_address_google_map"=> $shippingData['shippingAddress'],
          "customer_remarks"=> $shippingData['shippingRemarks'],
          "customer_login_email"=> $shippingData['shippingEmail'],
          "customer_password"=> NULL,
          "product_name"=> $item->title,
          "product_details"=> NULL,
          "product_price"=> $item->price,
          "product_image"=> $item->img,
          "order_qty"=> $item->qty,
          "order_delivery_time"=> $item->time,
          "order_frequency"=> $item->frequency,
          "order_payment_type"=> NULL,
          "order_paid"=> $data['state'],
          "admin_remarks"=> NULL,
          "delivery_boy_remarks"=> NULL,
          "staff_remarks"=> NULL,
          "delivery_time"=> NULL,
          "device_ip_address" => $ipaddress,
          "device_cookie_session"=> NULL,
        ]);
      }
    }
    return true;
    
    //redirect()->route('home')->with('success','Payment executed successfully.');
  }

  public static function getClientIp() {
      $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';
      return $ipaddress;
  }
}
