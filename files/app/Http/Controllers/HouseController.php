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
							if($count2Check == $count2) {
								$result = $query->where($key, $value);
							}else{
								$result = $query->orWhere($key, $value);
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



	public function filter2(Request $request)
	{
		$limit = env('HOUSES_LIMIT');
		$post = $request->all();
		$house_array = array();
		//Use the switch statement to determine the string to be displayed as the filter name to the public
		switch($post['filter']) {
			case 	'house_type_id' : 
					$filter = 'House Type'; 
					break;
			case    'location_id' : 
					$filter = 'Location'; 
					break;
			case    'price_range_id' : 
					$filter = 'Price Range'; 
					break;
			// Unset the filter and title so to disable multiple filtering for the status
			case    'status' : 
					$filter = 'Status'; 
					if($request->session()->has('filters.status')) {
						$request->session()->forget('filters.status');
					}
					if($request->session()->has('filter_title.status')) {
						$request->session()->forget('filter_title.status');
					}
					break;

			case    'bedrooms' : 
					$filter = 'Bedrooms'; 
					break;
			default : 
					$filter = 'Uknown';
		}

		if($request->session()->has('estate_id')) {
			$request->session()->put('filters.estate_id.estate', $request->session()->get('estate_id'));
		}
		//dd($post['filter']);
		//If the Filter checkbox is checked
		if($post['checked'] == 1) { 
			//If the checkbox checked is not the 'All' Checkbox
			if($post['value'] != 'all') { 
					//Add the value to the filter session and trim the values to avoid white spaces
					$request->session()->put('filters.'.$post['filter'].'.'.trim($post['title']), $post['value']);
					// The filter title is for displaying what is being filtered
					$request->session()->push('filter_title.'.$filter, trim($post['title'])); 

					foreach($request->session()->get('filter_title.'.$filter) as $key=>$val) {
						if($val == 'all') { //If any of the filter values is 'all', remove it
							$request->session()->forget('filter_title.'.$filter.'.'.$key);
						}
					}
			}else{ //If the checkbox checked is the 'All' Checkbox
				if($request->session()->has('filters')) {
					//Unset the filter group, so to off filter for that group and display everything
					$request->session()->forget('filters.'.$post['filter']);
					$_SESSION['filter_title'][$filter] = array('all'); // Display 'all' as the only value displayed in the filter group
					$request->session()->put('filter_title.'.$filter, array('all'));
				}
			}
		}

		//If the Filter checkbox is not checked
		if($post['checked'] == 0) { 
			//Remove the filter item from the paramenters being filtered
			$request->session()->forget('filters.'.$post['filter'].'.'.trim($post['title']));
			$filterTitleSess = $request->session()->get('filter_title.'.$filter); 
			//dd($request->session()->get('filter_title'));
			foreach($filterTitleSess as $key=>$title) {
				if($title == trim($post['title'])) { 
					//Remove the filter item from the values displayed in the filter group
				   $request->session()->forget('filter_title.'.$filter.'.'.$key);
				}
			}
			if(empty($request->session()->get('filters.'.$post['filter']))) { 
				//If the filter group is empty, Delete that group, 
				$request->session()->forget('filters.'.$post['filter']);  // to prevent it from being used as parameter for filter
			}
		}

		$filters = $request->session()->get('filters');


		if(empty($filters)) {
			// If there are no filters set, retrieve all the houses
			$houses = House::limit($limit)->orderBy('created_at', 'desc')->get();
			$houses_count = count(House::all()->get());
			$request->session()->put('filter_title', array());
		}else{
			$filters['available'][] = 1;
			//$houses = $houseClass->filter_houses($filters, $limit); //Retrieve houses based on the filter paraeters
			$count = count($filters);
			//dd($filters);
			//$result = DB::table('houses');
			//$result = House::query();
			$result = new House();
			//dd($filters);
			foreach($filters as $filter=>$array)
			{
				$count = $count - 1;
				$count2 = count($array);
				$count2Check = $count2;
				foreach($array as $value)
				{
					if($count2Check == $count2) {
						$result = $result->where($filter, $value);
					}else{
						$result = $result->orWhere($filter, $value);
					}
					$count2 = $count2 - 1;
					
						//$filter_array[$filter] = $value;
				}
						
					//$filter_array[$filter] = $value;
			}
			//$houses = $result->orderBy('created_at', 'desc')->limit($limit)->toSql();
			
			$houses = $result->orderBy('created_at', 'desc')->limit($limit)->get();
			//dd(DB::getQueryLog());
			//dd($houses);
			$houses_count = count($result->orderBy('created_at', 'desc')->get());
			foreach($request->session()->get('filter_title') as $filter_key=>$filter_title) {
				if(empty($filter_title)) {
					$request->session()->forget('filter_title.'.$filter_key);
				}
			}
		}

		 //var_dump($houses);
		 //var_dump($_SESSION['filter_title']);
		$houses = $this->myFunction->sanitize_houses($houses);
		 $n = count($houses); //getting the number of objects in the array
		 
		header("content-Type: text/xml");

		if(empty($request->session()->get('filter_title'))) { // If there is no parmeter being filtered, clear the display string
			$house_array['title'] = array();
		}else{
			$house_array['title'] = $request->session()->get('filter_title'); //If there are parameters to be filtered, add them to the display
		}
		$house_array['displayed_houses'] = $n;
		$house_array['total_houses'] = $houses_count;

		if(empty($houses)) {
			$house_array['house'] = array();
		}else{
			
			$i = 0; //initiating my counter
			$xmlResponse = '<response>';
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
					if(count($myhouse->estate)) {
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
				$xmlResponse .= '<house>';
				/*$xmlResponse .= '<house_id>'.$myhouse->id.'</house_id>';
				$xmlResponse .= '<location>'.$myhouse->location->name.'</location>';
				$xmlResponse .= '<location_id>'.$myhouse->location_id.'</location_id>';
				$xmlResponse .= '<house_type>'.$myhouse->house_type->type.'</house_type>';
				$xmlResponse .= '<bedrooms>'.$myhouse->bedrooms.'</bedrooms>';
				$xmlResponse .= '<bathrooms>'.$myhouse->bathrooms.'</bathrooms>';
				$xmlResponse .= '<toilets>'.$myhouse->toilets.'</toilets>';
				$xmlResponse .= '<estate>'.$myEstate.'</estate>';
				$xmlResponse .= '<units>'.$myhouse->units.'</units>';*/
				$xmlResponse .= '<title>'.$myhouse->title.'</title>';
				/*$xmlResponse .= '<status>'.$myhouse->status.'</status>';
				$xmlResponse .= '<price>'.number_format($myhouse->price).'</price>';
				$xmlResponse .= '<range_id>'.$myhouse->price_range_id.'</range_id>';
				$xmlResponse .= '<house_likes>'.count($myhouse->house_likes).'</house_likes>';
				$xmlResponse .= '<comments>'.count($myhouse->house_comments).'</comments>';
				$xmlResponse .= '<photo>'.$photo.'</photo>';*/
				$xmlResponse .= '</house>';

			}
		}
		foreach($request->session()->get('filter_title') as $group=>$filters) {
			if(!empty($filters)) {
				$xmlResponse .= '<filters group="'.$group.'">';
					foreach($filters as $title) {
						$xmlResponse .= '<filter>'.$title.'</filter>';
					}
				$xmlResponse .= '</filters>';
			}
		}
		$xmlResponse .= '<displayed_houses>'.$n.'</displayed_houses>';
		$xmlResponse .= '<total_houses>'.$n.'</total_houses>';
		$xmlResponse .= '</response>';
		echo $xmlResponse;
		
	}

}
