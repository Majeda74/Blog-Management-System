<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class visitorBlog extends Model
{
    use HasFactory;

    private static $blog, $image, $imageNewName, $dir, $imgUrl, $slug;

    public static function saveInfo($request, $id=null){
        $request->validate([
            'title' => 'required | string | max:40 | min:5',
            'slug' => 'nullable | string',
            'category_id' => 'required | integer',
            'author_name' => 'required | string',
            'description' => 'required |string',
            'image' => 'image | mimes:jpg,png'
        ],[
            'title.required' => 'Please give a title',
            'title.min' => 'Title must be minimum 5 character',
            'title.max' => 'Title can not be more than 40 character',
            'slug' => 'Give a string'
        ]);
        if($id!=null){
            self::$blog = visitorBlog::find($id);
        }
        else{
            self::$blog = new visitorBlog();
        }
        self::$blog->title = $request->title;
        self::$blog->slug = self::makeSlug($request);
        self::$blog->category_id = $request->category_id;
        self::$blog->author_name = $request->author_name;
        self::$blog->description = $request->description;
        if($request->file('image')){
            if(self::$blog->image){
                if(file_exists(self::$blog->image)){
                    unlink(self::$blog->image);
                }
            }
            self::$blog->image = self::saveImage($request);
        }
        self::$blog->save();
    }
    public static function saveImage($request){
        self::$image = $request->file('image');
        self::$imageNewName = rand() . '.' . self::$image->extension();
        self::$dir = 'admin-assets/blog-image/';
        self::$imgUrl = self::$dir . self::$imageNewName;
        self::$image->move(self::$dir, self::$imageNewName);
        return self::$imgUrl;
    }
    private static function makeSlug($request){
        if($request->slug){
            self::$slug = Str::slug($request->slug, '-');
        }
        else{
            self::$slug = Str::slug($request->title, '-');
        }
        return self::$slug;
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public static function statusCheck($id){
        self::$blog = visitorBlog::find($id);
        if(self::$blog->status == 1){
            self::$blog->status = 0;
        }
        else{
            self::$blog->status = 1;
        }
        self::$blog->save();
    }
}
