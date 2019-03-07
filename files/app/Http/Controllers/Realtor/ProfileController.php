<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

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
		$this->middleware('realtorAuth');
		$this->myFunction = new MyFunction;
	}
    
	public function index()
	{
		return view('realtor/profile/index');
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
                $data = array(
                    "status" => "success",
                    "code"   => 200,
                    "message"=> "Field edited successfully"
                );
            }else{
                $data = array(
                    "status" => "error",
                    "code"   => 500,
                    "message"=> "Field could not be edited"
                );
            }
        }else{
            $data = array(
                "status" => "error",
                "code"   => 404,
                "message"=> "Realtor was not found"
            );
        }
        return response()->json($data);
    }

    public function change_email()
    {
        $realtor = Auth::user();
        return view('realtor/profile/change_email', compact('realtor'));
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
                request()->session()->flash('status', 'success');
                request()->session()->flash('msg', 'Email changed successfully');
            }else{
                request()->session()->flash('status', 'error');
                request()->session()->flash('msg', 'Email could not be changed');
            }
        }else{
            request()->session()->flash('status', 'error');
            request()->session()->flash('msg', 'Wrong Email or Password');
        }
        return back();
    }

    public function change_password()
    {
        $realtor = Auth::user();
        return view('realtor/profile/change_password', compact('realtor'));
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
                    request()->session()->flash('status', 'success');
                    request()->session()->flash('msg', 'Password changed successfully');
                }else{
                    request()->session()->flash('status', 'error');
                    request()->session()->flash('msg', 'password could not be changed');
                }
            }else{
                request()->session()->flash('status', 'error');
                request()->session()->flash('msg', 'Secret Question Answer is Wrong');
            }
        }else{
            request()->session()->flash('status', 'error');
            request()->session()->flash('msg', 'Wrong Email or Password');
        }
        return back();
    }

    public function change_secret_question()
    {
        $realtor = Auth::user();
        return view('realtor/profile/change_secret_question', compact('realtor'));
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
                request()->session()->flash('status', 'success');
                request()->session()->flash('msg', 'Secret Question and Answer changed successfully');
            }else{
                request()->session()->flash('status', 'error');
                request()->session()->flash('msg', 'Secret Question and answer could not be changed');
            }
        }else{
            request()->session()->flash('status', 'error');
            request()->session()->flash('msg', 'Wrong Email or Password');
        }
        return back();
    }

    public function change_secret_answer()
    {
        $realtor = Auth::user();
        return view('realtor/profile/change_secret_answer', compact('realtor'));
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
                    request()->session()->flash('status', 'success');
                    request()->session()->flash('msg', 'Secret Answer changed successfully');
                }else{
                    request()->session()->flash('status', 'error');
                    request()->session()->flash('msg', 'Secret Answer could not be changed');
                }
            }else{
                request()->session()->flash('status', 'error');
                request()->session()->flash('msg', 'Secret Answer is Wrong');
            }
        }else{
            request()->session()->flash('status', 'error');
            request()->session()->flash('msg', 'Wrong Email or Password');
        }
        return back();
    }

    public function change_profile_photo()
    {
        $realtor = Auth::user();
        return view('realtor/profile/change_profile_photo', compact('realtor'));
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
                    request()->session()->flash('status', 'success');
                    request()->session()->flash('msg', 'Profile Photo changed successfully');
                }else{
                    request()->session()->flash('status', 'error');
                    request()->session()->flash('msg', 'Profile Photo could not be changed');
                }
            }else{
                request()->session()->flash('status', 'error');
                request()->session()->flash('msg', 'New Profile Photo could not be uploaded');
            }
        }else{
            request()->session()->flash('status', 'error');
            request()->session()->flash('msg', 'Wrong Email or Password');
        }
        return back();
    }

    public function edit_about()
    {
        $realtor = Auth::user();
        return view('realtor/profile/edit_about', compact('realtor'));
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
                request()->session()->flash('status', 'success');
                request()->session()->flash('msg', 'About Me Edited successfully');
            }else{
                request()->session()->flash('status', 'error');
                request()->session()->flash('msg', 'About Me could not be edited');
            }
        }else{
            request()->session()->flash('status', 'error');
            request()->session()->flash('msg', 'Wrong Email or Password');
        }
        return back();
    }


}
