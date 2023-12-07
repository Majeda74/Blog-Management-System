@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-xl-12 mx-auto">

            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Blogs Table</h6>
                        <hr/>
                        <table id="example" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>sl</th>
                                <th>Blog Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Create At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->category->category_name }}</td>
                                    <td>{{ $blog->author_name }}</td>
                                    <td>{{ substr($blog->description, 4, 40) }}</td>
                                    <td><img src="{{ asset($blog->image) }}" alt="" style="height: 50px; width: 50px"></td>
                                    <td>{{ date('j F Y', strtotime($blog->created_at)) }}</td>
                                    <td>{{ $blog->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary btn-sm float-start m-1">Edit</a>

                                        @if($blog->status == 1)
                                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-warning btn-sm float-start m-1">Inactive</a>
                                        @else
                                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-success btn-sm float-start m-1">Active</a>
                                        @endif

                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm float-start m-1" onclick="return confirm('Are you sure DELETE this!!')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
