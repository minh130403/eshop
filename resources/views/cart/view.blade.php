@extends('layouts.main')

@section('body')
<form action="/update-cart" >
  @csrf
    <div class="container mt-3">
       

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">Cart</li>
              <li class="breadcrumb-item">Checkout</li>
              <li class="breadcrumb-item">Confirm</li>
            </ol>
          </nav>

          <h1>Cart</h1>
        <div class="row">
            <div class="col-9">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Product's Name</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Price (1 unit)</th>
                          <th scope="col">Total Price</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @empty($cart->items)
                        <th scope="row" colspan="6" class="text-center"> Chưa có sản phẩm nào trong giỏ hàng</th>
                        @endempty
                        @isset($cart->items)
                          @foreach ($cart->items as $item)
                          <tr>
                            <th scope="row">1</th>
                            <td>{{ $item['item']->name }}</td>
                            <td>
                              <div class="input-group">
                                  <button class="btn btn-outline-secondary sub-button" data-btn-target="{{ $item['item']->id }}" type="button"><i class="fa-solid fa-minus"></i></button>
                                  <input name="items[{{ $item['item']->id }}]" data-id="{{ $item['item']->id }}" type="number" style="border: none; outline: none; width: 60px; text-align: center;" max="100" min="0" value="{{ $item['quantity'] }}">
                                  <button class="btn btn-outline-secondary add-button" data-btn-target="{{ $item['item']->id }}" type="button"><i class="fa-solid fa-plus"></i></button>
                              </div>
                            </td>
                            <td>{{ number_format($item['item']->price )}}</td>
                            <td>{{ number_format($item['totalPrice']) }}</td>
                            <td>
                              <a class="btn btn-primary " href="/remove-out-cart/{{ $item['item']->id }}"><i class="fa-solid fa-trash"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        @endisset

                        
                      </tbody>
                  </table>
            </div>

            <div class="col-3">
                <h3>Bill</h3>
                <div class="row mb-3">
                    <div class="col">Total Quantity:</div>
                    <div class="col">{{ $cart->totalQuantity  }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Total Price:</div>
                    <div class="col">{{number_format($cart->totalPrice)   }} VND</div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary" id="updateCart">Update Cart</button>
                    <a href="/check-out" class="btn btn-primary" id="nextToBtn">Get to Checkout</a>
                </div>
            </div>
        </div>
    </div>
  </form>

    <script>

      $addBtnElements = document.querySelectorAll('.add-button');
      $subBtnElements = document.querySelectorAll('.sub-button');
      $nextToBtn = document.querySelector('#nextToBtn');
      $updateBtn = document.querySelector('#updateCart');

      $addBtnElements.forEach(btn => {
          btn.onclick = function() {
            var inputSelected = document.querySelector(`[data-id="${this.dataset.btnTarget}"]`);
            if( inputSelected.value <  10){
              inputSelected.value ++;
            }
            nextToBtn.style.pointerEvents = 'none';
            nextToBtn.classList.add('disabled');
          }
      });

      $subBtnElements.forEach(btn => {
          btn.onclick = function() {
            var inputSelected = document.querySelector(`[data-id="${this.dataset.btnTarget}"]`);
            if( inputSelected.value > 0){
              inputSelected.value --;
            }
             
            nextToBtn.style.pointerEvents = 'none';
            nextToBtn.classList.add('disabled');
          }
         
      });


      

    </script>
@endsection