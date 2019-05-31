<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

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
		$this->myFunction = new MyFunction;
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

}
