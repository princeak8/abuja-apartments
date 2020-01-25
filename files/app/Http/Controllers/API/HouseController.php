<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;

use Storage;
use DB;

use App\Realtor;
use App\Realtor_house;
use App\House;
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;
use App\Follower;

class HouseController extends Controller
{
	public function __construct()
	{
		$this->myFunction = new MyFunction;
	}

	public function house($id)
	{
		$house = House::where('id', $id)->where('available', '1')->first();
		if($house) {
			$similar_houses = House::where('bedrooms', $house->bedrooms)->where('status', $house->status)->where('available', '1')->get();
			$house_photos = House_photo::where('house_id', $house->id);
			if($similar_houses->count() > 0) {
				foreach($similar_houses as $key=>$similar_house) {
					if($similar_house->id==$id) {
						unset($similar_houses[$key]);
						break;
					}
				}
			} 
			$link = 'house/'.$id;
			$encode_link = urlencode($link);
			$data = [
				'encode_link' => $encode_link,
				'house' => $house,
				'similar_houses' => $similar_houses
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
    
    public function houses($page=1)
    {
		$limit = env('APP_HOUSES_LIMIT');
		$offset = ($page - 1) * $limit;
        $houses = House::limit($limit)->offset($offset)->get();
        $houses = $this->myFunction->sanitize_houses($houses);
        
        //header("content-Type: application/json");

        if(empty($houses)) {
			$house_array = array();
		}else{
			$i = 0; //initiating my counter
            foreach($houses as $myhouse) { //Loop through the houses and add more informations
               //dd($myhouse);
               
				$i++; // incrementing my counter
				if(House_photo::GetMainPhoto($myhouse->id)->count()) {
					$main_photo = House_photo::GetMainPhoto($myhouse->id)->first();
				}elseif(House_photo::GetHousePhotos($myhouse->id)->count()){
					$main_photo = House_photo::GetHousePhotos($myhouse->id)->first();
				}else{
					$main_photo = '';
				}
				//$main_photo = $photoClass->main_photo($myhouse->house_id, 'house');
				$house_photos = array();
				if(count($myhouse->house_photos) > 0) {
					foreach($myhouse->house_photos as $house_photo) {
						$house_photos[] = env("APP_STORAGE").'images/houses/'.$myhouse->id.'/thumbnails/'.$house_photo->photo;
					}
				}else{
					$house_photos[] = env("APP_STORAGE").'images/no_image.png';
				}
				if($myhouse->estate_id > 0) { 
					if($myhouse->estate) {
						$myEstate = $myhouse->estate->name;
					}else{
						$myEstate = '';
					}
				}else{
					$myEstate = '';
				}
				
				if(empty($main_photo) || empty($main_photo->photo)) { 
					$photo = "no_img.png";
				}else{ 
					$photo = $main_photo->photo;
				}
							
				$house_array[] = array(
					"id"=>$myhouse->id,
					"location"=>$myhouse->location->name,
					"title"=>$myhouse->title,
					"status"=>$myhouse->status,
					"price"=>number_format($myhouse->price),
					"photo_url"=>env("APP_API_STORAGE").'images/houses/'.$myhouse->id.'/thumbnails/'.$photo,
					"bedrooms"=>$myhouse->bedrooms,
					"bathrooms"=>$myhouse->bathrooms,
					"toilets"=>$myhouse->toilets,
					"house_photos"=>$house_photos,
					"description"=>strip_tags($myhouse->description),
					);
				if(!empty($myhouse->service_charge)) {
					$service_charge = (int)$myhouse->service_charge;
					$house_array[$i]["service_charge"] = number_format($service_charge);
				}else{
					$house_array[$i]["service_charge"] = $myhouse->service_charge;
				}
				if(!empty($myhouse->agent_fee)) {
					$agent_fee = (int)$myhouse->agent_fee;
					$house_array[$i]["agent_fee"] = number_format($agent_fee);
				}else{
					$house_array[$i]["agent_fee"] = $myhouse->agent_fee;
				}

				if($myhouse->estate_id > 0) { 
						$house_array[$i]["estate"] = $myEstate;
				}
			}
        }
       // $house_array['status_code'] = 200;
       // $house_array['status'] = 'ok';
		//echo json_encode($house_array);
		return response()->json($house_array);
	}
	
	public function filter(Request $request)
	{
		$limit = env('HOUSES_LIMIT');
		$post = $request->all();
		$house_array = array();

		$filters = $post['filters'];

		//dd($filters);
		if(empty($filters)) {
			// If there are no filters set, retrieve all the houses
			$houses = House::limit($limit)->orderBy('created_at', 'desc')->get();
			$houses_count = count(House::all());
			$request->session()->put('filter_title', array());
		}else{
			$filters['available'] = 1;
			//$houses = $houseClass->filter_houses($filters, $limit); //Retrieve houses based on the filter paraeters
			$count = count($filters);
			//dd($filters);
			//$result = DB::table('houses');
			//$result = House::query();
			DB::enableQueryLog();
			$result = new House;
			foreach($filters as $key=>$filter)
			{
				if(!is_array($filter)) {
					if($filter != 'all') {
						$result = $result->where($key, $filter);
					}
				}else{
					$count = $count - 1;
					$count2 = count($filter);
					$count2Check = $count2;
					//dd($filter);
					$result = $result->where(function ($query) use($filter, $key, $count2, $result, $count2Check) {
						// Everything within this closure will be grouped together
						//dd($filter);
						foreach($filter as $value) {
							if($value != 'all') {
								if($count2Check == $count2) {
									$result = $query->where($key, $value);
								}else{
									$result = $query->orWhere($key, $value);
								}
							}
							$count2 = $count2 - 1;
						}
					});
				}		
					//$filter_array[$filter] = $value;
			}
			//$houses = $result->orderBy('created_at', 'desc')->limit($limit)->toSql();
			$houses_count = count($result->get());
			$houses = $result->orderBy('created_at', 'desc')->limit($limit)->get();
			//dd(DB::getQueryLog());
		}

		 //var_dump($houses);
		 //var_dump($_SESSION['filter_title']);
		$houses = $this->myFunction->sanitize_houses($houses);
		 $n = count($houses); //getting the number of objects in the array
		 
		//header("content-Type: application/json");
		$house_array['displayed_houses'] = $n;
		$house_array['total_houses'] = $houses_count;

		if(empty($houses)) {
			$house_array['house'] = array();
		}else{
			$i = 0; //initiating my counter
			foreach($houses as $mykey=>$myhouse) { //Loop through the houses and add more informations
				
				//echo $myhouse->location->name.'<br/>';
				$i++; // incrementing my counter
				if(House_photo::GetMainPhoto($myhouse->id)->count()) {
					$main_photo = House_photo::GetMainPhoto($myhouse->id)->first();
				}elseif(House_photo::GetHousePhotos($myhouse->id)->count()){
					$main_photo = House_photo::GetHousePhotos($myhouse->id)->first();
				}else{
					$main_photo = '';
				}
				//$main_photo = $photoClass->main_photo($myhouse->house_id, 'house');
				if($myhouse->estate_id > 0) { 
					if(is_object($myhouse->estate)) {
						$myEstate = $myhouse->estate->name;
					}else{
						$myEstate = '';
					}
				}else{
					$myEstate = '';
				}
					
				if(empty($main_photo) || empty($main_photo->photo)) { 
					$photo = env('APP_STORAGE')."images/no_image.png";
				}else{ 
					$photo = env('APP_STORAGE')."images/houses/".$myhouse->id."/thumbnails/".$main_photo->photo;
				}
							
				$house_array['house'][] = array(
					"house_id"=>$myhouse->id,
					"estate_id"=>$myhouse->estate_id,
					"location"=>$myhouse->location->name,
					"location_id"=>$myhouse->location_id,
					"house_type"=>$myhouse->house_type->type,
					"bedrooms"=>$myhouse->bedrooms,
					"bathrooms"=>$myhouse->bathrooms,
					"toilets"=>$myhouse->toilets,
					"estate"=>$myEstate,
					"units"=>$myhouse->units,
					"title"=>$myhouse->title,
					"status"=>$myhouse->status,
					"price"=>number_format($myhouse->price),
					"range_id"=>$myhouse->price_range_id,
					"house_likes"=>count($myhouse->house_likes),
					"comments"=>count($myhouse->house_comments),
					"photo"=>$photo
				);
			}
		}
		return response()->json($house_array);
		//echo json_encode($house_array);
		
	}
	
}
