
@php 
  use Carbon\Carbon;
@endphp 

    <div class="col mb-3">
        <a href="/product/{{ $product->slug ?? ''}}">
        <div class="card h-100 position-relative">
          @if ($product->is_new)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            NEW
          </span>
          @endif
          @if($product->is_sale)
          <span class="position-absolute top-50 start-50 translate-middle badge rounded-0  bg-danger w-100">
            <h6>Sale <i class="fa-solid fa-fire"></i> </h6>
          </span>

          @endif

          <img class="card-img-top object-fit-scale" alt="{{ $product->avatar->alt ?? ''}}" style="height: 200px"
          @empty($product->avatar->src)  src="https://png.pngtree.com/png-clipart/20230823/original/pngtree-illustration-of-set-different-dairy-milk-products-picture-image_8225323.png " @endempty 
          @isset($product->avatar->src)  src="{{ asset($product->avatar->src) }}" alt="{{ $product->avatar->alt }}" @endisset  >
          
          <div class="card-body">
            <h5 class="card-title" style="max-height:3em; line-height: 1.5em; overflow: hidden;">{{ $product->name  ?? ''}}</h5>
            <p class="card-text">{{ number_format($product->price ?? 0)  }} VNĐ</p>
            <a href="/add-to-cart/{{ $product->id ?? '' }}" class="btn btn-primary mt-1">Add to Cart</a>
          </div>
        </div>
         </a>
      </div>
