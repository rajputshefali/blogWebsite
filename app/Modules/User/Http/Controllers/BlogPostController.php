<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\User\Models\BlogPost;
use App\Modules\User\Models\User;
use App\Http\Requests\PostFormRequest;
use Auth;
use Session;
use Image;


class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::all();
        return view('User::index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("User::create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        // $this->validate = $request->validate([
        //     'title' => 'required',
        //     'body'  => 'required',
        //     'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    
        //    ]);
        // $validated = $request->validate([
        //     'title' => 'required',
        //     'body' => 'required',
        //     'image' => 'required|image|mimes:png,jpeg,jpg',
        // ]);

        //     $newPost = BlogPost::create([
        //     'title' => $request->title,
        //     'body' => $request->body,
             
        //     'created_by' =>Session::get('loginId'),
        // ]);

        // return redirect('/home');
        $data = $request->validated();
        $newPost = new BlogPost;
        $newPost->title = $data['title'];
        $newPost->body = $data['body'];
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $filename = time().'.'. $file->getClientOriginalExtension();
            $file->move('uploads/images/', $filename);
            $newPost->image= $filename;
        }
        $newPost->created_by = Session::get('loginId');
        $newPost->save();
        return redirect('/home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $blogPost1 = BlogPost::find($id) ;
     // dd($blogPost);
        return view('User::show', [
            'post' => $blogPost1,
        ]); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::find($id);
        if(Auth::check() && Auth::user()->id == $post->created_by)
        {
        return view('User::blogpost-edit')->withPost($post);
    }else{
        return redirect()->back()->with('fail', 'login first to edit the post');

    }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
        $data = $request->validated();
              $edit =  BlogPost::find($id);
              $edit->title= $request->input('title');
              $edit->body = $request->input('body');
              if($request->hasfile('image'))
              {
                  $file = $request->file('image');
                  $filename = time().'.'. $file->getClientOriginalExtension();
                  $file->move('uploads/images/', $filename);
                  $edit->image= $filename;
              }
              $edit->update();
              return redirect()->back()->with('status', 'POST UPDATED SUCCESSFULLY');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = BlogPost::find($id);
        if(Auth::check() && Auth::user()->id == $post->created_by)
        {
            $delete = BlogPost::where('id', $request->id)->firstorfail()->delete();
      
            return redirect()->back()->with('success', 'The  Requested post  is Deleted Successfully'); 

        }else{
            return redirect()->back()->with('fail', 'login first to delete the post');
        }
      
            // return redirect()->back()->with('userDeleted', 'The  Requested User  is Deleted Successfully'); 
       
    
}
}