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

}
?>
