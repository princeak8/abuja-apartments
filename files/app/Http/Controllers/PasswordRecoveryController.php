<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Mail;

use App\Repositories\MyFunction;

use Illuminate\Http\Request;

use Auth;

use App\Mail\Reset_password;
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
        if($realtor && !empty($realtor)) {
            if(!empty($realtor->sec_question) && !empty($realtor->sec_answer)) {
                $data['secQuestion_set'] = 1;
                $data['sec_question'] = $realtor->sec_question;
                $data['sec_answer'] = $realtor->sec_answer;
            }else{
                $data['secQuestion_set'] = 0;
                //Send Email with link;
            }
            $data['verified'] = 1;
        }else{
            $data['verified'] = 0; 
        }

        return response()->json($data, 200);
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
            //Mail::to($email)->send(new Reset_password($token));
        }
        catch(exception $e){
            //
        }
        
        $data['success'] = 1;

        return response()->json($data, 200);
   }

   public function reset_password($token)
   {
       $token = str_replace('-0-', '/', $token);
       $resetObj = Password_reset::where('token', $token)->first();
       $reset = true;
       $expired = false;
       if($resetObj && !empty($resetObj)) {
            $sentTime = strtotime($resetObj->created_at);
            $timeElapsed = time() - $sentTime;
            if($timeElapsed > 3600) {
                $expired = true;
                $resetObj->delete();
            }
       }else{
           $reset = false;
       }
       //dd($token);
       return view('reset_password', compact("reset", "expired", "token"));
   }

   public function change_password(Request $request)
   {
        $post = $request->all();
        $password = $post['password'];
        $token = $post['token'];
        $resetObj = Password_reset::where('token', $token)->first();
        $reset = 1;
        $expired = 0;
        $success = 0;
        if($resetObj && !empty($resetObj)) {
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
                    }else{
                        $success = 0;
                    }
                }else{
                    $success = 0;
                }
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


