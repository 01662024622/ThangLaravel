<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
// use Request;
// use Socialite;
use Auth;
class AdminLoginController extends Controller
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
    protected $redirectTo = 'admin/posts';
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function showLoginForm()
    {
        return view('adminauth.adminLogin');
    }
     protected function guard()
    {
        return Auth::guard('admin');
    }
    public function logout(Request $request)
    {
        $this->guard('admin')->logout();
        // dd($request->session());
        $request->session()->invalidate();

        return redirect('admin/login');
    }
   
   
    
   
}
