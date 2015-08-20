<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	// public function check_date_format($date)
	// {
	// 	$date = explode("/",$date);
	// 	var_dump($date);
	// 	die();
	// 	if((count($date)===3 && !checkdate($date[0],$date[1],$date[2])) || count($date)<3)
	// 	{
	// 		var_dump($date);
	// 		die();
	// 		$this->form_validation->set_message('check_date_format','The Date is not valid');
	// 		return FALSE;
	// 	}
	// 	else
	// 	{
	// 		var_dump($date);
	// 		die('success');
	// 		return TRUE;
	// 	}

	// }
	public function validate_reg($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|trim|ucwords|min_length[3]');
		$this->form_validation->set_rules('username','Username','required|trim|strtolower|is_unique[users.username]|min_length[3]');
		$this->form_validation->set_rules('password','Password','required|trim|min_length[8]|matches[confirm_password]|md5');
		$this->form_validation->set_rules('confirm_password','Confirm Password','required');
		$this->form_validation->set_rules('date_hired','Date Hired','required');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function validate_login($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login_username', 'Username', 'required');
		$this->form_validation->set_rules('login_password','Password','required|trim|md5');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function insert_user($post)
	{
		$query = "INSERT INTO users(name, username, password, date_hired, created_at, updated_at)
				  VALUES (?,?,?,STR_TO_DATE(?,'%m/%d/%Y'),NOW(),NOW())";
		$values = array($post['name'],$post['username'],$post['password'],$post['date_hired']);
		$this->db->query($query,$values);
	}

	public function find_user($post)
	{
		$query = 'SELECT * FROM Users WHERE username = ? AND password = ?';
		$values = array($post['login_username'], $post['login_password']);
		$result = $this->db->query($query, $values)->row_array();
		return $result;
	}

	public function find_user_dashboard($post)
	{
		$query = 'SELECT * FROM Users WHERE id = ? AND password = ?';
		$values = array($post['user_id'], $post['password']);
		$result = $this->db->query($query, $values)->row_array();
		return $result;
	}

	public function find_user_by_id($id)
	{
		$query = 'SELECT id, first_name, last_name, email, description, user_level, created_at, updated_at FROM Users WHERE id = ?';
		$values = array($id);
		$result = $this->db->query($query, $values)->row_array();
		return $result;
	}

	public function display_all_users()
	{
		$query = "SELECT id, CONCAT(first_name , ' ',last_name) as name, email, created_at,user_level
			      FROM users";
		$result = $this->db->query($query)->result_array();
		return $result;
	}

	public function delete_user($id)
	{
		$this->db->query("DELETE FROM users WHERE id = ?", $id);
	}
}
