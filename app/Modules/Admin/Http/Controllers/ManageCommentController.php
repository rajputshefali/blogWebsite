<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Admin\Models\Admin;
use App\Modules\User\Models\BlogPost;
use App\Modules\User\Models\User;
use App\Modules\User\Models\Comment;
use DataTables;

class ManageCommentController extends Controller
{
    public function manageComments(Request $request)
    {
          if($request->ajax())
          {
             try{
               $comments = Comment::latest()->get();
               return Datatables::of($comments)
               ->addIndexColumn()
               
               ->addColumn('action', function(Comment $comments){
                   $actbtn='<a href="/commentdelete/'.$comments->id.'" class="btn btn-danger btn-sm">Delete</a>';
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
             return view('Admin::managecomment');
           }
         }


         //deleting the posts
        public function commentDelete($id)
        {
            
            $deletecomment = Comment::where('id', $id)->firstorfail()->delete();
            
            return redirect()->back()->with('userDeleted', 'The  Requested User  is Deleted Successfully');   
        }
}
