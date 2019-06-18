<?php

namespace App\Http\Controllers\API\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Validator;
use App\Notifications\Registered;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use Storage;
use Validator;
//use Auth;

use App\Realtor;
use App\Realtor_phone;

class RegisterController extends Controller
{
	public function __construct()
	{
        $this->middleware('guest', ['except' => 'send_email']);
		$this->myFunction = new MyFunction;
    }
    
    public function individual()
    {
        $type = 'individual';
        $data = [
            'type'     => $type
        ];
        $code = 200;
        $response = [
            'status_code' => $code,
            'data'		  => $data
        ];
        return response()->json($response, $code);
    }

    public function company()
    {
        $type = 'company';
        $data = [
            'type'     => $type
        ];
        $code = 200;
        $response = [
            'status_code' => $code,
            'data'		  => $data
        ];
        return response()->json($response, $code);
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

    public function attempt_login($user)
    {
        if ($token = $this->guard()->attempt($user)) {
            //return $this->respondWithToken($token);
            //return response()->json($this->guard()->user());
            $user = $this->guard()->user();
            $data = [
                'token'         => $token,
                'logged_in'     => false,
                'user'       => $user,
                'redirect'      => 'api/v1/realtor/index'
            ];
            $realtor = Realtor::find($user->id);
            $realtor->logged_in = 1;
            $realtor->toggle_login_at = date('Y-m-d H:i:s');
            $realtor->save();
        }else{
            $data = [
                'logged_in'     => false,
                'redirect'      => 'api/v1/realtor/login'
            ];
        }
        return $data;
    }

    public function validateInput($request)
    {
        //Validate the form inputs
        $rules = [
            'firstname' => 'required|min:2',
            'lastname' => 'string',
            'profile_name' => 'required|min:3',
            'email' => 'required|string|email|max:255|unique:realtors',
            'password' => 'required|min:3',
            'phone' => 'string|required|min:10|max:13',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            $code = 500;
            $response = [
                'status_code' => $code,
                'message'     => $validator->errors()
            ];
            return response()->json($response, $code);
        }
    }

    public function register(Request $request)
    {
        $validateResponse = $this->validateInput($request);
        if($validateResponse) {
            return $this->validateInput($request);
        }
        // Create the realtor
        $realtor = Realtor::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'profile_name' => $request->input('profile_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        if($realtor) { //If realtor was registered successfully
            $user = array('email'=>$realtor->email, 'password'=>$request->input('password'));
            //add Realtor Phone Number
            $realtorPhone = Realtor_phone::create([
                'phone' => $request->input('phone'),
                'realtor_id' => $realtor->id
            ]);
            $code = 200;

            //attempt to login
            $data = $this->attempt_login($user);

            $response = [
                'status_code' => $code,
                'data'		  => $data
            ];
        }else{
            $code = 500;
            $response = [
                'status_code' => $code,
                'message'     => 'sorry! Registeration was not successfull. Please try again later'
            ];
        }
        return response()->json($response, $code);
    }

    public function register_company(Request $request)
    {
        //Validate the form inputs
        $validateResponse = $this->validateInput($request);
        if($validateResponse) {
            return $this->validateInput($request);
        }

            // Create the realtor
        $realtor = Realtor::create([
            'firstname' => $request->input('firstname'),
            'profile_name' => $request->input('profile_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'activated' => 1
        ]);

        if($realtor) { //If realtor was registered successfully
            $user = array('email'=>$realtor->email, 'password'=>$request->input('password'));
            //add Realtor Phone Number
            $realtorPhone = Realtor_phone::create([
                'phone' => $request->input('phone'),
                'realtor_id' => $realtor->id
            ]);
            $code = 200;

            //attempt to login
            $data = $this->attempt_login($user);
            $response = [
                'status_code' => $code,
                'data'		  => $data
            ];
        }else{
            $code = 500;
            $response = [
                'status_code' => $code,
                'message'     => 'sorry! Registeration was not successfull. Please try again later'
            ]; 
        }
        return response()->json($response, $code);
    }

    public function send_email()
    {
        $realtor = Auth::user();
        $realtor->notify(new registered($realtor));
    }

}
