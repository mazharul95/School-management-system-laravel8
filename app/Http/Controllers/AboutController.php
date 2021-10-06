<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
class AboutController extends Controller
{
    public function homeAbout(){
        $homeAbout = HomeAbout::latest()->get();
        return view('admin.home.index',compact('homeAbout'));
    }
    public function addAbout(){
        return view('admin.home.create');
    }
}
