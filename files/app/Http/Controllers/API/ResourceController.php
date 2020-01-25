<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use Storage;

use App\House;
use App\House_type;
use App\House_photo;
use App\Location;
use App\Price_range;

class ResourceController extends Controller
{
	public function __construct()
	{
		$this->myFunction = new MyFunction;
	}
    
    public function house_types()
	{
		$house_types = House_type::all();
		return response()->json($house_types);
    }
    
    public function locations()
	{
		$locations = Location::all();
		return response()->json($locations);
	}

	public function price_ranges()
	{
		$price_ranges = Price_range::all();
		return response()->json($price_ranges);
    }

}
