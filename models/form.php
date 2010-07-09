<?php

class Form extends Model {
//Handles user information - user db connect

	function Form()
	{
		//Call the Model constructor
		parent::Model();
	}

	function load_db()
	{
		$this->load->database();
	}

	function new_user($name, $email, $username, $pwd, $t)
	{
		//push new user into database
		$pwd =  md5($pwd);
		$data = array(
		'username' => $username,
		'name' => $name,
		'email' => $email,
		'key' => $pwd,
		'time_joined' => $t);
		
		$str = 'SELECT * FROM user WHERE username = \'' . $username . '\'';
		$query = $this->db->query($str);
		$a = $query->result_array();
		foreach($a as $row)
		{
			if($row['username'] == $username)
			{
				return false;
			}
		}
		$this->db->insert('user', $data);
		return true;
	}

	function newfb_user($userid, $name, $email)
	{
		$data = array(
		'username'=>$userid,
		'name'=>$name,
		'email'=>$email
		);
		$this->db->insert('user', $data);
	}

	function check_login($username, $pwd)
	{
		//query database for username
		$str = 'SELECT * FROM user WHERE username = \'' . $username . '\'';
		$query = $this->db->query($str);
		$a = $query->result_array();

		//check password
		foreach($a as $row)
		{
			if(md5($pwd)==$row['key'])
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	function load_user($username)
	{
		//query db for user information
		$str = 'SELECT * FROM user WHERE username = \'' . $username . '\'';
		$query = $this->db->query($str);
		$a = $query->result_array();
		return $a;
		//incomplete function
	}

	
}

?>
