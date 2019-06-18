<?php

namespace App\Http\Controllers\API\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;
use App\Repositories\RealtorBootstrap;

use Illuminate\Http\Request;
use Storage;

use App\Message;
use App\Realtor;
use App\House;
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;

class MessageController extends Controller
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
    
	public function send(Request $request)
	{
		$messageObj = new Message;
		$post = $request->all();
		if(isset($post['sender_id'])) {
			$messageObj->sender_id = $post['sender_id'];
		}else{
			$messageObj->name = $post['name'];
			$messageObj->phone = $post['phone'];
			$messageObj->email = $post['email'];
		}
		if(isset($post['related'])) {
			$messageObj->related = $post['related'];
			$messageObj->related_id = $post['related_id'];
		}
		$messageObj->receiver_id = $post['receiver_id'];
		$messageObj->message = $post['message'];
		if($messageObj->save()) {
			echo '<p style="color:green; font-size:11px;"><b>Message Successfully Sent</b></p>';
		}else{
			echo '<p style="color:red; font-size:11px;"><b>Sorry, Message Could not be sent</b></p>';
		}
	}

	public function messages()
	{
		$messages = $this->user->received_messages;
		$code = 200;
		$data = [
			'user'						=> $this->user,
			'unreadMessages'         	=> $this->unreadMessages,
			'circleMembers'     		=> $this->circleMembers,
			'requestsCount'       		=> $this->requestsCount,
			'messages'     				=> $messages
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
	}

	public function message($id)
	{
		$message = Message::find($id);
		if(!empty($message) && $message->receiver_id == $this->user->id) {
			//message not empty and loggedIn User is the intended receiver
			$message->unread = 0;
			$message->save();
			$code = 200;
			$data = [
				'message'     		=> $message,
				'user'				=> $this->user,
				'unreadMessages'    => $this->unreadMessages,
				'circleMembers'     => $this->circleMembers,
				'requestsCount'     => $this->requestsCount
			];
		}else{
			$code = 404;
			$data = [
				'redirect' => 'api/v1/realtor/messages'
			];
		}
		
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
	}

	public function mark_read(Request $request)
	{
        $data = Input::all();

        if(isset($data['id'])) {
			$message_id = $data['id'];
			$messageObj = Message::find($message_id);
			if(!empty($messageObj)) {
				$messageObj->unread = 0;
			
				if($messageObj->save()) {
					$data = array(
                    	"status" => "success",
                    	"code"   => 200,
               		 );
				}else{
					$data = array(
                    	"status" => "error",
                    	"code"   => 500,
                    	"message"=> "Could not be marked as read"
               		 );
				}
			}else{
				$data = array(
                    "status" => "success",
                   	"code"   => 404,
                   	"message"=> "Message not found"
           	    );
			}
		}else{
			$data = array(
                "status" => "success",
                "code"   => 404,
                "message"=> "id Was not found"
           	);
		}
	}

	public function delete($id)
	{
		//Check if its an admin and its logged in

		$messageObj = Message::find($id);
		if(!empty($messageObj)) {
			DB::beginTransaction();
			try{
				$deleted = $messageObj->delete();
				DB::commit();
				$code = 200;
				$data = [];
				$response = [
					'status_code' => $code,
					'data'		  => $data
				];
	        } catch (\Exception $e) {
				DB::rollback();
				$response = [
					'status_code' 		=> $code,
					'message'		  	=> "Message could not be deleted"
				];
	        }
		}
		
		return response()->json($response, $code);
	}

}
