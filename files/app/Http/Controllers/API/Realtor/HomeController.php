<?php

namespace App\Http\Controllers\API\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;
use App\Repositories\RealtorBootstrap;

use Illuminate\Http\Request;
use Storage;

use App\Realtor;
use App\Realtor_house;
use App\House;
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;
use App\Circle;

class HomeController extends Controller
{
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

	
    
	public function index()
	{
		//$realtor = Realtor::find($this->user->id);
		//$availableHouses = House::with([$realtor->AllMyhouses])->where('available', '1');
		//var_dump($availableHouses)
		$this->myFunction->expand_realtor_houses($this->user->Allhouses);
		$this->myFunction->expand_realtor_houses($this->user->Unavailablehouses);
		$this->myFunction->expand_realtor_houses($this->user->mySharedHouses);
		$code = 200;
		$data = [
			'user'				=> $this->user,
			'unreadMessages'    => $this->unreadMessages,
			'circleMembers'     => $this->circleMembers,
			'requestsCount'     => $this->requestsCount,
			'photo_url'			=> env("APP_STORAGE").'images/houses/'
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
	}

	public function houses()
	{
		return $this->index();
	}

	public function search_realtors(Request $request)
	{
		$foundRealtors = array();
		$post = $request->all();
		$name = $post['val'];
		$result = Realtor::where('firstname', 'LIKE', '%'.$name.'%')->orWhere('lastname', 'LIKE', '%'.$name.'%')->orWhere('profile_name', 'LIKE', '%'.$name.'%')->where('visible', 1)->where('activated', 1)->get();
		if($result->count() > 0) {
			foreach($result as $key=>$realtor) {
				if($realtor->id == $this->user->id) {
					unset($result[$key]);
					continue;
				}
				$circle = 3;
				if($this->user->rship_exists($realtor->id)) {
					if($this->user->request_sent($realtor->id)) {
						$circle = 2;
					}elseif($this->user->in_circle($realtor->id)) {
						$circle = 1;
					}
				}else{
					$circle = 0;
				}
				$foundRealtors[] = array(
						"id" => $realtor->id,
						"fullname" => $realtor->name,
						"photo" => $realtor->profile_photo,
						"circle" => $circle
					);
			}
		}
		$code = 200;
		$data = [
			'foundRealtors'     		=> $foundRealtors,
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

	public function requests()
	{
		$code = 200;
		foreach($this->user->circle_requests() as $key=>$request) {
			if($request->user_two == $this->user->id) {
				$requester = $request->userOne;
			}else{
				$requester = $request->userTwo;
			}
			$request->{"requester"} = $requester;
			unset($this->user->circle_requests()->user_one);
			unset($this->user->circle_requests()->user_two);
		}
		$this->user->{"circle_requests"} = $this->user->circle_requests();
		unset($this->user->users_one);
		unset($this->user->users_two);
		$data = [
			'user'						=> $this->user,
			'unreadMessages'         	=> $this->unreadMessages,
			'circleMembers'     		=> $this->circleMembers,
			'requestsCount'       		=> $this->requestsCount,
			'sentRequests'     			=> $this->user->sent_requests(),
			'sentShareRequests'     	=> $this->user->sent_share_requests,
			'shareRequests'     		=> $this->user->share_requests
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
	}

}
