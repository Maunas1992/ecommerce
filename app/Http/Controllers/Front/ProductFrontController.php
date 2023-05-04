<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\ProductVariant;    
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use View;
class ProductFrontController extends Controller
{
    public function index(Request $request , Product $products)
    {

        $products = $products->newQuery();
        $categories = Category::get();
        if ($products->count() || $productschecked !== null) {
                // echo "<pre>"; print_r('expression'); exit;
                $status = true;
                $user = auth()->user();
                
        } 
        
        
        // if ($request->search !== null){
        //     $products->select('products.*')
        //     ->where(function($query) use($request) {
        //         $query->where('p_name', 'LIKE', "%{$request->search}%" )
        //         ->orwhere('description', 'LIKE', "%{$request->search}%" );
        //     });
        // }
        $user = auth()->user();
        $productschecked = [];
        if ($productschecked == null && auth()->user()) {
            
                $products = $products->newQuery();
                $categories = Category::get();
                $productschecked = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
                $status = true;

        }
        
                // if ($request->search !== null){
                //     $products->select('products.*')
                //     ->where(function($query) use($request) {
                //         $query->where('p_name', 'LIKE', "%{$request->search}%" )
                //         ->orwhere('description', 'LIKE', "%{$request->search}%" );
                //     });
                // }      
               
            
        // echo "<pre>"; print_r($productschecked); exit;
        $products = $products->paginate(3);
        return view('welcome',compact('products','categories','productschecked'));
    }

    public function showproduct($id,Request $request , Product $products ,ProductVariant $productVariant)
    {
        $products = Product::find($id);
        $productVariant = ProductVariant::where('product_id',$products->id)->get();
        
        // echo "<pre>"; print_r($productVariant); exit;
        if ($products->count() || $productschecked !== null) {
                // echo "<pre>"; print_r('expression'); exit;
                $status = true;
                $user = auth()->user();
                
        } 
        $productschecked = [];
        if ($productschecked !== null && auth()->user()) {
            
                $user = auth()->user();
                $productschecked = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
                $status = true;
        }
        $productsshow = Product::get();

        return view('showproduct',compact('products','productschecked','productsshow','productVariant'));
    }

    public function storeproduct()
    {
        $products = Product::get();
        $categories = Category::get();
                    return view('store',compact('products'));
    }

    public function getcategory(Request $request , Product $products)
    {
        $user = auth()->user();
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
        if ($request->category_option !== null ){
            $products->where('category_id',$request->category_option)
                ->get();
            }
            
            // $products = $products->leftJoin('categories','categories.id','=','products.category_id')
            //         ->where(function($query) use($request) {
            //         $query->where('categories.id', 'LIKE', "%{$request->category_option}%" );
                    
            // });
        // };
        if ($request->search !== null){
                    $products->where('p_name', 'LIKE', "%{$request->search}%" )
                        ->orwhere('description', 'LIKE', "%{$request->search}%" )
                        ->orwhere('price', 'LIKE', "%{$request->search}%" );
                    // });
                }
        
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


            $products = $products->paginate();
            $productschecked = [];
            if ($products->count() && $productschecked !== null) {
                $status = true;
                if ($user) {
                    $productschecked = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
                    $html = view::make('categoryform',compact('products','productschecked'))
                    ->render();
                } 
                $html = view::make('categoryform',compact('products','productschecked'))
                    ->render();
            } 
            return response()->json([
                'status' => $status,
                'html' => $html
            ]);
        }
        $productschecked = [];
        if ($productschecked !== null && auth()->user()) {
            
                $user = auth()->user();
                $productschecked = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
                $status = true;
        }

        $products = $products->paginate(3);
        return view('store',compact('products','categories','oldcatid','productschecked'));
    }

    public function order()
    {
        
        return view('order');
    }

    public function myfavourite(Request $request , Product $products)
    {
        // echo "<pre>"; print_r($products); exit;
        $user = auth()->user();
        // $products = Product::all();
        if ($user) {
            $products = Wishlist::where('user_id',$user->id)->get();
            $wishlistcount = count($products);
            $productschecked = [];
            if ($productschecked !== null) {
                    $user = auth()->user();
                    $productschecked = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
                
                    $status = true;
            }
        } 
        else {
            return view('auth.login');
        }
        // echo "<pre>"; print_r($productschecked); exit;
        $categories = Category::get();
        return view('myfavourite',compact('products','categories','productschecked'));
    }
    
    public function addwishlist(Request $request , Product $products,$id)
    {
        $user = auth()->user();
        $products = Product::find($id);
        // echo "<pre>"; print_r($products->id); exit;
        if ($user) {
            $productscount = Wishlist::where('product_id', $products->id)
            ->where('user_id',$user->id)
            ->first();

        if($productscount){
            $wish = Wishlist::find($productscount['id']);
            $wish->delete();
        }else{
            $wish = new Wishlist; 
            $wish->product_id = $products->id;
            $wish->user_id = $user->id;
            $wish->save();
            $status = true;
                return response()->json([
                'status' => $status,
                'message' => 'Your product has been added to your Wishlist.'
            ]);
        }
        }
        $productsadded = Wishlist::where('product_id', $products->id)->pluck('product_id')->toArray();
       
         
        // $products = Wishlist::where('user_id',$user->id)->get();
        // if($request->product_id !== null ) {
        //     $products->select('products.*')
        //             ->where(function($query) use($request) {
        //     $query->where('id',$request->product_id);
        // });
        // }; 
        // $products = $products->paginate(4);
        // if($productscount->count() !== null) {
        //     $status = true;
        //     return response()->json([
        //         'status' => $status,
        //         'message' => 'Your product has been added to your WishlistYour product has been added to your Wishlist'
        //     ]); 
        // }  
        // else {
            $status = false;
            return response()->json([
                'status' => $status,
                'message' => 'Your product is removed from Wishlist.'
            ]);
    }

    public function removewishlist(Request $request , Product $products,$id)
    {
        $user = auth()->user();
        $wish = Wishlist::find($id);
        // echo "<pre>"; print_r($wish); exit;

        $wish->delete();
        return redirect()->route('myfavourite');

    }
}
