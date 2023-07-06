<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\User\Models\User;
use Auth; 
use Session;
use Hash;
use Validator;
use Carbon\Carbon;
use Mail;
use Str;
use DB;

class UserController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("User::welcome");
    }


    public function register()
    {
        return view("User::register");
    }


    public function save_user(Request $request){
        //dd("coming");
        $request->validate([
            'fname' => 'required|regex:/^[a-zA-Z]/u',
            'lname' => 'required|regex:/^[a-zA-Z]/u',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required|min:6|max:8|regex:/^\S*$/u',
            'cpassword' => 'required|same:password',

        ]);
        $user = new User;
        $user->fname = $request['fname'];
        $user->lname = $request['lname'];
        $user->email = $request['email'];
        $user->password =bcrypt($request['password']);
        $res = $user->save();
        if($res){
            //  return back()->with('success', 'you  have registered successfully');
           
             return redirect('/login-user')->with('success', 'successfully registered');
        }else{
             return back()->with('fail', 'something went wrong');
        }
        // $user = User::where('email', $request['email'])->first();

        // if($user)
        // {
        //     return response()->json(['exists' => 'Email already exists']);
        // } else {
        //     $request->validate([
        //         'fname' => 'required',
        //         'lname' => 'required',
        //         'email' => 'required|unique:users',
        //         'password' => 'required|min:6|max:8',
        //         'cpassword' => 'required|same:password',

        //     ]);
        //     $user = new User;
        //     $user->fname = $request['fname'];
        //     $user->lname = $request['lname'];
        //     $user->email = $request['email'];
        //     $user->password =bcrypt($request['password']);
        // }
        // $user->save();
        // // return response()->json(['success' => 'User Registered Successfully']);
        // return redirect('/login-user');
    }

    public function login()
    {
        return view('User::userlogin');
    }

    public function userlogin(Request $request){
          $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
 
          ]);
          

           if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
           ]))
           { 
           $email= $request->input('email');
   

            $users = User::select('*')
                    ->where('email', '=',$email )
                     ->first();
            $users_id = $users->id;
               
            session()->put('loginId', $users_id);
            // dd(session()->get('loginId', ));
            //  return response()->json(['success' => 'Successfully logged in']);
             return redirect('/home');
           }
           

           else{
            return back()->with('fail','Credentials mismatched');
           }
        }
    
      

      public function home()
      {
        return view('User::home');
      }


      public function logout(Request $request)
      {
         Auth::logout();
         if (session()->has('loginId')) 
         {
           session()->pull('loginId');
         }
        //  dd(session::get('loginId'));
        // dd(session::get('adminId'));
         
         return redirect('login-user');
      }



      //forget password
      public function forgetPass()
      {
        return view("User::forget-password");
      }

      public function resetPass(Request $request)
      {
       $request->validate([
        'email'=>'required|email|exists:users,email'
       ]);

       $token = str::random(40);
       DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => Carbon::now(),
       ]);

       $action_link = route('password-reset', ['token'=>$token, 'email'=>$request->email]);

       $body="You can reset your password by clicking the link below.";

       Mail::send('email-forgot', ['action_link'=> $action_link, 'body'=> $body], function($message)  use($request){
        $message->from('singhshefali74@gmail.com');
        $message->to($request->email)
                ->subject('reset password');
       });
       return back()->with('success', 'we have sent your password reset link successfully');
      }

      public function passwordReset(Request $request, $token=null)
      {
        return view("User::password-reset")->with(['token'=>$token, 'email'=>$request->email]);
      }

      public function reset(Request $request)
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
          User::where('email', $request->email)->update([
            'password'=>Hash::make($request->password)
          ]);

          DB::table('password_resets')->where([
            'email'=>$request->email
          ])->delete();

          return redirect()->route('login-user')->with('success', 'Your password has been changed successfully, You can login now.');
        }
      }
}
