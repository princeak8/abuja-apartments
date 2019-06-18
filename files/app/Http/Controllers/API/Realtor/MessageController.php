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
		$this->middleware('realtorAuth');
		$this->myFunction = new MyFunction;

		$this->realtorBootstrap->get_circle_members();
		$this->realtorBootstrap->get_all_requests_count();
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
		$messages = Message::orderBy('created_at', 'DESC')->get();
		$unread_messages = Message::Unread()->get();
		return view('realtor/messages', compact('messages', 'unread_messages'));
	}

	public function message($id)
	{
		$message = Message::find($id);
		if(!empty($message)) {
			$message->unread = 0;
			$message->save();
			return view('admin/message', compact('message'));
		}else{
			return redirect('realtor/messages');
		}
		
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
	        } catch (\Exception $e) {
    			DB::rollback();
	        }
		}

		return back();
	}

}
