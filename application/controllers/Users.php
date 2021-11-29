<?php
class Users extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('M_users');
        if ($this->M_user->log == false) header("location: /");
    }


	public function getUsersJson () { //generowanie listy użytkowników do JSON
		$Users = $this->M_users->getUsers();

		echo json_encode($Users);
	}
}
?>
