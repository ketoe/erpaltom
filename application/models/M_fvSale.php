<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_fvSale extends CI_Model {
	public function getOrderFv($order) {
		$sql = "SELECT s.*, u.name as autorName, u.surname as autorSurname FROM fv_sale as s 
		INNER JOIN users as u ON s.autor = u.id WHERE s.order = ?";
		$query = $this->db->query($sql, array($order));

		return $query->result_array();
	}

	public function addFvSale($data) {
		$sql = "INSERT INTO fv_sale (`order`, `name`, `money`, `date_create`, `autor`, `description`) VALUES (?, ?, ?, ?, ?, ?)";
		$query = $this->db->query($sql, array($data['id'], $data['name'], $data['money'], $data['date'], $data['autor'], $data['description']));

		return true;
	}

	public function deleteFvSale ($id) {
		$sql = "DELETE FROM fv_sale WHERE `id` = ?";
		$query = $this->db->query($sql, array($id));

		return true;
	}

	public function getIdFvSale($id) {
		$sql = "SELECT * FROM fv_sale WHERE id = ?";
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function save ($data) {
		$sql = "UPDATE fv_sale SET name = ?, description = ?, money = ? WHERE id = ?";
		$query = $this->db->query($sql, array($data['name'],$data['description'], $data['money'], $data['id']));

		return true;
	}


}
?>