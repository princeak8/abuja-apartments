<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Hashing\HashManager;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Repositories\MyFunction;

use Illuminate\Http\Request;

use Auth;

use App\Mail\Reset_password;
use App\Mail\Changed_password;
use App\Realtor;
use App\Password_reset;

class PasswordRecoveryController extends Controller 
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
        $this->middleware('guest');
    }

   public function verify_email(Request $request)
   {
        $post = $request->all();
        $email = $post['email'];
        $data = array();
        $realtor = Realtor::where('email', $email)->first();
        $resetObj = Password_reset::where('email', $email)->first();
        $data['tokenExists'] = 0;
        if($resetObj) {
            $sentTime = strtotime($resetObj->created_at);
            $timeElapsed = time() - $sentTime;
            if($timeElapsed <= 3600) {
                $data['tokenExists'] = 1;
            }else{
                $resetObj->delete();
            }
            $data['timeElapsed'] = $timeElapsed;
        }
        
        if($data['tokenExists'] == 0) {
            if($realtor && !empty($realtor)) {
                if(!empty($realtor->sec_question) && !empty($realtor->sec_answer)) {
                    $data['secQuestion_set'] = 1;
                    $data['sec_question'] = $realtor->sec_question;
                    $data['sec_answer'] = $realtor->sec_answer;
                }else{
                    $data['secQuestion_set'] = 0;
                    $valid = false;
                    while($valid===false) {
                        $token = app('auth.password.broker')->createToken($realtor);
                        if(strstr($token, '/') || strstr($token, '\\')) {
                            $valid = false;
                        }else{
                            $valid = true;
                            $data['token'] = $token;
                            try {
                                Mail::to($email)->send(new Reset_password($email, $token));
                            }
                            catch(exception $e){
                                //echo $e;
                            }
                        }
                    }
                    
                }
                $data['verified'] = 1;
            }else{
                $data['verified'] = 0; 
            }
        }else{
            $data['tokenExists'] = 1;
        }

        return response()->json($data, 200);
   }

   public function test()
   {
       $email = "akaloforex@gmail.com";
    Mail::to($email)->send(new Reset_password("93jwend0439fj0djw39"));
   }

   public function send_mail(Request $request)
   {
        $post = $request->all();
        $email = $post['email'];
        $realtor = Realtor::where('email', $email)->first();
        $valid = false;
        while($valid===false) {
            $token = app('auth.password.broker')->createToken($realtor);
            if(strstr($token, '/') || strstr($token, '\\')) {
                $valid = false;
            }else{
                $valid = true;
            }
        }
        try {
            Mail::to($email)->send(new Reset_password($email, $token));
        }
        catch(exception $e){
            //echo $e;
        }
        
        $data['success'] = 1;

        return response()->json($data, 200);
   }

   public function reset_password($email, $token)
   {
        $token = str_replace('-0-', '/', $token);
        $resetObj = Password_reset::where('email', $email)->first();
        $reset = true;
        $expired = false;
        $invalid = false;
        if($resetObj && !empty($resetObj)) {
            //$hash = new Hash;
            if(Hash::check($token, $resetObj->token)) {
                $sentTime = strtotime($resetObj->created_at);
                $timeElapsed = time() - $sentTime;
                if($timeElapsed > 3600) {
                    $expired = true;
                    $resetObj->delete();
                }
            }else{
                $invalid = true;
                $reset = false;
            }
        }else{
            $reset = false;
        }
       //dd($token);
       return view('reset_password', compact("reset", "expired", "invalid", "token", "email"));
   }

   public function change_password(Request $request)
   {
        $post = $request->all();
        $password = $post['password'];
        $token = $post['token'];
        $email = $post['email'];
        $resetObj = Password_reset::where('email', $email)->first();
        $reset = 1;
        $expired = 0;
        $success = 0;
        $invalid = 0;
        if($resetObj && !empty($resetObj)) {
            if(Hash::check($token, $resetObj->token)) {
                $sentTime = strtotime($resetObj->created_at);
                $timeElapsed = time() - $sentTime;
                if($timeElapsed > 3600) {
                    $expired = 1;
                    $resetObj->delete();
                }else{
                    $realtor = Realtor::where('email', $resetObj->email)->first();
                    if($realtor) {
                        $realtor->password = bcrypt($password);
                        if($realtor->save()) {
                            $success = 1;
                            $resetObj->delete();
                            //Send Mail
                            try {
                                Mail::to($email)->send(new Changed_password());
                            }
                            catch(exception $e){
                                //echo $e;
                            }
                        }else{
                            $success = 0;
                        }
                    }else{
                        $success = 0;
                    }
                }
            }else{
                $invalid = 1;
                $reset = 0;
            }
        }else{
            $reset = 0;
        }
        $data = [
            "expired"=> $expired,
            "reset" => $reset,
            "success"   => $success
        ];
        return response()->json($data, 200);
   }
}


