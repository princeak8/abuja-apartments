<?php

namespace App\Http\Controllers\API\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Email;
use App\Repositories\MyFunction;
use App\Repositories\RealtorBootstrap;

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
	private $user;
	private $unreadMessages;
	private $circleMembers;
	private $requestsCount;

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

	/**
     * The Friends of the logged in user
     *
     */
	public function show()
	{
		$code = 200;
		$data = [
			'user'						=> $this->user,
			'unreadMessages'         	=> $this->unreadMessages,
			'circleMembers'     		=> $this->circleMembers,
			'requestsCount'       		=> $this->requestsCount
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
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
			$rship = new Circle;
			$rship->user_one = $user['one'];
			$rship->user_two =  $user['two'];
		}
		$rship->status = 3;
		$rship->action_user = Auth::user()->id;
		if($rship->save()) {
			//update the circle record
			$circleRecord->user_one = $rship->action_user;
			if($rship->action_user == $rship->user_one) {
				$circleRecord->user_two = $rship->user_two;
			}else{
				$circleRecord->user_two = $rship->user_one;
			}
			$circleRecord->status = 3;
			$circleRecord->save();
			return true;
		}else{
			return false;
		}
	}

	public function cancel($user)
	{
		$circleRecord = new Circle_record;
		$rship = Circle::find($id);
		if($rship->status == 0) {
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
		}else{
			return true;
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
		//Ajax Request

		$post = $request->all();
		//var_dump($post);
		$id = $post['id'];
		$action = $post['action'];
		$user = array();
		if($action == 'send') {
			if($id > Auth::user()->id) {
				$user['one'] = Auth::user()->id;
				$user['two'] = $id;
			}else{
				$user['one'] = $id;
				$user['two'] = Auth::user()->id;
			}
			$circle_id = '';
		}else{
			$circle_id = $post['circle_id'];
		}
		
		if($this->sort_requests($user, $action, $circle_id)) {
			$code = 200;
			$data = [];
			$response = [
				'status_code' => $code,
				'data'		  => $data
			];
		}else{
			$code = 500;
			$response = [
				'status_code' => $code,
				'message'     => 'Request was not successfull'
			];
		}
		
		return response()->json($response, $code);
	}

	public function delete(Request $request)
	{
		$post = $request->all();
		$circle_id = $post['circle_id'];
		$rship = Circle::find($circle_id);
		if($rship->user_one == Auth::user()->id || $rship->user_two == Auth::user()->id) {
			if($circle->status == 1) {
				$circleRecord = new Circle_record;

				if($rship->delete()) {
					$code = 200;
					$circleRecord->user_one = $rship->action_user;
					if($rship->action_user == $rship->user_one) {
						$circleRecord->user_two = $rship->user_two;
					}else{
						$circleRecord->user_two = $rship->user_one;
					}
					$circleRecord->status = 4;
					$circleRecord->save();
					$data = [];
					$response = [
						'status_code' => $code,
						'data'		  => $data
					];
				}else{
					$code = 500;
					$response = [
						'status_code' 		=> $code,
						'message'		  	=> "Record could not be deleted"
					];
				}
			}
		}
		
		return response()->json($response, $code);
	}
    
}
