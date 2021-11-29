<?php
class Admin extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('M_admin');
        
        
        if ($this->M_user->log == false) header("location: /");
    }

	public function index() {
		if ($this->M_user->permission == 1 || $this->M_user->permission == 2 || $this->M_user->permission == 3) {
			$data = array (
				'permission' => $this->M_user->permission
			);
			$this->load->view('general/top');
			$this->load->view('admin/home',$data);
		}else {
			$this->load->view('general/top');
			$this->load->view('errors/errorPermission');
		};
	}

	public function system () {
		if ($this->M_user->permission == 2 || $this->M_user->permission == 3) {
			$data = array (
				'permission' => $this->M_user->permission,
				'year' => $this->config->item('actual_year')
			);
			$this->load->view('general/top');
			$this->load->view('admin/system',$data);
		}else {
			$this->load->view('general/top');
			$this->load->view('errors/errorPermission');
		}
	}
	
	//----------
	
	public function getFactory() {
		if ($this->M_user->permission == 1 || $this->M_user->permission == 2 || $this->M_user->permission == 3) {
			$this->load->model('M_factory');
			$data = array (
				'Factory' => $this->M_factory->getFactory()
			);

			$this->load->view('general/top');
			$this->load->view('admin/factory',$data);
		}
	}
	
	public function addFactory() {
		$this->load->model('M_factory');
		$this->form_validation->set_rules('name', 'Nazwa', 'required');
   		if ($this->form_validation->run() == TRUE) {
   			$data = array (
   				'name' => $_POST['name'],
   			);

   			$this->M_factory->addFactory($data);

   			header("location: /Admin/getFactory");
   		}
	}

	public function getUsers() {
		$this->load->model('M_users');
		$data = array (
			'Users' => $this->M_users->getUsers(),
			'dataPermission' => $this->M_user->dataPermission
		);
		$this->load->view('general/top');
		$this->load->view('admin/users',$data);
	}

	public function editPermission ($user, $permission) {
		$this->load->model('M_users');

		$this->M_users->editPermission($user, $permission);
		header("location: /Admin/getUsers");
	}

	public function activeUser ($user) {
		$this->load->model('M_users');
		$this->M_users->editActive($user, 1);
		header("location: /Admin/getUsers");
	}

	public function unActiveUser ($user) {
		$this->load->model('M_users');
		$this->M_users->editActive($user, 0);
		header("location: /Admin/getUsers");
	}

	public function deleteFvMonter($id, $order) {
      if ($this->M_user->permission > 0) {
        $this->M_fv->deleteFvMonter($id);

        header("location: /Orders/view/$order");
      };
    }

    public function deleteFvPayment($id, $order) {
      if ($this->M_user->permission > 0) {
        $this->M_fv->deleteFvPayment($id);

        header("location: /Orders/view/$order");
      };
    }

    public function deleteFvSale($id, $order) {
      if ($this->M_user->permission > 0) {
        $this->M_fv->deleteFvSale($id);

        header("location: /Orders/view/$order");
      };
    }

    public function deleteMaterial($id, $order) {
    	$this->load->model('M_materials');
      if ($this->M_user->permission > 0) {
        $this->M_materials->deleteMaterial($id);

        header("location: /Orders/view/$order");
      };
    }

    public function updateActualYear() {
    	if($this->M_user->permission == 2 || $this->M_user->permission == 3) {
    		if (isset($_POST['year'])) {
    			$this->M_admin->updateActualYear($_POST['year']);
    			header("location: /Admin/system");
    		}
    	}
    }
}
?>
