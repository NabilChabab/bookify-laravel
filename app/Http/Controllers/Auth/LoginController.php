<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        // Check the user's role and redirect accordingly
        if ($user->role_id == 1) {
            return redirect()->route('dashboard.index'); // Replace 'dashboard' with your actual route name
        } elseif ($user->role_id == 2) {
            return redirect()->route('home.index'); // Replace 'home' with your actual route name
        }

        return redirect($this->redirectTo);
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
}
