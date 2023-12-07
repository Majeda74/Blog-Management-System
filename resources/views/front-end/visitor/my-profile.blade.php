@extends('front-end.master')
@section('title','my-profile')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>This Is My Profile</h2>
                <p>Name: {{\Illuminate\Support\Facades\Session::get('visitorName')}}</p>
                <p>Email: {{\Illuminate\Support\Facades\Session::get('visitorEmail')}}</p>
                <p>Phone: {{\Illuminate\Support\Facades\Session::get('visitorPhone')}}</p>

            </div>
        </div>
    </div>



@endsection

