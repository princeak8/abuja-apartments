<?php 

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;

use Request;
use Auth;

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
        if( !auth()->attempt(request(['email', 'password']))) {
            // If not, redirect back
            return back()->withErrors([
                'message' => 'Please chek your credentials and try again.'
            ]); 

        }

        return redirect('realtor/home'); //Redirect to the home page 
   }

   public function logout()
   {
        auth()->logout();

        return redirect('realtor/login');
   }
}


