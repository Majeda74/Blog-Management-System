<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class VisitorController extends Controller
{
    private static $visitor;

    public function signUp(){
        return view('front-end.visitor.signup');
    }
    public function store(Request $request){
        //return $request->all();
        //return $request->only('user_name','mobile');
        //return $request->except('mobile','password');
        //Visitor::create($request->all());
        Visitor::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        return redirect(route('visitor.signin'));
//        return back();
    }
    public function visitorSignIn(){
        return view('front-end.visitor.signin');
    }
    public function visitorLogInCheck(Request $request){
        //return $request;
        self::$visitor = Visitor::where('email', $request->user_name)
            ->orWhere('phone', $request->user_name)
            ->first();
        if(self::$visitor){
            if(password_verify($request->password, self::$visitor->password)){
                Session::put('visitorId', self::$visitor->id);
                Session::put('visitorName', self::$visitor->user_name);
                Session::put('visitorEmail', self::$visitor->email);
                Session::put('visitorPhone', self::$visitor->phone);

//                return back()->with('message', 'LogIn Successful');
                return redirect(route('my.profile'));

            }
            else{
                return back()->with('message', 'please give a Correct Password');
            }
        }
        else{
            return back()->with('message', 'Please use valid Email or Phone');
        }
    }
    public function signOut(){
       Session::forget('visitorId');
       Session::forget('visitorName');
       Session::forget('visitorEmail');
       Session::forget('visitorPhone');
       return redirect(route('visitor.signin'));
    }
}
