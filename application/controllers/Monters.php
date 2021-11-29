<?php
class Monters extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('M_monters');
         if ($this->M_user->log == false) header("location: /");
    }

    public function index ($startDateGet = false) {
        $data = array();
        $data['monters'] = $this->M_monters->getMonters();
        $data['actualWeek'] = date("d");
        if ($startDateGet != false) {
            $data['startDateGet'] = $startDateGet;
        }else {
            $data['startDateGet'] = false;
        }
        $data['dd'] = 24; //pażysta liczba dni do wyświetlenia (zakres)
		$this->load->view('general/top');
        $this->load->view('monters/home',$data);
    }
	
	public function addMonter () {
    	$this->form_validation->set_rules('name', 'Nazwa', 'required');
		if ($this->form_validation->run() == TRUE) {
			$name = $_POST['name'];
			$contact = $_POST['contact'];
			$mail = $_POST['mail'];
			$data = array (
				'name' => $name,
				'contact' => $contact,
				'mail' => $mail
			);

			$this->M_monters->addMonter($data);

			header("location: /Monters/getMonters");
		}
    }

    public function editMonter ($id) {
    	$monter = $this->M_monters->getIdMonter($id);
    	$data = array();
    	$data['Monter'] = $monter;
    	$this->load->view('general/top');
    	$this->load->view('monters/editMonter',$data);
    }

    public function getMonters() { //Lista montażystów do edycji - admin
    	$data = array();
		$data['Monters'] = $this->M_monters->getMonters();
    	$this->load->view('general/top');
		$this->load->view('monters/listMonters',$data);
    }

    public function allMonters() {
        $data = array();
        $data['Monters'] = $data['Monters'] = $this->M_monters->getMonters();
        $this->load->view('general/top');
        $this->load->view('monters/allMonters',$data);
        

    }

    public function deleteMonter ($id) {
    	$this->M_monters->deleteMonter($id);

    	header("location: /Monters/getMonters");
    }

    public function saveMonter () {
    	$id = $_POST['id'];
    	$name = $_POST['name'];
    	$contact = $_POST['contact'];
    	$mail = $_POST['mail'];
    	$data = array();
    	$data['id'] = $id;
    	$data['name'] = $name;
    	$data['contact'] = $contact;
    	$data['mail'] = $mail;
    	$this->M_monters->updateMonter($data);

    	header("location: /Monters/getMonters");
    }

    public function sendMailMonter($idMonter, $idOrder) {
        $this->load->library('email');
        $this->load->model('M_orders');
        $monter = $this->M_monters->getIdMonter($idMonter);
        $order = $this->M_orders->getIdOrder($idOrder);

        $this->email->from('system@altom-okna.pl', 'Altom ERP');
        $this->email->to($monter[0]['mail']); 
        $this->email->subject('Montaż - '.$order[0]['name']);
        $message = 'Dzień Dobry.<br /> Przypominamy o montażu zlecenia: '.$order[0]['name'].'<br />';
        $message .= 'Montaż w dniach: '.$order[0]['dateMonter']. ' - '.$order[0]['endMonter'];
        $message .= '<br /><br />Wiadomość wygenerowana automatycznie.<br /><br />';
        $message .= '<img src="http://crm.altom-okna.pl/media/img/footerMail.jpg" style="width: 600px; height: 100px;">';
        $this->email->message($message);  
        $this->email->send();

        header("location: /Orders/view/$idOrder");
    }


}
?>