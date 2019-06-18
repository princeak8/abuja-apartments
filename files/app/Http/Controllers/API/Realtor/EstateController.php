<?php

namespace App\Http\Controllers\API\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;
use App\Repositories\RealtorBootstrap;

use Illuminate\Http\Request;
use App\Http\Requests\EstateRequest;
use App\Http\Requests\EstateHouseRequest;
use Storage;
use File;
use Intervention\Image\ImageManager;

use App\Realtor;
use App\House;
use App\Estate;
use App\House_type;
use App\House_photo;
use App\Estate_photo;
use App\Location;
use App\Price_range;
use App\Realtor_house;

class EstateController extends Controller
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

	public function estates()
	{
		$this->myFunction->expand_estates($this->user->estates);
		$code = 200;
		$data = [
			'user'				=> $this->user,
			'unreadMessages'    => $this->unreadMessages,
			'circleMembers'     => $this->circleMembers,
			'requestsCount'     => $this->requestsCount,
			'photo_url'			=> env("APP_STORAGE").'images/estates/'
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
	}

	public function show($id)
	{
		$estate = Estate::find($id);
		if($estate) {
			$this->myFunction->expand_estate($estate);
			$code = 200;
			$data = [
				'user'				=> $this->user,
				'unreadMessages'    => $this->unreadMessages,
				'circleMembers'     => $this->circleMembers,
				'requestsCount'     => $this->requestsCount,
				'estate'     		=> $estate,
				'photo_url'			=> env("APP_STORAGE").'images/houses/'.$estate->house->id.'/'
			];
			$response = [
				'status_code' => $code,
				'data'		  => $data
			];
		}
	}

	public function add()
	{
		$locations = Location::all();
		$code = 200;
		$data = [
			'user'			=> $this->user,
			'unreadMessages'=> $this->unreadMessages,
			'circleMembers' => $this->circleMembers,
			'requestsCount' => $this->requestsCount,
			'locations'		=> $locations
		];
		$response = [
			'status_code' => $code,
			'data'		  => $data
		];
		return response()->json($response, $code);
	}

	public function save(EstateRequest $request)
	{
		$post = $request->all(); // Get all the post fields
		$estateObj = new Estate; //instantiate the house class
		//Instantiate House properties
		$estateObj->name 	  			= $post['name'];
		$estateObj->realtor_id 			= Auth::user()->id;
		$estateObj->location_id 		= $post['location_id'];
		$estateObj->water_source 		= $post['water_source'];
		$estateObj->facilities 			= $post['facilities'];
		$estateObj->description 		= $post['description'];

		if($estateObj->save()) { //if the house information has been saved
			//dd($houseObj->id);

			//Attempt to save the house photos
			$filePath = storage_path('images/estates/'.$estateObj->id.'/'); //Set the path to the full images
			$filePathThumb = storage_path('images/estates/'.$estateObj->id.'/thumbnails/'); // set the path to the thumbnail
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
					$estatePhotoObj = new Estate_photo; // instantiate the estat photo class
					//initialize house_photo properties
					$estatePhotoObj->title = $post['photo_title'][$key];
					$estatePhotoObj->estate_id = $estateObj->id;
					$estatePhotoObj->photo = $filename;
					if(!$estatePhotoObj->save()) { //if the house photo could not be saved to db
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
				'redirect'    	=> 'api/v1/realtor/estate/'.$estateObj->id
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
		}else{
			//if house information could not be saved
			$code = 500;
			$failedHouseObj = House::find($houseObj->id);
			$failedHouseObj->delete(); // delete the uploaded house information
			$data = [
				'redirect' => 'api/v1/realtor/add_house'
			];
			$response = [
				'status_code' => $code,
				'data'		  => $data,
				'message'		=> 'sorry! Saving estate information was not complete, please try again'
			];
		}
		return response()->json($response, $code);
	}

	public function add_house($id)
	{
		$estate = Estate::find($id);
		$house_types = House_type::all();
		return view('realtor/add_estate_house', compact('estate', 'house_types'));
	}

	public function save_house(EstateHouseRequest $request)
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
		$houseObj->estate_id		= $post['estate_id'];

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
			$data = [];
			$response = [
				'status_code' => $code,
				'data'		  => $data,
				'message'		=> 'sorry! House information could not be saved'
			];
		}
		return response()->json($response, $code);
	}


}
