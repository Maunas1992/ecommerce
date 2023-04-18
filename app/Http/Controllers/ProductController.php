<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            'category_id'=>'required|numeric|min:6',    
        ];
        $messages =[
            'p_name.required'=>'Please enter your name',
            'description.required'=>'Please enter your address',
            'image.required'=>'Please enter your date of birth',
            'qty.required'=>'Please select your city name.',
            'price.required'=>'Please select your state name.',
            'color.required'=>'Please select your coutry name',
            'category_id.required'=>'Please enter your pincode',
        ];
                   
        $request->validate($validationrules,$messages);

        $products = new Product;
        $products->p_name = $request->p_name;
        $products->description = $request->description;
        $products->qty = $request->qty;
        $products->price = $request->price;
        $products->color = $request->color;
        $products->category_id = $request->category_id;
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
        //
    }
}
