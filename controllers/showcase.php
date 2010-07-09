<?php

class Showcase extends Controller{

function index()
{
	//list latest 5 themes
	$this->load->model('theme');
	$this->theme->load_db();
	$data = $this->theme->list_5();
	$this->load->view('index_showcase', $data);
}

function current()
{
	$this->load->model('theme');
	$this->theme->load_db();
	$data = $this->theme->current();
	$this->load->view('current_theme', $data);
	
	$this->load->model('sessions');
	$username = $this->sessions->get_user();
	if($username == NULL)
	{
		$data['redirect'] = "http://code.angad.sg/index.php/showcase/current/";
		$this->load->helper('form');
		$this->load->view('signup', $data);
	}
	else
	{
		$this->load->view('server1.php');
	}
}

function theme($theme_link)
{
	$this->load->model('theme');
	$this->theme->load_db();
	$data = $this->theme->load_theme($theme_link);
	$this->load->view('theme_showcase', $data);
}

function tag($tag_name)
{
	//get all photo + story with $name tag
	//load all photo+story of the above data
}

function user($username)
{
	//get all photo+story of the $user
}

}

?>
