@extends('layouts.app')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>
@section('content')
<section>
<div class="container">
    <div class="row">
        <div class ="col-12">
            <a href="/blog" class="btn btn-outline-primary">Go back</a><br><br>
            <div class="card card-body">
            <h1 class="display-one">{{ ucfirst($post->title) }}</h1>
            <p>{{ $post->body }}</p> 
            @if ($post->image)
            <img src="{{ asset('uploads/images/' . $post->image) }}" alt="{{ $post->title }} photo" class="img-fluid" width="250px" height="250px">
            @endif
            
            
        </div>
        </div>
    </div>
    <hr/>
     
    

<div class="comment-area mt-4">
    @if(session('message'))
    <h6 class="alert alert-warning mb-3">{{session('message')}}</h6>
    @endif
    {{-- @if(Auth::check() && Auth::user()->isRestrict == 1) --}}
    @if(Auth::check()  && Auth::user()->isRestrict == 0)
    <div class="card card-body">
        
        <h3 class="card-title">Leave a Comment</h3>
        
        <form action="{{route ('comments')}}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value= "{{$post->id}}">
            <textarea name="comment_body" class="form-control" rows="4" required> </textarea>
         
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
          </form>
        </div>
    @else
    <div class="form-control">
    <h3>you are restrictred to comment</h3>
    </div>
    @endif

{{-- @endif --}}
@forelse ($post->comments as $comment)
<div class="comment-container card card-body shadow-sm mt-3">
<div class="detail-area">
    <h6 class="user-name mb-1">
        @if($comment->user)
        {!! $comment->user->fname !!}

        @endif
        <small class="ms-3 text-primary">commented on:{{ $comment->created_at->format('d-m-y') }}</small>
    </h6>
    <p class="user-comment mb-1">
        {!! $comment->comment_body !!}
    </p>
</div>


@if(Auth::check() && Auth::id()== $comment->user_id)
<div>
    <a style="padding: 3px" href=" {{url('editcomment/'.$comment->id)}} " class=" btn btn-primary ">Edit</a>
    <button style="padding: 3px;" type="button" value="{{ $comment->id }}" class="deleteComment btn btn-danger btn-sm-me-2">Delete</button>
    
</div>
@elseif(Auth::check() && Auth::id() == $post->created_by)
<div>
    <button style="padding: 3px;" type="button" value="{{ $comment->id }}" class="comment btn btn-danger btn-sm-me-2">Delete</button>
</div>
@endif
</div>
@empty
    <h6>No comments yet</h6>
@endforelse
</section>

@section('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $(document).on('click', '.deleteComment', function(){
           if(confirm('are you sure you want to delete the comment'))
           {
            var thisClicked = $(this);
            var comment_id = thisClicked.val();

            $.ajax({
                type:"POST",
                url:"/delete-comment",
                data:{
                    'comment_id': comment_id
                },
                success: function(response){
                        if(response.status == 200){
                            thisClicked.closest('.comment-container ').remove();
                            alert(response.message);
                        }else{
                            alert(response.message);
                        }
                }
            });

           }
        });
    });

    $(document).ready(function(){
        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $(document).on('click', '.comment', function(){
           if(confirm('are you sure you want to delete the comment'))
           {
            var thisClicked = $(this);
            var comment_id = thisClicked.val();

            $.ajax({
                type:"POST",
                url:"/destroy-comment",
                data:{
                    'comment_id': comment_id
                },
                success: function(response){
                        if(response.status == 200){
                            thisClicked.closest('.comment-container ').remove();
                            alert(response.message);
                        }else{
                            alert(response.message);
                        }
                }
            });

           }
        });
    });

    
    </script>

@endsection
    