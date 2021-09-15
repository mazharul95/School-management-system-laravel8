<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\support\Facades\DB;

class CategoryController extends Controller
{
    public function allCat(){
       /* $categories = DB::table('categories')
                    ->join('users','categories.user_id','users.id')
                    ->select('categories.*','users.name')
                    ->latest()->paginate(5);*/

        //$categories = DB::table('categories')->latest()->paginate(5);
       // return view('admin.category.index', compact('categories'));

        $categories = Category::latest()->paginate(5);
        $trachCats = Category::onlyTrashed()->latest()->paginate(5);
        //$categories = DB::table('categories')->latest()->get();
        return view('admin.category.index', compact('categories','trachCats'));
    }

    public function addCat(Request $request){

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

    public function editCategory($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));

       /* $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));*/
    }

    public function updateCategory($id,Request $request){
        /* $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->update(); */

        $data = array();
        $data ['category_name'] = $request->category_name;
        $data [user_id] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
        return redirect()->route('all.category')->with('success','Category updated Successful');
    }

    public function softDelete($id){
        Category::find($id)->delete();
        return redirect()->back()->with('success','Category soft delete Successful');
    }
    public function restoreData($id){
        Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Category restore Successful');
    }
    public function delete($id){
        Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','Category permanently delete Successful');
    }

}
