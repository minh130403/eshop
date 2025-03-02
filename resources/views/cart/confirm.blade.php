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

          <h1>Confirm</h1>

          <div class="row">
             <div class="col-9">
                <table class="table">
                    <tbody>
                      <tr>
                        <th scope="row">Custommer:</th>
                        <td>{{ $customer['fullname'] }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Address</th>
                        <td >{{ $customer['address'] }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Phone</th>
                        <td >{{ $customer['phone'] }}</td>
                      </tr>
                      <tr>
                        <th scope="row">Email</th>
                        <td >{{ $customer['email'] }}</td>
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
                        @foreach ($cart->items as $item)
                        <tr>
                          <th scope="row">1</th>
                          <td> {{ $item['item']->name }}</td>
                          <td>
                            <div class="input-group mb-3">
                                {{ $item['quantity'] }}
                              </div>
                          </td>
                          <td>{{ $item['item']->price }}</td>
                          <td>{{ $item['totalPrice']}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
             </div>
             <div class="col-3">
                <div class="row mb-3">
                    <div class="col">Total Quantity:</div>
                    <div class="col">{{ $cart->totalQuantity }} units</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Total Price:</div>
                    <div class="col">{{ number_format($cart->totalPrice) }} VND</div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        How way to pay?
                        <form action="">
                         <div class="form-check">
                             <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                             <label class="form-check-label" for="flexRadioDefault1">
                               COD
                             </label>
                           </div>
                           <div class="form-check">
                             <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                             <label class="form-check-label" for="flexRadioDefault2">
                               Zalo pay
                             </label>
                           </div>
                        </form>
                    </div>
                   
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary">Back</button>
                    <form action="/confirm-order" method="post">
                      @csrf
                      <button type="submit" class="btn btn-primary">Pay</button>
                    </form>
                   
                </div>
             </div>
          </div>
    </div>
@endsection