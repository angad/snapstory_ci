<?php

class Admin extends Controller{

function index(){
//login admin
$this->load->helper('form');
$this->load->view('admin_home');
}

function login()
{
	$this->load->model('root');
	$this->root->load_db();
	
	$username = $this->input->post('username');
	$pwd = $this->input->post('password');
	if($this->root->check_login($username, $pwd))
	{
		$this->load->helper('form');		
		$this->load->view('admin_account', $username);
	}
	else 
	{
		echo "Incorrect username password";
		$this->index();
	}
}

function new_theme()
{
	$theme_name = $this->input->post('name');
	$date_start = $this->input->post('date_start');
	$date_end = $this->input->post('date_end');
	$theme_desc = $this->input->post('theme_desc');
	$theme_pic = $this->input->post('theme_pic');

	$data = array(
	'name'=>$theme_name,
	'date_start'=>$date_start,
	'date_end'=>$date_end,
	'theme_desc'=>$theme_desc,
	'theme_pic'=>$theme_pic
	);
	$this->load->model('root');
	$this->root->load_db();
	$this->root->new_theme($data);
	$this->load->view('admin_theme', $data);
}

}
?>
