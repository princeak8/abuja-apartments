<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use Storage;

use App\Realtor;
use App\House;
use App\Estate;
use App\House_photo;
use App\Estate_photo;

class PhotoController extends Controller
{
	public function __construct()
	{
		$this->middleware('realtorAuth');
		$this->myFunction = new MyFunction;
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
			echo 1;
		}
	}

	public function show($id)
	{
		$realtor = Realtor::find(Auth::user()->id);
		$estate = Estate::find($id);
		return view('realtor/estate', compact('estate', 'realtor'));
	}

}
