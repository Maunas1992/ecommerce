<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
            return view('admin.category.index',compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category_name;
        
        $validationrules = [
            'category_name'=>'required',
    
        ];
         $messages =[
                        'category_name.required'=>'Please enter your category name',
                        
                    ];
                    $request->validate($validationrules,$messages);
                    $category->save();
                        return redirect(route('category.index'));

    }

    public function edit($id)
    {
        $categories = Category::find($id);
            return view('admin.category.edit',compact('categories'));
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
                    $category = Category::find($id);
                    $category->category_name = $request->category_name;
                    $category->update();
                        return redirect(route('category.index'));
    }

    public function destroy($id)
    {
        $categorys = Category::find($id);
        $categorys->delete();
        return redirect(route('category.index'));
    }

}
