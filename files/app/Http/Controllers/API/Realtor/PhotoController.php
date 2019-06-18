<?php

namespace App\Http\Controllers\API\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;
use App\Repositories\RealtorBootstrap;

use Illuminate\Http\Request;
use Storage;
use App\Http\Requests\PhotoRequest;
use File;
use Intervention\Image\ImageManager;

use App\Realtor;
use App\House;
use App\Estate;
use App\House_photo;
use App\Estate_photo;

class PhotoController extends Controller
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

	public function change_house_main_photo(Request $request)
	{
		$post = $request->all();
		$photo_id = $post['photo_id'];
		$house_id = $post['house_id'];
		$housePhotoObj = House_photo::find($photo_id);
		if(House_photo::GetMainPhoto($house_id)->count()) {
			$mainPhoto = House_photo::GetMainPhoto($house_id)->first();
		}
		$housePhotoObj->main = 1;
		if($housePhotoObj->save() && $housePhotoObj->id != $mainPhoto->id) { 
			$mainPhoto->main = 0;
			$mainPhoto->save();
			$code = 200;
			$message = 'House main photo changed';
		}else{
			$code = 500;
			$message = 'House Photo could not be updated';
		}
		$response = [
			'status_code' => $code,
			'message'	  => $message,
			'data'		  => []
		];
		return response()->json($response, $code);
	}

	public function save_house_photo(PhotoRequest $request)
	{
		$post = $request->all(); // Get all the post fields
		$house_id = $post['house_id'];

		$filePath = storage_path('images/houses/'.$house_id.'/'); //Set the path to the full images
		$filePathThumb = storage_path('images/houses/'.$house_id.'/thumbnails/'); // set the path to the thumbnail
				//dd($filePath);
		if(!is_dir($filePath)) { //if the full images file does not exist
			File::makeDirectory($filePath, 0777); // create full images file with the required permission
		}
		if(!is_dir($filePathThumb)) { //if the thumbnail file does not exist
			File::makeDirectory($filePathThumb, 0777); // create thumbnail file with the required permission
		}

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
				//dd('yes');
				$housePhotoObj = new House_photo; // instantiate the house photo class
				//initialize house_photo properties
				$housePhotoObj->title = $post['photo_title'][$key];
				$housePhotoObj->house_id = $house_id;
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
		$message = 'photo Added Successfully';
		$code = 200;
		if(!empty($errors)) {
			$errorText = '';
			foreach($errors as $error) {
				$errorText .= $error.'<br/>';
			}
			request()->session()->flash('add-photo-error', $errorText);
			$code = 500;
			$message = $errorText;
		}
		$response = [
			'status_code' => $code,
			'message'	  => $message,
			'data'		  => []
		];
		return response()->json($response, $code);
	}

	public function update_house_photo(Request $request)
	{
		$post = $request->all(); // Get all the post fields
		$photo_id = $post['photo_id'];
		$photoObj = House_photo::find($photo_id);

		$filePath = storage_path('images/houses/'.$photoObj->house_id.'/'); //Set the path to the full images
		$filePathThumb = storage_path('images/houses/'.$photoObj->house_id.'/thumbnails/'); // set the path to the thumbnail
				//dd($filePath);
		if(!is_dir($filePath)) { //if the full images file does not exist
			File::makeDirectory($filePath, 0777); // create full images file with the required permission
		}
		if(!is_dir($filePathThumb)) { //if the thumbnail file does not exist
			File::makeDirectory($filePathThumb, 0777); // create thumbnail file with the required permission
		}

		if(!empty($request->file('photo'))) {
			$Intervention_img = new ImageManager(); //make an instance of the Image manager Class
			$original_name = $request->file('photo')->getClientOriginalName(); //get the name of the photo
			$filename = time() . '-'.$original_name; //create a unique name for the photo
			$img = $Intervention_img->make($request->file('photo')->getRealPath());//re-create the image using the Image manager object
					
			if($img->save($filePath.$filename, 80)) { //Save the full image 
				$img->resize(250, null, function ($constraint){
					$constraint->aspectRatio();
				})->save($filePathThumb.$filename); //resize and save the thumbnail
				//delete previous images
				unlink($filePath.$photoObj->photo); // delete the full image
				unlink($filePathThumb.$photoObj->photo); //delete the thumbnail

				//initialize house_photo properties
				$photoObj->photo = $filename;
			}
		}
		$code = 200;
		$message = 'Photo updated';
		$photoObj->title = $post['photo_title'];
		if($photoObj->save()) {
			$code = 500;
			$message = 'Photo could not be edited';
		}
		$response = [
			'status_code' => $code,
			'message'	  => $message,
			'data'		  => []
		];
		return response()->json($response, $code);
	}

	public function delete_house_photo(Request $request)
	{
		$post = $request->all(); // Get all the post fields
		$photoObj = House_photo::find($post['photo_id']);
		$photo = $photoObj->photo;
		$filePath = storage_path('images/houses/'.$photoObj->house_id.'/'); 
		$filePathThumb = storage_path('images/houses/'.$photoObj->house_id.'/thumbnails/');
		if($photoObj->delete()) {
			unlink($filePath.$photo);
			unlink($filePathThumb.$photo);
			$code = 200;
			$message = 'Photo deleted successfully';
		}else{
			$code = 500;
			$message = 'Photo could not be deleted';
		}
		$response = [
			'status_code' => $code,
			'message'	  => $message,
			'data'		  => []
		];
		return response()->json($response, $code);
	}

}
