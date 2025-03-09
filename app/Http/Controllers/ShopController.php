<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShopConfig;
use App\Models\SubOrder;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index(){
        $newestProducts = Product::orderBy('created_at','desc')->take(4)->get();
        $popularProducts = Product::take(4)->get();

        return view('home_page',[
            'newestProducts' => $newestProducts,
            'popularProducts' => $popularProducts
        ]);
    }
    public function getToCart(Request $request){
        // session(['cart' => null]);   
        // $request->session()->forget('cart');

        
        // $request->session()->put('cart', null);
        $oldCart = $request->session()->get('cart') ?? null;

        $cart = new Cart($oldCart);
        return view('cart.view', ['cart' => $cart]);
    }


    public function updateToCart(Request $request){
        $oldCart = $request->session()->get('cart') ?? null;

        $cart = new Cart($oldCart);

        $itemsUpdated = $request->input('items', []);;
        $newQuantity = 0;
        $newTotalPrice = 0;


        foreach (array_keys($itemsUpdated) as $key) {
           if(array_key_exists($key, $cart->items)){
                if($itemsUpdated[$key] == 0){
                    unset($cart->items[$key]);
                } else {
                    $cart->items[$key]['quantity'] = $itemsUpdated[$key];
                    $cart->items[$key]['totalPrice'] =  $itemsUpdated[$key] * $cart->items[$key]['item']->price;
                    $newQuantity += $cart->items[$key]['quantity'];
                    $newTotalPrice += $cart->items[$key]['totalPrice'];
                }
           }
        }

        $cart->totalPrice = $newTotalPrice;
        $cart->totalQuantity = $newQuantity;


        session(['cart' => $cart]);

        return redirect('/cart');
    }


    public function showCheckOutPage(){
        return view('cart.checkout');
    }

    public function showConfirmPage(Request $request){
        $customerInfo = $request->validate([
            'fullname' => ['required'],
            'email' => ['required','email'],
            'address' => ['required'],
            'city' => ['required'],
            'note' => ['nullable'],
            'phone' =>['required', 'regex:/^(\+84|0)(\d{9})$/']
        ]);

        $cart = $request->session()->get('cart');

        session(['customer' => $customerInfo]);
    
        return view('cart.confirm', [
            'customer' => $customerInfo,
            'cart' => $cart
        ]);
    }


    public function createOrder(Request $request){
        $newCustomer = new Customer($request->session()->get('customer'));
        $newCustomer->save();

        $cart =new Cart($request->session()->get('cart') ); 
        
        $order = new Order();
        $order->customer_id = $newCustomer->id;
        $order->total_price = $cart->totalPrice;
        $order->total_quantity = $cart->totalQuantity;
        $order->save();

        foreach ($cart->items as $item) {
             $subOrder = new SubOrder([
                'order_id' => $order->id,
                'product_name' => $item['item']->name,
               
                'quantity' => $item['quantity'],
                'total_price' => $item['totalPrice']
             ]);

             $subOrder->product_price =   $item['item']->price;
             
             $subOrder->save();
        }


        $request->session()->flush();




        return view('order.show', ['order' => $order]);
    }


    public function orders(){
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('order.index', ['orders' => $orders, 'page_group'=> 'shop']);
    }

    public function deleteOrder(Order $order){
        $order->subOrders()->delete();
        // $order->customer()->delete();
        $order->delete();

        return back();
    }


    public function showDetailOrder(Order $order){
        return view('order.detail', [
            'order' => $order,
            'page_group' => 'shop'
        ]);
    }


    public function showConfigPage(){
        $shop = ShopConfig::orderBy('created_at', 'desc')->first() ?? null;

        return view('admin.site_config', [
            'page_group' => 'config',
            'shop' =>  $shop
        ]);
    }

    public function addConfig(Request $request){
        $shop =  ShopConfig::orderBy('created_at', 'desc')->first() ?? new ShopConfig();
        
        $validatedData = $request->validate([
            'name' => ['nullable'],
            'email' =>  ['nullable', 'email'],
            'address' => ['nuLlable'],
            'phone' => ['nullable', 'regex:/^(\+84|0)(\d{9})$/'],
            'currency' => ['nullable'],
            'logo' => ['nullable', 'mimes:jpg, png'],
            'favicon' => ['nullable', 'mimes:jpg, png']
        ]);

        $shop->name = $validatedData['name'];
        $shop->email = $validatedData['email'];
        $shop->address = $validatedData['address'];
        $shop->phone = $validatedData['phone'];
        $shop->currency = $validatedData['currency'];

        if($request->hasFile('logo')){

            $shop->logo = $request->file('logo')->storeAs('shop', 'logo'  ,'public') ;
        }

        if($request->hasFile('favicon')){

            $shop->favicon = $request->file('favicon')->storeAs('shop', 'favicon'  ,'public');
        }
       
        $shop->save();

        return back();
    }
   
}
