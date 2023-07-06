<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\User\Models\Comment;
use App\Modules\User\Models\BlogPost;
use App\Modules\User\Models\User;
use Auth;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
           'comment_body' => 'required|string'
        ]);
        if($validator->fails())
        {
            return redirect()->back()->with('message', 'comment body is required');
        }
        if(Auth::check()){
            $post = BlogPost::where('id' , $request->post_id)->first();
            if($post)
            {
            Comment::create([
                'post_id' => $post->id,
                'user_id'  =>Auth::user()->id,
                'comment_body' => $request->comment_body,
                'commented_by' => Session::get('loginId'),
            ]);
            return redirect()->back()->with('message', 'Commented successfully');
            }
            else
            {
                return redirect()->back()->with('message', 'No such post found');

            }

        }else{
            return redirect()->back()->with('message', 'Login first');
        }
    }

//     public function replyStore(Request $request)
//     {
//         $reply = new Comment();
//         $reply->body = $request->get('comment_body');
//         $reply->user()->associate($request->user());
//         $reply->parent_id = $request->get('comment_id');
//         $post = BlogPost::find($request->get('post_id'));
//         $post->comments()->save($reply);
//         return back();

// }
    public function destroy(Request $request){
        if(Auth::check()){
            $comment = Comment::where('id', $request->comment_id)
            ->where('user_id', Auth::user()->id )
            ->first();

            $comment->delete();
            
            return response()->json([
             'status' => 200,
             'message' => "comment deleted successfully"
            ]);

        }else{
            return response([
                'status' => 401,
            
            ]);
        }
    }

     //display comments
    public function commentShow(Request $request)
    {
     $data = Comment::get();
     return $data;
 
    }
    
       public function edit($id)
        {
            
            $comment = Comment::find($id);
            
            if(Auth::check() && Auth::user()->id == $comment->user_id)
            {
           return view('User::comment-edit')->withComment($comment);
            }else{
                return redirect()->back()->with('fail', 'login first to comment');

            }
        }
    //update user role
    public function updateComment(Request $request, $id)
    {  
       
    //   dd(Auth::user()->id);
// dd(Auth::id());
  
    //  dd($request->user_id);
    $comment = Comment::find($id);
    if(Auth::check() && Auth::user()->id == $comment->user_id)
     
    {
     
    
     
      $edit = Comment::find($id);
      $edit->comment_body = $request->input('comment_body');
      
      $edit->update();
      return redirect()->back()->with('status','CommentUpdated Successfully');
    }
    else{
        return redirect()->back()->with('fail', 'login first');
    }
}
        
        
    
    
    


    


    public function delete(Request $request)
    {
        if(Auth::check()){
            $comment = Comment::where('id', $request->comment_id);
            

            $comment->delete();
            
            return response()->json([
             'status' => 200,
             'message' => "comment deleted successfully"
            ]);

        }else{
            return response([
                'status' => 401,
            
            ]);
        }
    }
}
