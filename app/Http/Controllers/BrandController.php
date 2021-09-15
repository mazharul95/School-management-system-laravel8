<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function allBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));

    }
    public function storeBrand(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],[
            'brand_name.required' => 'Please input brand name.',
            'brand_image.min' => 'Brand longer then 4 character.',
        ]);

        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);


        Brand::insert([
           'brand_name' => $request->brand_name,
            'brand_image' =>$last_img,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success','Brand inserted Successful');

    }
    public function editBrand($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }
    public function updateBrand($id,Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
        ],[
            'brand_name.required' => 'Please input brand name.',
            'brand_image.min' => 'Brand longer then 4 character.',
        ]);
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if ($brand_image) {

            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' =>$last_img,
                'created_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success','Brand update Successful');

        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
            return redirect()->back()->with('success','Brand update Successful');
        }

    }















}
