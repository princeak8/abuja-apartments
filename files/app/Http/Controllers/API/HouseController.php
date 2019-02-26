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

class HouseController extends Controller
{
	public function __construct()
	{
		$this->myFunction = new MyFunction;
	}
    
    public function houses()
    {
    	$limit = env('HOUSES_LIMIT');
        $houses = House::limit(50)->get();
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
							
				$house_array[] = array(
					"id"=>$myhouse->id,
					"location"=>$myhouse->location->name,
					"title"=>$myhouse->title,
					"price"=>number_format($myhouse->price),
					"photo_url"=>'http://10.0.2.2/abj/files/storage/images/houses/'.$myhouse->id.'/thumbnails/'.$photo
					);
			
			}
        }
       // $house_array['status_code'] = 200;
       // $house_array['status'] = 'ok';
		//echo json_encode($house_array);
		return response()->json($house_array);
    }
	
}
