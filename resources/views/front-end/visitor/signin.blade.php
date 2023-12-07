@extends('front-end.master')

@section('title')
    ZenBlog SignUp
@endsection

@section('content')
    <div class="row py-5">
        <div class="col-xl-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">SignIn Form</h6>
                        <hr/>
                        <form action="{{ route('visitor.signin') }}" method="POST">
                            @csrf
                            <h4 class="text-danger">{{ session('message') }}</h4>
                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label">User Name</label>
                                <input type="text" name="user_name" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
