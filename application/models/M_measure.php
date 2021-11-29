<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_measure extends CI_Model {
	public function getIdMeasure ($id) {
		$sql = "
		SELECT * FROM measure WHERE id = ?"; 
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function updateOrder ($id, $order) {
		$sql = "UPDATE measure SET `order` = ? WHERE `id` = ?";
		$query = $this->db->query($sql, array($order, $id));

		return true;
	}
	public function getMeasureActual() {
		$sql = "
		SELECT m.*, c.name as clientName, a.name as autorName, a.surname as autorSurname
		FROM measure as m
		INNER JOIN users as a ON m.autor = a.id 
		INNER JOIN clients as c ON c.id = m.client 
		WHERE m.date_measure >= ? ORDER BY m.date_measure DESC"; 
		$query = $this->db->query($sql, array(date("Y-m-d")));

		return $query->result_array();
	}

	public function getMeasureOrder($id) {
		$sql = "
		SELECT m.*, a.name as autorName, a.surname as autorSurname
		FROM measure as m
		INNER JOIN users as a ON m.autor = a.id 
		WHERE m.order = ?"; 
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function getMeasureDate($start, $end) {
		$sql = "
		SELECT m.*, c.name as clientName, a.name as autorName, a.surname as autorSurname
		FROM measure as m
		INNER JOIN users as a ON m.autor = a.id 
		INNER JOIN clients as c ON c.id = m.client 
		WHERE m.date_measure >= ? AND m.date_measure <= ? ORDER BY m.date_measure DESC"; 
		$query = $this->db->query($sql, array($start, $end));

		return $query->result_array();
	}

	public function deleteMeasure ($id) {
		$sql = "DELETE FROM measure WHERE `id` = ?";
		$query = $this->db->query($sql, array($id));

		return true;
	}

	public function addMeasure($data) {
		$sql = "INSERT INTO measure (`address`, `contact`, `mail`, `autor`, `date_measure`, `date_create`, `description`,`client`, `order`) VALUES (?,?,?,?,?,?,?,?,?)";
			$query = $this->db->query($sql, 
				array(
					$data['address'],
					$data['contact'],
					$data['mail'],
					$data['autor'],
					$data['date_measure'],
					date("Y-m-d"),
					$data['description'],
					$data['client'],
					$data['order']));
			return true;
	}

	public function getMeasureId($id) {
		$sql = "SELECT * FROM measure WHERE id = ?"; 
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}


}
?>