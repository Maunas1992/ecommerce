<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Storage;
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
        $products = Product::get();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationrules = [           
            'p_name'=>'required',
            'description'=>'required',
            'image'=>'required',
            'qty'=>'required',
            'price'=>'required',
            'color'=>'required',        
            'category_id'=>'required',
        ];
        $messages =[
            'p_name.required'=>'Please enter product name',
            'description.required'=>'Please enter description',
            'image.required'=>'Please select image',
            'qty.required'=>'Please enter quantity',
            'price.required'=>'Please enter price',
            'color.required'=>'Please enter color',
            'category_id.required'=>'Please select your category',
        ];
                   
        $request->validate($validationrules,$messages);

        $products = new Product;
        $products->p_name = $request->p_name;
        $products->description = $request->description;
        $products->qty = $request->qty;
        $products->price = $request->price;
        $products->color = $request->color;
        $products->category_id = $request->category_id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->store('public/product');
            $products->image = $image->hashName();
        }
        $products->save();
        return redirect(route('product.index'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        return view('admin.products.edit',compact('products'));
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
            'category_id'=>'required',
        ];
        $messages =[
            'p_name.required'=>'Please enter product name',
            'description.required'=>'Please enter description',
            'qty.required'=>'Please enter quantity',
            'price.required'=>'Please enter price',
            'color.required'=>'Please enter color',
            'category_id.required'=>'Please select your category',
        ];

        $request->validate($validationrules,$messages);
        $products = Product::find($id);
        $products->p_name = $request->p_name;
        $products->description = $request->description;
        $products->qty = $request->qty;
        $products->price = $request->price;
        $products->color = $request->color;
        $products->category_id = $request->category_id;
        if($request->hasFile('image')){
            if(Storage::exists('public/product',$products->image)){
                Storage::delete('public/product',$products->image);
            }
            $image = $request->file('image');
            $image->store('public/product');
            $products->image = $image->hashName();
        }
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
