<?php namespace App\Repositories;

use Mail;
use Swift_Mailer;

use App\User;
use App\UserRole;
use App\Role;
use App\Order;
use App\Payment;

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
			if($h->location_id <= 0 || $h->house_type_id <= 0) {
				unset($houses[$key]);
			}
			
		}
		return $houses;
	}
}