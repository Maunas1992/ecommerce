<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::get();
            return view('category.createcategory',compact('categorys'));
    }
    public function create(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category_name;
        $input = $request->all();
        
        $validationrules = [
            'category_name'=>'required',
    
        ];
         $messages =[
                        'category_name.required'=>'Please enter your category name',
                        
                    ];
                    $request->validate($validationrules,$messages);
                    $category->save();
                        return redirect(route('category.list'));

    }

    public function list()
    {
        $categorys = Category::get();
            return view('category.listcategory',compact('categorys'));
    }
    public function edit($id)
    {
        $categorys = Category::find($id);
            return view('category.edit',compact('categorys'));
    }
    public function destroy($id)
    {
        $categorys = Category::find($id);
        $categorys->delete();
        return redirect(route('category.listcategory'));
    }

    public function update(Request $request, $id)
    {
        
       
        $input = $request->all();
        
        $validationrules = [
            'category_name'=>'required',
    
        ];
         $messages =[
                        'category_name.required'=>'Please enter your category name',
                        
                    ];
                    $request->validate($validationrules,$messages);
                    $categorys = Category::find($id);
                    $category->category_name = $request->category_name;
                    $category->update();
                        return redirect(route('category.list'));

    }
}
