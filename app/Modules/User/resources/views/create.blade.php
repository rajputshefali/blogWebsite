@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a><br><br>
            <div class="card">
                <div class="card-header">Create Post</div>
                <div class="card-body">
                    <form  action="{{ url('/blog/create/post') }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                         
                            <label class="label">Post Title: </label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" >
                            @error('title')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="form-group">
                         
                            {{-- <label class="label">Post Body: </label>
                            <input type="text" name="body" class="form-control" value="{{ old('body') }}" >
                            @error('body')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div> --}}
                        <div class="form-group">
                            <label class="label">Post Body: </label>
                            <textarea name="body" rows="10" cols="30" class="form-control">{{old('body')}}</textarea>
                            @error('body')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div><br>
                        <label class="image">Post Image: </label>
                        <input type="file" name="image" class="form-control"  value="{{ old('image') }}"  >
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div><br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



{{-- @extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Create a New Post</h1><br><br>

                    <hr>

                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="title">BLOG TITLE</label>
                                <input type="text" id="title" class="form-control" name="title"
                                       placeholder="Enter Post Title" required>
                            </div>
                            <div class="control-group col-12 mt-2">
                                <label for="body">BLOG BODY</label>
                                <textarea id="body" class="form-control" name="body" placeholder="Enter Post Body"
                                          rows="" required></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Create Blog
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection --}}