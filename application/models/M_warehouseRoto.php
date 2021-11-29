<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_warehouseRoto extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getArticles () { //cały magazyn
		$sql = "SELECT * FROM `warehouseroto` ORDER BY `id` DESC"; 
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	
	public function getZamRoto() {
		$sql = "SELECT * FROM `orders_roto` ORDER BY `id` DESC"; 
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	
	public function getIdZam ($id) {
		$sql = "SELECT * FROM `orders_roto` WHERE `id` = ?"; 
		$query = $this->db->query($sql,array($id));

		return $query->result_array();
	}
	
	public function getZamArticleZam ($id) {
		$sql = "SELECT * FROM `articleroto_zam` WHERE `id_zam` = ?"; 
		$query = $this->db->query($sql,array($id));

		return $query->result_array();
	}
	
	public function getZamName	($name, $autor) { 
		$sql = "SELECT * FROM `orders_roto` WHERE `name` = ? AND `autor` = ? LIMIT 1"; 
		$query = $this->db->query($sql, array($name, $autor));

		return $query->result_array();
	}

	public function getCodeArticle ($code) { 
		$sql = "SELECT * FROM `warehouseroto` WHERE sap = ?"; 
		$query = $this->db->query($sql, array($code));

		return $query->result_array();
	}

	public function getIdArticle ($code) { 
		$sql = "SELECT * FROM `warehouseroto` WHERE id = ?"; 
		$query = $this->db->query($sql, array($code));

		return $query->result_array();
	}


	public function addArticle($data) {
		$sql = "INSERT INTO `warehouseroto` (`name`, `sap`, `pack`, `value`) VALUES (?,?,?,?)";
		$query = $this->db->query($sql, array($data['name'], $data['sap'], $data['pack'], $data['value']));

		return true;
	}
	
	public function addArticleZam($data) {
		$sql = "INSERT INTO `articleroto_zam` (`id_zam`,`article`,`value`) VALUES (?,?,?)";
		$query = $this->db->query($sql, array($data['id_zam'], $data['article'], $data['value']));

		return true;
	}


	public function updateValueArticle ($id, $value) {
		$sql = "UPDATE warehouseroto SET value = ? WHERE id = ?";
		$query = $this->db->query($sql, array($value, $id));

		return true;
	}

	public function deleteArticle ($id) {
		$sql = "DELETE FROM warehouseroto WHERE id = ? LIMIT 1";
		$query = $this->db->query($sql, array($id));

		return true;
	}

	public function updateArticle ($data) {
		$sql = "UPDATE warehouseroto SET name = ?, sap = ?, value = ?, pack = ? WHERE id = ?";
		$query = $this->db->query($sql, array($data['name'], $data['sap'], $data['value'], $data['pack'], $data['id']));

		return true;
	}

	public function zaokrWGore($liczba, $znaczenie) {
 		if($znaczenie == 0) return FALSE;
  		$wynik = ceil($liczba / $znaczenie);
  		$wynik*= $znaczenie;
  		return $wynik;
	}

	public function addZamRoto ($name, $date, $autor) {
		$sql = "INSERT INTO `orders_roto` (`name`, `date`, `autor`) VALUES (?,?,?)";
		$query = $this->db->query($sql, array($name, $date, $autor));

		return true;
	}


	
}
?>