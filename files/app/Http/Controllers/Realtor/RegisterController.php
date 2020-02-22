<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use Storage;
//use Auth;
use App\Mail\Registration;
use App\Mail\Registered;
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
        return view('register', compact('type'));
    }

    public function company()
    {
        $type = 'company';
        return view('register', compact('type'));
    }

    public function register(Request $request)
    {
        //Validate the form inputs
        $validatedData = $request->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'string',
            'profile_name' => 'required|min:3|unique:realtors',
            'email' => 'required|string|email|max:255|unique:realtors',
            'password' => 'required|min:3',
            'phone' => 'string|min:10|max:13',
        ],
        [
            'email.unique' => 'This email exists.. Try login in with the email.. Use forgotten password link to generate a new password if you have forgotten your password',
            'profile_name.unique' => 'The profile name that you entered is not available.. If you have registered before Try login in with the profile name.. Use forgotten password link to generate a new password if you have forgotten your password'
        ]);
        if(!preg_match('/\s/',$request->input('profile_name')) ) {
            //does not contain white spaces;
        
            // Create the realtor
            $realtor = Realtor::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'profile_name' => $request->input('profile_name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'twitter' => $request->input('twitter'),
                'instagram' => $request->input('instagram'),
                'activated' => 1,
                'type' => 'agent'
            ]);

            if($realtor) { //If realtor was registered successfully
                $user = array('email'=>$realtor->email, 'password'=>$request->input('password'));
                //add Realtor Phone Number
                $realtorPhone = Realtor_phone::create([
                    'phone' => $request->input('phone'),
                    'realtor_id' => $realtor->id
                ]);
                
                try{
                    //Send Email to newly registered Realtor
                    Mail::to($realtor->email)->send(new Registration($realtor));
                }catch(exception $e) {
                    //
                }
                try{
                    //Send Email to Admin
                    Mail::to("akalodave@gmail.com")->send(new Registered($realtor));
                }catch(exception $e) {
                    //
                }

                //attempt to login
                //dd(Auth::attempt($user));
                if(Auth::attempt($user)) {
                    $realtor = Realtor::find(Auth::user()->id);
                    $realtor->logged_in = 1;
                    $realtor->logged_in_count += 1;
                    $realtor->save();
                    
                    return redirect('/realtor/home');
                }else{
                    return redirect('realtor/login');
                }
            }else{
                return back()->withErrors([
                    'message' => 'sorry! Registeration was not successfull. Please try again later'
                ]); 
            }
        }else{
            return back()->withErrors([
                'message' => 'Profile Name should be one word without white spaces'
            ]);
        }
    }

    public function register_company(Request $request)
    {
        //Validate the form inputs
        $validatedData = $request->validate([
            'firstname' => 'required|min:2',
            'profile_name' => 'required|min:3|unique:realtors',
            'email' => 'required|string|email|max:255|unique:realtors',
            'password' => 'required|min:3',
            'phone' => 'string|min:10|max:13',
            'rc_number' => 'int|required',
        ],
        [
            'email.unique' => 'This email exists.. Try login in with the email.. Use forgotten password link to generate a new password if you have forgotten your password',
            'profile_name.unique' => 'The profile name that you entered is not available.. If you have registered before Try login in with the profile name.. Use forgotten password link to generate a new password if you have forgotten your password'
        ]);

        if(!preg_match('/\s/',$request->input('profile_name')) ) {
            //does not contain white spaces;
            // Create the realtor
            $realtor = Realtor::create([
                'firstname' => $request->input('firstname'),
                'profile_name' => $request->input('profile_name'),
                'email' => $request->input('email'),
                'rc_number' => $request->input('rc_number'),
                'password' => bcrypt($request->input('password')),
                'twitter' => $request->input('twitter'),
                'instagram' => $request->input('instagram'),
                'activated' => 1,
                'type' => 'company'
            ]);

            if($realtor) { //If realtor was registered successfully
                $user = array('email'=>$realtor->email, 'password'=>$request->input('password'));
                //add Realtor Phone Number
                $realtorPhone = Realtor_phone::create([
                    'phone' => $request->input('phone'),
                    'realtor_id' => $realtor->id
                ]);
                try{
                    //Send Email to newly registered Realtor
                    Mail::to($realtor->email)->send(new Registration($realtor));
                }catch(exception $e) {
                    //
                }
                try{
                    //Send Email to Admin
                    Mail::to("akalodave@gmail.com")->send(new Registered($realtor));
                }catch(exception $e) {
                    //
                }

                //attempt to login
                //dd(Auth::attempt($user));
                if(Auth::attempt($user)) {
                    return redirect('/realtor/home');
                }else{
                    return redirect('realtor/login');
                }
            }else{
                return back()->withErrors([
                    'message' => 'sorry! Registeration was not successfull. Please try again later'
                ]); 
            }
        }else{
            return back()->withErrors([
                'message' => 'Profile Name should be one word without white spaces'
            ]);
        }
    }

    public function send_email()
    {
        $realtor = Auth::user();
        $realtor->notify(new registered($realtor));
    }

}
