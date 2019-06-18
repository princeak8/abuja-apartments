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
	public $user;

	public function __construct()
	{
		$this->middleware('auth:api');
		$this->myFunction = new MyFunction;
		$this->user = Auth::guard('api')->user();
		$this->realtorBootstrap = new RealtorBootstrap($this->user);

		$this->realtorBootstrap->get_circle_members();
		$this->realtorBootstrap->get_all_requests_count();
	}

	
    
	public function index()
	{
		//$realtor = Realtor::find($this->user->id);
		//$availableHouses = House::with([$realtor->AllMyhouses])->where('available', '1');
		//var_dump($availableHouses)
		$messages = $this->user->unread_messages;
		
		$circleMembers = $this->realtorBootstrap->circle_members;
		$requestsCount = $this->realtorBootstrap->all_requests_count;
		$houses = Realtor_house::where('realtor_houses.realtor_id', $this->user->id)->where('realtor_houses.available', '1')->leftJoin('houses', 'realtor_houses.house_id', '=', 'houses.id')->get();
		var_dump($requestsCount);
		/*
		if(Auth::user()->type=='company') {
			return view('realtor/index_company', compact('realtor', 'houses'));
		}else{
			return view('realtor/index_agent', compact('realtor', 'houses'));
		}
		*/
	}

	public function houses()
	{
		return $this->index();
	}

	public function estates()
	{
		$realtor = Realtor::find(Auth::user()->id);
		return view('realtor/estates', compact('realtor'));
	}

	public function search_realtors(Request $request)
	{
		$loggedInRealtor = Realtor::find(Auth::user()->id);
		$realtorArray = array();
		$post = $request->all();
		$name = $post['val'];
		$result = Realtor::where('firstname', 'LIKE', '%'.$name.'%')->orWhere('lastname', 'LIKE', '%'.$name.'%')->orWhere('profile_name', 'LIKE', '%'.$name.'%')->where('visible', 1)->where('activated', 1)->get();
		if($result->count() > 0) {
			foreach($result as $key=>$realtor) {
				if($realtor->id == $loggedInRealtor->id) {
					unset($result[$key]);
					continue;
				}
				$circle = 3;
				if($loggedInRealtor->rship_exists($realtor->id)) {
					if($loggedInRealtor->request_sent($realtor->id)) {
						$circle = 2;
					}elseif($loggedInRealtor->in_circle($realtor->id)) {
						$circle = 1;
					}
				}else{
					$circle = 0;
				}
				$realtorArray[] = array(
						"id" => $realtor->id,
						"fullname" => $realtor->full_name,
						"photo" => $realtor->profile_photo,
						"circle" => $circle
					);
			}
		}
		return response()->json($realtorArray);
	}

	public function requests()
	{
		return view('realtor/requests');
	}

}
