<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_warehouse extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function getArticles () { //cały magazyn
		$sql = "SELECT * FROM `warehouse` ORDER BY `id` DESC"; 
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	
	public function getZamAluprof() {
		$sql = "SELECT * FROM `orders_aluprof` ORDER BY `id` DESC"; 
		$query = $this->db->query($sql);

		return $query->result_array();
	}
	
	public function getIdZam ($id) {
		$sql = "SELECT * FROM `orders_aluprof` WHERE `id` = ?"; 
		$query = $this->db->query($sql,array($id));

		return $query->result_array();
	}
	
	public function getZamArticleZam ($id) {
		$sql = "SELECT * FROM `article_zam` WHERE `id_zam` = ?"; 
		$query = $this->db->query($sql,array($id));

		return $query->result_array();
	}
	
	public function getZamName	($name, $autor) { 
		$sql = "SELECT * FROM `orders_aluprof` WHERE `name` = ? AND `autor` = ? LIMIT 1"; 
		$query = $this->db->query($sql, array($name, $autor));

		return $query->result_array();
	}

	public function getCodeArticle ($code) { 
		$sql = "SELECT * FROM `warehouse` WHERE code = ?"; 
		$query = $this->db->query($sql, array($code));

		return $query->result_array();
	}

	public function getIdArticle ($code) { 
		$sql = "SELECT * FROM `warehouse` WHERE id = ?"; 
		$query = $this->db->query($sql, array($code));

		return $query->result_array();
	}


	public function addArticle($data) {
		$sql = "INSERT INTO `warehouse` (`name`, `code`, `jm`, `value`) VALUES (?,?,?,?)";
		$query = $this->db->query($sql, array($data['name'], $data['code'], $data['jm'], $data['value']));

		return true;
	}
	
	public function addArticleZam($data) {
		$sql = "INSERT INTO `article_zam` (`id_zam`,`article`,`jm`,`value`,`pack`) VALUES (?,?,?,?,?)";
		$query = $this->db->query($sql, array($data['id_zam'], $data['article'], $data['jm'], $data['value'], $data['pack']));

		return true;
	}

	public function getOrdersAluprofMounth($mounth, $year) { //zamówienie do Aluprof z danego miesiąca
		$dataStart = $year.'-'.$mounth.'-01';
		$dataEnd = $year.'-'.$mounth.'-31';

		$sql = "SELECT * FROM `orders_aluprof` WHERE `date` >= ? AND `date` <= ?"; 
		$query = $this->db->query($sql, array($dataStart, $dataEnd));

		return $query->result_array();
	}

	public function updateValueArticle ($id, $value) {
		$sql = "UPDATE warehouse SET value = ? WHERE id = ?";
		$query = $this->db->query($sql, array($value, $id));

		return true;
	}

	public function deleteArticle ($id) {
		$sql = "DELETE FROM warehouse WHERE id = ? LIMIT 1";
		$query = $this->db->query($sql, array($id));

		return true;
	}

	public function updateArticle ($data) {
		$sql = "UPDATE warehouse SET name = ?, code = ?, value = ? WHERE id = ?";
		$query = $this->db->query($sql, array($data['name'], $data['code'], $data['value'], $data['id']));

		return true;
	}
	public function createNameZamAluprof($value) { //tworzenie nr zamówienia do aluprof
		$value = $value+1;
		if ($value < 10) {
			$v = '000'.$value;
		}elseif ($value >= 10 && $value < 100) {
			$v = '00'.$value;
		}elseif ($value >= 100 && $value < 1000) {
			$v = '0'.$value;
		}elseif ($value >= 1000 && $value < 10000) {
			$v = $value;
		}else {
			$v = $value;
		}

		return $v.'/'.date('m').'/'.date('Y');
	}

	public function zaokrWGore($liczba, $znaczenie) {
 		if($znaczenie == 0) return FALSE;
  		$wynik = ceil($liczba / $znaczenie);
  		$wynik*= $znaczenie;
  		return $wynik;
	}

	public function addZamAluprof ($name, $date, $autor) {
		$sql = "INSERT INTO `orders_aluprof` (`name`, `date`, `autor`) VALUES (?,?,?)";
		$query = $this->db->query($sql, array($name, $date, $autor));

		return true;
	}


	
}
?>