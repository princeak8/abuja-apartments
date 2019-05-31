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

	public function get_deposit($order)
	{
		$payments = $order->payments;
		$deposit = 0;
		if(!empty($payments)) {
			foreach ($payments as $payment) {
				$deposit = $deposit + $payment->amount;
			}
		}
		return $deposit;
	}

	public function get_balance($order)
	{
		$price = '';
		if(!empty($order->price)) {
			$price = $order->price;
		}else{
			$price = $order->plan->price;
		}
		if(is_numeric((int)$price)) {
			if(empty($payments)) {
				$balance = $price;
			}else{
				$deposit = $this->get_deposit($order);
				$balance = $price - $deposit;
			}
		}else{
			$balance = "Not Available";
		}
		return $balance;
	}

	public function is_myOrder($order, $client)
	{
		if($order->client_id == $client->id) {
			return true;
		}else{
			return false;
		}
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
			if($h->realtor_id <= 0 || $h->location_id <= 0 || $h->house_type_id <= 0) {
				unset($houses[$key]);
			}
		}
		return $houses;
	}
}