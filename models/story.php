<?php

class Story extends Model {

function load_db()
{
	$this->load->database();
}

function new_story($link, $title, $story, $username)
{
	$data = array(
	'photo_id'=>$link,
	'user_id'=>$username,
	'title'=>$title,
	'story'=>$story
	);
	$this->db->insert('story', $data);
}

function get_story($photo_link)
{
	$str = 'SELECT * FROM story WHERE photo_id = \'' . $photo_link . '\'';
	$query = $this->db->query($str);
	$result = $query->result_array();
	foreach($result as $row)
	{
		return $row;
	}
}

//function get_user_story($username)
//{

//}

}
?>
