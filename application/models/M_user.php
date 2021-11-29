<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public $id = 0;
	public $login = null;
	public $password = null;
	public $name = null;
	public $surname = null;
	public $permission = 0;
	public $active = 0;
	public $log = FALSE;
	public $nrEdi = 0;

	public $dataPermission = array (
      array ('id' => 0, 'name' => 'Użytkownik'),
      array ('id' => 1, 'name' => 'Moderator'),
      array ('id' => 2, 'name' => 'Admin'),
      array ('id' => 3, 'name' => 'SYSTEM')
    );

	public function __construct() {
		parent::__construct();
		$this->getLog();
		$this->getActualYear();
	}

	public function getLog () { //logowanie użytkownika
		if ($this->session->userdata('user_id') > 0) {
			$user_id = $this->session->userdata('user_id');
			$user_login = $this->session->userdata('user_login');
			$user_password = $this->session->userdata('user_password');

			$sql = "SELECT * FROM users WHERE id = ? AND login = ? AND password = ? LIMIT 1";
			$query = $this->db->query($sql, array($user_id, $user_login, $user_password));
			$return = $query->result_array();

			if (count($return) == 1) {
				$this->id = $return[0]['id'];
				$this->login = $return[0]['login'];
				$this->password = $return[0]['password'];
				$this->name = $return[0]['name'];
				$this->surname = $return[0]['surname'];
				$this->log = TRUE;
				$this->permission = $return[0]['permission'];
				$this->active = $return[0]['active'];
				$this->nrEdi = $return[0]['nrEdi'];
			}
		}
	}

	public function getAuth($data) {
		$sql = "SELECT * FROM users WHERE login = ? AND password = ? LIMIT 1";
		$query = $this->db->query($sql, array($data['login'],md5($data['password'])));
		$return = $query->result_array();

		if (count($return) == 1) {
			$this->session->set_userdata('user_id',$return[0]['id']);
			$this->session->set_userdata('user_login',$return[0]['login']);
			$this->session->set_userdata('user_password',$return[0]['password']);
			
			return true;
		}else {
			return false;
		}
	}

	public function getActualYear () {
		$sql = "SELECT * FROM settings WHERE name = ? LIMIT 1";
		$query = $this->db->query($sql, array('actual_year'));
		$return = $query->result_array();

		if (count($return) == 1) {
			$this->config->set_item('actual_year', $return[0]['value']);
		}

		return $return[0]['value'];
	}

}
?>