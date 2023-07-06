@extends('layouts.master')

@section('content')

<section>
    <div id="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                     <h4 class="text-center">Admin Login</h4>
                    </div>
                <div class="card-body">
                    
                    <form action="/admin_login" method="POST"> 
                        @if(Session::has('success'))
                        <div class="div alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('fail'))
                        <div class="div alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf       
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="enter email" value="{{ old('email') }}">
                            <span class="text-danger">@error('email') {{ $message }} @enderror </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="enter password" value="{{ old('email') }}">
                            <span class="text-danger"> @error('password') {{ $message }} @enderror</span>
                        </div>
                        <button class="btn btn-dark btn-block mt-4" id="loginbtn">Login</button><br><br>

                        <div class="form-group">
                            <a href="{{ route('pwforget') }}">FORGET PASSWORD</a>
                        </div>
                        
                       
                    </form> 
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

{{-- @push('javascript')
<script>
     $(document).ready(function(){
     $("#loginbtn").on('click', function( ){
  
        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }); --}}
        {{-- var email=$("#email").val();
        var password=$("#password").val();
       
        $.ajax({
                url: '/admin_login',
                type: 'POST',
                data: {
                    email: email,
                    password: password,
                    _token:"{{csrf_token()}}"
                },
                success: function(data){
                    if($.isEmptyObject(data.error)){
                        if (data.success) {
                            $('#notifDiv').fadeIn();
                            $('#notifDiv').css('background', 'green');
                            $('#notifDiv').text('user logged in successfully.');
                            setTimeout(() => {
                            $('#notifDiv').fadeOut();
                            }, 8000); --}}
                        {{-- window.location = "{{ route('dashboard') }}";

                        }
                    } else {
                        // alert("here");
                        $('#notifDiv').fadeIn();
                        $('#notifDiv').css('background', 'red');
                        $('#notifDiv').text('An error occured.');
                        setTimeout(() => {
                            $('#notifDiv').fadeOut();
                        }, 5000);
                    }  
                }
             });
        });
     });
</script>
@endpush --}}




