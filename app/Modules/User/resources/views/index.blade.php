@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-8">
               
                <h1 style="color:black;text-align:center;">BLOG LISTS</h1><br><br>
                <h4>CLICK ON A BLOG TO READ📑</h>
            </div>
            <div class="col-4">
                
                <h3>Create New Post📜</h3>
                <a  href="/blog/create/post" class="btn btn-primary btn-sm">Create Blog</a>
                <a class="btn btn-dark btn-sm" href="/logout">LOGOUT</a>
                
                <a href="/home" class="btn btn-primary btn-sm">Go back</a><br><br>
                
                  
            </div>
            @if(Session::has('success'))
            <div class="div alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="div alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            
            <table class="table table-striped">
                <thead>
                    {{-- <th>ID</th> --}}
                    <th>Title</th>
                    <th>Action</th>
                    <th>Image</th>
                    <th></th>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    {{-- <td>{{ $post->id }}</td> --}}
                    <td>{{ $post->title }}</td>
                    <td>
                        <a href="./blog/{{ $post->id }}">{{ ucfirst($post->title) }}</a>  
                    </td>
                   <td>
                    @if ($post->image)
                    <img src="{{ asset('uploads/images/' . $post->image) }}" alt="{{ $post->title }} photo" class="img-fluid" width="50px" height="50px">
                    @endif
                   </td>
                  
                     
                    <td>
                        @if(Auth::check() && Auth::id() == $post->created_by)
                        <a href="{{url('editpost/'.$post->id)}}" class="btn btn-success">EDIT</a>
                        
                        <a href="{{ url('deletepost/'.$post->id) }}" class="btn btn-danger">DELETE</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection













{{-- @extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <h1 style="color:black;text-align:center;">BLOG LISTS</h1><br><br>
                        <h5>Click on a blog to read!</h5>
                    </div>
                    <div class="col-4">
                        <p>Create new Post</p>
                        <a  href="/blog/create/post" class="btn btn-primary btn-sm">Create Blog</a>
                    </div>
                </div>                
                @forelse($posts as $post)
                    <ul>
                        <li><a href="./blog/{{ $post->id }}">{{ ucfirst($post->title) }}</a></li>
                    </ul>
                @empty
                    <p class="text-warning">No blog Posts available</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection --}}