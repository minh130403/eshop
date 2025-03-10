<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Media;
use App\Models\Cart;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Show all products
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $products = Product::orderByDesc('created_at')->paginate(6);
        $page_group = 'product';

        return view('products.index')->with(compact('products', 'page_group'));
    }

    /**
     * Show create product page
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function create(){

        return view('products.create')->with('page_group', 'product');
    }

    /**
     * Store a new product object
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request){


        $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['nullable'],
            'short_description' => ['nullable'],
            'price' => ['nullable','numeric', 'max:1000000000' ,'min:0', 'gt:sale_price'],
            'sale_price' => ['nullable', 'numeric', 'min:1'],
            'tags' => ['nullable'],
            'avatar_id' => ['nullable', 'image'],
            'categories' => ['nullable', 'array', 'exists:categories,id'],
        ]);


        // dd( $validatedData['short_description']);

        $product = Product::create(array_merge(array_slice($validatedData,0,5), ['slug' => Str::of($validatedData['name'])->slug('_')]) );

        $tagsArray = explode(";", $validatedData['tags']);

        foreach($tagsArray as $tagElement){
            $tag = Tag::firstOrCreate(['name' => trim($tagElement), 'slug' => Str::of(trim($tagElement))->slug('_')]);
            $tag->products()->save($product);
        }


        if(isset($validatedData['categories'])){
            foreach($validatedData['categories'] as $id){
                $product->categories()->save(Category::find($id));
            }
        }
       

        return redirect('/admin/product/');
    }

    /**
     * Edit a product object
     * @param \App\Models\Product $product
     * @return mixed|\Illuminate\Contracts\View\View
     */
    public function edit(Product $product){
        $page_group = 'product';

        // dd($product->avatar->src);

        return view('products.edit')->with(compact('product', 'page_group'));
    }


    /**
     * Update product
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $product){
         $validatedData = $request->validate([
            'name' => ['required'],
            'description' => ['nullable'],
            'short_description' => ['nullable'],
            'price' => ['nullable','numeric', 'max:1000000000' ,'min:0', 'gt:sale_price'],
            'sale_price' => ['nullable', 'numeric', 'min:1'],
            'avatar_id' => ['nullable', 'exists:images,id'],
            'tags' => ['nullable'],
            'categories' => ['nullable', 'array', 'exists:categories,id'],
        ]);

        // dd( $request->all());


        $product->update(array_merge(array_slice($validatedData,0, 5), ['slug' => Str::of($validatedData['name'])->slug('_')]));

        $product->tags()->detach();

        $tagsArray = explode(";", $validatedData['tags']);

        foreach($tagsArray as $tagElement){
            $tag = Tag::firstOrCreate(['name' => trim($tagElement), 'slug' => Str::of(trim($tagElement))->slug('_')]);
            $tag->products()->save($product);
        }

        // $product->avatar_id = (int) $validatedData['avatar_id'];

        // $avatar = Media::find($validatedData['avatar_id']);

        // $avatar->products()->save($product);

        $product->categories()->detach();  

        if(isset($validatedData['categories'])){
            foreach($validatedData['categories'] as $id){
                $product->categories()->save(Category::find($id));
            }
        }

       

        return redirect("/admin/product/$product->id" );
    }


    /**
     * Delete a product
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Product $product){
        $product->delete();
        return back();
    }


    /**
     * Show the product page
     * @param mixed $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($slug){
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('products.view')->with(compact('product'));
    }


    /**
     * Find products by keyword
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request){
        $keyword = $request->input('keyword');
        $result = Product::where('name', 'LIKE', '%' . $keyword . '%')->paginate(8);

        return view('products.search')->with(compact('result', 'keyword'));
    }


    /**
     * Add the product into the cart
     * @param mixed $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addToCart($id, Request $request){
        $product = Product::find($id);
        $oldCart = $request->session()->get('cart') ?? null;
        $cart = new Cart($oldCart);

        $cart->addItem($product);

        session(['cart' => $cart]);

        return redirect('/cart');
    }


    /**
     * Remove the product outto the cart
     * @param mixed $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeOutCart(Product $product, Request $request){
        $oldCart = $request->session()->get('cart') ?? null;
        $cart = new Cart($oldCart);

        $cart->removeItem($product);
        
        session(['cart' => $cart]);

        return redirect('/cart');
    }

    /**
     * Show comment list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function comments(){
        $comments = Comment::orderBy('created_at', 'desc')->paginate(10);


        return view('products.comments', [
            'comments' => $comments,
            'page_group' => 'product'
        ]);
    }

    /**
     * Add a new comment for the product from a user
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addComment(Request $request, Product $product){
        $comment = new Comment();

        $comment->content = $request->input('content');
        $comment->user_id = Auth::id();
        $comment->product_id = $product->id;
        $comment->save();

        return back();
    }

    /**
     * Update sate of comment
     * @param \App\Models\Comment $comment
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStateComment(Comment $comment, Request $request){
        $comment->state = $request->input('state');
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
