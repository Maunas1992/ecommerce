<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            return view('home');
        }else{
            $products = Product::get();
            $categories = Category::get();
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
