<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return '/admin/home';
        }
        return '/';
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = array(
            'username.required'=>'Please enter name',
            'address.required'=>'Please enter address',
            'dob.required'=>'Please select date of birth',
            'city.required'=>'Please enter city name.',
            'state.required'=>'Please enter state name.',
            'country.required'=>'Please enter coutry name',
            'pincode.required'=>'Please enter pincode',
            'pincode.min.6'=>'Please enter 6 digit  pincode',
            'pincode.numeric'=>'Please enter valid  pincode',
            'mobile_no.unique'=> 'Please enter other contact number ,contact number already exist .',
            'mobile_no.min.10'=>'Please enter 10 digit contact number.',
            'mobile_no.max.10'=>'Please enter 10 digit contact number.',
            'mobile_no.required'=> 'Please enter contact number.',
            'mobile_no.numeric.required'=> 'Please enter valid contact number.',
            // 'email'=> 'Please enter valid email address.',
            'email.required'=>'Please enter email.',
            'email.unique'=> 'Please enter other email address,Email address is already exist. ',
            'password.required'=>'Please enter password',
            'password.min.8'=>'Please enter 8 digit  password',
        );
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'dob' => ['required','after:1990|before:today'],
            'gender' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'country' => ['required', 'string', 'max:255'],
            'mobile_no' => ['required', 'string', 'max:255'],
            'pincode' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create($data)
    {
        return User::create([
            'username' => $data['username'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'pincode' => $data['pincode'],
            'mobile_no' => $data['mobile_no'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
    }
}
