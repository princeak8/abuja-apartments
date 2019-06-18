<?php 

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;

use Request;
use Auth;

use App\Realtor;

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
        $realtor = Realtor::find(Auth::user()->id);
        $realtor->logged_in = 1;
        $realtor->toggle_login_at = date('Y-m-d H:i:s');
        $realtor->save();
        return redirect('realtor/home'); //Redirect to the home page 
   }

   public function logout()
   {
       if(!Auth::user()) {
            return redirect('realtor/login');
       }
        $realtor = Realtor::find(Auth::user()->id);
        auth()->logout();

        $realtor->logged_in = 0;
        $realtor->toggle_login_at = date('Y-m-d H:i:s');
        $realtor->save();

        return redirect('/');
   }
}


