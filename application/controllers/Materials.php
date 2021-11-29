<?php
class Materials extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('M_materials');
         if ($this->M_user->log == false) header("location: /");
    }

   	public function addMaterial () {
   		$this->form_validation->set_rules('name', 'Nazwa', 'required');
   		$id = $_POST['id'];
   		if(isset($_POST['description'])) { $description = $_POST['description']; }else { $description = ''; };
   		if ($this->form_validation->run() == TRUE) {
   			$data = array (
   				'id' => (int)$_POST['id'],
   				'name' => $_POST['name'],
   				'description' => $description,
   				'factory' => (int)$_POST['factory'],
   				'autor' => (int)$this->M_user->id,
   				'date' => date('Y-m-d')
   			);

   			$this->M_materials->addMaterial($data);

   			header("location: /Orders/view/$id");
   		}
   	}

    public function deleteMaterial($id, $order) {
      if ($this->M_user->permission > 0) {
        $this->M_materials->deleteMaterial($id);

        header("location: /Orders/view/$order");
      };
    }

    public function save () {
      $this->form_validation->set_rules('name', 'Nazwa', 'required');
      if ($this->form_validation->run() == TRUE) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['id'];

        $data = array();
        $data['name'] = $name;
        $data['description'] = $description;
        $data['id'] = $id;

        $this->M_materials->save($data);
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

    public function edit ($id, $order = null) {
      $material = $this->M_materials->getIdMaterial($id);

      $data = array();
      $data['id'] = $id;
      $data['name'] = $material[0]['name'];
      $data['description'] = $material[0]['description'];
      $data['order'] = $order;

      $this->load->view('general/top');
      $this->load->view('materials/edit',$data);
    }
}
?>