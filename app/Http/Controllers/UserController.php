<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','user')->orderBy('created_at','ASC')->paginate(5);
        return view('admin.users.index',compact('users'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.users.create',compact('countries'));
    }

    public function store(Request $request)
    {
        $validationrules = [           
            'username'=>'required',
            'address'=>'required',
            'dob'=>'required|date|after:1990|before:2002',
            'gender'=>'required',
            // 'city'=>'required',
            // 'state'=>'required',
            // 'country'=>'required',
            'city_id'=>'required',
            'state_id'=>'required',
            'country_id'=>'required',        
            'status'=>'required',        
            'role'=>'required',
            'pincode'=>'required|numeric|min:6',
            'mobile_no'=>['required', 'digits:10','unique:users,mobile_no'],
            'email'=>'required|max:255|email:rfc,dns|unique:users,email',
            'password'=>'required|min:8|confirmed',
           
        ];
        $messages =[
            'username.required'=>'Please enter name',
            'address.required'=>'Please enter address',
            'dob.required'=>'Please enter date of birth',
            'city_id.required'=>'Please select city name.',
            'state_id.required'=>'Please select state name.',
            'country_id.required'=>'Please select coutry name',
            'pincode.required'=>'Please enter pincode',
            'pincode.min.6'=>'Please enter 6 digit pincode',
            'pincode.numeric'=>'Please enter valid pincode',
            'mobile_no.unique'=> 'Please enter other mobile number ,mobile number already exist .',
            'mobile_no.min.10'=>'Please enter 10 digit mobile number.',
            'mobile_no.max.10'=>'Please enter 10 digit mobile number.',
            'mobile_no.required'=> 'Please enter mobile number.',
            'mobile_no.numeric.required'=> 'Please enter valid mobile number.',
            'email'=> 'Please enter valid email address.',
            'email.required'=>'Please enter email.',
            'email.unique'=> 'Please enter other email address,Email address is already exist. ',
            'password.required'=>'Please enter password',
            'password.min.5'=>'Please enter 8 digit password',
            'status.required'=>'Please select status',
            'role.required'=>'Please select role',
        ];
                   
        $request->validate($validationrules,$messages);

        $user = new User;
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
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect(route('user.index'));
    }

    public function edit($id)
    {
        $users = User::find($id);
        $countries = Country::all();
        return view('admin.users.edit',compact('users','countries'));
    }

    public function show($id)
    {
        $users = User::find($id);
        return view('admin.users.show',compact('users'));
    }

    public function update(Request $request, $id)
    {
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
            // 'mobile_no'=>'required|numeric|digits:10|unique:users,mobile_no,'.$user->id,
            'mobile_no'=>['required', 'digits:10','unique:users,mobile_no,'.$user->id],
            'email'=>'required|max:255|email:rfc,dns|unique:users,email,'.$user->id,
            'password'=>'required|min:8|confirmed',
            'status'=>'required',        
            'role'=>'required',        
           
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
            'mobile_no.unique'=> 'Mobile number already exist .',
            'mobile_no.min.10'=>'Please enter 10 digit mobile number.',
            'mobile_no.required'=> 'Please enter mobile number.',
            'mobile_no.numeric'=> 'Please enter valid mobile number.',
            'status.required'=>'Please select status',
            'role.required'=>'Please select role',
            'email'=> 'Please enter valid email address.',
            'email.required'=>'Please enter email.',
            'email.unique'=> 'Please enter other email address,Email address is already exist. ',
            'password.required'=>'Please enter password',
            'password.min.5'=>'Please enter 8 digit  password',
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
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect(route('user.index'));
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect(route('user.index'));
    }

    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["state_name","id"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name","id"]);
        // echo "<pre>"; print_r($data['cities']); exit;
        return response()->json($data);
    }
}
