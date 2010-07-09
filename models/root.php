<?php

class Root extends Model{

function load_db()
{
	$this->load->database();
}
function check_login($username, $password)
{
	$str = 'SELECT * FROM admin WHERE username = \'' . $username . '\'';
	$query = $this->db->query($str);
	$result = $query->result_array();
	foreach($result as $row)
	{
		if($password == $row['password'])
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

function new_theme($data)
{
	$this->db->insert('theme_list', $data);
}
}
?>
