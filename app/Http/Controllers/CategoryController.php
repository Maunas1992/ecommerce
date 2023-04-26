<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at','DESC')->paginate(10);
            return view('admin.category.index',compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $validationrules = [
            'category_name'=>'required',
            'status'=>'required',
            'is_header'=>'required',
        ];
         $messages =[
            'category_name.required'=>'Please enter category name',
            'status.required'=>'Please select status',
            'is_header.required'=>'Please select Is Header',
                        
        ];
        $request->validate($validationrules,$messages);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->is_header = $request->is_header;
        $category->status = $request->status;
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
        $validationrules = [
            'category_name'=>'required',
            'status'=>'required',
            'is_header'=>'required',
    
        ];
         $messages =[
            'category_name.required'=>'Please enter category name',
            'status.required'=>'Please select status',
            'is_header.required'=>'Please select Is Header',
        ];
        $request->validate($validationrules,$messages);
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->status = $request->status;
        $category->is_header = $request->is_header;
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
