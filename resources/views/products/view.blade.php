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
            <div class="col-12 col-md-4">
                <img class="img-fluid object-fit-scale" alt="{{ $product->avatar->alt ?? null}}"
                @empty($product->avatar->src)  src="https://png.pngtree.com/png-clipart/20230823/original/pngtree-illustration-of-set-different-dairy-milk-products-picture-image_8225323.png " @endempty 
                @isset($product->avatar->src)  src="{{ asset($product->avatar->src) }}" alt="{{ $product->avatar->alt }}" @endisset  >
            </div>

            <div class="col-12 col-md-8">
                <h1>{{ $product->name }}</h1>
                <span class="mb-3"> <b> {{ number_format($product->price) }} VND </b> </span>
                <div class="mb-3"> {!! $product->short_description !!}
                </div>
                <span></span>
                <div class="mb-1">
                    <a href="/add-to-cart/{{ $product->id }}" class="btn btn-primary">Add to Cart</a>
                </div>
                <hr>
                <div id="tagsGroup" class="mb-1">
                    Tags:
                    @foreach ($product->tags as  $tag)
                        <a class="badge text-bg-primary" href="/tag/{{ $tag->slug }}" style="text-decoration: none">{{ $tag->name }}</a>
                    @endforeach
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
                  <button class="nav-link position-relative" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Comments
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $product->loadCount('comments')->comments_count }}
                  </span></button>
                    
                </li>
              </ul>
              <div class="tab-content" id="productTabContent">

                {{-- Description --}}
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    {!! $product->description !!}
                </div>

                {{-- Comments --}}
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <form class="mt-2" action="/admin/product/{{ $product->id }}/comments/add" class="d-flex" method="post">
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
                                        <form action="/admin/product/comment/{{ $comment->id }}/remove" method="post"> 
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
        </div>
        <div class="container">
            <div class="row row-cols-2 row-cols-md-4 g-4">
                @foreach ($similarProducts ?? [] as $product)
                   <x-product-card :product="$product"></x-product-card>
                @endforeach
        </div>
    </div>
    </div>


   
@endsection
