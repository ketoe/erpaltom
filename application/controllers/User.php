<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
	}

	 public function getAuth() {
	 	$this->form_validation->set_rules('login', 'Hasło', 'required');
	 	$this->form_validation->set_rules('password', 'Hasło', 'required');
	 	if ($this->form_validation->run()) {
	 		$login = $_POST['login'];
	 		$password = $_POST['password'];
	 		$data = array('login' => $login, 'password' => $password);
	 		$log = $this->M_user->getAuth($data);
	 		$this->M_user->getLog();
	 		if ($log) {
	 			if ($this->M_user->active == 1) {
	 				header("location: /");
	 			}else {
	 				echo 'Błąd logowania. <br /><a href="/">Powrót</a>';
	 			}
	 		}else {
	 			echo 'Błąd logowania. <Br /><a href="/">Powrót</a>';
	 		}
	 	}else {
	 		echo 'Błąd logowania. <Br /><a href="/">Powrót</a>';
	 	}
	 }

	 public function logOut() {
	 	$this->session->sess_destroy();
	 	header("location: /");
	 }
}

?>