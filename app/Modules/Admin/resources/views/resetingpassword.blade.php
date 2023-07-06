@extends('layouts.master')

@section('content')

<section>
    <div id="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4 class="text-center">RESET PASSWORD</h4>
                    </div>
                <div class="card-body">
                      <form action="{{ route('resetpw') }}" method="POST"> 
                       @if(Session::has('success'))
                        <div class="div alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="div alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <input type="hidden" name="token" value = "{{ $token }}">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="enter email" value="{{ $email ?? old('email') }}">
                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="enter password" value="{{ old('password') }}">
                            <span class="text-danger">@error('password') {{$message}}@enderror</span>
                        </div><br>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="enter password" value="{{ old('password') }}">
                            <span class="text-danger">@error('password_confirmation') {{$message}}@enderror</span>
                        </div><br>
                       
                        <div class="form-group">
                        <button type="submit" class="btn btn-dark btn-block mt-4" id="loginbtn">RESET PASSWORD</button>
                        </div><br>
                        <a href="{{ route('alogin')}}">LogIn</a>
                       
                  </form> 
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection