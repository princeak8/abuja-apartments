<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;

use Storage;

use App\Realtor;
use App\Realtor_house;
use App\House;
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;
use App\Follower;

class RealtorController extends Controller
{
	public function __construct()
	{
		$this->myFunction = new MyFunction;
		$this->user = Auth::guard('api')->user();
	}
    
    public function realtor($profile_name)
    {
    	$limit = env('HOUSES_LIMIT');
    	$house_types = House_type::all();
		$locations = Location::all();
		$price_ranges = Price_range::all();
		$realtor = Realtor::where('profile_name', $profile_name)->where('activated', '1')->first();
		if($realtor) { //If the realtor is found
			$realtor_houses = Realtor_house::where('realtor_id', $realtor->id)->limit($limit)->get();
			$allRealtor_houses = Realtor_house::where('realtor_id', $realtor->id)->get();
			$link = $profile_name;
			$encode_link = urlencode($link);
			$data = [
				'realtor'			=> $realtor,
				'realtor_houses' 	=> $realtor_houses,
				'allRealtor_houses' => $allRealtor_houses,
				'house_types' 		=> $house_types,
				'locations' 		=> $locations,
				'price_ranges' 		=> $price_ranges,
				'limit' 			=> $limit,
				'encode_link'		=> $encode_link
			];
			$response = [
				'status_code' => 200,
				'data'		  => $data
			];
			return response()->json($response, 200);
		}else{
			$response = [
				'status_code' => 404,
				'message'	  => 'House was not found'
			];
			return response()->json($response, 404);
		}
    }

    public function follow(Request $request)
    {
    	$post = $request->all();
    	$followerObj = new Follower;
    	$followerObj->follower_id = $post['follower'];
		$followerObj->realtor_id = $post['followed'];
		if($followerObj->save()) {
			$data = [];
			$code = 200;
			$response = [
				'status_code' => $code,
				'data'		  => $data
			];
		}else{
			$code = 500;
			$response = [
				'status_code' => $code,
				'message'	  => 'Change could not be saved'
			];
		}

		return response()->json($response, $code);
    }

    public function unfollow(Request $request)
    {
    	$post = $request->all();
    	$follow_id = $post['follow_id'];
		$followerObj = Follower::find($follow_id);
		if(!empty($followerObj)) {
			if($followerObj->delete()) {
				$data = [];
				$code = 200;
				$response = [
					'status_code' => $code,
					'data'		  => $data
				];
			}else{
				$code = 500;
				$response = [
					'status_code' => $code,
					'message'	  => 'Change could not be saved'
				];
			}
		}else{
			$code = 404;
			$response = [
				'status_code' => $code,
				'message'	  => 'Follower instance was not found'
			];
		}
		return response()->json($response, $code);
	}

	private function search_query($loggedIn, $searchValue)
	{
		if($loggedIn) {
			$result = Realtor::where('firstname', 'LIKE', $searchValue)
						->orWhere('lastname', 'LIKE', $searchValue)
						->orWhere('profile_name', 'LIKE', $searchValue)
						->where('id', '!=', $this->user->id)
						->where('activated', 1)->where('visible', 1)
						->get();
		}else{
			$result = Realtor::where('firstname', 'LIKE', $searchValue)
						->orWhere('lastname', 'LIKE', $searchValue)
						->orWhere('profile_name', 'LIKE', $searchValue)
						->where('activated', 1)->where('visible', 1)
						->get();
		}
		return $result;
	}
	
	public function search(Request $request)
	{
		$post = $request->all();
		$searchValue = $post['search_realtor'];
		$realtors = array();
		
		$result = ($this->user) ? $this->search_query(true, $searchValue) : $this->search_query(false, $searchValue);
		//dd($result->count());
		if($result) {
			$code = 200;
			if($result->count() > 0) {
				foreach($result as $realtor) {
					$realtors[] = [
						'id' => $realtor->id,
						'name' => $realtor->name,
						'photo'	=> $realtor->profile_photo
					];
				}
				$data = $realtors;
				$message = '';
			}else{
				$message = 'No realtor with the name or profile name of '.$searchValue.' was found';
				$data = [];
			}
		}else{
			$code = 500;
			$message = 'sorry! A problem occured, contact the administrator';
			$data = [];
		}
		$response = [
			'status_code' => $code,
			'data'		  => $data,
			'message' => $message
		];
		return response()->json($response, $code);
	}

	public function search_mobile(Request $request)
	{
		$post = $request->all();
		$searchValue = $post['search_realtor'];
		$result = Realtor::where('firstname', 'LIKE', $searchValue)
					->orWhere('lastname', 'LIKE', $searchValue)
					->orWhere('profile_name', 'LIKE', $searchValue)
					->where('activated', 1)->where('visible', 1)
					->get();
		//dd($result->count());
		if($result->count() == 1)
		if($result->count() > 0) {
			if($result->count() == 1 && Auth::user()) {
				if($result[0]->id == Auth::user()->id) {
					$code = 404;
					$data = [];
					$response = [
						'status_code' => $code,
						'data'		  => $data,
						'message'		=> 'Search for a realtor other than the logged in Realtor'
					];
				}
				foreach($result as $realtor) {
					if($realtor->id == Auth::user()->id){
						$code = 500;
						$response = [
							'status_code' => $code,
							'message'	  => 'Search for a realtor other than the logged in Realtor'
						];
						exit();
					}
				}
			}
			return view('realtor_search_result', compact('result', 'searchValue'));
		}else{
			request()->session()->flash('status', 'error');
			request()->session()->flash('msg', 'No realtor with the name or profile name of '.$searchValue.' was found');
			return back();
		}
	}
	
}
