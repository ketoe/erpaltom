<?php
class Factory extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('M_factory');
        if ($this->M_user->log == false) header("location: /");
    }

    public function index () {
    	$this->load->view('general/top');
		$this->load->view('factory');
    }
}
?>