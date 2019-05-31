<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Email;
use App\Repositories\MyFunction;
use App\Notifications\Circle_request;
use App\Notifications\Circle_request_acceptance;

use DB;
use Illuminate\Http\Request;
use Request as Req;
use Storage;

use App\Circle;
use App\Circle_record;
use App\Realtor;
use App\House;

class CircleController extends Controller
{
	private $email;
	private $realtors;
	private $myFunction;

	public function __construct()
	{
		$this->middleware('realtorAuth');
		$this->email = new Email;
		$this->myFunction = new MyFunction;
		$this->realtors = Realtor::where('activated', '1');
	}

	/**
     * The Friends of the logged in user
     *
     */
	public function show()
	{
		$circle = Circle::where('user_one', Auth::user()->id)->orwhere('user_two', Auth::user()->id)->where('status', '1');
		return view('circle', compact('circle'));
	}

	public function send($user)
	{
		$circle = new Circle;
		$circleRecord = new Circle_record;
		$circle->user_one = $user['one'];
		$circle->user_two = $user['two'];
		$circle->action_user = Auth::user()->id;
		if($circle->save()) {
			$circleRecord->user_one = $circle->user_one;
			$circleRecord->user_two = $circle->user_two;
			$circleRecord->save();

			if($user['one']==Auth::user()->id) {
				$receiver = Realtor::find($user['two']);
				$sender = Realtor::find($user['one']);
			}else{
				$receiver = Realtor::find($user['one']);
				$sender = Realtor::find($user['two']);
			}
			try{
                $receiver->notify(new Circle_request(Auth::user(), $circle));
             }catch(\Exception $e){
                //
            }
			return true;
		}else{
			return false;
		}
	}

	public function accept($id)
	{
		$circleRecord = new Circle_record;
		$rship = Circle::find($id);
		$rship->status = 1;
		$rship->action_user = Auth::user()->id;
		if($rship->save()) {

			$circleRecord->user_one = $rship->action_user;
			switch($rship->action_user) {
				case $rship->user_one : $inactive_user = $rship->user_two; break;
				case $rship->user_two : $inactive_user = $rship->user_one; break;
			}

			//update the circle record
			$circleRecord->user_two = $inactive_user;
			$circleRecord->action = 1;
			$circleRecord->save();

			//Send message to accepted realtor
			$acceptedRealtor = Realtor::find($inactive_user);
			try{
                $acceptedRealtor->notify(new Circle_request_acceptance(Auth::user()));
             }catch(\Exception $e){
                //
            }

			return true;
		}else{
			return false;
		}
	}

	public function decline($id)
	{
		$circleRecord = new Circle_record;
		$rship = Circle::find($id);
		$rship->status = -1;
		$rship->action_user = Auth::user()->id;
		if($rship->save()) {
			
			//update the circle record
			$circleRecord->user_one = $rship->action_user;
			if($rship->action_user == $rship->user_one) {
				$circleRecord->user_two = $rship->user_two;
			}else{
				$circleRecord->user_two = $rship->user_one;
			}
			$circleRecord->status = -1;
			$circleRecord->save();
			return true;
		}else{
			return false;
		}
	}

	public function block($user)
	{
		$circleRecord = new Circle_record;
		$rship = Circle::find($id);
		if(empty($rship)) {
			$rship = new Friend;
			$rship->user_one = $user['one'];
			$rship->user_two =  $user['two'];
		}
		$rship->status = 3;
		$rship->action_user = Auth::user()->id;
		if($rship->save()) {
			return true;
		}else{
			return false;
		}
	}

	public function cancel($user)
	{
		$circleRecord = new Circle_record;
		$rship = Circle::find($id);
		if($rship->delete()) {
			$circleRecord->user_one = $rship->action_user;
			if($rship->action_user == $rship->user_one) {
				$circleRecord->user_two = $rship->user_two;
			}else{
				$circleRecord->user_two = $rship->user_one;
			}
			$circleRecord->status = 2;
			$circleRecord->save();
			return true;
		}else{
			return false;
		}
	}

	public function sort_requests($user, $action, $circle_id='')
	{
		if($action=='send') {
			return $this->send($user);
		}else{
			if(empty($circle_id)) {
				$circle = Circle::where('user_one', $user['one'])->where('user_two', $user['two'])->first();
				$circle_id = $circle->id;
			}
			if($action=='accept') {
				return $this->accept($circle_id);
			}
			if($action=='decline') {
				return $this->decline($circle_id);
			}
			if($action=='block') {
				return $this->block($circle_id);
			}
		}
	}

	/**
	 *Accepts and processes requests i.e send, accept, decline, cancel or block
	 *Redirects if not ajax request
	*/
	public function process_request(Request $request)
	{
		$post = $request->all();
		//var_dump($post);
		$id = $post['id'];
		$action = $post['action'];
		$circle_id = $post['circle_id'];
		$user = array();
		if($id > Auth::user()->id) {
			$user['one'] = Auth::user()->id;
			$user['two'] = $id;
		}else{
			$user['one'] = $id;
			$user['two'] = Auth::user()->id;
		}
		if(isset($post['ajax'])) {
			if($this->sort_requests($user, $action, $circle_id)) {
				echo 1;
			}else{
				echo 0;
			}
		}else{
			if($this->sort_requests($user, $action)) {
				request()->session()->flash('circle_success', 'Circle Request Accepted Successfully');
			}else{
				request()->session()->flash('circle_error', 'There was a problem while trying to accept Circle Request');
			}
			return back();
		}
	}
    
}
