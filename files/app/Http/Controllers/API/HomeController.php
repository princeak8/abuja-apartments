<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use Storage;

use App\House;
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;

class HomeController extends Controller
{
	public function __construct()
	{
		$this->myFunction = new MyFunction;
	}
    
	public function index(Request $request)
	{
		$request->session()->forget('limit');
		$request->session()->forget('filter_title');
		$request->session()->forget('filters');
		//echo bcrypt('akalo88');
		$limit = env('HOUSES_LIMIT');
		$houses = House::limit($limit)->orderBy('created_at', 'desc')->get();
		$house_types = House_type::all();
		$locations = Location::all();
		$price_ranges = Price_range::all();

		$houses = $this->myFunction->sanitize_houses($houses);
		$data = [
			'houses' 		=> $houses,
			'house_types' 	=> $house_types,
			'locations' 	=> $locations,
			'price_ranges' 	=> $price_ranges,
			'limit' 		=> $limit
		];
		$response = [
			'status_code' => 200,
			'data'		  => $data
		];
		return response()->json($response, 200);
	}

}
