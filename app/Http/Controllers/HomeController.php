<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private static $blog;

    public function index(){
        return view('front-end.home.home',[
            'blogs' => Blog::where('status',1)->orderBy('id', 'desc')->take(5)->get(),
            'leftsidebars' => Blog::where('status',1)->orderBy('id', 'desc')->take(5)->skip(1)->get(),


        ]);
    }
    public function blogDetails($slug){

        //return self::$blog;
        return view('front-end.blog.details',[
            'details' =>Blog::where('slug',$slug)->get(),
            'categories' =>Category::all()
        ]);
    }
    public function singlePost(){
        return view('front-end.single-post.single-post',[
            'blogs'=> Blog::where('status',1)->take(10)->orderBy('id','desc')->get()]);
    }
    public function about(){
        return view('front-end.about.about');
    }
    public function contact(){
        return view('front-end.contact.contact');
    }
    public function category(){
        return view('front-end.category.category');
    }
//    =======================myprofile===================================
public function myProfile(){
        return view('front-end.visitor.my-profile');
}
    public function createpost(){
        return view('front-end.visitor.create-post',[
            'categories' => Category::all()
        ]);
    }
//     user post blog


}
