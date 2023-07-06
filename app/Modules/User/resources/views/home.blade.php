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
       <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
         
          <a class="navbar-brand" href="#">{{ Auth::user()->fname  }}</a>
          
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  LOGOUT??
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="/logout">LOGOUT</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">WELCOME TO BLOG DASHBOARD</h1>
                <br>
                <a href="/blog" class="btn btn-outline-primary">Show Blog</a>
            </div>
            <div class="col-12 text-center pt-5">
                <h3>CREATE NEW BLOG</h3>
                <a href="/blog/create/post" class="btn btn-outline-primary">Create New Blog</a>
            </div>
        </div>
    </div>
@endsection
</body>
</html>
 

