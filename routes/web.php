<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProductController;

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





Route::get('/category/{slug}', [CategoryController::class, 'show'] );


Route::get('/cart', [ShopController::class, 'getToCart']);

Route::get('/update-cart', [ShopController::class, 'updateToCart']);

Route::get('/check-out', [ShopController::class, 'getToCheckOut']);

Route::get('/confirm-order', [ShopController::class, 'getToConfirm'] );

Route::post('/confirm-order', [ShopController::class, 'createOrder'] );


Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart']);

Route::get('/remove-out-cart/{id}', [ProductController::class, 'removeOutCart']);

Route::get('/product/search', [ProductController::class, 'search']);

Route::get('/product/{slug}', [ProductController::class, 'show']);




// ADMIN 

Route::middleware(['auth', 'admin', 'check.device'])->group(function(){

    
    Route::get('/admin', [ShopController::class, 'showConfigPage']);

    Route::post('/admin', [ShopController::class, 'addConfig']);
    // ADMIN MEDIA

    Route::get('/admin/media', [MediaController::class, 'index']);

    Route::get('/admin/media/upload', [MediaController::class, 'add']);

    Route::post('/admin/media/store', [MediaController::class, 'store']);

    Route::get('/admin/media/edit/{id}', [MediaController::class, 'edit']);

    Route::put('/admin/media/edit/{id}', [MediaController::class, 'update']);

    Route::delete('/admin/media/delete/{id}', [MediaController::class, 'destroy']);


    // ADMIN CATEGORY

    Route::get('/admin/category', [CategoryController::class, 'index']);

    Route::get('/admin/category/add', [CategoryController::class, 'add']);

    Route::post('/admin/category/store', [CategoryController::class, 'store']);

    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'edit']);

    Route::put('/admin/category/edit/{id}', [CategoryController::class, 'update']);

    Route::delete('/admin/category/delete/{category}', [CategoryController::class, 'delete']);

    // ADMIN/PRODUCTS

    Route::get('/admin/products/add', [ProductController::class, 'add']);

    Route::post('/admin/products/store', [ProductController::class, 'store']);

    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit']);

    Route::get('/admin/products/', [ProductController::class, 'index']);

    Route::post('/admin/products/{productId}/comments/add', [ProductController::class, 'addComment']);

    Route::delete('/admin/products/comment/{comment}/remove', [ProductController::class, 'removeComment']);

    Route::delete('/admin/products/delete/{product}', [ProductController::class, 'delete']);

    Route::put('/admin/products/edit/{product}', [ProductController::class, 'update']);

    Route::get('/admin/products/comments', [ProductController::class, 'comments']);

    // Orders
    Route::get('/admin/orders', [ShopController::class, 'orders']);

    Route::delete('/admin/orders/{order}/delete', [ShopController::class, 'deleteOrder']);

    Route::get('/admin/orders/detail/{order}', [ShopController::class, 'detailOrder']);


    // ADMIN/USERS

    Route::delete('/admin/users/{user}/delete', [AuthController::class, 'deleteUser']);

    Route::put('/admin/users/{user}/update_state', [AuthController::class, 'updateState']);

    Route::get('/admin/users/', [AuthController::class, 'gotoUsers']);


});

Route::get('/admin/register', function () { return view('admin.register');})->name('register');

Route::get('/admin/login', function () {return view('admin.login');})->name('login');

Route::post('/admin/login', [AuthController::class, 'authenticate']);

Route::post('/admin/logout', [AuthController::class, 'logout'] );

Route::post('/admin/register', [AuthController::class, 'register'] );

Route::get('/not-available-on-mobile', function (){ return view("no_mobile");} )->name('not-available-on-mobile');
// Route::get('/admin', function () {return view('admin.site_config');});


Route::get('/', [ShopController::class, 'index']);