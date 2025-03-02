@extends('admin.dashbroad')

@section('body')
<div class="container-fluid mt-3">
    <h3>Shop Config</h3>
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="shopName" class="form-label">Shop Name</label>
          <input type="text" class="form-control" id="shopName" value="{{ $shop->name ?? '' }}"  name="name">
        </div>
          <div class="mb-3">
            <label for="shopFavicon" class="form-label">Shop Favicon:</label>
            <input class="form-control" type="file" id="shopFavicon" name="favicon">
          </div>
            <div class="mb-3">
                <label for="shopLogo" class="form-label">Logo:</label>
                <input class="form-control" type="file" id="shopLogo" name="logo">
              </div>
            <div class="mb-3">
                <label for="shopEmail" class="form-label">Shop's email</label>
                <input type="email" class="form-control" id="shopEmail" name="email" value="{{ $shop->email ?? '' }}" >
              </div>
              <div class="mb-3">
                <label for="shopPhone" class="form-label">Shop's phone</label>
                <input type="text" class="form-control" id="shopPhone" name="phone" value="{{ $shop->phone ?? '' }}" >
              </div>
              <div class="mb-3">
                <label for="shopAddress" class="form-label">Shop's address</label>
                <input type="text" class="form-control" id="shopAddress" name="address" value="{{ $shop->address ?? '' }}">
              </div>
              <div class="mb-3">
                <label for="shopAddress" class="form-label">Shop's currency</label>
                <input type="text" class="form-control" id="shopAddress" name="currency" value="{{ $shop->currency ?? '' }}" >
              </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
</div>
@endsection