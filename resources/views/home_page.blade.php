@extends('layouts.main')

@section('body')

    <div class="container">
        {{-- Banner --}}
        {{-- <div class="row mb-3 mt-2">
            <div id="carouselBanner" class="carousel slide">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img style="height: 600px" src="https://images.rawpixel.com/image_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTEwL3Jhd3BpeGVsb2ZmaWNlMThfcGhvdG9fb2ZfYW5fYW5jaWVudF90ZW1wbGVfaW50ZXJpb3Jfc3VubGlnaHRfcF9hZDY1NDMyMC05OWE0LTQ0ZTgtOTZlMC0xZDg0ZTI3ZDliMGVfMS5qcGc.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>First slide label</h5>
                      <p>Some representative placeholder content for the first slide.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img style="height: 600px" src="https://images.rawpixel.com/image_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTEwL3Jhd3BpeGVsb2ZmaWNlMThfcGhvdG9fb2ZfYW5fYW5jaWVudF90ZW1wbGVfaW50ZXJpb3Jfc3VubGlnaHRfcF9hZDY1NDMyMC05OWE0LTQ0ZTgtOTZlMC0xZDg0ZTI3ZDliMGVfMS5qcGc.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Second slide label</h5>
                      <p>Some representative placeholder content for the second slide.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img style="height: 600px" src="https://images.rawpixel.com/image_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTEwL3Jhd3BpeGVsb2ZmaWNlMThfcGhvdG9fb2ZfYW5fYW5jaWVudF90ZW1wbGVfaW50ZXJpb3Jfc3VubGlnaHRfcF9hZDY1NDMyMC05OWE0LTQ0ZTgtOTZlMC0xZDg0ZTI3ZDliMGVfMS5qcGc.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Third slide label</h5>
                      <p>Some representative placeholder content for the third slide.</p>
                    </div>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div> --}}
        
        {{-- Newest Products --}}
        <div class="row mb-3">
            <div class="d-flex justify-content-between">
                <h2>Newest Products</h2>
              

            </div>
            <div id="carouselNewestProduct" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row row-cols-5">
                          @foreach ($newestProducts->slice(0,5) as $product)
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
                    </div>
                    <div class="carousel-item">
                        <div class="row row-cols-5">
                          @foreach ($newestProducts->slice(5,10) as $product)
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
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselNewestProduct" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselNewestProduct" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>

        {{-- Popular Products --}}
        <div class="row mb-2">
            <div class="d-flex justify-content-between">
                <h2>Popular Products</h2>

            </div>
            <div id="carouselPopularProduct" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row row-cols-5">
                           @foreach ($popularProducts->slice(0,5) as $product)
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
                    </div>
                    <div class="carousel-item">
                        <div class="row row-cols-5">
                          @foreach ($popularProducts->slice(5,10) as $product)
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
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPopularProduct" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselPopularProduct" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
       
    </div>



@endsection