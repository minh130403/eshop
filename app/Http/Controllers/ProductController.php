<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Media;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at', 'desc')->paginate(5);
        return view('products.index', [
            'products' => $products,
            'page_group' => 'product' 
        ]);
    }

    public function add(){
        $categories = Category::all();
        return view('products.add',[
            'categories' => $categories,
            'page_group' => 'product' 
        ]);
    }

    public function store(Request $request){
        $newProduct = new Product();
        $newProduct->name = $request->input('name');
        $newProduct->description = $request->input('description') ?? '';
        $newProduct->short_description = $request->input('short_description') ?? '';
        $newProduct->price = $request->input('price') ?? 0 ;
        $newProduct->slug = Str::of($newProduct->name)->slug('_');

        $avatar = Media::find($request->input('avatar_id'));
 
        $avatar->products()->save($newProduct);

        $categories = Category::findMany( $request->input('categories', []));
        
        // foreach($categories as $category){
        //     $category->products()->save($newProduct);
        // }


        foreach($categories as $category){
            $newProduct->categories()->save($category);
        }
       

        return redirect('/admin/products/');
    }

    public function edit($id){
        $product = Product::find($id);
        $categories = Category::all();

        return view('products.edit',[
            'product' => $product,
            'categories' => $categories,
            'page_group' => 'product' 
       ]);
    }

    public function update(Request $request, Product $product){
        $product->name = $request->input('name');
        $product->short_description = $request->input('short_description') ?? $product->short_description;
        $product->description = $request->input('description') ?? $product->description;
        $product->price = $request->input('price') ?? $product->price;
        $product->avatar_id = $request->input('avatar_id') ?? $product->avatar_id;
        $categories = Category::findMany( $request->input('categories', []));

        $product->categories()->detach();  

        foreach($categories as $category){
            $product->categories()->save($category);
        }

        $product->save();

        return view('products.edit',[
            'product' => $product,
            'page_group' => 'product' 
       ]);
    }


    public function delete(Product $product){
        $product->delete();
        return back();
    }

    public function show($slug){
        $product = Product::where('slug', $slug)->first();

        return view('products.view',[
            'product' => $product,
       ]);
    }


    public function search(Request $request){
        $keyword = $request->input('keyword');
        $result = Product::where('name', 'LIKE', '%' . $keyword . '%')->paginate(12);

        return view('products.search', ['result' => $result, 'keyword' => $keyword]);
    }


    public function addToCart($id, Request $request){
        $product = Product::find($id);
        $oldCart = $request->session()->get('cart') ?? null;
        $cart = new Cart($oldCart);

        $cart->addItem($product);

        session(['cart' => $cart]);

        return redirect('/cart');
    }


    public function removeOutCart($id, Request $request){
        $product = Product::find($id);
        $oldCart = $request->session()->get('cart') ?? null;
        $cart = new Cart($oldCart);

        $cart->removeItem($product);
        
        session(['cart' => $cart]);

        return redirect('/cart');
    }


    public function comments(){
        $comments = Comment::orderBy('created_at', 'desc')->paginate(10);


        return view('products.comments', [
            'comments' => $comments,
            'page_group' => 'product'
        ]);
    }

    /**
     * Add a new comment for the product from a user
     * @param number $productId
     * @return \App\Models\Comment; 
     */
    public function addComment(Request $request, $productId){
        $comment = new Comment();

        $comment->content = $request->input('content');
        $comment->user_id = Auth::id();
        $comment->product_id = $productId;
        $comment->save();

        return back();
    }



    /**
     * Remove comment from product, user
     * @param \App\Models\Comment;
     * @return \App\Models\Comment; 
     */
    public function removeComment(Comment $comment){

        $comment->delete();
        

        return back();
    }
}
