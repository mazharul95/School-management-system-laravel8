<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Multipic;
use Image;
use Auth;

class MultiPicController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function multipic(){
        $image = Multipic::all();
        return view('admin.multipic.index',compact('image'));
    }
    public function storeImg(Request $request){

        $image = $request->file('image');

        /* $name_gen = hexdec(uniqid());
         $img_ext = strtolower($brand_image->getClientOriginalExtension());
         $img_name = $name_gen . '.' . $img_ext;
         $up_location = 'image/brand/';
         $last_img = $up_location . $img_name;
         $brand_image->move($up_location, $img_name);*/

        foreach ($image as $multi_img){
        $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
        Image::make($multi_img)->resize(300,300)->save('image/multi/'.$name_gen);
        $last_img = 'image/multi/'.$name_gen;

        Multipic::insert([
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        } //end foreach
        return redirect()->back()->with('success', 'Brand inserted Successful');

    }

}
