<?php

class Showcase extends Controller{

function index()
{
	//list latest 5 themes
	$this->load->model('theme');
	$data = $this->theme->list_5();
	$this->load->view('index_showcase', $data);
}

function current()
{
	$this->load->model('theme');
	$data = $this->theme->current();
	$this->load->view('current_theme', $data);
}

function theme($theme_name)
{
	//theme $name showcase
	//get theme name/details
	//load all photo+story of current theme
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
