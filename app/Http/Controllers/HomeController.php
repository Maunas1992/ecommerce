<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Order;
use Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request , Product $products)
    {
        
        if(Auth::user()->role == 'admin'){
            $products = Product::count();
            $users = User::count();
            $category = Category::count();
            return view('home',compact('products','users','category'));
        }else{
            
            $products = Product::get();
            $categories = Category::get();
            if ($products->count() || $productschecked !== null) {
                // echo "<pre>"; print_r('expression'); exit;
                $status = true;
                $user = auth()->user();
                
            } 
            $productschecked = [];
            if ($productschecked == null) {
            // echo "<pre>"; print_r('expression'); exit;
            $user = auth()->user();
            $productschecked = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
             $status = true;
            // echo "<pre>"; print_r($productschecked); exit;
            }
              
            return view('welcome',compact('products','categories','productschecked'));
        }
    }
}
