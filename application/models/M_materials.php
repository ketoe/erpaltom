<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_materials extends CI_Model {
	public function getOrderMaterials($order) {
		$sql = "SELECT m.*, u.name as autorName, u.surname as autorSurname, f.name as factoryName FROM materials as m 
		INNER JOIN users as u ON m.autor = u.id 
		INNER JOIN factory as f ON f.id = m.factory WHERE m.order = ?";
		$query = $this->db->query($sql, array($order));

		return $query->result_array();
	}

	public function getIdMaterial($id) {
		$sql = "SELECT * FROM materials WHERE id = ?";
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function deleteMaterial ($id) {
		$sql = "DELETE FROM materials WHERE `id` = ?";
		$query = $this->db->query($sql, array($id));

		return true;
	}

	public function addMaterial($data) {
		$sql = "INSERT INTO materials (`order`, `name`, `factory`, `date_create`, `autor`, `description`) VALUES (?, ?, ?, ?, ?, ?)";
		$query = $this->db->query($sql, array($data['id'], $data['name'], $data['factory'], $data['date'], $data['autor'], $data['description']));

		return true;
	}

	public function save ($data) {
		$sql = "UPDATE materials SET name = ?, description = ? WHERE id = ?";
		$query = $this->db->query($sql, array($data['name'],$data['description'],$data['id']));

		return true;
	}

}
?>