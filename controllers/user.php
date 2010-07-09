<?php

class User extends Controller {

	function index()
	{
		//try autologin (check cookie/database)
		$this->auto_login();
	}

	function load_signup()
	{
		//load the signup/login page
		$this->load->helper('form');
		$this->load->view('signup');
	}

	function auto_login()
	{
		$app_secret = '0532f6ba3dc46931fd6af9cf05d467d2';
		$appid = '132809166742172';

		$this->load->helper('cookie');
		
		//check sessions model
		$this->load->model('sessions');
		$cookie = $this->sessions->get_facebook_cookie($appid, $app_secret);
		if($cookie)
		{
			$this->load_account($cookie['uid']);
		}
		else
		{
			$this->load->library('session');

			//if logged in, load_account
			if ($this->session->userdata('logged_in') == TRUE)
			{
				$username = $this->session->userdata('username');
			        $this->load_account($username);
			}
			//else load_signup
			else
			{
				$this->load_signup();
			}
		}
	}

	function submit()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|min_length[6]|max_length[12]|matches[pwdconf]');
		$this->form_validation->set_rules('pwdconf', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->load_signup();
		}
		else
		{
			//load the form handler model
			$this->load->model('form');

			//load db
			$this->form->load_db();

			//get form variables from input
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$pwd = $this->input->post('pwd');
			$t = time();

			//send to form model
			if($this->form->new_user($name, $email, $username, $pwd, $t))
			{
				$this->load->view('email_confirmation_sent');
			}
			else
			{
				echo "Username already exists";
				$this->load_signup();
			}
		}
	}

	function login()
	{
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|min_length[6]|max_length[12]');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->load_signup();
		}
		else
		{
			//load the form handler model
			$this->load->model('form');
			$this->load->library('session');
			//load db
			$this->form->load_db();
	
			//get form variables
			$username = $this->input->post('username');
			$pwd = $this->input->post('pwd');
			//query db for login
			if($this->form->check_login($username, $pwd))
			{	//initialize user session
				$data = array(
	                	'username'  => $username,
		       	        'logged_in'  => TRUE
		                );

		                $this->session->set_userdata($data);
				$this->load_account($username);
			}
			else
			{
				$this->load->view('incorrect_user_pwd');
				$this->load_signup();
			}
		}
	}

	function logout()
	{
		$this->load->helper('cookie');
		$appid = '132809166742172';

		delete_cookie('fbs_' . $appid);
		$this->load->library('session');
		$this->session->sess_destroy();
		$this->load_signup();
	}

	function load_account($username)
	{
		$this->load->model('sessions');
		$p = $this->sessions->load_user($username); 
		//load account view with the user information
		$this->load->view('account', $p);  //view for account information
		$this->load->view('server1'); //view for photo upload
	}


	function fbregister()
	{
                $app_secret = '0532f6ba3dc46931fd6af9cf05d467d2';
                $appid = '132809166742172';
		
		$this->load->model('sessions');
                $cookie = $this->sessions->get_facebook_cookie($appid, $app_secret);

		$user = json_decode(file_get_contents('https://graph.facebook.com/me?access_token=' . $cookie['access_token']));
		$userid = $user->id;
		$name = $user->name;
		$email= $user->email;

		$this->load->model('form');
		$this->form->load_db();
		$this->form->newfb_user($userid, $name, $email);
	}
}

?>
