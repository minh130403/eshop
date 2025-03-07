@extends('layouts.main')

@section('body')

    <div class="container mt-3">
        <div class="row mb-3">
            {{-- Side bar --}}
            <div class="col-3 d-none d-md-block">
                <div class="list-group mb-3">
                    @foreach ($categories as $category)
                    <a href="/category/{{ $category->slug }}" class="list-group-item list-group-item-action" aria-current="true">
                        {{ $category->name }}
                        <span class="badge text-bg-primary rounded-pill">{{ $category->loadCount('products')->products_count }}</span>
                       </a>
                       
                    @endforeach
                  </div>
                 {{-- <div id="filter" class="">
                    <div id="priceFilter">
                        <label for="PriceRange" class="form-label">Price Range</label>
                    <input type="range" class="form-range" min="0" max="1000000" id="PriceRange" value="0">   
                    <div class="input-group">
                        <span class="input-group-text">Min</span>
                        <input type="text" aria-label="First name" class="form-control" value="0">
                        <span class="input-group-text">Max</span>
                        <input type="text" aria-label="Last name" class="form-control" value="10000">
                      </div> 
                    </div>
                </div>  --}}
            </div>

            {{-- Product --}}
            <div class="col-12 col-md-9">
                <div class="container">
                    <div class="row mb-2">
                        <div class="d-flex justify-content-between">
                            <h2>Kết quả tìm kiếm: {{ $keyword }}</h2>    
                        </div>
                        <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4">
                            @foreach ($result as $product)
                            <div class="col mb-3">
                                <a href="/product/{{ $product->slug }}">
                                    <div class="card">
                                      <img style="height: 240px;" src="{{ asset($product->avatar->src) }}" class="card-img-top" alt="{{ $product->avatar->alt }}">
                                      <div class="card-body" style="height: 160px">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">{{ number_format($product->price)  }} VNĐ</p>
                                        <a href="/add-to-cart/{{ $product->id }}" class="btn btn-primary">Add to Cart</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        {{ $result->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection