<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_clients extends CI_Model {

	public function getClients () {
		$sql = "SELECT * FROM `clients`";
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function addNewClient ($name) { //nowy klient
		$sql = "INSERT INTO `clients` (`name`) VALUES (?)";
		$query = $this->db->query($sql, array($name));

		return true;
	}

	public function addNewClientFullDate ($data) { //nowy klient pełne dane
		$sql = "INSERT INTO `clients` (`name`,`address`,`mail`,`phone`,`nip`) VALUES (?,?,?,?,?)";
		$query = $this->db->query($sql, array($data['name'], $data['address'], $data['mail'], $data['phone'], $data['nip']));

		return true;
	}

	public function lastInsertClient() { //ostatnio dodany klient
		$sql = "SELECT * FROM `clients` ORDER BY `id` DESC LIMIT 1"; 
        $query = $this->db->query($sql);

        $return = $query->result_array();

      	return $return;
	}

	public function getIdClient($id) {
		$sql = "SELECT * FROM `clients` WHERE `id` = ? LIMIT 1"; 
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function updateClient ($data) {
		$sql = "UPDATE `clients` SET `name` = ?, `address` = ?, `mail` = ?, `phone` = ?, `nip` = ? WHERE `id` = ?";
		$query = $this->db->query($sql, array($data['name'], $data['address'], $data['mail'], $data['phone'], $data['nip'], $data['id']));

		return true;
	}
	
}
?>