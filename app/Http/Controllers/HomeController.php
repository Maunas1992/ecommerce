<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
// use App\Models\Order;
use Auth;

use App\Models\Product;
use App\Models\Category;
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
    public function index()
    {
        if(Auth::user()->role == 'admin'){
            $products = Product::count();
            $users = User::count();
            $category = Category::count();
            return view('home',compact('products','users','category'));
        }else{
            $products = Product::get();
            $categories = Category::get();
            return view('welcome',compact('products','categories'));
        }
    }
}
