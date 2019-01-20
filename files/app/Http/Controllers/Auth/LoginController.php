<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating admin for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

   public function login()
   {
       // Attempt to authenticate the user
        if( !auth()->attempt(request(['username', 'password']))) {
            // If not, redirect back
            return back()->withErrors([
                'message' => 'Please chek your credentials and try again.'
            ]); 

        }

        return redirect('admin/home'); //Redirect to the home page 
   }

   public function logout()
   {
        auth()->logout();

        return redirect('admin/login');
   }
}


