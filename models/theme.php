<?php

class Theme extends Model{

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
	foreach($result as $row)
	{
		$data['theme_name' . $i] = $row['name'];
		$data['date_start' . $i] = $row['date_start'];
		$data['date_end' . $i] = $row['date_end'];
		$data['theme_pic' . $i] = $row['theme_pic'];
		$data['theme_desc' . $i] = $row['theme_desc'];
		$i++;
	}
	$data['size'] = $i;
	return $data;
}

function current()
{
	$query = $this->db->get('theme_list', 1);
	$result = $query->result_array();
	foreach($result as $row)
	{
		$theme_name = $row['name'];	
	}

	return $this->load_theme($theme_name);
	

//find the latest theme $theme_name from theme_list 
//query theme db for $theme_name
//call load_theme($theme_name)
}

function load_theme($theme_name)
{
	//query theme db for $theme_name
	$str = 'SELECT * FROM theme WHERE name = \'' . $theme_name . '\'';
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
		$data[$i]['server'] = $photo_db['server'];
		$data[$i]['img_name'] = $photo_db['name'];
		$data[$i]['username'] = $photo_db['username'];
		$data[$i]['tags'] = $photo_db['tags'];
		$data[$i]['caption'] = $photo_db['caption'];
		$data[$i]['title'] = $story_db['title'];
		$data[$i]['story'] = $story_db['story'];
		$i++;
	}
	$data['size'] = $i;
	return $data;

	//return a $data array containing $img_name, $server, $photo_tags, $username, $curr_user, $caption, $title, $story, $likes
}

function model_load_model($model_name)
{
	$CI =& get_instance();
	$CI->load->model($model_name);
	return $CI->$model_name;
}


}
?>

