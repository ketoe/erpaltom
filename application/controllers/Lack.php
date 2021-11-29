<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lack extends CI_Controller {

	public function __construct() {
		parent::__construct();
     if ($this->M_user->log == false) header("location: /");
		$this->load->model('M_lacks');
		$this->load->model('M_orders');
	}

  public function index() {
    $data = array();

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
    $data['Lack'] = $this->M_lacks->getLackDate($data['start'], $data['end']);
    $this->load->view('general/top');
    $this->load->view('lack/home',$data);
  }

	public function unActive ($id, $order = null) {
      $this->M_lacks->unActive($id);

      if ($order == null) {
        header("location: /Lack");
      }else {
        header("location: /Orders/view/$order");
      }
  }

  public function addActive ($id, $order = null) {
      $this->M_lacks->addActive($id);

      if ($order == null) {
        header("location: /Lack");
      }else {
        header("location: /Orders/view/$order");
      }
  }

  public function deleteLack ($id, $order = null) {
      $this->M_lacks->deleteLack($id);

    if ($order == null) {
      header("location: /Lack");
    }else {
      header("location: /Orders/view/$order");
    }
  }

   	public function addLack () {
   		$this->form_validation->set_rules('description', 'Opis', 'required');
   		$id = $_POST['id'];
      $radio = $_POST['inside'];

      if ($radio == 1) {
        $inside = 1;
        $outside = 0;
      }else {
        $inside = 0;
        $outside = 1;
      };

      $order = $this->M_orders->getIdOrder($id); //dane zlecenia
      $lackCount = $this->M_lacks->getCountLackOrder($id); //ile dotychczas kart braków

      $name = ($lackCount+1).'/'.$order[0]['name'];
   		$description = $_POST['description'];
   		if ($this->form_validation->run() == TRUE) {
   			$data = array (
   				'order' => (int)$id,
   				'name' => $name,
   				'description' => $description,
   				'date' => date('Y-m-d'),
          'autor' => $this->M_user->id,
          'inside' => (int)$inside,
          'outside' => (int)$outside
   			);

   			$this->M_lacks->addLack($data);

   			header("location: /Orders/view/$id");
   		}
   	}

    public function printIdLack ($id) {
      $lack = $this->M_lacks->getLackId($id);
      $order = $this->M_orders->getIdOrder($lack[0]['order']);
      $data = array();
      $data['lackName'] = $lack[0]['name'];
      $data['orderName'] = $order[0]['name'];
      $data['date'] = $lack[0]['date'];
      $data['autorName'] = $lack[0]['autorName'];
      $data['autorSurname'] = $lack[0]['autorSurname'];
      $data['description'] = $lack[0]['description'];

      $this->load->view('general/topPrint');
      $this->load->view('print/lack',$data);
    }

    public function printLacks($start, $end) {
      $data['Lack'] = $this->M_lacks->getLackDate($start, $end);
      $this->load->view('general/topPrint');
      $this->load->view('print/listLack',$data);
    }

    public function edit ($id) {
      $lack = $this->M_lacks->getLackId($id);
      $order = $this->M_orders->getIdOrder($lack[0]['order']);

      $data = array();
      $data['id'] = $lack[0]['id'];
      $data['name'] = $lack[0]['name'];
      $data['nameOrder'] = $order[0]['name'];
      $data['description'] = $lack[0]['description'];

      $this->load->view('general/top');
      $this->load->view('lack/edit',$data);
    }

    public function save () {
      $id = $_POST['id'];
      $data = array();
      $data['id'] = $id;
      $data['description'] = $_POST['description'];
      $this->M_lacks->save($data);

      header("location: /Lack");

    }
}
?>
