<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_orders extends CI_Model {

	public function getOrderLastInsert() {
		$sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 1"; 
		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function getOrdersAtYear ($year) {
		$sql = "
		SELECT o.*, u.name as autorName, u.surname as autorSurname, c.name as clientName 
		FROM orders as o 
		INNER JOIN users as u ON o.autor = u.id 
		INNER JOIN clients as c ON c.id = o.client 
		WHERE o.year = ?"; 
		$query = $this->db->query($sql, array($year));

		return $query->result_array();
	}
	
	public function addOrder($data) {
		$sql = "INSERT INTO orders (name, date_create, autor, money, pcv_white, pcv_color, aluminium, rolets, parapets, week, year, description, id_general, client, orderMonter, glass, anotherElement) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$query = $this->db->query($sql, 
			array(
				$data['name'],
				$data['date_create'],
				$data['autor'],
				$data['money'],
				$data['pcv_white'],
				$data['pcv_color'],
				$data['aluminium'],
				$data['rolets'],
				$data['parapets'],
				$data['week'],
				$data['year'],
				$data['description'],
				$data['id_general'],
				$data['client'],
				$data['orderMonter'],
				$data['glass'],
				$data['anotherElement']
		));

		return true;
	}

	public function addMonter($data) {
		$sql = "INSERT INTO order_monters (`order`,`monter`,`start`,`end`,`description`) VALUES (?,?,?,?,?)";
		$query = $this->db->query($sql, 
			array(
				$data['id'],
				$data['monter'],
				$data['startMonter'],
				$data['endMonter'],
				$data['description']
				
		));

		return true;
	}

	public function getOrderLast($year) { //ostatnio dodane zlecenie z danego roku
		$sql = "SELECT (CASE WHEN count(*)=0 THEN 1 ELSE max(id_general)+1 END) as number, id FROM orders WHERE year = ? ORDER BY id_general DESC "; 
        $query = $this->db->query($sql, array((int) $year));

        return $query->result_array();
	}

	public function getIdOrder($id) {
		$sql = "SELECT * FROM `orders` WHERE `id` = ?"; 
		$query = $this->db->query($sql, array($id));

		return $query->result_array();
	}

	public function updateMoney ($id, $money) {
		$sql = "UPDATE orders SET money = ? WHERE id = ?";
		$query = $this->db->query($sql, array($money, $id));

		return true;
	}

	public function updateDescription ($id, $description) {
		$sql = "UPDATE orders SET description = ? WHERE id = ?";
		$query = $this->db->query($sql, array($description, $id));

		return true;
	}

	public function updateMonter ($id, $monter) {
		$sql = "UPDATE orders SET monter = ? WHERE id = ?";
		$query = $this->db->query($sql, array($monter, $id));

		return true;
	}

	public function updateUser ($id, $user) {
		$sql = "UPDATE orders SET autor = ? WHERE id = ?";
		$query = $this->db->query($sql, array($user, $id));

		return true;
	}

	public function updateWeek ($id, $week) {
		$sql = "UPDATE orders SET week = ? WHERE id = ?";
		$query = $this->db->query($sql, array($week, $id));

		return true;
	}
	
	public function updateDateMonter ($id, $dateMonter) {
		$sql = "UPDATE orders SET dateMonter = ? WHERE id = ?";
		$query = $this->db->query($sql, array($dateMonter, $id));

		return true;
	}

	public function updateEndDateMonter ($id, $endDateMonter) {
		$sql = "UPDATE orders SET endMonter = ? WHERE id = ?";
		$query = $this->db->query($sql, array($endDateMonter, $id));

		return true;
	}

	public function addArchiveOrder ($id) {
		$sql = "UPDATE orders SET archive = 1 WHERE id = ?";
		$query = $this->db->query($sql, array($id));

		return true;
	}

	public function unArchiveOrder ($id) {
		$sql = "UPDATE orders SET archive = 0 WHERE id = ?";
		$query = $this->db->query($sql, array($id));

		return true;
	}

	public function saveClient ($order, $client) {
		$sql = "UPDATE orders SET client = ? WHERE id = ?";
		$query = $this->db->query($sql, array($client, $order));

		return true;
	}

	public function deleteOrder ($id) {
		$sql = "DELETE FROM orders WHERE id = ? LIMIT 1";
		$query = $this->db->query($sql, array($id));

		$sql2 = "DELETE FROM fv_monter WHERE `order` = ?";
		$query2 = $this->db->query($sql2, array($id));

		$sql3 = "DELETE FROM fv_payment WHERE `order` = ?";
		$query3 = $this->db->query($sql3, array($id));

		$sql4 = "DELETE FROM fv_sale WHERE `order` = ?";
		$query4 = $this->db->query($sql4, array($id));

		$sql5 = "DELETE FROM lack WHERE `order` = ?";
		$query5 = $this->db->query($sql5, array($id));

		$sql6 = "DELETE FROM materials WHERE `order` = ?";
		$query6 = $this->db->query($sql6, array($id));

		return true;
	}

	public function getOrdersWeek($year, $startWeek, $endWeek) {
		$sql = "SELECT o.*, u.name as autorName, u.surname as autorSurname, c.name as clientName FROM orders as o INNER JOIN users as u ON o.autor = u.id INNER JOIN clients as c ON c.id = o.client WHERE o.year = ? AND o.week >= ? AND o.week <= ?"; 
		$query = $this->db->query($sql, array($year, $startWeek, $endWeek));

		return $query->result_array();
	}

}
?>