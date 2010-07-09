<?php

class Sessions extends Model{

	function Sessions()
	{
		parent::Model();
	}
	
	function get_facebook_cookie($app_id, $application_secret) {
	  $args = array();
	if(isset($_COOKIE['fbs_' . $app_id]))
	{
		 parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
		  ksort($args);
		  $payload = '';
		  foreach ($args as $key => $value) {
		    if ($key != 'sig') {
		      $payload .= $key . '=' . $value;
				    }
			  }
	  if (md5($payload . $application_secret) != $args['sig']) {
	    return null;
	 	 }
	  return $args;
		}
	}

	function load_user($username) //loads user info and checks fb logged in or not
	{
		$app_secret = '0532f6ba3dc46931fd6af9cf05d467d2';
                $appid = '132809166742172';

		$cookie = $this->get_facebook_cookie($appid, $app_secret);
		
		$form = $this->model_load_model('form');
		$form->load_db();
		$data = $form->load_user($username);
		foreach($data as $row)
		{
			$p = $row;
		}
		if($cookie)
		{
			$p['fb_logged_in'] = true;
		}
		else 
		{
			$p['fb_logged_in'] = false;
		}
		return $p;
	}

	function get_user()//gets current logged in user
	{
		$app_secret = '0532f6ba3dc46931fd6af9cf05d467d2';
		$appid = '132809166742172';

		$this->load->helper('cookie');

		//get facebook uid		
		$cookie = $this->get_facebook_cookie($appid, $app_secret);
		if($cookie)
		{
			return $cookie['uid']; //uid is username for fb account
		}

		$this->load->library('session');
		
		//get session username
		if ($this->session->userdata('logged_in') == TRUE)
		{
			$username = $this->session->userdata('username');
		        return $username;
		}
		else
		{
			return NULL;
		}
	}

	function model_load_model($model_name)
	{
		$CI =& get_instance();
		$CI->load->model($model_name);
		return $CI->$model_name;
   	}
}
?>
