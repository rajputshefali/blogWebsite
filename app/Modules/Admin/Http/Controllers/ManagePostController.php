<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Admin\Models\Admin;
use App\Modules\User\Models\BlogPost;
use App\Modules\User\Models\User;
use DataTables;

class ManagePostController extends Controller
{
 //manageposts
 


    //manage posts
    public function managePost(Request $request)
    {
          if($request->ajax())
          {
             try{
               $posts = BlogPost::latest()->get();
               return Datatables::of($posts)
               ->addIndexColumn()
               
               ->addColumn('action', function(BlogPost $posts){
                   $actbtn='<a href="/postdelete/'.$posts->id.'" class="btn btn-danger btn-sm">Delete</a>';
                   return $actbtn;
                   })
                 
               ->rawColumns(['action'])
               ->make(true);
             }
             catch(exception $e){
               dd($e);
             }
           }
           else
           {
             return view('Admin::managepost');
           }
         }


         //deleting the posts
        public function deletePost($id)
        {
            
            $delete = BlogPost::where('id', $id)->firstorfail()->delete();
            
            return redirect()->back()->with('userDeleted', 'The  Requested User  is Deleted Successfully');   
        }




      //
      public function showPost(Request $request)
      {
        $blog = BlogPost::get();
        return view("Admin::postManagement", compact('blog'));
      }

       //edit 
       public function restricUser($id)
       {
          $restrict_user= BlogPost::find($id);
          return view('Admin::postrestrict-edit')->with('restrict_user', $restrict_user);
       }
       //update user role
       public function updatePostuser(Request $request, $id)
       {
         $user = BlogPost::find($id);
         
         $user->restrict_users = $request->input('restrict_users');
         $user->update();
         return redirect()->back()->with('status','Updated Successfully');
       }
        
    }

