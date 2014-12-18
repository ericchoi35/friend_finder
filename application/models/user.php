<?php

class User extends CI_Model{
	
	function add_user($user)
	{
		$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?, NOW(), NOW())";
		$values = array($user['first_name'], $user['last_name'], $user['email'], $user['password']);
		return $this->db->query($query, $values);
	}

	function get_user_by_email($email)
	{
		return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
	}

	function get_last_entry()
	{
		return $this->db->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->row_array();
	}

	function get_user_by_id($id)
	{
		return $this->db->query("SELECT * FROM users WHERE id = ?", array($id))->row_array();
	}

	function non_friends($id)
	{
		$not_in = "SELECT friendship_id FROM friendships WHERE user_id = ?";
		$query = "SELECT * FROM users WHERE id NOT IN (" . $not_in . ") AND id != ?";
		$values = array($id, $id);
		return $this->db->query($query, $values)->result_array();
	}
	function friends($id){
		$query = "SELECT * FROM friendships
			LEFT JOIN users as friends on friends.id = friendships.friendship_id
			WHERE friendships.user_id = ?";
		$values = array($id);
		return $this->db->query($query, $values)->result_array();
	}
	function add_friend($id1, $id2)
	{
		$query = "INSERT INTO friendships (user_id, friendship_id) VALUES (?,?)";
		$values = array($id1, $id2);
		return $this->db->query($query, $values);
	}

}
