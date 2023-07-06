@extends('layouts.master')

@section('content')
    <section>
        <div id="container">
         <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                       <h4 class="text-center">USER REGISTRATION</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('save_user') }}" method="POST">
                            @if(session('success'))
                            <div class="div alert alert-success">{{session('success')}}</div>
                            @endif
                            @if(session('fail'))
                            <div class="div alert alert-danger">{{session('fail')}}</div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="fname">First name</label>
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name" value="{{ old('fname') }}">
                                <span class="text-danger">@error('fname'){{ $message }} @enderror </span>
                            </div>

                            <div class="form-group">
                                <label for="lname">Last name</label>
                                <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter Last Name" value="{{ old('lname') }}">
                                <span class="text-danger"> @error('lname'){{ $message }} @enderror </span>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required value="{{ old('email') }}">
                                <span class="text-danger"> @error('email') {{ $message }} @enderror </span>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" 
                                placeholder="Enter Password" value="{{ old('password')}}">
                                <span class="text-danger"> @error('password') {{ $message }} @enderror </span>
                            </div>

                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" name="cpassword" id="cpassword" class="form-control"
                                 placeholder="Enter Confirm Password" value="{{ old('cpassword') }}">
                                 <span class="text-danger"> @error('cpassword'){{ $message }} @enderror </span>
                            </div>
                            <button type="submit" class="btn btn-dark btn-block mt-4" id="save_form">Register</button><br><br>
                            

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
    $(document).ready(function( ){
        $('#save_form').on('click', function( ) {
                var fname = $("#fname").val();
                var lname = $("#lname").val();
                var email = $("#email").val();
                var password = $("#password").val(); 
                var cpaasword=$("#cpassword").val(); 
                var form=$(this).parents('form');
                $(form).validate({
                rules: {
                    fname:{
                       required: true,
                       },
                    lname:{
                        required: true,
                    },
                    email:{
                        required: true,
                        email: true,
                    },
                    password:{
                        required: true ,
                        minlength:6,
                        maxlength:8,
                        
                    },
                    cpassword:{
                        required: true,
                        equalTo: "#password"
                    },
                },
                messages:{
                    fname: "Full Name is required.",
                    lname: "Last Name is required.",
                    email: {
                        required:"Email is required.",
                        email: "Enter valid email"
                    },
                    password: {
                        required:"Password should be minimum of 6 length.",
                        minlength: "Password should be minimum 6 length",
                        maxlength: "Password should not be more then 8 length",
                       
                    },
                    cpassword: "Confirm password is required.",
                    cpassword:{
                        equalTo:"confirm password is not matched"
                    },
                },
                highlight: function(element){
                    $(element).addClass('error')
                },
                submitHandler: function(){
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: '/save_user',
                        data: formData,
                        dataType:'JSON',
                        processData: false,
                        contentType: false,
                        success: function(data){
                        if (data.exists) {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('Email already exists');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                } else if (data.success) {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'green');
                    $('#notifDiv').text('user registered successfully.');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                  

                    $('[name="fname"]').val('');
                    $('[name="lname"]').val('');
                    $('[name="email"]').val('');
                    $('[name="password"]').val('');
                    $('[name="cpassword"]').val('');
                    window.location = "{{ route('login-user') }}";

                } else {
                    $('#notifDiv').fadeIn();
                    $('#notifDiv').css('background', 'red');
                    $('#notifDiv').text('An error occured. Please try later');
                    setTimeout(() => {
                        $('#notifDiv').fadeOut();
                    }, 3000);
                    }
                }
             });
            }
        });
     });
 });
</script>
@endpush --}}