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
        </div>
              <div class="row">  
                @foreach ($newestProducts as $product)
                <x-product-card :product="$product"></x-product-card>
                @endforeach
              </div>

        {{-- Popular Products --}}
        <div class="row mb-3">
            <div class="d-flex justify-content-between">
                <h2>Popular Products</h2>
            </div>
          </div>
          <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4">  
            @foreach ($popularProducts as $product)
              <x-product-card :product="$product"></x-product-card>
            @endforeach
          </div>
        </div>
       
    </div>



@endsection