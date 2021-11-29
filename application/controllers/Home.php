<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {
		if ($this->M_user->log) {
			$this->load->view('general/top');
			$this->load->view('home');
			$this->load->view('general/bottom');
		}else {
			$this->load->view('login/form');
		}
	}
}

?>