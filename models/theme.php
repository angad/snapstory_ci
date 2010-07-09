<?php

class Theme extends Model{

//NOTE - New theme can only be created by an admin and is done in the admin controller/root model

function load_db()
{
	$this->load->database();
}

function list_5()
{
//get top 5 themes
//store theme name, start end date, theme picture, theme description
	$query = $this->db->get('theme_list', 5);
	$result = $query->result_array();
	$i = 0;
	foreach($result as $row)
	{
		$data['theme_name' . $i] = $row['name'];
		$data['date_start' . $i] = $row['date_start'];
		$data['date_end' . $i] = $row['date_end'];
		$data['theme_pic' . $i] = $row['theme_pic'];
		$data['theme_desc' . $i] = $row['theme_desc'];
		$data['theme_link' . $i] = $row['theme_link'];
		$i++;
	}
	$data['size'] = $i;
	$data2['data'] = $data;
	return $data2;
}

function current()
{
	$query = $this->db->get('theme_list', 1);
	$result = $query->result_array();
	foreach($result as $row)
	{
		return $row; //contains info about current theme
	}
}

function get_current_theme()
{
	$query = $this->db->get('theme_list', 1);
	$result = $query->result_array();
	foreach($result as $row)
	{
		$data['theme_link'] = $row['theme_link'];
		$data['theme_name'] = $row['name'];
	}
	return $theme_link;
}

function load_theme($theme_link)
{
	//query theme db for theme name
	$str = 'SELECT * FROM theme WHERE theme_link = \'' . $theme_link . '\'';
	$query = $this->db->query($str);
	$result = $query->result_array();

	//load photo model to get photo information
	$photo = $this->model_load_model('photo');
	$photo->load_db();

	//load story model to get story
	$story = $this->model_load_model('story');
	$story->load_db();

	$i=0;
	foreach($result as $row)
	{
		$photo_db = $photo->get_info($row['photo_link']);
		$story_db = $story->get_story($row['photo_link']);
		$data['server' . $i] = $photo_db['server'];
		$data['img_name' . $i] = $photo_db['name'];
		$data['username' . $i] = $photo_db['username'];
		$data['tags' . $i] = $photo_db['tags'];
		$data['caption' . $i] = $photo_db['caption'];
		$data['title' . $i] = $story_db['title'];
		$data['story' . $i] = $story_db['story'];
		$data['theme_name'] = $row['name'];
		$i++;
	}
	$data['size'] = $i;
	$data['theme_link'] = $theme_link;
	$data2['data'] = $data;
	return $data2;

	//return a $data array containing $img_name, $server, $photo_tags, $username, $curr_user, $caption, $title, $story, $likes
}

function submit_to_theme($photo_link, $username)
{
	$data = $this->get_current_theme();
	$data = array(
	'name'=>$data['theme_name'],
	'theme_link'=>$data['theme_link'],
	'photo_link'=>$photo_link,
	'username'=>$username
	);
	$this->db->insert('theme', $data);
}

function model_load_model($model_name)
{
	$CI =& get_instance();
	$CI->load->model($model_name);
	return $CI->$model_name;
}


}
?>
