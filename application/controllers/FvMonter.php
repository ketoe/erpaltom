<?php
class FvMonter extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('M_fvMonter');
         if ($this->M_user->log == false) header("location: /");
    }

    public function addFvMonter () {
    	$this->form_validation->set_rules('name', 'Nazwa', 'required');
    	$this->form_validation->set_rules('money', 'Wartość', 'required');
      $id = $_POST['id'];
    	if ($this->form_validation->run() == TRUE) {
    		$data = array (
   				'id' => (int)$_POST['id'],
   				'name' => $_POST['name'],
   				'description' => $_POST['description'],
   				'autor' => (int)$this->M_user->id,
   				'date' => date('Y-m-d'),
   				'money' => $_POST['money']
   			);

   			$this->M_fvMonter->addFvMonter($data);

   			header("location: /Orders/view/$id");
   		};
   	}

    public function deleteFvMonter($id, $order) {
      if ($this->M_user->permission > 0) {
        $this->M_fvMonter->deleteFvMonter($id);

        header("location: /Orders/view/$order");
      };
    }

    public function edit ($id, $order = null) {
      $fv = $this->M_fvMonter->getIdFvMonter($id);

      $data = array();
      $data['id'] = $id;
      $data['name'] = $fv[0]['name'];
      $data['description'] = $fv[0]['description'];
      $data['money'] = $fv[0]['money'];
      $data['order'] = $order;

      $this->load->view('general/top');
      $this->load->view('fvMonter/edit',$data);
    }

    public function save () {
      $this->form_validation->set_rules('name', 'Nazwa', 'required');
      $this->form_validation->set_rules('money', 'Wartość', 'required');

      if ($this->form_validation->run() == TRUE) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $money = $_POST['money'];
        $id = $_POST['id'];

        $data = array();
        $data['name'] = $name;
        $data['description'] = $description;
        $data['money'] = $money;
        $data['id'] = $id;

        $this->M_fvMonter->save($data);
        if ($_POST['order'] != null) {
          $order = $_POST['order'];
          header("location: /Orders/view/$order");
        }else {
          header("location: /Orders");
        }
      }else {
        $data = array();
        $data['error'] = 'Błąd zapisu';
        $this->load->view('general/top');
        $this->load->view('errors/error',$data);
      }
    }



}

?>