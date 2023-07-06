<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMMENT EDIT </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="/blog" class="btn btn-outline-primary">Go back</a><br><br>
                <h2>Edit Comments</h2>

                <div class="card">
                    <div class="card-body">
                        @if(session('status'))
                        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="div alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                      <form action="{{url('commentupdate/'.$comment->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                       {{-- <div class="form-group">
                        <textarea name="comment_body" value="{{ $comment->comment_body }}"></textarea>
                       </div><br><br> --}}
                       @if($comment->user)
                       {!! $comment->user->fname !!}
               
                      
                       <div class="form-group">
                        <input type="text" name="comment_body"   value="{{ $comment->comment_body }}" class="form-control">
                       </div><br><br>
                       @endif
                       <div class="form-group" class="form-control">
                        <button type="submit" class="btn btn-success">Update</button>
                       </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>