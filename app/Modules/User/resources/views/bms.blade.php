@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BLOG POST</title>
</head>
<body>
       <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
         
          <a class="navbar-brand" href="#"></a>
          
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <!-- <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  
                </a> -->
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href=""></a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">WELCOME TO BANK MANAGEMENT SYSTEM</h1>
                <br>
                
            </div> -->
            <section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">USER DEATAILS</h2>
              @if (session('status'))
              <div class="alert alert-danger">{{ session('status') }}</div>
              @endif
              <form action="{{route('bmsDetails')}}" method="POST">
                @if(session('success'))
                <div class="div alert alert-success">{{session('success')}}</div>
                @endif
                @if(session('fail'))
                <div class="div alert alert-danger">{{session('fail')}}</div>
                @endif
                @csrf
                <div class="form-outline mb-4">
                  <input type="firstname" name="firstname" id="firstname" class="form-control form-control-lg" value="{{old('firstname')}}" />
                  <label class="form-label" for="firstname">Enter Your First Name</label>
                  <span class="text-danger"> @error('firstname'){{ $message }}@enderror </span>
                </div>
                <div class="form-outline mb-4">
                  <input type="lastname" name="lastname" id="lastname" class="form-control form-control-lg" value="{{old('lastname')}}" />
                  <label class="form-label" for="lastname">Enter Your Last Name</label>
                  <span class="text-danger"> @error('lastname'){{ $message }}@enderror </span>
                </div>

                <div class="form-outline mb-4">
                  <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{old('email')}}" />
                  <label class="form-label" for="email">Enter Email</label>
                  <span class="text-danger"> @error('email'){{ $message }}@enderror </span>
                </div>
                <div class="form-outline mb-4">
                  <input type="mobile" name="mobile" id="mobile" class="form-control form-control-lg" value="{{old('mobile')}}" />
                  <label class="form-label" for="email">Enter Your Mobile No</label>
                  <span class="text-danger"> @error('mobile'){{ $message }}@enderror </span>
                </div>

                <div class="form-outline mb-4">
                  <input type="address" name="address" id="address" class="form-control form-control-lg" value="{{old('address')}}"/>
                  <label class="form-label" for="password">Enter Your Mobile No</label>
                  <span class="text-danger"> @error('address'){{ $message }} @enderror </span>
                </div>

                <div class="form-outline mb-4">
                <label class="adhar">Upload Your Aadhar Card : </label>
                        <input type="file" name="adhar" class="form-control"  value="{{ old('adhar') }}"  >
                        @error('adhar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div><br>

                <div class="form-outline mb-4">
                <label class="pan">Upload Your Pan Card : </label>
                        <input type="file" name="pan" class="form-control"  value="{{ old('pan') }}"  >
                        @error('pan')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                </div><br>

                <div class="d-flex justify-content-center">
                  <button type="submit" 
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">SUBMIT</button>
                </div>

               

                    
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
        </div>
    </div>
@endsection
</body>
</html>
 

