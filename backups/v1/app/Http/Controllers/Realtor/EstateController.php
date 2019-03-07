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
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;

class EstateController extends Controller
{
	public function __construct()
	{
		$this->middleware('realtorAuth');
		$this->myFunction = new MyFunction;
	}

	public function estates()
	{
		$realtor = Realtor::find(Auth::user()->id);
		return view('realtor/estates', compact('realtor'));
	}

	public function show($id)
	{
		$realtor = Realtor::find(Auth::user()->id);
		$estate = Estate::find($id);
		return view('realtor/estate', compact('estate', 'realtor'));
	}

}
