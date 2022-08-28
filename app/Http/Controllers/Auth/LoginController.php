<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = '/admin/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login()
    {
        return view('auth.login');
    }
    
    public function userlogin(Request $request)
    {

        $email = $request->get('email');
        $password = $request->get('password');
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            // dd($user);
            if ($user->status == "Inactive") {
                Auth::logout();
                Session::put("login_error", 'Sorry! Your account is suspended. Contact our support team for further info');
                return redirect('admin/login');
            }
            return redirect('/admin/home');
        } else {
            Session::put("login_error", 'Credentials do not match our records');
            return redirect('/admin/login');
        }

       
    }

   
    
}
