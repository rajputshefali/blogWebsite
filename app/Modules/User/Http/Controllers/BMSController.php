<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\User\Models\BMS;


class BMSController extends Controller
{
    public function bmsFront()
    {
        return view("User::bms");
    }


    public function saveDetails(Request $request){
        //dd("coming");
        $request->validate([
            'firstname' => 'required|regex:/^[a-zA-Z]/u',
            'lastname' => 'required|regex:/^[a-zA-Z]/u',
            'email' => 'required|unique:BMS|email:rfc,dns',
            'mobile' => 'required|min:10|numeric',
            'address' => 'required',
            'adhar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'pan' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            

        ]);
        $user = new BMS;
        $user->firstame = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->email = $request['email'];
        $user->mobile = $request['mobile'];
        $user->address = $request['address'];
        $user->adhar = $request['adhar'];
        $user->pan = $request['pan'];
        
        $res = $user->save();
        if($res){
            //  return back()->with('success', 'you  have registered successfully');
           
             return back()->with('success', 'successfully registered');
        }else{
             return back()->with('fail', 'something went wrong');
        }
}
}
