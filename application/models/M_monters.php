<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_monters extends CI_Model {
	public function getIdMonter($id) {
		$sql = "SELECT * FROM `monters` WHERE `id` = ?"; 
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function getIdInstall($id) {
		$sql = "SELECT * FROM `order_monters` WHERE `id` = ?"; 
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}


	public function getIdMonterOrder ($startDate, $id) {
		$sql = "SELECT om.*, o.id as orderId, o.name as orderName FROM order_monters as om INNER JOIN orders as o ON o.id = om.order  WHERE om.end >= ? AND om.monter = ?"; 
		$query = $this->db->query($sql, array($startDate, $id));

		return $query->result_array();
	}

	public function addMonter ($data) {
		$sql = "INSERT INTO `monters` (`name`,`contact`,`mail`) VALUES (?, ?, ?)";
		$query = $this->db->query($sql, array($data['name'], $data['contact'], $data['mail']));

		return true;
	}

	public function getMonters () {
		$sql = "SELECT * FROM monters"; 
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function deleteIdMonter ($id) { //usuwanie montażysty
		$sql = "DELETE FROM order_monters WHERE `monter` = ?";
		$query = $this->db->query($sql, array($id));

		$sql2 = "DELETE FROM monters WHERE `id` = ?";
		$query2 = $this->db->query($sql2, array($id));
	}

	public function deleteIdMonterOrder ($id) { //usuwanie montażu
		$sql2 = "DELETE FROM order_monters WHERE `id` = ?";
		$query2 = $this->db->query($sql2, array($id));
	}

	public function updateMonter($data) {
		$sql = "UPDATE monters SET name = ?, contact = ?, mail = ? WHERE id = ?";
		$query = $this->db->query($sql, array($data['name'], $data['contact'], $data['mail'], $data['id']));

		return true;
	}

	public function getListMontersOrder ($order) {
		$sql = "
		SELECT o.*, m.name as monterName
		FROM order_monters as o 
		INNER JOIN monters as m ON o.monter = m.id 
		WHERE o.order = ?"; 
		$query = $this->db->query($sql, array($order));

		return $query->result_array();
	}
}

?>