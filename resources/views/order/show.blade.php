@extends('layouts.main')

@section('body')
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Cart</li>
              <li class="breadcrumb-item">Checkout</li>
              <li class="breadcrumb-item">Confirm</li>
            </ol>
          </nav>

          <h1>OrderID {{ $order->id }}</h1>

          <div class="row">
             <div class="col-9">
                <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">Custommer:</th>
                        <td>{{$order->customer->fullname }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Address</th>
                        <td >{{ $order->customer->address }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Phone</th>
                        <td >+84.0203.0002</td>
                      </tr>
                      <tr>
                        <th scope="row">Email</th>
                        <td >{{ $order->customer->email }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Date</th>
                        <td >13-20-2003</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Product's Name</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Price (1 unit)</th>
                          <th scope="col">Total Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($order->subOrders as $subOrder)
                        <tr>
                          <th scope="row">1</th>
                          <td> {{ $subOrder->product_name }}</td>
                          <td>
                            <div class="input-group mb-3">
                                {{ $subOrder->quantity }}
                              </div>
                          </td>
                          <td>{{ number_format($subOrder->product_price) }}</td>
                          <td>{{ number_format($subOrder->total_price)}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
             </div>
             <div class="col-3">
                <div class="row mb-3">
                    <div class="col"><b>Total Quantity:</b></div>
                    <div class="col">{{ $order->total_quantity}} units</div>
                </div>
                <div class="row mb-3">
                    <div class="col"><b>Total Price:</b></div>
                    <div class="col">{{ number_format($order->total_price) }} VND</div>
                </div>  
                </div>
             </div>
          </div>
    </div>
@endsection