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
    
        <h1>Checkout</h1>

        <div class="row">
            <form class="row g-3" action="/confirm-order">
                <div class="col-md-6">
                  <label for="fullname" class="form-label">Full Name</label>
                  <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="name" name="fullname" placeholder="eg: Nguyen Tien Minh">
                  @error('fullname')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Eg: +(84) 869 321 *** or 0869 321 ***">
                  @error('phone')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-6">
                  <label for="email" class="form-label">Email</label>
                  <input type="mail" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" placeholder="eg: minh@example.com">
                  @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Address</label>
                  <input type="text" class="form-control  @error('address') is-invalid @enderror" id="inputAddress" placeholder="eg: 1234 Main St" name="address">
                  @error('address')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">City</label>
                  <input type="text" class="form-control  @error('city') is-invalid @enderror" id="inputCity" name="city" placeholder="eg: Ha Noi capital">
                  @error('city')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
                </div>
                <div class="col-md-2">
                  <label for="note" class="form-label">Note</label>
                  <input type="text" class="form-control " id="note" name="note">
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Next</button>
                  <a href="/cart" class="btn btn-primary">Back</a>
                </div>
              </form>
        </div>
    </div>
@endsection