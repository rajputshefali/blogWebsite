<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FORGET PASSWORD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-mt-4" style="margin-top: 40px">
                <h5>FORGOT PASSWORD</h5><hr>
              <form action=" {{ route('forgot-password') }} " method="POST">
                @if(Session::has('success'))
                <div class="div alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                <div class="div alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your registered email here"  value=" {{ old('email') }} ">
                <span class="text-danger"> @error('email') {{ $message }} @enderror </span>
               </div>
            <div class="form-group mt-2">
            <button type="submit" class="btn btn-primary">Send Reset Link</button>
            </div>
            <a href="{{ route('login-user')}}">LogIn</a>
            </form>
            </div>
        </div>

    </div>
   
</body>

</html>