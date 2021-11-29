<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_factory extends CI_Model {

	public function getFactory () {
		$sql = "SELECT * FROM factory";
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function addFactory($data) {
		$sql = "INSERT INTO factory (`name`) VALUES (?)";
		$query = $this->db->query($sql, array($data['name']));

		return true;
	}
}
?>