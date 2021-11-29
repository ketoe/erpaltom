<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

	public function getUsers() {
		$sql = "SELECT * FROM `users`"; 
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function getIdUser($id) {
		$sql = "SELECT * FROM `users` WHERE `id` = ?"; 
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function getUsersActive() {
		$sql = "SELECT * FROM `users` WHERE `active` = ?"; 
		$query = $this->db->query($sql, array(1));

		return $query->result_array();
	}

	public function editPermission ($user, $permission) {
		$sql = "UPDATE users SET permission = ? WHERE id = ?";
		$query = $this->db->query($sql, array($permission, $user));

		return true;
	}

	public function editActive ($user, $active) {
		$sql = "UPDATE users SET active = ? WHERE id = ?";
		$query = $this->db->query($sql, array($active, $user));

		return true;
	}

	public function addUser ($data) {
		$sql = "INSERT INTO `users` (`name`,`surname`,`login`,`password`,`permission`) VALUES (?,?,?,?,?)";
		$query = $this->db->query($sql, array($data['name'],$data['surname'],$data['login'],$data['password'],0));

		return true;
	}
}
?>