<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Models\Tag;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/tag/{slug}', [TagController::class, 'show']);

Route::get('/category/{slug}', [CategoryController::class, 'show'] );

Route::get('/cart', [ShopController::class, 'getToCart']);

Route::get('/update-cart', [ShopController::class, 'updateToCart']);

Route::get('/check-out', [ShopController::class, 'showCheckOutPage']);

Route::get('/confirm-order', [ShopController::class, 'showConfirmPage'] );

Route::post('/confirm-order', [ShopController::class, 'createOrder'] );


Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart']);

Route::get('/remove-out-cart/{id}', [ProductController::class, 'removeOutCart']);

Route::get('/product/search', [ProductController::class, 'search']);

Route::get('/product/{slug}', [ProductController::class, 'show']);


Route::middleware('auth')->group(function() {

    Route::delete('/admin/product/comment/{comment}/remove', [ProductController::class, 'removeComment']);
 
    Route::post('/admin/product/{product}/comments/add', [ProductController::class, 'addComment']);
    
});

// ADMIN 

Route::middleware(['auth', 'admin', 'check.device'])->group(function(){


    // ADMIN MEDIA


    Route::get('/admin/media/create', [MediaController::class, 'create']);

    Route::get('/admin/media/{media}', [MediaController::class, 'edit']);

    Route::put('/admin/media/{media}', [MediaController::class, 'update']);

    Route::delete('/admin/media/{media}', [MediaController::class, 'destroy']);

    Route::get('/admin/media', [MediaController::class, 'index']);

    Route::post('/admin/media', [MediaController::class, 'store']);



    // ADMIN CATEGORY


    Route::get('/admin/category/create', [CategoryController::class, 'create']);

    Route::get('/admin/category/{category}', [CategoryController::class, 'edit']);

    Route::put('/admin/category/{category}', [CategoryController::class, 'update']);

    Route::delete('/admin/category/{category}', [CategoryController::class, 'delete']);

    Route::get('/admin/category', [CategoryController::class, 'index']);

    Route::post('/admin/category', [CategoryController::class, 'store']);

    // ADMIN TAG

    Route::get('/admin/tag/create', [TagController::class, 'create']);


    Route::delete('/admin/tag/{tag}', [TagController::class, 'delete']);
   
    Route::put('/admin/tag/{tag}', [TagController::class, 'update']);

    Route::get('/admin/tag/{tag}', [TagController::class, 'edit']);

    Route::post('/admin/tag', [TagController::class, 'store']);

    Route::get('/admin/tag', [TagController::class, 'index']);


    // ADMIN/PRODUCTS
    Route::get('/admin/product/comments', [ProductController::class, 'comments']);


    Route::get('/admin/product/create', [ProductController::class, 'create']);


    Route::get('/admin/product/{product}', [ProductController::class, 'edit']);

    Route::delete('/admin/product/{product}', [ProductController::class, 'delete']);

    Route::put('/admin/product/{product}', [ProductController::class, 'update']);

    Route::get('/admin/product/', [ProductController::class, 'index']);

    Route::post('/admin/product', [ProductController::class, 'store']);


   
    // Orders
    Route::get('/admin/orders', [ShopController::class, 'orders']);

    Route::delete('/admin/orders/{order}/delete', [ShopController::class, 'deleteOrder']);

    Route::get('/admin/orders/detail/{order}', [ShopController::class, 'showDetailOrder']);


    // ADMIN/USERS

    

    Route::delete('/admin/users/{user}/delete', [AuthController::class, 'deleteUser']);

    Route::put('/admin/users/{user}/update_state', [AuthController::class, 'updateState']);

    Route::get('/admin/users/', [AuthController::class, 'gotoUsers']);

        
    Route::get('/admin', [ShopController::class, 'showConfigPage']);

    Route::post('/admin', [ShopController::class, 'addConfig']);

    


});




Route::get('/admin/register', function () { return view('admin.register');})->name('register');

Route::get('/admin/login', function () {return view('admin.login');})->name('login');

Route::post('/admin/login', [AuthController::class, 'authenticate']);

Route::post('/admin/logout', [AuthController::class, 'logout'] );

Route::post('/admin/register', [AuthController::class, 'register'] );

Route::get('/not-available-on-mobile', function (){ return view("no_mobile");} )->name('not-available-on-mobile');
// Route::get('/admin', function () {return view('admin.site_config');});


Route::get('/', [ShopController::class, 'index']);