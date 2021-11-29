<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Measure extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->M_user->log == false) header("location: /");
		$this->load->model('M_measure');
	}

	public function index () {
		$data['measureActual'] = $this->M_measure->getMeasureActual();
		$this->load->view('general/top');
		$this->load->view('measure/home',$data);
	}

	public function delete ($id) {
		$this->M_measure->deleteMeasure($id);

		header("Location: /Measure");
	}

	public function archive () {
		if (isset($_POST['mounth_start'])) {
      		$data['Actual_year'] = (int)$_POST['year'];
      		$data['Years'] = $this->config->item('years');
      		$data['start'] = $data['Actual_year'].'-'.$_POST['mounth_start'].'-01';
      		$data['end'] = $data['Actual_year'].'-'.$_POST['mounth_end'].'-31';
    	}else {
      		$data['Actual_year'] = $this->config->item('actual_year');
      		$data['Years'] = $this->config->item('years');
      		$data['start'] = $data['Actual_year'].'-01-01';
      		$data['end'] = $data['Actual_year'].'-12-31';
    	}
			
        $data['measureArchive'] = $this->M_measure->getMeasureDate($data['start'], $data['end']);
		$this->load->view('general/top');
		$this->load->view('measure/archive',$data);
	}

	public function newMeasure() {
		$this->load->view('general/top');
		$this->load->view('measure/newMeasure');
	}

	public function addMeasure () {
		$this->load->model('M_clients');
		$this->form_validation->set_rules('address', 'Adres pomiaru', 'required');
		$this->form_validation->set_rules('date_measure', 'Data pomiaru', 'required');

    	if ($this->form_validation->run() == TRUE) {
    		$address = $_POST['address'];
    		$contact = $_POST['contact'];
    		$mail = $_POST['mail'];
    		$date_measure = $_POST['date_measure'];
    		$autor = $this->M_user->id;
    		$description = $_POST['description'];
    		$order = 0;

    		if (!empty($_POST['new_client'])) {
           		$newClient = $this->M_clients->addNewClient($_POST['nameClient']);
            	$client = $this->M_clients->lastInsertClient();
           		$clientId = (int)$client[0]['id'];
        	}else {
        		if (isset($_POST['clientId'])) {
            		$clientId = $_POST['clientId'];
            	}else {
            		$clientId = 0;
            	}
        	}

    		$data = array (
    			'address' => $address,
    			'contact' => $contact,
    			'mail' => $mail,
    			'date_measure' => $date_measure,
    			'autor' => $autor,
    			'description' => $description,
    			'client' => (int)$clientId,
    			'order' => (int)$order
    		);

    		$this->M_measure->addMeasure($data);

    		header("location: /Measure");
		}
	}

	public function saveMeasureOrder () {
		$this->load->model('M_clients');
		$this->form_validation->set_rules('address', 'Adres pomiaru', 'required');
		$this->form_validation->set_rules('date_measure', 'Data pomiaru', 'required');

    	if ($this->form_validation->run() == TRUE) {
    		$address = $_POST['address'];
    		$contact = $_POST['contact'];
    		$mail = $_POST['mail'];
    		$date_measure = $_POST['date_measure'];
    		$autor = $this->M_user->id;
    		$description = $_POST['description'];
    		$order = $_POST['order'];
    		$client = $_POST['client'];

    		$data = array (
    			'address' => $address,
    			'contact' => $contact,
    			'mail' => $mail,
    			'date_measure' => $date_measure,
    			'autor' => $autor,
    			'description' => $description,
    			'client' => (int)$client,
    			'order' => (int)$order
    		);

    		$this->M_measure->addMeasure($data);

    		header("location: /Orders/view/$order");
		};
	}

    public function printMeasure ($id) {
        $this->load->model('M_clients');
        $this->load->model('M_users');
        $measure = $this->M_measure->getMeasureId($id);
        $client = $this->M_clients->getIdClient($measure[0]['client']);
        $autor = $this->M_users->getIdUser($measure[0]['autor']);
        $data = array();
        $data['id'] = $measure[0]['id'];
        $data['address'] = $measure[0]['address'];
        $data['phone'] = $measure[0]['contact'];
        $data['mail'] = $measure[0]['mail'];
        $data['date'] = $measure[0]['date_measure'];
        $data['description'] = $measure[0]['description'];
        $data['client'] = $client[0]['name'];
        $data['name'] = $autor[0]['name'];
        $data['surname'] = $autor[0]['surname'];

        $this->load->view('general/topPrint');
        $this->load->view('print/measure',$data);
    }
}


?>