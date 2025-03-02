@extends('layouts.main')

@section('body')
    <div class="container">
        <div class="row mt-3 mb-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
              </nav>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-4">
                <img src="{{ asset($product->avatar->src) }}" class="img-fluid" alt="{{ $product->avatar->alt }}">
            </div>

            <div class="col-8">
                <h1>{{ $product->name }}</h1>
                <span> <b> {{ number_format($product->price) }} VND </b> </span>
                <div> {!! $product->short_description !!}
                </div>
                <span></span>
                <div class="mb-1">
                    <a href="/add-to-cart/{{ $product->id }}" class="btn btn-primary">Add to Cart</a>
                </div>
                <hr>
                <div id="tagsGroup" class="mb-1">
                    Tags:
                    <a class="tag-item mb-1">T-shirt</a> 
                    <a class="tag-item mb-1">Teanager</a> 
                    <a class="tag-item mb-1">Fashian</a> 
                    <a class="tag-item mb-1">Cheap</a>
                </div>
            </div>
            
        </div>
        <hr>

        
        {{-- Body --}}
        <div class="row mb-3">
            <ul class="nav nav-tabs" id="productTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Comments</button>
                </li>
              </ul>
              <div class="tab-content" id="productTabContent">

                {{-- Description --}}
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    {!! $product->description !!}
                </div>

                {{-- Comments --}}
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <form class="mt-2" action="/admin/products/{{ $product->id }}/comments/add" class="d-flex" method="post">
                        @csrf
                        <div class="form-floating mb-2">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="content"></textarea>
                            <label for="floatingTextarea">Comments</label>
                            </div>
                            <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Post</button>
                            </div>
                    </form>
                    <hr>
                    <div id="listComments">
                        @if (count($product->comments))
                            @foreach ($product->comments as $comment )
                            <div class="row mb-2" >
                                <div class="col-1" >
                                    <img style="height: 80px" src="https://th.bing.com/th/id/OIP.8wB2R85fj6V7QfRR_jVtsQHaHa?w=626&h=626&rs=1&pid=ImgDetMain" class="img-fluid" alt="...">
                                    <div class="text-center">{{ $comment->user->name }}</div>
                                </div>
                                <div class="col-11">
                                    <pre class="border rounded p-4" >{{ $comment->content }}</pre>
                                    @if (Auth::id() == $comment->user->id)
                                    <div class="text-end">
                                        <form action="/admin/products/comment/{{ $comment->id }}/remove" method="post"> 
                                            @csrf 
                                            @method('delete') 
                                            <button class="btn btn-primary ">Delete <i class="fa-solid fa-trash"></i></button>
                                        </form>
                                        <br>
                                        <button class="btn btn-primary ">Edit <i class="fa-solid fa-pen-to-square"></i></button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <hr> 
                            @endforeach
                        @endif
                       
                        
                    </div>
                </div>
              </div>
        </div>
        <hr>

         {{-- Similar Products --}}

    <div class="row mb-2">
        <div class="d-flex justify-content-between">
            <h2>Similar Products</h2>
            <a class="d-flex align-items-end mb-2" href=""><span>More</span></a>
        </div>
        <div id="carouselSimilarProduct" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row row-cols-4">
                        @for ($i = 0; $i< 4; $i++)
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="https://th.bing.com/th/id/OIP.SUA8N47Q2yLwM8s6cXlkmAHaHO?w=189&h=184&c=7&r=0&o=5&dpr=1.3&pid=1.7" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title">Card title {{ $i }}</h5>
                                <p class="card-text">1.000.000 VND</p>
                                <a href="#" class="btn btn-primary">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row row-cols-4">
                        @for ($i = 4; $i< 8; $i++)
                        <div class="col">
                            <div class="card" style="width: 18rem;">
                                <img src="https://th.bing.com/th/id/OIP.SUA8N47Q2yLwM8s6cXlkmAHaHO?w=189&h=184&c=7&r=0&o=5&dpr=1.3&pid=1.7" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title">Card title {{ $i }}</h5>
                                <p class="card-text">1.000.000 VND</p>
                                <a href="#" class="btn btn-primary">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSimilarProduct" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSimilarProduct" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
    </div>


   
@endsection
