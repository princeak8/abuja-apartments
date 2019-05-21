<?php 

namespace App\Http\Controllers\API\Realtor;

use App\Http\Controllers\Controller;

//use Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Auth;
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
        $this->middleware('auth:api', ['except' => ['login']]);
    }

     /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }

   public function login(Request $request)
   {
        $credentials = $request->only('email', 'password');
    
            if ($token = $this->guard()->attempt($credentials)) {
                //return $this->respondWithToken($token);
                //return response()->json($this->guard()->user());
                $user = $this->guard()->user();
                $code = 200;
                $data = [
                    'token'     => $token,
                    'realtor'   => $user,
                    'redirect'  => 'api/v1/realtor/index'
                ];
                $realtor = Realtor::find($user->id);
                $realtor->logged_in = 1;
                $realtor->toggle_login_at = date('Y-m-d H:i:s');
                $realtor->save();
                $response = [
                    'status_code' => $code,
                    'data'		  => $data
                ];
            }else{
                $code = 500;
                $response = [
                    'status_code' => $code,
                    'message'     => 'Invalid Credentials'
                ];
            }
        return response()->json($response, $code);
   }

   public function logout()
   {
        $realtor = Realtor::find($this->guard()->user()->id);
        $this->guard()->logout();

        $realtor->logged_in = 0;
        $realtor->toggle_login_at = date('Y-m-d H:i:s');
        $realtor->save();

        $data = [
            'redirect' => 'api/v1/realtor/login'
        ];
        $response = [
            'status_code' => 200,
            'data'     => $data
        ];
        return response()->json($response, 200);
   }
}


