<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Storage;
use Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->productVariant);
        $validationrules = [           
            'p_name'=>'required',
            'description'=>'required',
            'image' => 'required|image|mimes:jpeg,bmp,png',
            'qty'=>'required',
            'price'=>'required',
            'color'=>'required',        
            'discount'=>'required',        
            'category_id'=>'required',
            'status'=>'required',
            // 'productVariant.*.color' => 'required',
            // 'productVariant.*.quantity' => 'required',
            // 'productVariant.*.price' => 'required',
            // 'productVariant.*.discount' => 'required',
        ];
        $messages =[
            'p_name.required'=>'Please enter product name',
            'description.required'=>'Please enter description',
            'image.required'=>'Please select image',
            'qty.required'=>'Please enter quantity',
            'price.required'=>'Please enter price',
            'color.required'=>'Please enter color',
            'discount.required'=>'Please enter discount',
            'status.required'=>'Please select status',
            'category_id.required'=>'Please select category',
        ];
                   
        $request->validate($validationrules,$messages);

        $products = new Product;
        $products->p_name = $request->p_name;
        $products->description = $request->description;
        $products->qty = $request->qty;
        $products->price = $request->price;
        $products->color = $request->color;
        $products->discount = $request->discount;
        $products->status = $request->status;
        $products->category_id = $request->category_id;
        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $image->store('public/product');
        //     $products->image = $image->hashName();
        // }
        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->hashName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $path = public_path('storage/product/'.$filename);
            $image_resize->save($path);
        }

        $products->image = $filename;
        $products->status = $request->status;
        $products->save();

        $productVariant = new ProductVariant;
        if($request['productVariant']){
            foreach ($request['productVariant'] as $key => $pVariant) {
                // dd($pVariant);
            $productVariant->product_id = $products->id;
            $productVariant->quantity = $pVariant->qty;
            $productVariant->price = $pVariant->price;
            $productVariant->color = $pVariant->color;
            $productVariant->discount = $pVariant->discount;
            }
        }
        return redirect(route('product.index'))->with('success','Product added successfully');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::get();
        $products = Product::find($id);
        return view('admin.products.edit',compact('products','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validationrules = [
            'p_name'=>'required',
            'description'=>'required',
            'image'=>'nullable',
            'qty'=>'required',
            'price'=>'required',
            'color'=>'required',
            'discount'=>'required',
            'category_id'=>'required',
            'status'=>'required',
        ];
        $messages =[
            'p_name.required'=>'Please enter product name',
            'description.required'=>'Please enter description',
            'qty.required'=>'Please enter quantity',
            'price.required'=>'Please enter price',
            'color.required'=>'Please enter color',
            'discount.required'=>'Please enter discount',
            'category_id.required'=>'Please select category',
            'status.required'=>'Please select status',
        ];

        $request->validate($validationrules,$messages);
        $products = Product::find($id);
        $products->p_name = $request->p_name;
        $products->description = $request->description;
        $products->qty = $request->qty;
        $products->price = $request->price;
        $products->color = $request->color;
        $products->discount = $request->discount;
        $products->status = $request->status;
        $products->category_id = $request->category_id;
        // if($request->hasFile('image')){
        //     if(Storage::exists('public/product',$products->image)){
        //         Storage::delete('public/product',$products->image);
        //     }
        //     $image = $request->file('image');
        //     $image->store('public/product');
        //     $products->image = $image->hashName();
        // }
        if($request->hasFile('image')) {
            $image = $request->file('image');
            if(Storage::exists('storage/product',$products->image)){
                Storage::delete('storage/product',$products->image);
            }
            $filename = $image->hashName();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $path = public_path('storage/product/'.$filename);
            $image_resize->save($path);
            $products->image = $filename;
        }
        $products->status = $request->status;
        $products->save();
        return redirect(route('product.index'));
    }

    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::find($id);
        $products->delete();
        return redirect(route('product.index'));
    }
}
