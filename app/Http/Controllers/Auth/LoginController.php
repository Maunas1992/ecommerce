<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated(Request $request, $user)
    {
        $user = User::where('email', $request->email)->first();
        if($user->role == 'admin' && $user->status == 'Active') {
            return redirect()->intended('admin/home');
        }else if($user->role == 'user' && $user->status == 'Inactive'){
            $this->logout($request);
            return $this->unauthorized();
        }else{
            return redirect()->intended('/');
        }
        // return redirect()->intended('/');
    }

    private function unauthorized($message = null){
        // return response()->json([
        //     'message' => $message ? $message : 'You are unauthorized to access this resource',
        //     'success' => false
        // ], 401);
        return response(view('admin.errorPages.loginError'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        $user = Auth::user();
        if($user->role == 'admin'){
            Auth::logout();
            return redirect('admin/login');
        }else{
            Auth::logout();
            return redirect('login');
        }
    }
}
