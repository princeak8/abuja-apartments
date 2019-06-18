<?php

namespace App\Http\Controllers;

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
			return view('realtor', compact('realtor', 'encode_link', 'house_types', 'locations', 'price_ranges', 'limit', 'realtor_houses', 'allRealtor_houses'));
		}else{
			abort(404, 'House Not found');
		}
    }

    public function follow(Request $request)
    {
    	$post = $request->all();
    	$followerObj = new Follower;
    	$followerObj->follower_id = $post['follower'];
		$followerObj->realtor_id = $post['followed'];
		$followerObj->save();
		if(isset($_SERVER['HTTP_REFERER'])) {
			$redirect = $_SERVER['HTTP_REFERER'];
		}else{
			$redirect = 'index';
		}
		return redirect($redirect);
    }

    public function unfollow(Request $request)
    {
    	$post = $request->all();
    	$follow_id = $post['follow_id'];
		$followerObj = Follower::find($follow_id);
		if(!empty($followerObj)) {
			$followerObj->delete();
		}
		if(isset($_SERVER['HTTP_REFERER'])) {
			$redirect = $_SERVER['HTTP_REFERER'];
		}else{
			$redirect = 'index';
		}
		return redirect($redirect);
	}
	
	public function search(Request $request)
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
				foreach($result as $realtor) {
					if($realtor->id == Auth::user()->id){
						request()->session()->flash('status', 'error');
						request()->session()->flash('msg', 'Search for a realtor other than the logged in Realtor');
						return back();
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
