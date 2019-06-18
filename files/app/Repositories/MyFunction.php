<?php namespace App\Repositories;

use Mail;
use Swift_Mailer;

use App\Realtor;
use App\House;
use App\Location;

class MyFunction
{

	public function isInternal($url) {
	  $components = parse_url($url);
	  $host = env('APP_HOST');
	  $return = false;
	  if ( empty($components['host']) )  {  // we will treat url like '/relative.php' as relative
	  	$return = true;
	  }else{
		  if ( strcasecmp($components['host'], $host) === 0 ) { // url host looks exactly like the local host
		  	$return = true;
		  	// check if the url host is a subdomain
		  }elseif(strrpos(strtolower($components['host']), '.'.$host) == strlen($components['host']) - strlen('.'.$host)) {
		  	$return = true;
		  }
	  }
	  return $return;
	}

	public function random_integers($length)
	{
		$integer = '';
		for($i=0; $i<=$length; $i++) {
			$integer .= mt_rand(0,9);
		}
		return $integer;
	}

	public function delete_folder($path)
		{
			if (is_dir($path) === true)
			{
				$files = array_diff(scandir($path), array('.', '..'));
		
				foreach ($files as $file)
				{
					self::delete_folder(realpath($path) . '/' . $file);
				}
		
				return rmdir($path);
			}
		
			else if (is_file($path) === true)
			{
				return unlink($path);
			}
		}
		
	public function del_folder($dir) { 
		$files = array_diff(scandir($dir), array('.','..')); 
		foreach ($files as $file) { 
		  (is_dir("$dir/$file")) ? self::del_folder("$dir/$file") : unlink("$dir/$file"); 
		} 
		return rmdir($dir); 
	} 

	public function has_role($user, $role)
	{
		$hasRole = false;
		foreach($user->userRole as $user_role) {
			if($user_role->role->common_name==$role) {
				$hasRole = true;
			}
		}
		return $hasRole;
	}

	public function sanitize_houses($houses)
	{
		foreach($houses as $key=>$h) {
			if($h->id <= 0 || $h->location_id <= 0 || $h->house_type_id <= 0) {
				unset($houses[$key]);
			}
		}
		return $houses;
	}

	public function expand_realtor_houses($realtorHouses)
	{
		foreach($realtorHouses as $realtorHouse) {
			$this->expand_realtor_house($realtorHouse);
		}
	}

	public function expand_realtor_house($realtorHouse)
	{
		$realtorHouse->{"house"} = $realtorHouse->house;
		$realtorHouse->house->{"location"} = $realtorHouse->house->location->name;
		$realtorHouse->house->{"house_type"} = $realtorHouse->house->house_type->type;
		$realtorHouse->house->{"likes"} = $realtorHouse->house->likes;
		$realtorHouse->{"sharer"} = $realtorHouse->sharer;
	}

	public function expand_house($house)
	{
		$house->{"location"} = $house->location->name;
		$house->{"house_type"} = $house->house_type->type;
		$house->{"house_photos"} = $house->house_photos;
	}

	public function expand_estates($estates)
	{
		foreach($estates as $estate) {
			$this->expand_estate($estate);
		}
	}

	public function expand_estate($estate)
	{
		$estate->{"location"} = $estate->location->name;
		$estate->{"estate_photos"} = $estate->estate_photos;
		$estate->{"houses"} = $estate->houses;
		$this->expand_house($estate->house);
	}
}