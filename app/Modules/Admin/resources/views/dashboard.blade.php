<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/show.css">
    
</head>
<body>
    
    <section id="sidebar">
       
        <div class="sidebar-brand">
            <h2><i class="fa-solid fa-desktop"></i><span>&nbsp;ADMIN DASHBOARD</span></h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a id="user_manage" href="#"><i class="fa fa-user"></i><span>MANAGE USER</span></a></li>
                <li><a id="posts_manage" href="#"><i class="fa-regular fa-file"></i><span>MANAGE BLOG POSTS</span></a></li>
                <li><a id="comments_manage" href="#"><i class="fa-solid fa-comment"></i><span>MANAGE COMMENTS</span></a></li>
                <li><a id="logout_id" href="/logout-user"><i class="fa-solid fa-right-from-bracket"></i><span>LOGOUT</span></a></li>
                {{-- <li id="btn-li"><button type="button" onclick="window.location='{{ URL::route('front'); }}'"><i class="fa-solid fa-right-from-bracket"></i>LOGOUT</button></li> --}}

            </ul>
        </div>
    </section>
    <nav>
    <section id="main-content">
        <header class="main-header">
       <div class="header-left">
        <h4><i class="fa-solid fa-bars"></i><span>&nbsp;Dashboard</span></h4>
       </div>
       
       <div class="header-left">
       <img src="/assets/img/user.jpg" class="img-responsive">
       <h3>Admin</h3>
       </div>
        </header>
    </section>
</nav>
    
    {{-- usermanage --}}
    <div class="container" id="upload-file" style="display:none">
        <h2 style="text-align:center;">USER MANAGEMENT</h2>
        <div class="w3-container">
            <div class="container mt-5">
             <h3 class="mb-4 header"> USER LIST</h3>
        <table class="table table-bordered yajra-datatable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>fname</th> 
                    <th>lname</th>
                    <th>email</th>
                    <th>isBan</th>
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
      {{-- fontawesome --}}
    <script src="https://kit.fontawesome.com/19e6f5c2df.js" crossorigin="anonymous"></script>
    <script type="text/javascript">

        $(function () {
          
          var table = $('.yajra-datatable').DataTable({
            //   distroy: true,
              processing: true,
              serverSide: true,
              ajax: "{{ route('user-list') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'fname', name: 'fname'},
                  {data: 'lname', name: 'lname'},
                  {data: 'email', name: 'email'},
                  {data: 'isBan', name:'isBan'},
                  {data: 'action', name: 'action', orderable: true,  searchable: true},
              ]
          });
        });
      </script>

      {{-- post management --}}
      <div class="container" id="upload-posts" style="display:none">
        <h2 style="text-align:center;">BLOG POST MANAGEMENT</h2>
        <div class="w3-container" id="i-post">
            <div class="container mt-5">
             <h3 class="mb-4 header">BLOG POSTS LIST</h3>
        <table class="table table-bordered data-datatable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>title</th> 
                    <th>body</th>
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
        
        var table = $('.data-datatable').DataTable({
            // distroy: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('post-list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'body', name: 'body'},
                {data: 'action', name: 'action', orderable: true,  searchable: true},
            ]
        });
      });
    </script>

</html> 


<script>
    $(document).ready(function( ){
        $('#user_manage').on('click', function( ) {
        window.location.replace('/manage');
        // $('#upload-file').css('display','');
     });
    })

    $(document).ready(function(){
        $('#posts_manage').on('click', function(){
            window.location.replace('/managepost');
            // $('#upload-posts').css('display', '');
        });
    })

    $(document).ready(function( ){
        $('#comments_manage').on('click', function(){
            window.location.replace('/managecomment');
        })
    });

    
    // $(document).ready(function(){
    //     $('#logout_id').on('click', function(){
    //         window.location.replace('/logout-user');
         
    // })
// });


    </script>


