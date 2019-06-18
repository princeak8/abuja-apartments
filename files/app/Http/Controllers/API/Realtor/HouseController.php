<?php

namespace App\Http\Controllers\API\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;
use App\Repositories\RealtorBootstrap;

use Illuminate\Http\Request;
use App\Http\Requests\HouseRequest;
use Storage;
use File;
use Intervention\Image\ImageManager;

use App\Realtor;
use App\House;
use App\Realtor_house;
use App\Share_request;
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;

class HouseController extends Controller
{
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

	public function houses()
	{
		$this->myFunction->expand_realtor_houses($this->user->Allhouses);
		$this->myFunction->expand_realtor_houses($this->user->Unavailablehouses);
		$this->myFunction->expand_realtor_houses($this->user->mySharedHouses);
		$code = 200;
		$data = [
			'user'				=> $this->user,
			'unreadMessages'    => $this->unreadMessages,
			'circleMembers'     => $this->circleMembers,
			'requestsCount'     => $this->requestsCount,
			'photo_url'			=> env("APP_STORAGE").'images/houses/',
			'profilePhoto_url'	=> env("APP_STORAGE").'images/profile_photos/'
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
	}

	public function show($id)
	{
		$house = House::find($id);
		if($house) {
			$realtorHouse = Realtor_house::where('realtor_id', $this->user->id)->where('house_id', $house->id)->first();
			$this->myFunction->expand_house($house);
			$house->{"is_shared"} = $house->is_shared($this->user->id);
			$realtorHouse->{"sharer"} = $realtorHouse->sharer;
			$code = 200;
			$data = [
				'user'				=> $this->user,
				'unreadMessages'    => $this->unreadMessages,
				'circleMembers'     => $this->circleMembers,
				'requestsCount'     => $this->requestsCount,
				'house'     		=> $house,
				'realtorHouse'		=> $realtorHouse,
				'photo_url'			=> env("APP_STORAGE").'images/houses/'.$house->id.'/'
			];
			$response = [
				'status_code' => $code,
				'data'		  => $data
			];
		}else{
			$response = [
				'status_code' 	=> $code,
				'message'		=> "House was not found"
			];
		}
		return response()->json($response, $code);
	}

	public function add()
	{
		$locations = Location::all();
		$house_types = House_type::all();
		$code = 200;
		$data = [
			'user'			=> $this->user,
			'unreadMessages'=> $this->unreadMessages,
			'circleMembers' => $this->circleMembers,
			'requestsCount' => $this->requestsCount,
			'houseTypes'    => $house_types,
			'locations'		=> $locations
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
	}

	public function save(HouseRequest $request)
	{
		$post = $request->all(); // Get all the post fields
		$houseObj = new House; //instantiate the house class
		$realtorHouseObj = new Realtor_house; // instantite the realtor_house class

		//Instantiate House properties
		$houseObj->title 	  		= $post['title'];
		$houseObj->location_id 		= $post['location_id'];
		$houseObj->house_type_id 	= $post['house_type_id'];
		$houseObj->bedrooms 		= $post['bedrooms'];
		$houseObj->status 			= $post['status'];
		$houseObj->purpose 			= $post['purpose'];
		$houseObj->price 			= $post['price'];

		if($houseObj->save()) { //if the house information has been saved
			//dd($houseObj->id);
			//Instantiate Realtor_house properties
			$realtorHouseObj->realtor_id = Auth::user()->id;
			$realtorHouseObj->house_id = $houseObj->id;
			if($realtorHouseObj->save()) {

				//Attempt to save the house photos
				$t = str_replace(' ', '_', $houseObj->title);
				$filePath = storage_path('images/houses/'.$houseObj->id.'/'); //Set the path to the full images
				$filePathThumb = storage_path('images/houses/'.$houseObj->id.'/thumbnails/'); // set the path to the thumbnail
				//dd($filePath);
				if(!is_dir($filePath)) { //if the full images file does not exist
					File::makeDirectory($filePath, 0777); // create full images file with the required permission
				}
				if(!is_dir($filePathThumb)) { //if the thumbnail file does not exist
					File::makeDirectory($filePathThumb, 0777); // create thumbnail file with the required permission
				}
				//loop through all the photos and save them in file
				foreach ($request->file('photo') as $key=>$photoInput) {
					$Intervention_img = new ImageManager(); //make an instance of the Image manager Class
					$original_name = $photoInput->getClientOriginalName(); //get the name of the photo
					$filename = time() . '-'.$original_name; //create a unique name for the photo
					$img = $Intervention_img->make($photoInput->getRealPath());//re-create the image using the Image manager object
					
					if($img->save($filePath.$filename, 80)) { //Save the full image
						$img->resize(250, null, function ($constraint){
							$constraint->aspectRatio();
						})->save($filePathThumb.$filename); //resize and save the thumbnail
						//Save the photo informations in an array
						$photos[] = array(
							'filename' => $filename,
							'title' => $post['photo_title'][$key]
						);
						//$errors[$n] = '';
						$housePhotoObj = new House_photo; // instantiate the house photo class
						//initialize house_photo properties
						$housePhotoObj->title = $post['photo_title'][$key];
						$housePhotoObj->house_id = $houseObj->id;
						$housePhotoObj->photo = $filename;
						if(!$housePhotoObj->save()) { //if the house photo could not be saved to db
							unlink($filePath.$filename); // delete the full image
							unlink($filePathThumb.$filename); //delete the thumbnail
							$errors[] = $photoInput->originalName.' Image information could not be saved to database';
						}
					}else{
						$errors[] = $photoInput->originalName.' Image could not be uploaded';
					}
				}
				$code = 200;
				$data = [
					'user'			=> $this->user,
					'unreadMessages'=> $this->unreadMessages,
					'circleMembers' => $this->circleMembers,
					'requestsCount' => $this->requestsCount,
					'redirect'    	=> 'api/v1/realtor/house/'.$houseObj->id
				];
				if(!empty($errors)) {
					$errorText = '';
					foreach($errors as $error) {
						$errorText .= $error.'<br/>';
					}
					$data['error'] = $errorText;
				}
				$response = [
					'status_code' => $code,
					'data'		  => $data
				];
			}else{ //realtor_house could not be saved
				$code = 500;
				$failedHouseObj = House::find($houseObj->id);
				$failedHouseObj->delete(); // delete the uploaded house information
				$data = [];
				$response = [
					'status_code' => $code,
					'data'		  => $data,
					'message'		=> 'sorry! Saving house information was not complete, please try again'
				];
			}
		}else{
			//if house information could not be saved
			$code = 500;
			$data = [
				'redirect' => 'api/v1/realtor/add_house'
			];
			$response = [
				'status_code' => $code,
				'data'		  => $data,
				'message'		=> 'sorry! House information could not be saved'
			];
		}
		
		return response()->json($response, $code);
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
		$code = 200;
		$data = [
			'house'			=> $house,
			'mainPhoto'		=> $mainPhoto,
			'user'			=> $this->user,
			'unreadMessages'=> $this->unreadMessages,
			'circleMembers' => $this->circleMembers,
			'requestsCount' => $this->requestsCount
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
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
			$shareRequest = new Share_request;
			$shareRequest->house_id = $house_id;
			$shared_id->realtor_id = $realtor_id;
			$shareRequest->sharer_id = $sharer_id;
			if($shareRequest->save()) {
				$success[] = $realtor_id;
			}else{
				$errors[] = $realtor_id;
			}
		}
		if(empty($errors)) {
			request()->session()->flash('success', 'House Shared successfully');
			$message = 'House Shared successfully';
		}else{
			$message = '';
			foreach($errors as $key=>$id) {
				$errors[$key] = $realtor = Realtor::find($id)->profile_name;
				$message .= "House not shared with ".$realtor;
			}
		}
		$code = 200;
		$data = [
			'redirect' => 'api/v1/realtor/share_house/'.$house_id
		];
		$response = [
			'status_code' 	=> $code,
			'data'			=> $data,
			'message'		=> $message
		];
		return response()->json($response, $code);
	}

	public function process_share_request(Request $request)
	{
		$post = $request->all();
		$request_id = $post['request_id'];
		$action = $post['action'];
		$shareRequest = Share_request::find($request_id);
		if(!empty($shareRequest)) {
			if($action == 1) { 
				$realtorHouseObj = new Realtor_house;
				$shared_id = $shareRequest->shared_id;
				$sharer_id = $shareRequest->sharer_id;
				$house_id = $shareRequest->house_id;
				$realtorHouse = Realtor_house::where('realtor_id', $sharer_id)->where('house_id', $house_id)->where('shared', '0')->first();
				$realtorHouseObj->realtor_id = $shared_id; // the realtor the house is being shared with
				$realtorHouseObj->house_id = $house_id;
				$realtorHouseObj->sharer_id = $sharer_id;
				$realtorHouseObj->shared = 1;
				if($realtorHouseObj->save()) {
					$realtorHouse->shared_with = $realtorHouse->shared_with + 1;
					$realtorHouse->save();
					$shareRequest->delete();
					$message = 'House Share request accepted Successfully';
					$code = 200;
				}else{
					$message = 'sorry, there was an error while trying to accept request';
					$code = 500;
				}
			}else{
				$ShareRequest->status = -1; //if the request was declined, update the status of the request
				$shareRequest->save();
				$code = 200;
				$message = 'House Share request Declined';
			}
		}
		$response = [
			'status_code' 	=> $code,
			'data'			=> [],
			'message'		=> $message
		];
		return response()->json($response, $code);
	}

	public function change_house_availability(Request $request)
	{
		$post = $request->all();
		$house_id = $post['house_id'];
		$available = $post['available'];
		$realtorHouse = Realtor_House::where('realtor_id', Auth::user()->id)->where('house_id', $house_id)->where('shared', '0')->first();
		$realtor_houses = Realtor_house::where('house_id', $house_id)->get();

		foreach($realtor_houses as $house) {
			$house->available = $available;
			$house->save();
		}
		$code = 200;
		$response = [
			'status_code' 	=> $code,
			'data'			=> [],
			'message'		=> $message
		];
		return response()->json($response, $code);
	}

	public function edit($id)
	{
		$house = House::find($id);
		$locations = Location::all();
		$house_types = House_type::all();
		$code = 200;
		$data = [
			'house'			=> $house,
			'houseTypes'    => $house_types,
			'locations'		=> $locations,
			'user'			=> $this->user,
			'unreadMessages'=> $this->unreadMessages,
			'circleMembers' => $this->circleMembers,
			'requestsCount' => $this->requestsCount
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
	}

	public function update(HouseRequest $request)
	{
		$post = $request->all(); // Get all the post fields
		$house_id = $post['house_id'];
		$houseObj = House::find($house_id); //instantiate the house class

		//Instantiate House properties
		$houseObj->title 	  		= $post['title'];
		if($houseObj->estate_id==0){
			$houseObj->location_id 		= $post['location_id'];
		}
		$houseObj->house_type_id 		= $post['house_type_id'];
		$houseObj->rooms 				= $post['rooms'];
		$houseObj->bedrooms 			= $post['bedrooms'];
		$houseObj->bathrooms 			= $post['bathrooms'];
		$houseObj->toilets 				= $post['toilets'];
		$houseObj->status 				= $post['status'];
		$houseObj->purpose 				= $post['purpose'];
		$houseObj->price 				= $post['price'];
		$houseObj->agent_fee 			= $post['agent_fee'];
		$houseObj->service_charge 		= $post['service_charge'];
		$houseObj->water_source 		= $post['water_source'];
		$houseObj->facilities 			= $post['facilities'];
		$houseObj->description 			= $post['description'];
		if($houseObj->status=='sale') {
			$houseObj->sale_plan 			= $post['sale_plan'];
		}

		if($houseObj->save()) { //if the house information has been saved
			$message = 'House information saved successfully';
		}else{
			//if house information could not be saved
			$message = 'sorry! House information could not be saved';
		}
		$response = [
			'status_code' 	=> $code,
			'message'		=> $message,
			'data'		  	=> []
		];
		return response()->json($response, $code);
	}

	public function delete($id)
	{
		$houseObj = House::find($id);
		if(!empty($houseObj)) {
			if($houseObj->delete()){
				$filePath = storage_path('images/houses/'.$id.'/');
				$this->myFunction->delete_folder($filePath);
				$code = 200;
				$response = [
					'status_code' 	=> $code,
					'data'		  	=> []
				];
			}else{
				$code = 500;
				$response = [
					'status_code' 	=> $code,
					'message'		=> 'House Could not be deleted'
				];
			}
		}else{
			$code = 404;
			$response = [
				'status_code' 	=> $code,
				'message'		=> 'House was not found'
			];
		}
		return response()->json($response, $code);
	}

}
