<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Response;
use Storage;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','DESC')->paginate(5);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::where('status','Active')->get();
        if ($request->getMethod() == 'POST') {
            $validationrules = [
                'p_name'=>'required',
                'description'=>'required',
                'image' => 'required|image|mimes:jpeg,bmp,png',
                'qty'=>'required|numeric',
                'price'=>'required|numeric',
                'color'=>'required|string|regex:/^[a-zA-Z]+$/u',
                'discount'=>'numeric|between:00.00,99.99',
                'category_id'=>'required',
                'status'=>'required',
                'productVariant.*.color' => 'required|string|regex:/^[a-zA-Z]+$/u',
                'productVariant.*.quantity' => 'required|numeric',
                'productVariant.*.price' => 'required|numeric',
                'productVariant.*.discount' => 'required|numeric|regex:/^\d*(\.\d{2})?$/|between:00.0,99.9',
            ];
            $messages =[
                'p_name.required'=>'Please enter product name',
                'description.required'=>'Please enter description',
                'image.required'=>'Please select image',
                'qty.required'=>'Please enter quantity',
                'qty.numeric'=>'Please enter valid quantity',
                'price.required'=>'Please enter price',
                'price.numeric'=>'Please enter valid price',
                'color.required'=>'Please enter color',
                'color.regex'=>'Please enter valid color',
                'discount.required'=>'Please enter discount',
                'discount.numeric'=>'Please enter discount in number',
                'discount.between'=>'Please enter discount 0 to 99.9',
                'status.required'=>'Please select status',
                'category_id.required'=>'Please select category',
                'productVariant.*.color.required' =>'Please enter variant color',
                'productVariant.*.color.regex'=>'Please enter valid variant color',
                'productVariant.*.quantity.required' =>'Please enter variant quantity',
                'productVariant.*.quantity.numeric'=>'Please enter valid variant quantity',
                'productVariant.*.price.required' =>'Please enter variant price',
                'productVariant.*.price.numeric'=>'Please enter valid variant price',
                'productVariant.*.discount.required' =>'Please enter variant discount',
                'productVariant.*.discount.numeric' =>'Please enter variant discount in number',
                'productVariant.*.discount.between' =>'Please enter variant discount 0 to 99.9',
            ];

            $validator = Validator::make($request->all(), $validationrules, $messages);
            $errors = $validator->errors();
            if(empty($errors->getMessages())){
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
                if(isset($request['productVariant'])){
                    foreach($request['productVariant'] as $variant)
                    {
                        $pVariant = [];
                        $productVariant = new ProductVariant;
                        if(! empty($variant))
                        {
                            $pVariant[] = [
                                $productVariant->product_id = $products->id,
                                $productVariant->quantity = $variant['quantity'],
                                $productVariant->price = $variant['price'],
                                $productVariant->color = $variant['color'],
                                $productVariant->discount = $variant['discount'],
                            ];
                        }
                        $productVariant->save();
                    }
                }
                return redirect(route('product.index'))->with('success','Product added successfully');
            }else{
                if($request->file('image')){
                    $imagename = $request->file('image')->getClientOriginalName();
                    return view('admin.products.create',compact('categories', 'errors','imagename'));
                }
                return view('admin.products.create',compact('categories', 'errors'));
            }
        }else{
            return view('admin.products.create',compact('categories'));
        }
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
            'image' => 'required|image|mimes:jpeg,bmp,png',
            'qty'=>'required',
            'price'=>'required',
            'color'=>'required',
            'discount'=>'required',
            'category_id'=>'required',
            'status'=>'required',
            'productVariant.*.color' => 'required',
            'productVariant.*.quantity' => 'required',
            'productVariant.*.price' => 'required',
            'productVariant.*.discount' => 'required',
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
            'productVariant.*.color' =>'Please enter variant color',
            'productVariant.*.quantity' =>'Please enter variant quantity',
            'productVariant.*.price' =>'Please enter variant price',
            'productVariant.*.discount' =>'Please enter variant discount',
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
        if(isset($request['productVariant'])){
        foreach($request['productVariant'] as $variant)
        {
        $pVariant = [];
        $productVariant = new ProductVariant;
            if(! empty($variant))
            {
                $pVariant[] = [
                $productVariant->product_id = $products->id,
                $productVariant->quantity = $variant['quantity'],
                $productVariant->price = $variant['price'],
                $productVariant->color = $variant['color'],
                $productVariant->discount = $variant['discount'],
                ];
            }
          $productVariant->save();
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
    public function edit(Request $request, $id)
    {
        $categories = Category::where('status','Active')->get();
        if ($request->getMethod() == 'POST') {
            $validationrules = [           
                'p_name'=>'required',
                'description'=>'required',
                'image' => 'nullable|image|mimes:jpeg,bmp,png',
                'qty'=>'required|numeric',
                'price'=>'required|numeric',
                'color'=>'required|string|regex:/^[a-zA-Z]+$/u',
                'discount'=>'numeric|between:00.00,99.99',
                'category_id'=>'required',
                'status'=>'required',
                'productVariant.*.color' => 'required|regex:/^[a-zA-Z]+$/u',
                'productVariant.*.quantity' => 'required|numeric',
                'productVariant.*.price' => 'required|numeric',
                'productVariant.*.discount' => 'required|numeric|between:00.00,99.99',
            ];
            $messages =[
                'p_name.required'=>'Please enter product name',
                'description.required'=>'Please enter description',
                'qty.required'=>'Please enter quantity',
                'qty.numeric'=>'Please enter valid quantity',
                'price.required'=>'Please enter price',
                'price.numeric'=>'Please enter valid price',
                'color.required'=>'Please enter color',
                'color.regex'=>'Please enter valid color',
                'discount.numeric'=>'Please enter discount in number',
                'discount.between'=>'Please enter discount 0 to 99.99',
                'status.required'=>'Please select status',
                'category_id.required'=>'Please select category',
                'productVariant.*.color.required' =>'Please enter variant color',
                'productVariant.*.color.regex' =>'Please enter valid variant color',
                'productVariant.*.quantity.required' =>'Please enter variant quantity',
                'productVariant.*.quantity.numeric' =>'Please enter valid variant quantity',
                'productVariant.*.price.required' =>'Please enter variant price',
                'productVariant.*.price.numeric' =>'Please enter valid variant price',
                'productVariant.*.discount.required' =>'Please enter variant discount',
                'productVariant.*.discount.numeric' =>'Please enter variant discount in number',
                'productVariant.*.discount.between' =>'Please enter variant discount 0 to 99.99',
            ];

            $validator = Validator::make($request->all(), $validationrules, $messages);
            $errors = $validator->errors();
            if(empty($errors->getMessages())){
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

                $array1 = ProductVariant::where('product_id',$products->id)->pluck('id')->toArray();
                $array2 = $request['productVariant'];
                if(isset($array1) && $array2){
                    $variant_id = array_column($array2, 'variant_id');
                    $result = array_diff($array1,$variant_id);
                    foreach ($result as $key => $id) {
                        $removeVariants = ProductVariant::find($id);
                        $removeVariants->delete();
                    }
                }
                if(isset($request['productVariant'])){
                    foreach($request['productVariant'] as $variant)
                    {
                        $pVariant = [];
                        if(isset($variant['variant_id'])){
                            $productVariant = ProductVariant::find($variant['variant_id']);
                            $pVariant[] = [
                                $productVariant->product_id = $products->id,
                                $productVariant->quantity = $variant['quantity'],
                                $productVariant->price = $variant['price'],
                                $productVariant->color = $variant['color'],
                                $productVariant->discount = $variant['discount'],
                            ];
                            $productVariant->save();
                        }else{
                            $productVariant = new ProductVariant;
                            $pVariant[] = [
                                $productVariant->product_id = $products->id,
                                $productVariant->quantity = $variant['quantity'],
                                $productVariant->price = $variant['price'],
                                $productVariant->color = $variant['color'],
                                $productVariant->discount = $variant['discount'],
                            ];
                            $productVariant->save();
                        }
                    }
                }
                return redirect(route('product.index'))->with('success','Product updated successfully');
            }else{
                $products = Product::find($id);
                $productVariant = ProductVariant::with('productMultiVariant')->where('product_id', $id)->get();
                $productVariantCount = count($productVariant);
                return view('admin.products.edit',compact('products','categories','productVariant','errors','productVariantCount'));
            }
        }else{
        $products = Product::find($id);
        $productVariant = ProductVariant::with('productMultiVariant')->where('product_id', $id)->get();
        $productVariantCount = count($productVariant);
        return view('admin.products.edit',compact('products','categories','productVariant','productVariantCount'));
        }
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
            'productVariant.*.color' => 'required',
            'productVariant.*.quantity' => 'required',
            'productVariant.*.price' => 'required',
            'productVariant.*.discount' => 'required',
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
            'productVariant.*.color.required' =>'Please enter variant color',
            'productVariant.*.quantity.required' =>'Please enter variant quantity',
            'productVariant.*.price.required' =>'Please enter variant price',
            'productVariant.*.discount.required' =>'Please enter variant discount',
        ];
        $validator = Validator::make($request->all(), $validationrules, $messages);
            $errors = $validator->errors();
        if (!empty($errors->getMessages())) {
            $categories = Category::get();
            $products = Product::find($id);
            $productVariant = ProductVariant::with('productMultiVariant')->where('product_id', $id)->get();
            return view('admin.products.edit',compact('products','categories','productVariant','errors'));
            // return Response::make(['error' => $errors], 400);
        }
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

        $array1 = ProductVariant::where('product_id',$products->id)->pluck('id')->toArray();
        $array2 = $request['productVariant'];
        if(isset($array1) && $array2){
            $variant_id = array_column($array2, 'variant_id');
            $result = array_diff($array1,$variant_id);
            foreach ($result as $key => $id) {
                $removeVariants = ProductVariant::find($id);
                $removeVariants->delete();
            }
        }
        if(isset($request['productVariant'])){
            foreach($request['productVariant'] as $variant)
            {
                $pVariant = [];
                if(isset($variant['variant_id'])){
                    $productVariant = ProductVariant::find($variant['variant_id']);
                    $pVariant[] = [
                        $productVariant->product_id = $products->id,
                        $productVariant->quantity = $variant['quantity'],
                        $productVariant->price = $variant['price'],
                        $productVariant->color = $variant['color'],
                        $productVariant->discount = $variant['discount'],
                    ];
                    $productVariant->save();
                }else{
                    $productVariant = new ProductVariant;
                    $pVariant[] = [
                        $productVariant->product_id = $products->id,
                        $productVariant->quantity = $variant['quantity'],
                        $productVariant->price = $variant['price'],
                        $productVariant->color = $variant['color'],
                        $productVariant->discount = $variant['discount'],
                    ];
                    $productVariant->save();
                }
            }
        }
        return redirect(route('product.index'))->with('success','Product updated successfully');
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
