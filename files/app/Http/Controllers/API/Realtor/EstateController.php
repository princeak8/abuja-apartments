<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

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
		$this->middleware('realtorAuth');
		$this->myFunction = new MyFunction;
	}

	public function estates()
	{
		$estateObj = new estate;

		$realtor = Realtor::find(Auth::user()->id);
		return view('realtor/estates', compact('realtor'));
	}

	public function show($id)
	{
		$realtor = Realtor::find(Auth::user()->id);
		$estate = Estate::find($id);
		$locations = Location::all();
		$house_types = House_type::all();
		return view('realtor/estate', compact('estate', 'realtor', 'locations', 'house_types'));
	}

	public function add()
	{
		$locations = Location::all();
		return view('realtor/add_estate', compact('locations'));
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
			if(!empty($errors)) {
				$errorText = '';
				foreach($errors as $error) {
					$errorText .= $error.'<br/>';
				}
				request()->session()->flash('error', $errorText);
			}
			return redirect('realtor/estate/'.$estateObj->id); //Redirect to view the saved house
		}else{
			//if house information could not be saved
			request()->session()->flash('error', 'sorry! House information could not be saved');
			return back();
		}
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
				if(!empty($errors)) {
					$errorText = '';
					foreach($errors as $error) {
						$errorText .= $error.'<br/>';
					}
					request()->session()->flash('error', $errorText);
				}
				return redirect('realtor/house/'.$houseObj->id); //Redirect to view the saved house
			}else{ //realtor_house could not be saved
				$failedHouseObj = House::find($houseObj->id);
				$failedHouseObj->delete(); // delete the uploaded house information
				request()->session()->flash('error', 'sorry! Saving house information was not complete, please try again');
				return back();
			}
		}else{
			//if house information could not be saved
			request()->session()->flash('error', 'sorry! House information could not be saved');
			return back();
		}
	}


}
