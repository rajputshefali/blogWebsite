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
                        <form action="{{ route('admin-register') }}" method="POST">
                            @if(session('success'))
                            <div class="div alert alert-success">{{session('success')}}</div>
                            @endif
                            @if(session('fail'))
                            <div class="div alert alert-danger">{{session('fail')}}</div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="fname"> name</label>
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter First Name" value="{{ old('fname') }}">
                                <span class="text-danger">@error('fname'){{ $message }} @enderror </span>
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


                   