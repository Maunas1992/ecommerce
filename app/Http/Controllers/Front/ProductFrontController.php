<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;    
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
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
        $products = $products->paginate(3);
             
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
        // echo "<pre>"; print_r('expression'); exit;
        $categories = Category::get(["category_name","id"]);
        $oldcatid = NULL;
        if(($request->category_ids)) {
            $oldcatid = $request->category_ids;
        }
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
        
        $products = $products->paginate(3);
        return view('store',compact('products','categories','oldcatid'));
    }

    

    public function order()
    {
        
        return view('order');
    }

    public function myfavourite(Request $request , Product $products)
    {
        // $products = Product::all();
        $user = auth()->user();
        $products = Wishlist::where('user_id',$user->id)->get();
        $wishlistcount = count($products);

        $categories = Category::get();
        return view('myfavourite',compact('products','categories'));
    }

    // public function addfavourite(Request $request , Product $products)
    // {
    //     $products = Product::all();
    //     $categories = Category::get();
    //     return view('myfavourite',compact('products','categories'));
    // }


    public function addwishlist(Request $request , Product $products,$id)
    {

        
        $user = auth()->user();
        $products = Product::find($id);
        $productscount = Wishlist::where('product_id', $products->id)
        ->where('user_id',$user->id)
        ->get();
        
        // $countproduct = count

        if($productscount->count() == null) {
       
        $wish = new Wishlist; 
        $wish->product_id = $products->id;
        $wish->user_id = $user->id;
        
        $wish->save();
        }

        // $products = Wishlist::where('user_id',$user->id)->get();
         // return redirect()->back()->with('success','Your product has been added to your Wishlist');
        
            
        // if($request->product_id !== null ) {
        //     $products->select('products.*')
        //             ->where(function($query) use($request) {
        //     $query->where('id',$request->product_id);
        // });
            

        // }; 
        // $products = $products->paginate(4);
        if($productscount->count() == null) {
            $status = true;
            return response()->json([
                'status' => $status,
                'message' => 'Your product has been added to your WishlistYour product has been added to your Wishlist'
            ]); 
        }  
        else {
            $status = false;
            return response()->json([
                'status' => $status,
                'message' => 'Your product is already in Wishlist.'
            ]);

        }            
          
        
        // return view('myfavourite',compact('products'));
    // }
}
}
