<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validationrules = [           
            'username'=>'required',
            'address'=>'required',
            'dob'=>'required|date|after:1990|before:2002',
            'gender'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',        
            'pincode'=>'required|numeric|min:6',
            'mobile_no'=>'required|numeric|min:10|unique:users,mobile_no',
            'email'=>'required|max:255|email:rfc,dns|unique:users,email',
            'password'=>'required|min:8|confirmed',
           
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
                        'mobile_no.min.10'=>'Please enter  10 digit contact number number.',
                        'mobile_no.required'=> 'Please enter your contact number number.',
                        'mobile_no.numeric'=> 'Please enter valid contact number.',
                        'email'=> 'Please enter valid email address.',
                        'email.required'=>'Please enter your email.',
                        'email.unique'=> 'Please enter other email address,Email address is already exist. ',
                        'password.required'=>'Please enter your password',
                        'password.min.5'=>'Please enter 8 digit  password',
                    ];
                   
                    $request->validate($validationrules,$messages);

        $user = new User;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->city = $request->city;
        $user->gender = $request->gender;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->pincode = $request->pincode;
        $user->mobile_no = $request->mobile_no;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->save();
        return redirect(route('user.index'));
    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.users.edit',compact('users'));
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'address' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'mobile_no' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::find($id);
        $user->username = $request->username;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->city = $request->city;
        $user->gender = $request->gender;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->pincode = $request->pincode;
        $user->mobile_no = $request->mobile_no;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user';
        $user->save();
        return redirect(route('user.index'));
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect(route('user.index'));
    }
}
