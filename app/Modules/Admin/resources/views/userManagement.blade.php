<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USER MANAGEMENT</title>
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
                <th>fname</th> 
                <th>lname</th>
                <th>email</th>
                <th>isBan</th>
                <th>isRestrict</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item-> id}}</td>
                <td>{{ $item-> fname }}</td>
                <td>{{ $item-> lname }}</td>
                <td>{{ $item-> email}}</td>
                <td>
                    
                    @if($item->isBan == "0")
                    
                    <label class="btn btn-primary">Not Banned</label>
                    @elseif($item->isBan == "1")
                    <label class="btn btn-danger">Banned</label>
                    
                    @endif
                </td>
                <td>
                    @if($item->isRestrict == "0")
                    <label class="btn btn-primary">Unestrict </label>
                    @elseif($item->isRestrict == "1")
                    <label class="btn btn-danger">Restrict </label>
                    @endif
                </td>
                <td>
                    <a href="{{url('edit/'.$item->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{url('delete/'.$item->id)}}" class="btn btn-danger">Delete</a>
                    <a href="{{url('editpostUsers/'.$item->id)}}" class="btn btn-primary">EDIT RESTRICTION</a>
                </td>
            @endforeach
        </tr>
        </tbody>
        </div>
    </div>
    </div>
</body>
</html>