<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_fvPayment extends CI_Model {
	public function getOrderFv($order) {
		$sql = "SELECT p.*, f.name as factoryName, u.name as autorName, u.surname as autorSurname FROM fv_payment as p 
		INNER JOIN users as u ON p.autor = u.id 
		INNER JOIN factory as f ON p.factory = f.id WHERE p.order = ?";
		$query = $this->db->query($sql, array($order));

		return $query->result_array();
	}

	public function addFvPayment($data) {
		$sql = "INSERT INTO fv_payment (`order`, `name`, `money`, `date_create`, `autor`, `description`,`factory`) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$query = $this->db->query($sql, array($data['id'], $data['name'], $data['money'], $data['date'], $data['autor'], $data['description'], $data['factory']));

		return true;
	}

	public function deleteFvPayment ($id) {
		$sql = "DELETE FROM fv_payment WHERE `id` = ?";
		$query = $this->db->query($sql, array($id));

		return true;
	}

	public function getIdFvPayment($id) {
		$sql = "SELECT * FROM fv_payment WHERE id = ?";
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function save ($data) {
		$sql = "UPDATE fv_payment SET name = ?, description = ?, money = ? WHERE id = ?";
		$query = $this->db->query($sql, array($data['name'],$data['description'], $data['money'], $data['id']));

		return true;
	}
}
?>