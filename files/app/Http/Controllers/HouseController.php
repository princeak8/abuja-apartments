<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use Storage;

use App\House;
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;

class HouseController extends Controller
{
	public function __construct()
	{
		$this->myFunction = new MyFunction;
		//DB::enableQueryLog();
	}

	public function house($id)
	{
		$house = House::where('id', $id)->where('available', '1')->first();
		if($house) {
			$similar_houses = House::where('bedrooms', $house->bedrooms)->where('status', $house->status)->where('available', '1')->get();
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
			return view('house', compact('house', 'encode_link', 'similar_houses'));
		}else{
			abort(404, 'House Not found');
		}
	}
    
	public function load_houses(Request $request)
	{
		$limit = env('HOUSES_LIMIT');
		$post = $request->all();
		$offset = $post['displayed'];
		$house_array = array();

		if($request->session()->has('filters')) {

			//If we are dealing with houses within an estate, Add the criterea to the filter
			if($request->session()->has('estate_id')) {
				//$_SESSION['filters']['estate_id']['estate'] = $_SESSION['estate_id'];
				$request->session()->put('filters.estate_id.estate', $request->session()->get('estate_id'));
			}
			
			$filters = $request->session()->get('filters');
			
			
			if(empty($filters)) { 
				$houses = House::limit($limit)->offset($offset)->get(); // If there are no filters set, retrieve all the houses
			}else{
				$filters['available'][] = 1;
				//$houses = $houseClass->filter_houses($filters, $limit, true, $offset); 
				//Retrieve houses based on the filter paraeters
				$count = count($filters);
				$result = new House();
					foreach($filters as $filter=>$array)
					{
						$count = $count - 1;
						$count2 = count($array);
						$count2Check = $count2;
						foreach($array as $value)
						{
							if($count2Check == $count2) {
								$result= $result->where($filter, $value);
							}
							$count2 = $count2 - 1;
							if($count2>=1) {
								$result = $result->orWhere($filter, $value);
							}else{
								$result = $result->orWhere($filter, $value);
							}
							//$filter_array[$filter] = $value;
						}
						
						//$filter_array[$filter] = $value;
					}
				$houses = $result->orderBy('created_at', 'desc')->limit($limit)->offset($offset)->get();
			}

		}// End of if(SESSION filter exists)
		else{
			$houses = House::limit($limit)->offset($offset)->orderBy('created_at', 'desc')->get();
		}

		$houses = $this->myFunction->sanitize_houses($houses);

		$n = count($houses); //getting the number of objects in the array
		$house_array['total_houses'] = $n;
		 
		header("content-Type: application/json");



		if(empty($houses)) {
			$house_array['house'] = array();
		}else{
			$i = 0; //initiating my counter
			foreach($houses as $myhouse) { //Loop through the houses and add more informations
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
					if(count($myhouse->estate)) {
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
		echo json_encode($house_array);
	}
	

}
