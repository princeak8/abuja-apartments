<?php 

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;

use Request;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth; 

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

   public function login(Request $request)
   {
        $credentials = $request->only('email', 'password');
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

        try {
            if($token = JWTAuth::attempt($credentials)) {
                $user = JWTAuth::parseToken()->authenticate();
                $code = 200;
                $data = [
                    'token'     => $token,
                    'realtor'   => $user
                ];
                $realtor = Realtor::find($user->id);
                $realtor->logged_in = 1;
                $realtor->toggle_login_at = date('Y-m-d H:i:s');
                $realtor->save();
            }else{
                $code = 404;
                $response = [
                    'status_code' => $code,
                    'message'     => 'Invalid Credentials'
                ];
            }

        } catch (JWTException $e) {
            $code = 500;
            $response = [
                'status_code' => $code,
                'message'     => 'Could not create token'
            ];
        }

        return response()->json($response, $code);
   }

   public function logout()
   {
        $realtor = Realtor::find(Auth::user()->id);
        auth()->logout();

        $realtor->logged_in = 0;
        $realtor->toggle_login_at = date('Y-m-d H:i:s');
        $realtor->save();

        return redirect('/');
   }
}


