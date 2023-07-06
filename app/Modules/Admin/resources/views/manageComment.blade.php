<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>COMMENTS MANAGEMENTG</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <div class="container" id="#upload-comment">
        <h2 style="text-align:center;">COMMENTS MANAGEMENT</h2>
        <div class="w3-container">
            <div class="container mt-5">
            <a href="/dashboard" class="btn btn-outline-primary">Go back</a><br><br>
            <h3 class="mb-4 header"> COMMENT LIST</h3>
        <table class="table table-bordered yajra-datatable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>post_id</th>
                    <th>user_id</th>
                    <th>comment_body</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
            </div>
        </div>
    </div>
       
    </body>
      <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>   
      <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
      
    <script type="text/javascript">
    
      $(function () {
        
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('comment-list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'post_id', name: 'post_id'},
                {data: 'user_id', name: 'user_id'},
                {data: 'comment_body', name:'comment_body'},
                {data: 'action', name: 'action', orderable: true,  searchable: true},
            ]
        });
      });
    </script>
</body>
</html>