@extends('layouts/app')

@section('content')

<section class="step-one">
      <div class="container">
          <div class="row">
            <table class="table">
                <thead>
                    <th>Customer Name</th>
                    <th>Customer Address</th>
                    <th>Customer Email</th>
                    <th>Customer Remarks</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Frequency</th>
                    <th>Created At</th>
                </thead>
                
                @foreach ($orders as $key => $order)
                    <tr>
                        <td>{{$order->customer_name}}</td>
                        <td>{{$order->customer_address}}</td>
                        <td>{{$order->customer_email}}</td>
                        <td>{{$order->customer_remarks}}</td>
                        <td>{{$order->product_name}}</td>
                        <td>{{$order->product_price}}</td>
                        <td>{{$order->product_frequency}}</td>
                        <td>{{$order->created_at}}</td>
                    </tr>
                @endforeach
               
            </table>
          </div>
      </div>
  </section>
  @endsection