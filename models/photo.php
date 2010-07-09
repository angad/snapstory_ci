<?php

class Photo extends Model{

	function Photo()
	{
		//Call the Model constructor		
		parent::Model();
	}

	function load_db()
	{
		$this->load->database();
	}
	
	function upload_photo($data)
	{
		$this->db->insert('photo', $data);
	}

	function get_tags($link)
	{
		$str = 'SELECT * FROM photo WHERE link = \'' . $link . '\'';		
		$query = $this->db->query($str);
		$result= $query->result_array();
		foreach($result as $row)
		{
			$tag = $row['tags'];
			return $tag;
		}
	}

	function update_pic($link, $tags, $caption)
	{
		$str = 'UPDATE photo SET tags = \'' . $tags . '\', caption = \''. $caption . '\' WHERE link = \'' . $link . '\'';
		$this->db->query($str);
	}

	function add_tag($link, $tag)
	{
		$this->db->insert('tags', $tag . $this->get_tags($link));
	}

	

	function get_likes($link)
	{
		$str = 'SELECT * FROM photo WHERE link = \'' . $link . '\'';		
		$query = $this->db->query($str);
		$result= $query->result_array();
		foreach($result as $row)
		{
			$likes = $row['likes'];
			return $likes;
		}
	}

	function add_likes($link)
	{
		$likes = get_likes($link);
		$likes++;	
	}

	function get_link($name)
	{
		$str = 'SELECT * FROM photo WHERE name = \''. $name . '\'';
		$query = $this->db->query($str);
		$result = $query->result_array();
		foreach($result as $row)
		{
			return $row['link'];
		}
	}

	function get_info($link)
	{
		$str = 'SELECT * FROM photo WHERE link = \''. $link . '\'';
		$query = $this->db->query($str);
		$result = $query->result_array();
		foreach($result as $row)
		{
			return $row;
		}
	}
}
?>
