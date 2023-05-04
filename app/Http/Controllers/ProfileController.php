<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends Controller
{
    public function adminprofile(){
        $countries = Country::all();
        $users = Auth::user();
        return view('admin.profile.adminprofile',compact('users','countries'));
    }

    public function adminUpdateProfile(Request $request, $id){
        $user = User::find($id);
        $validationrules = [           
            'username'=>'required',
            'address'=>'required',
            'dob'=>'required|date|after:1990|before:2002',
            'gender'=>'required',
            'city_id'=>'required',
            'state_id'=>'required',
            'country_id'=>'required',        
            'pincode'=>'required|numeric|min:6',
            'mobile_no'=>['required', 'digits:10','unique:users,mobile_no,'.$user->id],
            'email'=>'required|max:255|email:rfc,dns|unique:users,email,'.$user->id,
            'status'=>'required',        
           
             ];
        $messages =[
            'username.required'=>'Please enter name',
            'address.required'=>'Please enter address',
            'dob.required'=>'Please enter date of birth',
            'city_id.required'=>'Please select city name.',
            'state_id.required'=>'Please select state name.',
            'country_id.required'=>'Please select coutry name',
            'pincode.required'=>'Please enter pincode',
            'pincode.min.10'=>'Please enter 6 digit  pincode',
            'pincode.numeric'=>'Please enter valid  pincode',
            'mobile_no.unique'=> 'Please enter other mobile number ,mobile number already exist .',
            'mobile_no.min.10'=>'Please enter  10 digit mobile number number.',
            'mobile_no.required'=> 'Please enter mobile number.',
            'mobile_no.numeric'=> 'Please enter valid mobile number.',
            'status.required'=>'Please select status',
            'email'=> 'Please enter valid email address.',
            'email.required'=>'Please enter email.',
            'email.unique'=> 'Please enter other email address,Email address is already exist. ',
        ];
                   
        $request->validate($validationrules,$messages);
        $user->username = $request->username;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->city_id = $request->city_id;
        $user->gender = $request->gender;
        $user->state_id = $request->state_id;
        $user->country_id = $request->country_id;
        $user->pincode = $request->pincode;
        $user->mobile_no = $request->mobile_no;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();
        return redirect(route('home'))->with('success','Profile Updated');
    }

    public function adminChangePassword(){
        $users = Auth::user();
        return view('admin.profile.adminChangePassword',compact('users'));
    }

    public function adminUpdatePassword(Request $request,$id){
        $validationrules = [           
            'old_password'=>'required',
            'new_password'=>'required|string|min:8|confirmed',
        ];
        $messages =[
            'old_password.required'=>'Please enter old password',
            'new_password.required'=>'Please enter new password',
            'new_password.min.5'=>'Please enter 8 digit  password',
        ];
                   
        $request->validate($validationrules,$messages);
        $users = User::find($id);

        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your old password is wrong.");
        }
        if(strcmp($request->get('old_password'), $request->get('new_password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your old password.");
        }

        $users->password = Hash::make($request->get('new_password'));
        $users->save();
        return redirect()->back()->with("success","Password successfully changed!");
    }
}
