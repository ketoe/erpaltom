<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_fvMonter extends CI_Model {
	public function getOrderFv($order) {
		$sql = "SELECT m.*, u.name as autorName, u.surname as autorSurname FROM fv_monter as m 
		INNER JOIN users as u ON m.autor = u.id WHERE m.order = ?";
		$query = $this->db->query($sql, array($order));

		return $query->result_array();
	}

	public function addFvMonter($data) {
		$sql = "INSERT INTO fv_monter (`order`, `name`, `money`, `date_create`, `autor`, `description`) VALUES (?, ?, ?, ?, ?, ?)";
		$query = $this->db->query($sql, array($data['id'], $data['name'], $data['money'], $data['date'], $data['autor'], $data['description']));

		return true;
	}

	public function deleteFvMonter ($id) {
		$sql = "DELETE FROM fv_monter WHERE `id` = ?";
		$query = $this->db->query($sql, array($id));

		return true;
	}


	public function getIdFvMonter($id) {
		$sql = "SELECT * FROM fv_monter WHERE id = ?";
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function save ($data) {
		$sql = "UPDATE fv_monter SET name = ?, description = ?, money = ? WHERE id = ?";
		$query = $this->db->query($sql, array($data['name'],$data['description'], $data['money'], $data['id']));

		return true;
	}

}
?>