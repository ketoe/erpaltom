<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

	public function __construct() {
		parent::__construct();
		 if ($this->M_user->log == false) header("location: /");
		$this->load->model('M_clients');
	}

	public function index () {
		$this->load->view('general/top');
		$this->load->view('clients/home');
	}

	public function getClientsJson() {
		$clients = $this->M_clients->getClients();

		echo json_encode($clients);
	}

	public function edit ($client) {
		$client = $this->M_clients->getIdClient($client);

		$data = array();
		$data['id'] = $client[0]['id'];
		$data['name'] = $client[0]['name'];
		$data['address'] = $client[0]['address'];
		$data['mail'] = $client[0]['mail'];
		$data['nip'] = $client[0]['nip'];
		$data['phone'] = $client[0]['phone'];

		$this->load->view('general/top');
		$this->load->view('clients/edit',$data);
	}

	public function saveClient () {
		$this->form_validation->set_rules('name', 'Nazwa', 'required');
   		if ($this->form_validation->run() == TRUE) {
      		$name = $_POST['name'];
      		$address = $_POST['address'];
      		$mail = $_POST['mail'];
      		$phone = $_POST['phone'];
      		$nip = $_POST['nip'];
      		$id = $_POST['id'];

      		$data = array();
      		$data['name'] = $name;
      		$data['address'] = $address;
      		$data['mail'] = $mail;
      		$data['phone'] = $phone;
      		$data['nip'] = $nip;
      		$data['id'] = $id;

      		$this->M_clients->updateClient($data);

      		header("location: /Clients");
    	}
	}

	public function newClient () {
		$this->load->view('general/top');
		$this->load->view('clients/newClient');
	}

	public function addClient () {
		$this->form_validation->set_rules('name', 'Nazwa', 'required');
   		if ($this->form_validation->run() == TRUE) {
      		$name = $_POST['name'];
      		$address = $_POST['address'];
      		$mail = $_POST['mail'];
      		$phone = $_POST['phone'];
      		$nip = $_POST['nip'];

      		$data = array();
      		$data['name'] = $name;
      		$data['address'] = $address;
      		$data['mail'] = $mail;
      		$data['phone'] = $phone;
      		$data['nip'] = $nip;

      		$this->M_clients->addNewClientFullDate($data);

      		header("location: /Clients");
    	}

	}
}
?>
