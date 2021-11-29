<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_lacks extends CI_Model {

	public function getOrderLacks($order) {
		$sql = "SELECT l.*, u.name as autorName, u.surname as autorSurname FROM lack as l
		INNER JOIN users as u ON u.id = l.autor WHERE l.order = ? ORDER BY l.id DESC"; 
		$query = $this->db->query($sql, array($order));

		return $query->result_array();
	}

	public function addLack($data) {
		$sql = "INSERT INTO lack (`order`,`name`,`date`,`autor`,`description`,`inside`,`outside`,`active`) VALUES (?,?,?,?,?,?,?,?)";
		$query = $this->db->query($sql, array($data['order'], $data['name'], $data['date'], $data['autor'], $data['description'], $data['inside'],$data['outside'],'1'));

		return true;
	}

	public function unActive ($id) {
		$sql = "UPDATE lack SET active = ? WHERE id = ?";
		$query = $this->db->query($sql, array(0, $id));

		return true;
	}

	public function deleteLack ($id) {
		$sql = "DELETE FROM lack WHERE `id` = ?";
		$query = $this->db->query($sql, array($id));

		return true;
	}

	public function addActive ($id) {
		$sql = "UPDATE lack SET active = ? WHERE id = ?";
		$query = $this->db->query($sql, array(1, $id));

		return true;
	}

	public function save ($data) {
		$sql = "UPDATE lack SET description = ? WHERE id = ?";
		$query = $this->db->query($sql, array($data['description'],$data['id']));

		return true;
	}

	public function getCountLackOrder ($id) {
		$sql = "SELECT * FROM `lack` WHERE `order` = ?"; 
		$query = $this->db->query($sql, array($id));

		return count($query->result_array());
	}

	public function getCountLackActiveOrder ($id) {
		$sql = "SELECT * FROM `lack` WHERE `order` = ? and `active` = ?"; 
		$query = $this->db->query($sql, array($id, 1));

		return count($query->result_array());
	}

	public function getLackOrder ($id) {
		$sql = "SELECT l.*, u.name as autorName, u.surname as autorSurname FROM lack as l INNER JOIN users as u ON l.autor = u.id WHERE l.order = ?"; 
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}


	public function getLackId ($id) {
		$sql = "SELECT l.*, u.name as autorName, u.surname as autorSurname FROM lack as l INNER JOIN users as u ON l.autor = u.id WHERE l.id = ?"; 
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function getLackDate ($start, $end) {
		$sql = "SELECT l.*, o.name as orderName, u.name as autorName, u.surname as autorSurname FROM lack as l INNER JOIN users as u ON  l.autor = u.id INNER JOIN orders as o ON o.id = l.order WHERE `date` >= ? and `date` <= ? ORDER BY `date` DESC"; 
		$query = $this->db->query($sql, array($start, $end));

		return $query->result_array();
	}
}
?>