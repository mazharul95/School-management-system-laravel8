<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat(){
        //$categories = Category::latest()->get();

        $categories = DB::table('categories')->latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function AddCat(Request $request){

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],[
            'category_name.required' => 'Please input category name.',
            'category_name.max' => 'Category less than 255 character.',
        ]);

      //  Category::insert([
      //      'category_name' => $request->category_name,
      //      'user_id' => Auth::user()->id,
      //      'created_at' => Carbon::now()
      //  ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect()->back()->with('success','Category inserted Successful');
    }
}
