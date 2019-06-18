<?php

namespace App\Http\Controllers\API\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;
use App\Repositories\RealtorBootstrap;

//use Request;
use Illuminate\Http\Request;
use App\Http\Requests\ProfilePhotoRequest;
use Storage;
use File;
use Intervention\Image\ImageManager;

use App\Realtor;
use App\Realtor_house;
use App\House;
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;
use App\Circle;

class ProfileController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
		$this->myFunction = new MyFunction;
		$this->user = Auth::guard('api')->user();
		$this->realtorBootstrap = new RealtorBootstrap($this->user);

		$this->realtorBootstrap->get_circle_members();
		$this->realtorBootstrap->get_all_requests_count();

		$this->unreadMessages = $this->user->unread_messages;
		$this->circleMembers = $this->realtorBootstrap->circle_members;
		$this->requestsCount = $this->realtorBootstrap->all_requests_count;
	}
    
	public function index()
	{
        $this->user->{"phones"} = $this->user->phones;
		$code = 200;
		$data = [
			'user'				=> $this->user,
			'unreadMessages'    => $this->unreadMessages,
			'circleMembers'     => $this->circleMembers,
			'requestsCount'     => $this->requestsCount,
			'profilePhoto_url'	=> env("APP_STORAGE").'images/profile_photos/'
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
	}

    public function edit_field(Request $request)
    {
        $post = $request->all();
        $title = $post['title'];
        $value = $post['value'];

        $realtorObj = Realtor::find(Auth::user()->id);
        if(!empty($realtorObj)) {
            $realtorObj->{$title} = $value;
            if($realtorObj->save()) {
                $message = "Field edited successfully";
                $code = 200;
            }else{
                $message = "Field could not be edited";
                $code = 500;
            }
        }else{
            $message = "Realtor was not found";
            $code = 404;
        }
        $response = [
            'status_code'   => $code,
            'message'       => $message,
			'data'		    => []
		];
		return response()->json($response, $code);
    }

    public function change_email()
    {
        $code = 200;
		$data = [
			'user'				=> $this->user,
			'unreadMessages'    => $this->unreadMessages,
			'circleMembers'     => $this->circleMembers,
			'requestsCount'     => $this->requestsCount,
			'profilePhoto_url'	=> env("APP_STORAGE").'images/profile_photos/'
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
    }

    public function update_email(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'new_email' => 'required|email',
            'password' => 'required|min:3',
        ]);
        $post = $request->all();
        $email = $post['email'];
        $new_email = $post['new_email'];
        $password = $post['password'];
        
        $realtorObj = Realtor::where('email', $email)->first();

        //dd(bcrypt($password));
        if(!empty($realtorObj) && password_verify($password, $realtorObj->password)) {
            $realtorObj->email = $new_email;
            if($realtorObj->save()) {
                $message = "Email changed successfully";
                $code = 200;
            }else{
                $message = "Email could not be changed";
                $code = 500;
            }
        }else{
            $message = "Wrong Email or Password";
            $code = 500;
        }
        $response = [
            'status_code'   => $code,
            'message'       => $message,
			'data'		    => []
		];
		return response()->json($response, $code);
    }

    public function change_password()
    {
        $code = 200;
		$data = [
			'user'				=> $this->user,
			'unreadMessages'    => $this->unreadMessages,
			'circleMembers'     => $this->circleMembers,
			'requestsCount'     => $this->requestsCount,
			'profilePhoto_url'	=> env("APP_STORAGE").'images/profile_photos/'
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
    }

    public function update_password(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'answer' => 'required',
            'password' => 'required|min:3',
            'new_password' => 'required|min:3',
        ]);
        $post = $request->all();
        $email = $post['email'];
        $answer = $post['answer'];
        $password = $post['password'];
        $new_password = $post['new_password'];
        
        $realtorObj = Realtor::where('email', $email)->first();

        if(!empty($realtorObj) && password_verify($password, $realtorObj->password)) {
            if($realtorObj->sec_answer == $answer){
                $realtorObj->password = bcrypt($new_password);
                if($realtorObj->save()) {
                    $message = "Password changed successfully";
                    $code = 200;
                }else{
                    $message = "Password could not be changed";
                    $code = 500;
                }
            }else{
                $message = "Secret Question Answer is Wrong";
                $code = 500;
            }
        }else{
            $message = "Wrong Email or Password";
            $code = 500;
        }
        $response = [
            'status_code'   => $code,
            'message'       => $message,
			'data'		    => []
		];
		return response()->json($response, $code);
    }

    public function change_secret_question()
    {
        $code = 200;
		$data = [
			'user'				=> $this->user,
			'unreadMessages'    => $this->unreadMessages,
			'circleMembers'     => $this->circleMembers,
			'requestsCount'     => $this->requestsCount,
			'profilePhoto_url'	=> env("APP_STORAGE").'images/profile_photos/'
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
    }

    public function update_secret_question(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
            'new_question' => 'required',
            'new_answer' => 'required',
        ]);
        $post = $request->all();
        $email = $post['email'];
        $password = $post['password'];
        $secret_question = $post['new_question'];
        $secret_answer = $post['new_answer'];
        
        $realtorObj = Realtor::where('email', $email)->first();

        if(!empty($realtorObj) && password_verify($password, $realtorObj->password)) {
            $realtorObj->sec_question = $secret_question;
            $realtorObj->sec_answer = $secret_answer;
            if($realtorObj->save()) {
                $message = "Secret Question and Answer changed successfully";
                $code = 200;
            }else{
                $message = "Secret Question and answer could not be changed";
                $code = 500;
            }
        }else{
            $message = "Wrong Email or Password";
            $code = 500;
        }
        $response = [
            'status_code'   => $code,
            'message'       => $message,
			'data'		    => []
		];
		return response()->json($response, $code);
    }

    public function change_secret_answer()
    {
        $code = 200;
		$data = [
			'user'				=> $this->user,
			'unreadMessages'    => $this->unreadMessages,
			'circleMembers'     => $this->circleMembers,
			'requestsCount'     => $this->requestsCount,
			'profilePhoto_url'	=> env("APP_STORAGE").'images/profile_photos/'
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
    }

    public function update_secret_answer(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
            'current_answer' => 'required',
            'new_answer' => 'required',
        ]);
        $post = $request->all();
        $email = $post['email'];
        $password = $post['password'];
        $current_answer = $post['current_answer'];
        $secret_answer = $post['new_answer'];
        
        $realtorObj = Realtor::where('email', $email)->first();

        if(!empty($realtorObj) && password_verify($password, $realtorObj->password)) {
            if($realtorObj->sec_answer == $current_answer){
                $realtorObj->sec_answer = $secret_answer;
                if($realtorObj->save()) {
                    $message = "Secret Answer changed successfully";
                    $code = 200;
                }else{
                    $message = "Secret Answer could not be changed";
                    $code = 500;
                }
            }else{
                $message = "Secret Answer is Wrong";
                $code = 500;
            }
        }else{
            $message = "Wrong Email or Password";
            $code = 500;
        }
        $response = [
            'status_code'   => $code,
            'message'       => $message,
			'data'		    => []
		];
		return response()->json($response, $code);
    }

    public function change_profile_photo()
    {
        $code = 200;
		$data = [
			'user'				=> $this->user,
			'unreadMessages'    => $this->unreadMessages,
			'circleMembers'     => $this->circleMembers,
			'requestsCount'     => $this->requestsCount,
			'profilePhoto_url'	=> env("APP_STORAGE").'images/profile_photos/'
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
    }

    public function update_profile_photo(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
            'photo' => 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:10000',
        ]);
        $post = $request->all();
        $email = $post['email'];
        $password = $post['password'];
        
        $realtorObj = Realtor::where('email', $email)->first();

        if(!empty($realtorObj) && password_verify($password, $realtorObj->password)) {
            $current_photo = $realtorObj->profile_photo;
            $filePath = storage_path('images/profile_photos/'); //Set the path to the image
            $photoInput = $request->file('photo');
            //dd($photoInput);
            //request()->file('photo')->store($filePath);
            //foreach ($request->file('photo') as $key=>$photoInput) {
            $Intervention_img = new ImageManager(); //make an instance of the Image manager Class
            $original_name = $photoInput->getClientOriginalName(); //get the name of the photo
            $filename = time() . '-'.$original_name; //create a unique name for the photo
            $img = $Intervention_img->make($photoInput->getRealPath());//re-create the image using the Image manager object
                
            if($img->save($filePath.$filename, 100)) {
                unlink($filePath.$current_photo);
                $realtorObj->profile_photo = $filename;
                if($realtorObj->save()) {
                    $message = "Profile Photo changed successfully";
                    $code = 200;
                }else{
                    $message = "Profile Photo could not be changed";
                    $code = 500;
                }
            }else{
                $message = "New Profile Photo could not be uploaded";
                $code = 500;
            }
        }else{
            $message = "Wrong Email or Password";
            $code = 500;
        }
        $response = [
            'status_code'   => $code,
            'message'       => $message,
			'data'		    => []
		];
		return response()->json($response, $code);
    }

    public function edit_about()
    {
        $code = 200;
		$data = [
			'user'				=> $this->user,
			'unreadMessages'    => $this->unreadMessages,
			'circleMembers'     => $this->circleMembers,
			'requestsCount'     => $this->requestsCount,
			'profilePhoto_url'	=> env("APP_STORAGE").'images/profile_photos/'
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
    }

    public function update_about(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
            'about' => 'required|min:5',
        ]);
        $post = $request->all();
        $email = $post['email'];
        $password = $post['password'];
        $about = $post['about'];
        
        $realtorObj = Realtor::where('email', $email)->first();

        if(!empty($realtorObj) && password_verify($password, $realtorObj->password)) {
            $realtorObj->about = $about;
            if($realtorObj->save()) {
                $message = "About Me Edited successfully";
                $code = 200;
            }else{
                $message = "About Me could not be edited";
                $code = 500;
            }
        }else{
            $message = "Wrong Email or Password";
            $code = 500;
        }
        $response = [
            'status_code'   => $code,
            'message'       => $message,
			'data'		    => []
		];
		return response()->json($response, $code);
    }


}
