<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Admin\Models\Admin;
use App\Modules\User\Models\User;
use App\Modules\User\Models\Comment;
use Auth;
use Hash;
use DataTables;
use Session;
use Str;
use DB;
use Mail;
use Carbon\Carbon;
use Cookie;


class AdminController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Admin::welcome");
    }
     public function front(){
      return view('front');
     }


     //register
     public function registerAdmin()
     { 
      return view('Admin::register-admin');
     }

     public function save(Request $request)
     {
     
      $request->validate([
          'fname' => 'required',        
          'email' => 'required|unique:admins',
          'password' => 'required|min:6|max:8|regex:/^\S*$/u',
          'cpassword' => 'required|same:password',

      ]);
      $admin = new Admin;
      $admin->fname = $request['fname'];
      $admin->email = $request['email'];
      $admin->password =bcrypt($request['password']);
      $res = $admin->save();
      if($res){
          //  return back()->with('success', 'you  have registered successfully');
           return redirect('/alogin');
      }else{
           return back()->with('fail', 'something went wrong');
      }
    }
    //login 
    public function adminlogin()
    {
        return view("Admin::login");
    }


    public function adminAuth(Request $request)
    {
    //    //dd("coming");
     $request->validate([
          'email' => 'required|email',
          'password' => 'required'
      ]);

   
       
    
      $admin = Admin::where(['email'=> $request->email])->first();
        if($admin)
        {
         if(Hash::check($request->password, $admin->password))
         {
         $request->session()->put('adminId', $admin->id);
        // dd(session()->get('adminId'));
        
        Cookie::queue(Cookie::make('adminId', $admin->id));
        // dd(Cookie::get('adminId'));
        
       
        return redirect('/dashboard')->with('success' ,'Successfully logged in');
       } else{
        return back()->with('fail' ,'Password mismatched.');
       }
       
      }
     else{
      return back()->with('fail' ,'Credentials mismatched.');
     }
    }
    
    

   





    //MANAGEUSER
     public function manageUser(Request $request)
     {
       if($request->ajax())
       {
          try{
            $data = User::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            
            ->addColumn('action', function(User $data){
                // dump($data->id);
                $btn='<a href="/delete/'.$data->id.'" class="btn btn-danger btn-sm">Delete</a> <br><br> 
                <a href ="/ban/'.$data->id.'" class="btn btn-primary btn-sam">isBan</a>';
                
                return $btn;
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
          return view('Admin::manageUsers');
        }
      }



        public function userDelete($id)
        {
          $delete = User::where('id', $id)->firstorfail()->delete();
      
          return redirect()->back()->with('userDeleted', 'The  Requested User  is Deleted Successfully');   
   
        }
      

        //userManagement testing
   public function userManage(Request $request)
   {
    $data = User::get();
    return view('Admin::userManagement', compact('data'));

   }


        //edit user role
        public function editRole($id)
        { 
          $user_role= User::find($id);
         
           
            return view('Admin::user-edit')->with('user_role', $user_role);

          }
        

        //update user role  
        public function updateRole(Request $request, $id)
        { 
          $user = User::find($id);
          $user->fname = $request->input('fname');
          $user->email = $request->input('email');
          $user->isBan = $request->input('isBan');
          if($user->isBan == 0 || $user->isBan == 1)
          {
            $user->update(); 
            return redirect()->back()->with('status','Updated Successfully');

          }
         else{
          return redirect()->back()->with('fail','can not update');

         }
        }
      

       //RESTRICT USER
       public function restricUser($id)
      {
        $restrict_user= User::find($id);
        return view('Admin::postrestrict-edit')->with('restrict_user', $restrict_user);
      }
       //update user role
       public function updatePostuser(Request $request, $id)
      {
       $user = User::find($id);
       
       $user->isRestrict = $request->input('isRestrict');
       $user->update();
       return redirect()->back()->with('status','Updated Successfully');
     }

       
     //dashboard
    public function dashboard()
    {
     return view("Admin::dashboard");
    }





    //forget-password
   public function pwforget(){
    return view('Admin::pw-forget');
   }

   public function showform(Request $request)
   {
    $request->validate([
      'email' => 'required|email|exists:admins,email'
    ]);

    $token = Str::random(40);
    DB::table('password_resets')->insert([
      'email' => $request->email,
      'token' => $token,
      'created_at' => Carbon::now(),
     ]);

     $action_link = route('reset', ['token'=>$token, 'email'=>$request->email]);
     $body= "You can reset your password by clicking the link below";

     Mail::send('forget', ['action_link'=> $action_link, 'body'=> $body], function($message)  use($request){
      $message->from('singhshefali74@gmail.com');
      $message->to($request->email)
              ->subject('reset password');
     });
     return back()->with('success', 'we have sent your password reset link successfully');

   }


   public function reseting(Request $request , $token=null)
   {
    return view("Admin::resetingpassword")->with(['token'=>$token, 'email'=>$request->email]);

   }
   public function resetpw(Request $request)
   {
    $request->validate([
      'email' => 'required|email|exists:users,email',
      'password'=> 'required|min:6|max:8|confirmed|regex:/^\S*$/u',
      'password_confirmation' => 'required'
       
    ]);
    $check_token = \DB::table('password_resets')->where([
      'email'=> $request->email,
      'token' => $request->token,
    ])->first();

    if(!$check_token )
        {
          return back()->with('fail', 'Invalid token');
        }else{
          Admin::where('email', $request->email)->update([
            'password'=>Hash::make($request->password)
          ]);
          DB::table('password_resets')->where([
            'email'=>$request->email
          ])->delete();
          return redirect()->route('alogin')->with('success', 'Your password has been changed successfully, You can login now.');
        }
   }













    //logout
    public function logout()
    {
    // Auth::logout(); 
    //  if (session()->has('adminId')) 
    //  {
    //    session()->pull('adminId');
       
    //  }
    
    // return redirect('/');
    Cookie::forget('adminId');
    if (session()->has('adminId')) 
     {
       session()->pull('adminId');
       
     }
    return redirect('/');
    
    }
    }

