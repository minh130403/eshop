
    <div class="col mb-3">
        <a href="/product/{{ $product->slug ?? ''}}">
        <div class="card h-100">
          <img src="{{ asset($product->avatar->src ?? '') }}" class="card-img-top object-fit-scale" alt="{{ $product->avatar->alt ?? ''}}" style="height: 200px">
          <div class="card-body">
            <h5 class="card-title" style="max-height:3em; line-height: 1.5em; overflow: hidden;">{{ $product->name  ?? ''}}</h5>
            <p class="card-text">{{ number_format($product->price ?? 0)  }} VNĐ</p>
            <a href="/add-to-cart/{{ $product->id ?? '' }}" class="btn btn-primary mt-1">Add to Cart</a>
          </div>
        </div>
         </a>
      </div>
