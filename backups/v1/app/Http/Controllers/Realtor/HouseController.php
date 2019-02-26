<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use App\Http\Requests\ShareRequest;
use Storage;

use App\Realtor;
use App\House;
use App\Realtor_house;
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;

class HouseController extends Controller
{
	public function __construct()
	{
		$this->middleware('realtorAuth');
		$this->myFunction = new MyFunction;
	}

	public function houses()
	{
		$realtor = Realtor::find(Auth::user()->id);
		//$availableHouses = House::with([$realtor->AllMyhouses])->where('available', '1');
		//var_dump($availableHouses)
		$requests = $realtor->sent_share_requests->count() + $realtor->share_requests->count() + $realtor->sent_requests->count() + $realtor->circle_requests->count();
		if(Auth::user()->type=='company') {
			return view('realtor/index_company', compact('realtor'));
		}else{
			return view('realtor/index_agent', compact('realtor'));
		}
	}

	public function show($id)
	{
		$realtor = Realtor::find(Auth::user()->id);
		$house = House::find($id);
		if($house) {
			$realtorHouse = Realtor_house::where('realtor_id', $realtor->id)->where('house_id', $house->id)->first();
			return view('realtor/house', compact('realtor', 'house', 'realtorHouse'));
		}else{
			abort(404, 'House Not found');
		}
	}

	public function share($id)
	{
		$house = House::find($id);
		$realtor = Realtor::find(Auth::user()->id);
		if(House_photo::GetMainPhoto($id)->count()) {
			$mainPhoto = House_photo::GetMainPhoto($id)->first();
		}else{
			$mainPhoto = House_photo::where('house_id', $id)->first();
		}
		return view('realtor/share_house', compact('house', 'mainPhoto', 'realtor'));
	}

	public function share_house(ShareRequest $request)
	{
		$post = $request->all();
		$realtors = $post['share']; //this is an array of realtor id that you want to shre the house with
		$house_id = $post['house_id'];
		$sharer_id = $post['sharer_id'];
		$success = array();
		$errors = array();
		foreach($realtors as $realtor_id) {
			$realtorHouse = new Realtor_house;
			$realtorHouse->house_id = $house_id;
			$realtorHouse->realtor_id = $realtor_id;
			$realtorHouse->sharer_id = $sharer_id;
			if($realtorHouse->save()) {
				$success[] = $realtor_id;
			}else{
				$errors[] = $realtor_id;
			}
		}
		if(empty($errors)) {
			request()->session()->flash('success', 'House Shared successfully Successfully');
		}else{
			foreach($errors as $key=>$id) {
				$errors[$key] = Realtor::find($id)->biz_name;
			}
			request()->session()->flash('error', $errors);
		}
		return back();
	}

	public function change_house_availability(Request $request)
	{
		$post = $request->all();
		$house_id = $post['house_id'];
		$available = $post['available'];
		$houseObj = House::find($house_id);

		$houseObj->available = $available;
		if($houseObj->save()) { 
			echo 1;
		}
	}

}
