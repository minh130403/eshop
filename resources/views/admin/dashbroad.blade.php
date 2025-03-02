<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop Project</title>
    {{-- Boostrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- Fontanwsome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            height: 100vh;
            overflow: hidden;
        }

        .list-group-item{
            height: 60px;
        }

        #body{
            height: 100vh;
            overflow-y: scroll
        }

        #main-content{
            min-height: 80vh;
        }

        .list-group-item-action:hover{
            z-index: unset;
        }


        p, span, tr, td, h1, h2, h3, h4{
            caret-color: transparent
        }

        #sidebar .list-group-item:hover{
            cursor: pointer;
        }
    </style>

    {{-- Config TimyEdittor --}}
    <x-head.tinymce-config/>
</head>
<body>
   <div class="">
    <div class="row">
        <div class="col-2 d-flex align-items" id="sidebar">

            {{-- Side bar --}}
                <ul class="list-group border rounded shadow" style="height:100vh; width:100%">
                    <li class="list-group-item    d-flex justify-content-between align-items-center">
                    <h3>Eshop Admin</h3>
                    </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $page_group == 'config' ? 'active' : '' }}">
                        <div><a style="color: inherit; text-decoration: none;" href="/admin"><i class="fa-solid fa-gear"></i> Site Config</a></div>
                    </li>
                    <li class="list-group-item list-group-item-action  d-flex justify-content-between align-items-center  {{ $page_group == 'product' ? 'active' : '' }}">
                        <div class="dropdown">
                            <span class="dropdown-toggle" type="span" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-box"></i> Product
                            </span>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="/admin/products/add"><i class="fa-solid fa-plus"></i> Add a New Product</a></li>
                              <li><a class="dropdown-item" href="/admin/products"><i class="fa-solid fa-bars"></i> All Products</a></li>
                              <li><a class="dropdown-item" href="/admin/products/comments"><i class="fa-solid fa-comment"></i> Comments</a></li>
                              {{-- <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash"></i> Trash</a></li> --}}
                            </ul>
                          </div>
                    </li>
    
                    <li class="list-group-item list-group-item-action  d-flex justify-content-between align-items-center  {{ $page_group == 'category' ? 'active' : '' }}">
                        <div class="dropdown">
                            <span class="dropdown-toggle" type="span" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-book"></i> Category
                            </span>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="/admin/category/add"><i class="fa-solid fa-plus"></i> New Category</a></li>
                              <li><a class="dropdown-item" href="/admin/category"><i class="fa-solid fa-bars"></i> All Categories</a></li>
                              {{-- <li><a class="dropdown-item" href=""><i class="fa-solid fa-trash"></i> Trash</a></li>     --}}
                            </ul>
                          </div>
                    </li>
                    <li class="list-group-item list-group-item-action  d-flex justify-content-between align-items-center  {{ $page_group == 'shop' ? 'active' : '' }}">
                        
                        <div class="dropdown">
                            <span class="dropdown-toggle" type="span" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-shop"></i> Shop    
                            </span>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="/admin/orders"><i class="fa-solid fa-money-bill"></i> Order</a></li>
                    
                            </ul>
                          </div>
                    </li>
                    <li class="list-group-item list-group-item-action  d-flex justify-content-between align-items-center  {{ $page_group == 'user' ? 'active' : '' }}">
                        
                        <div class="dropdown">
                            <span class="dropdown-toggle" type="span" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i> User   
                            </span>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="/admin/users"><i class="fa-solid fa-users"></i> Users</a></li>
                            </ul>
                          </div>
                    </li>
                    <li class="list-group-item list-group-item-action  d-flex justify-content-between align-items-center {{ $page_group == 'media' ? 'active' : '' }}">
                        
                        <div class="dropdown">
                            <span class="dropdown-toggle" type="span" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-image"></i> Media   
                            </span>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="/admin/media/upload"><i class="fa-solid fa-plus"></i> Add Image</a></li>
                              <li><a class="dropdown-item" href="/admin/media"><i class="fa-solid fa-image"></i> All Image</a></li>
                            </ul>
                          </div>
                    </li>
                    {{-- <li class="list-group-item list-group-item-action  d-flex justify-content-between align-items-center">
                        
                        <div class="dropdown">
                            <span class="dropdown-toggle" type="span" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-pager"></i> Page   
                            </span>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#"><i class="fa-solid fa-plus"></i> About Me</a></li>
                              <li><a class="dropdown-item" href="#"><i class="fa-solid fa-image"></i> Contact</a></li>
                            </ul>
                          </div>
                    </li> --}}
                </ul>

        </div>

        <div class="col-10" id="body">
            <div id="main-content">
                @yield('body')
            </div>

            <footer class="p-3 mt-3 mb-3 text-center border rounded">
                <span>Design by tienminh@.@</span>
            </footer>
        </div>
    </div>  
   </div>
</body>
</html>