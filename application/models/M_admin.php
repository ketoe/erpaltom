<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function updateActualYear ($year) {
		$sql = "UPDATE `settings` SET value = ? WHERE `name` = 'actual_year'";
		$query = $this->db->query($sql, array($year));

		return true;
	}
}
?>