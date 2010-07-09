<?php

class Snap extends Controller {

	function index()
	{
	}
	
	function error()
	{
		$this->load->model('sessions');
			
		//error posted from upload_file.php on img server
		$error = $this->input->post('error');

		//postback URL if user is not signed in
		$postback = array(
		'postback' =>'http://code.angad.sg/index.php/snap/error/' . $error
		);

		//get current user
		$username = $this->sessions->get_user();
		if($username == NULL)
		{
			//user not signed in, login to continue
			$this->load->view('login_to_continue', $postback);
		}
		else
		{
			//process error
			if($error == "inv") //invalid file
			{
				$data = array(
				'error'=>"Invalid file"
				);
			}
			if($error == "captcha")
			{
				$data = array(
				'error'=>"Captcha error, enter again"
				);
			}
			
			//load current user
			$data = $this->sessions->load_user($username);
			//load account view with the user information
			$this->load->view('account', $data);
			$this->load->view("upload_error", $data);
			$this->load->view('server1');
		}
	}
	
	function success()
	{
		//success posted from upload_file.php on img server
		$success = $this->input->post('success');
		$server = $this->input->post('server');

		$name = $success;
		//file link
		$link = "http://" . $server . ".000space.com/upload/" . $name;
		
		//postback URL if user is not signed in
		$postback = array (
		'postback' => 'http://code.angad.sg/index.php/snap/' . $server . '/' . $success
		);
		
		$this->load->model('photo');
		$this->load->model('sessions');
		
		//get current user
		$username = $this->sessions->get_user();
		if($username == NULL)
		{
			//user not signed in, login to continue
			$this->load->view('login_to_continue', $postback);
		}
		else
		{
			//push photo info to database
			$this->photo->load_db();
			$data = array(
			'name' =>$name,
			'server'=>$server,
			'link'=>$link,
			'username'=>$username
			);
			$this->photo->upload_photo($data);
			
			$this->load->helper('form');
			$this->load->view('photo_edit', $data);
		}
	}

	function edit()
	{

		$this->load->model('sessions');
		$username = $this->sessions->get_user();

		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		$tags = $this->input->post('tags');	//photo tags
		$link = $this->input->post('link');	//link to image (direct link used as photo_id in story db)
		$caption = $this->input->post('caption');//caption to photo
		$story = $this->input->post('story'); //story text
		$title = $this->input->post('title'); //story title

		$this->load->model('photo');
		$this->photo->load_db();
		$this->photo->update_pic($link, $tags, $caption); //update photo db with the tag and caption
		
		$this->load->model('story');
		$this->story->load_db();
		$this->story->new_story($link, $title, $story, $username); //insert story title and text into db

		$photo_info = $this->photo->get_info($link);	//get photo links
		$server = $photo_info['server'];
		$name = $photo_info['name'];

		$data = array(
		'link'=>$link,
		'tags'=>$tags,
		'caption'=>$caption,
		'story'=>$story,
		'title'=>$title,
		'server'=>$server,
		'name'=>$name,
		'username'=>$username
		);

		$this->load->view('photo_story',$data);
	}
}
?>
