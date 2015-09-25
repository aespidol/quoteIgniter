<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quote extends CI_Model {
	public function register($post)
	{
		$query = "INSERT INTO users (name, alias, email, password,dob, created_at, updated_at)
				VALUES (?,?,?,?,?,NOW(),NOW())";
		$values = array($post['name'],$post['username'],$post['email'],md5($post['password']),$post['dob']);
		$this->db->query($query,$values);
	}
	public function success($post)
	{
		$query = "SELECT * FROM users WHERE alias = ? AND password = ?";
		$values = array($post['username'],md5($post['password']));
		return $this->db->query($query,$values)->row_array();
	}
	public function contribute($post)
	{
		$query = "INSERT INTO quotes(quoted_by,message,posted_by,created_at,updated_at)
					VALUES (?,?,?,NOW(),NOW())";
		$values = array($post['quoted_by'],$post['quote'],$this->session->userdata('profile')['id']);
		$this->db->query($query,$values);
	}
	public function fetch_all_quotes()
	{
		$query = "SELECT * FROM quotes
		WHERE quotes.message
		NOT IN
		(SELECT quotes.message FROM quotes_has_users
		LEFT JOIN quotes
		ON quotes_has_users.quotes_id = quotes.id
		WHERE quotes_has_users.users_id = ?)";
		$values = array($this->session->userdata('profile')['id']);		
		return $this->db->query($query,$values)->result_array();
	}
	public function favorite($post)
	{
		$query = "INSERT INTO quotes_has_users(quotes_id, users_id)
				VALUES (?,?)";
		$values = array($post['quote_id'], $this->session->userdata('profile')['id']);
		$this->db->query($query,$values);
	}
	public function fetch_favorites()
	{
		$query = "SELECT * FROM quotes_has_users
		LEFT JOIN quotes
		ON quotes_has_users.quotes_id = quotes.id
		WHERE quotes_has_users.users_id = ?";
		$values = array($this->session->userdata('profile')['id']);
		return $this->db->query($query,$values)->result_array();
	}
	public function delete($post)
	{
		$query = "DELETE FROM quotes_has_users
					WHERE quotes_id = ? AND users_id = ?";
		$values = array($post['quote_id'], $this->session->userdata('profile')['id']);
		$this->db->query($query,$values);
	}
	public function fetch_users()
	{
		$query = "SELECT * FROM users";
		return $this->db->query($query)->result_array();
	}
}