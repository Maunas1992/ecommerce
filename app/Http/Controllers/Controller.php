<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function signup()
    {
        return view('signup');
    }

    public function frontLoginPage(){
        return view('front_login');
    }
    

    public function viewprofile()
    {
        $user = Auth::user();
        return view('profile',compact('user'));
    }

    public function updateprofile(Request $request,$id)
    {
        $user = User::find($id);
        $input = $request->all();
        
        $validationrules = [
            'username'=>'required',
            'address'=>'required',
            'dob'=>'required|date|after:1990|before:2002',
            'gender'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',         
            'pincode'=>'required|numeric|min:6',
            'mobile_no'=>'required|numeric|digits:10|unique:users,mobile_no,' . $user->id,
            'email'=>'required|max:255|email:rfc,dns|unique:users,email,' . $user->id,
            ];
        $messages =[
                        'username.required'=>'Please enter your name',
                        'address.required'=>'Please enter your address',
                       'dob.required'=>'Please enter your date of birth',
                        'city.required'=>'Please select your city name.',
                        'state.required'=>'Please select your state name.',
                        'country.required'=>'Please select your coutry name',
                        
                        'pincode.required'=>'Please enter your pincode',
                        'pincode.min.10'=>'Please enter 6 digit  pincode',
                        'pincode.numeric'=>'Please enter valid  pincode',
                        'mobile_no.unique'=> 'Please enter other contact number ,contact number already exist .',
                        'mobile_no.digits'=>'Please enter  10 digit contact number number.',
                        'mobile_no.required'=> 'Please enter your contact number number.',
                        'mobile_no.numeric'=> 'Please enter valid contact number.',
                        'email'=> 'Please enter valid email address.',
                        'email.required'=>'Please enter your email.',
                        'email.unique'=> 'Please enter other email address,Email address is already exist. ',
            ];
                    
            $request->validate($validationrules,$messages);
            $user->update($input);
            return redirect()->back()->with("success","Profile updated successfully!");
    }

    public function changePassword()
    {
        $user = Auth::user();
        return view('userchangepassword',compact('user'));
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }


}

