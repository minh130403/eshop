<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/"><img class="border rounded-circle " src="{{ asset($shop->logo ?? '') }}" alt="" style="height: 50px"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          {{-- List Category --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu">
              @foreach ($categories as $category)
              <li><a class="dropdown-item" href="/category/{{ $category->slug }}">{{ $category->name }}</a></li>
              @endforeach
            </ul>
          </li>
        </ul>


        <form class="d-flex" role="search" action="/product/search/"> 
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
        </form>

        @if (Auth::check())
          <form action="/admin/logout" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary ms-2" href="">Logout</button>
          </form>
        @else
         <a class="btn btn-primary ms-2" href="/admin/login">Login</a>
        @endif
        <a class="btn btn-primary ms-2" href="/cart/"><i class="fa-solid fa-cart-shopping"></i></a>
      </div>
    </div>
  </nav>