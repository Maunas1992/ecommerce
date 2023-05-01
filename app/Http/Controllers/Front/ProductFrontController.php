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
        }
        $productschecked = [];
        if ($productschecked == null) {
            if (!auth()->user()){
                $products = $products->newQuery();
                $categories = Category::get();
                if ($request->search !== null){
                    $products->select('products.*')
                    ->where(function($query) use($request) {
                        $query->where('p_name', 'LIKE', "%{$request->search}%" )
                        ->orwhere('description', 'LIKE', "%{$request->search}%" );
                    });
                }      
                $products = $products->paginate(3);
                return view('welcome',compact('products','categories','productschecked'));
            }
        }
        $products = $products->paginate(3);
        return view('welcome',compact('products','categories','productschecked'));
    }

    public function showproduct($id)
    {
      $products = Product::find($id);
        return view('showproduct',compact('products'));
    }

    public function storeproduct()
    {
        $products = Product::get();
        $categories = Category::get();
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
            $products = $products->paginate();
            if ($products->count() || $productschecked !== null) {
                $status = true;
                $user = auth()->user();
                if ($user) {
                    $productschecked = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();

                    $html = view::make('categoryform',compact('products','productschecked'))
                    ->render();
                } 
                $productschecked = Wishlist::where('user_id', $user->id)->pluck('product_id')->toArray();
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
}
