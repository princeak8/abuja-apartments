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
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;
use App\Circle;

class RequestController extends Controller
{
	public function __construct()
	{
		$this->middleware('realtorAuth');
		$this->myFunction = new MyFunction;
	}

	public function requests()
	{
		return view('realtor/requests');
	}

	public function process()
	{
		
	}

}
