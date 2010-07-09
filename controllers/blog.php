<?php

class Blog extends Controller{

function index()
{
	$this->load->view('blog/index');
}

function secure_file_upload()
{
	$this->load->view('blog/secure_file_upload');
}

function image_hotlinking()
{
	$this->load->view('blog/image_hotlinking');
}

function free_hosting()
{
	$this->load->view('blog/free_hosting');
}

}
?>

