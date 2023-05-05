<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;

class CartController extends Controller
{
    public function addtocart(Request $request , Product $products) {
        // $products = Product::find($id);
        $categories = Category::get();
        $products = Product::get();
        // echo "<pre>"; print_r($carts); exit;
        // echo "<pre>"; print_r('expression'); exit;
        return view('viewcart',compact('products','categories'));
    }
}
