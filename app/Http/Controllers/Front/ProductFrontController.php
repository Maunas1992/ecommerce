<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductFrontController extends Controller
{
    public function index(Request $request , Product $products)
    {
        
        $products = $products->newQuery();
      
        $categories = Category::get();

        if ($request->search !== null){
        
            $products->select('products.*')
                    ->where(function($query) use($request) {
            $query->where('p_name', 'LIKE', "%{$request->search}%" )
            ->orwhere('description', 'LIKE', "%{$request->search}%" );
            });
        };
            

          // echo "<pre>"; print_r($users->get()); exit;
        // $inquirys = new Inquiry();      
        $products = $products->paginate();
             
        return view('welcome',compact('products','categories'));
    }

    public function showproduct($id)
    {
        $products = Product::find($id);
        // $products = Product::get();
        return view('showproduct',compact('products'));
    }

    public function storeproduct()
    {
        $products = Product::get();
        $categories = Category::get();

 // echo "<pre>"; print_r($categories); exit;
        return view('store',compact('products'));
    }

    public function getcategory($id)
    {
        
        $categories = Category::find($id);
        // echo "<pre>"; print_r($categories); exit;
            $products = Product::where('category_id',$categories->id)->get();
        
        return view('store',compact('products'));
    }

     

    public function order()
    {
        
        return view('order');
    }


}
