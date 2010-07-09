<?php

class Editor extends Controller {

	function index()
	{
		$this->load->helper('form');
		$this->load->view('create');

	}
	
	function submit()
	{
		$this->load->model('post');
		$this->post->load_db();
		

		$post = $this->input->post('post');
		$title = $this->input->post('title');
		$date = time();

		$data = array(
		'title' => $title,
       		'post' => $post,
        	'time' => $date
        	);
		
		$this->post->submit_post($data);
		
		echo "submitted";
		echo $title;

		$submitted = $this->post->get_post($title);
		foreach($submitted as $row)
		{
			echo '<a href = "http://code.angad.sg/index.php/loader/' . $title . '>' . $row['title'] . '</a> <br />';
			echo $row['time'] . '<br />';			
			echo $row['post'];
		}
	}

	function load($n)
	{	
		$this->load->model('post');
		$this->post->load_db();
		
		$result = $this->post->get_latest($n);
		foreach($result as $row)
		{
			echo $row['title'];
			echo $row['post'];	
		}
	}

}

?>
