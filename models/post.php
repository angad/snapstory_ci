<?php

 
class Post extends Model {

	var $post = "";	
	var $title = "";
	var $date = "";
	
	function Post()
	{
		//Call the Model constructor		
		parent::Model();
	}

	function load_db()
	{
		$this->load->database();
	}

	function submit_post($data)
	{
		$this->db->insert('post',$data);
	}

	function get_post($title)
	{
		$str = 'SELECT * FROM post WHERE title = \'' . $title . '\'';		
		$query = $this->db->query($str);
		return $query->result_array();
	}

	function get_latest($n)
	{
		$query = $this->db->get('post', $n);
		return $query->result_array();
	}

	function submit_comment()
	{
		$post_id = $this->input->post('post_id');
		$author = $this->input->post('name');
		$time = time();
		$comment = $this->input->post('comment');
	}

}
?>
