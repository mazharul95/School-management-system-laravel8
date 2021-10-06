<?php

namespace App\Http\Controllers;

use App\Models\blogCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{

    public function index()
    {
        $categorys = blogCategory::latest()->get();
        return view('admin.blogCategory.index',compact('categorys'));
    }

    public function create()
    {
        return view('admin.blogCategory.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        BlogCategory::create([
            'name' => $request->name,
        ]);
//        Toastr::success('Blog Category added successfully', 'Success');
        return redirect()->route('blog-category.index');
    }

    public function edit($id)
    {
        $category = blogCategory::findOrFail($id);
        return view('admin.blogCategory.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        $category = blogCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);
//        Toastr::success(' updated successfully', 'Success');
        return redirect()->route('blog-category.index');
    }

    public function destroy($id)
    {
        blogCategory::findOrFail($id)->delete();
        // Toastr::success('Blog Category deleted successfully', 'Success');
        return redirect()->route('blog-category.index');
    }
}
