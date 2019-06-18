<?php namespace App\Repositories;

use Mail;
use Swift_Mailer;

use App\User;
use App\UserRole;
use App\Role;
use App\Order;
use App\Payment;
use App\Circle;

class RealtorBootstrap
{
	public $circle_members;
	public $all_requests_count;
	public $unreadMessages;

    public function __construct($user)
    {
        $this->user = $user;
	}

    public function get_circle_members()
	{
		$members = array();
		$circle = $circle = Circle::where('user_one', $this->user->id)
		->orwhere('user_two', $this->user->id)
		->where('status', '1')->get();

		foreach($circle as $pal) {
			if($this->user->id == $pal->user_one) {
				$members[] = $pal->userTwo;
			}else{
				$members[] = $pal->userOne;
			}
		}
		$this->circle_members = $members;
	}

	public function get_all_requests_count()
	{
		$shareRequests = $this->user->sent_share_requests->count() + $this->user->share_requests->count();
		$circleRequests = \App\Circle::SentRequests($this->user->id)->count() + \App\Circle::CircleRequests($this->user->id)->count();
		$requestsCount = $shareRequests + $circleRequests;
		$this->all_requests_count = $requestsCount;
	}

	public function messages()
	{
		$this->unreadMessages = $this->user->unread_messages;
	}

}