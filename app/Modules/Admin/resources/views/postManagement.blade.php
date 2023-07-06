<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POST MANAGEMENT</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
    <div class="container" id="upload-user">
        <div class="row">
            <div class="container mt-5">
            <a href="/dashboard" class="btn btn-outline-primary">Go back</a><br><br>
            <h3 class="mb-4 header"> USERS LIST</h3>
            <table class="table table-bordered ">
              <thead>
                <tr>
                <th>Id</th>
                <th>title</th> 
                <th>body</th>
                <th>created_by</th>
                <th>restrict_users</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blog as $item)
            <tr>
                <td>{{ $item-> id}}</td>
                <td>{{ $item-> title }}</td>
                <td>{{ $item-> body }}</td>
                <td>{{ $item-> created_by}}</td>
                <td>
                
                    @if($item->restrict_users == "0")
                    <label class="btn btn-primary">Unestrict User</label>
                    @elseif($item->restrict_users == "1")
                    <label class="btn btn-danger">Restrict User</label>
                    @endif
                </td>
                <td>
                    <a href="{{url('editpostUsers/'.$item->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{url('postdelete/'.$item->id)}}" class="btn btn-danger">Delete</a>
                </td>
            @endforeach
        </tr>
        </tbody>
        </div>
    </div>
    </div>
</body>
</html>