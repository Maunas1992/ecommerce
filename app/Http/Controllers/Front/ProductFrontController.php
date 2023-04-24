<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use View;
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

    public function getcategory(Request $request , Product $products)
    {
        
        $categories = Category::get(["category_name","id"]);
    
        $products = $products->newQuery()
            ->select('products.*');
        if ($request->category !== null){
                $products = $products->leftJoin('categories','categories.id','=','products.category_id')
                ->where(function($query) use($request) {
                    $query->where('categories.id', 'LIKE', "%{$request->category}%" );
                });
        };
                

        if($request->ajax()) {
            $html = '';
            $status = false;
            if ($request->category_ids !== null && count($request->category_ids)){
                    $products = $products
                        ->leftJoin('categories','categories.id','=','products.category_id')
                        ->where(function($query) use($request) {
                            $query->wherein('categories.id', $request->category_ids );
                    });
            }

            // Price
            
            // Brand
            $products = $products->paginate();
            if ($products->count()) {
                $status = true;
                $html = view::make('categoryform',compact('products'))
                    ->render();
            }

            return response()->json([
                'status' => $status,
                'html' => $html
            ]);
        }
        
        $products = $products->paginate();
        return view('store',compact('products','categories'));
    }

    

    public function order()
    {
        
        return view('order');
    }

    public function myfavourite(Request $request , Product $products)
    {
        $products = Product::all();
        $categories = Category::get();
        return view('myfavourite',compact('products','categories'));
    }

    public function addfavourite(Request $request , Product $products)
    {
        $products = Product::all();
        $categories = Category::get();
        return view('myfavourite',compact('products','categories'));
    }
}
