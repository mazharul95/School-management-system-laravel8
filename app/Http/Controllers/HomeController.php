<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use Auth;

class HomeController extends Controller
{
    public function homeSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function addSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.create', compact('sliders'));
    }

    public function storeSlider(Request $request ){
        $slider_image = $request->file('image');
        
        $imageName = uniqid('slider', false) .'.'.$slider_image->extension();
        $slider_image->move(public_path('image/slider'), $imageName);

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = $imageName;
        $slider->save();

        return redirect()->route('home.slider')->with('success', 'slider inserted Successfully');
    }

    public function editSlider($id){
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }
}
