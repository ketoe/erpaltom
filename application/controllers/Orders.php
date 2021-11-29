<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function __construct() {
		parent::__construct();
     if ($this->M_user->log == false) header("location: /");
		$this->load->model('M_orders');
	}

	public function index() {
		$data = array();
		$data['Actual_year'] = $this->config->item('actual_year');
		$data['Years'] = $this->config->item('years');
		$this->load->view('general/top');
		$this->load->view('orders/home',$data);
		$this->load->view('general/bottom');
		$this->session->unset_userdata('new_order');
	}

	public function newOrder ($measure = null) {
		$data['Years'] = $this->config->item('years');
    $data['measure'] = $measure;
		$this->load->view('general/top');
		$this->load->view('orders/newOrder',$data);
		$this->load->view('general/bottom');
	}

	public function addNewOrder() {
		$this->load->model('M_clients');
		$clientId = 0;
		$general_id = $this->M_orders->getOrderLast($_POST['year']);

    if (!isset($_POST['measure'])) {
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
      }

        if (isset($_POST['measure'])) {
          $this->load->model('M_measure');
          $measureId = $_POST['measure'];
          $measure = $this->M_measure->getIdMeasure($measureId);
          $clientId = $measure[0]['client'];
        }

        if (isset($_POST['pcv_white'])) { $pcv_white = 1; }else { $pcv_white = 0; };
        if (isset($_POST['pcv_color'])) { $pcv_color = 1; }else { $pcv_color = 0; };
        if (isset($_POST['aluminium'])) { $aluminium = 1; }else { $aluminium = 0; };
        if (isset($_POST['rolets'])) { $rolets = 1; }else { $rolets = 0; };
        if (isset($_POST['parapets'])) { $parapets = 1; }else { $parapets = 0; };
        if (isset($_POST['glass'])) { $glass = 1; }else { $glass = 0; };

        if (isset($_POST['orderMonter'])) { $orderMonter = 1; }else { $orderMonter = 0; };

        if (!empty($_POST['description'])) { $description = $_POST['description']; }else { $description = ''; };


		$dataNew = array (
            'name' => $general_id[0]['number'].'/'.$_POST['year'],
            'date_create' => date("Y-m-d"),
            'autor' => (int)$this->M_user->id,
            'money' => $_POST['money'],
            'description' => $description,
            'pcv_white' => (int)$pcv_white,
            'pcv_color' => (int)$pcv_color,
            'aluminium' => (int)$aluminium,
            'rolets' => (int)$rolets,
            'parapets' => (int)$parapets,
            'glass' => (int)$glass,
            'week' => (int)$_POST['week'],
            'year' => (int)$_POST['year'],
            'id_general' => (int)$general_id[0]['number'],
            'client' => (int)$clientId,
            'orderMonter' => (int)$orderMonter,
            'anotherElement' => $_POST['anotherElement']
        );

        if ($clientId != 0 && $dataNew['week'] > 0 && $dataNew['year'] > 0 && $dataNew['money'] > 0) {
        	if ($dataNew['client'] > 0) {
        		$return = true;
        	}else {
        		$return = false;
        	}
        }else {
        	$return = false;
        }

        if ($return == true) {
        	$this->M_orders->addOrder($dataNew);
        	$order = $this->M_orders->getOrderLast($_POST['year']);
        	$this->session->set_userdata('new_order', $order[0]['id']);
          if (isset($_POST['measure'])) {
            $orderLast = $this->M_orders->getOrderLastInsert();
            $this->M_measure->updateOrder($_POST['measure'],$orderLast[0]['id']);
          };
       		header("location: /Orders");
        }else {
        	$this->load->view('general/top');
        	$this->load->view('errors/addOrder');
        }
        		
   }

   public function view($id) {
   		$this->load->model('M_users');
   		$this->load->model('M_clients');
   		$this->load->model('M_lacks');
   		$this->load->model('M_fvSale');
   		$this->load->model('M_fvMonter');
   		$this->load->model('M_fvPayment');
   		$this->load->model('M_monters');
   		$this->load->model('M_materials');
      $this->load->model('M_factory');
      $this->load->model('M_measure');
   		$order = $this->M_orders->getIdOrder($id);
   		if (count($order) == 1) {
   			$autor = $this->M_users->getIdUser($order[0]['autor']);
   			$client = $this->M_clients->getIdClient($order[0]['client']);
   			$lacks = $this->M_lacks->getOrderLacks($order[0]['id']);
   			$monter = $this->M_monters->getIdMonter($order[0]['monter']);
        $monters = $this->M_monters->getMonters();
   			$fv_monter = $this->M_fvMonter->getOrderFv($order[0]['id']);
   			$fv_sale = $this->M_fvSale->getOrderFv($order[0]['id']);
   			$fv_payment = $this->M_fvPayment->getOrderFv($order[0]['id']);
   			$materials = $this->M_materials->getOrderMaterials($order[0]['id']);
        $measure = $this->M_measure->getMeasureOrder($order[0]['id']);
        $listMonters = $this->M_monters->getListMontersOrder($order[0]['id']); //lista montaży

   			$data = array();
        $data['id'] = $order[0]['id'];  
   			$data['nameOrder'] = $order[0]['name'];
   			$data['description'] = $order[0]['description'];
   			$data['autor'] = $autor[0]['name']. ' '.$autor[0]['surname'];
   			$data['client'] = $client[0]['name'];
        $data['clientId'] = $client[0]['id'];
   			$data['date_create'] = $order[0]['date_create'];
   			$data['money'] = $order[0]['money'];
   			$data['week'] = $order[0]['week'];
   			$data['year'] = $order[0]['year'];
   			$data['orderMonter'] = $order[0]['orderMonter'];
   			$data['fv_monter'] = $fv_monter;
   			$data['fv_sale'] = $fv_sale;
   			$data['fv_payment'] = $fv_payment;
   			$data['materials'] = $materials;
        $data['monters'] = $monters;
        $data['archive'] = $order[0]['archive'];
        $data['permission'] = $this->M_user->permission;
        $data['usersActive'] = $this->M_users->getUsersActive();
        $data['factory'] = $this->M_factory->getFactory();
        $data['lacksActive'] = $this->M_lacks->getCountLackActiveOrder($order[0]['id']);
        $data['lacks'] = $lacks;
        $data['anotherElement'] = $order[0]['anotherElement'];
        $data['measure'] = $measure;
        $data['listMonters'] = $listMonters;
        $data['countFile'] = 0;

   			(count($monter) > 0) ? $data['monter'] = $monter[0]['name'] : $data['monter'] = 'Brak';
        (count($monter) > 0) ? $data['idMonter'] = $monter[0]['id'] : $data['idMonter'] = 0;
   			($order[0]['pcv_white'] == 1) ? $data['pcv_white'] = $this->config->item('pcv_white') : $data['pcv_white'] = false;
   			($order[0]['pcv_color'] == 1) ? $data['pcv_color'] = $this->config->item('pcv_color') : $data['pcv_color'] = false;
   			($order[0]['aluminium'] == 1) ? $data['aluminium'] = $this->config->item('aluminium') : $data['aluminium'] = false;
   			($order[0]['rolets'] == 1) ? $data['rolets'] = $this->config->item('rolets') : $data['rolets'] = false;
   			($order[0]['parapets'] == 1) ? $data['parapets'] = $this->config->item('parapets') : $data['parapets'] = false;
   			($order[0]['glass'] == 1) ? $data['glass'] = $this->config->item('glass') : $data['glass'] = false;

        if ($dir = @opendir($_SERVER['DOCUMENT_ROOT']."/media/upload/files/".$id."/")) {
        while($file = readdir($dir)) {
          if ($file != '.' && $file != '..') {
              $data['countFile']++;
          }
        }  
         closedir($dir);
       }


   			$this->load->view('general/top');
   			$this->load->view('orders/view',$data);
   		}
   }

	public function getOrdersJson($year) {
		$orders = $this->M_orders->getOrdersAtYear($year);

		echo json_encode($orders);
	}

  public function saveMoney () {
    $this->form_validation->set_rules('money', 'Wartość umowy', 'required');
    if ($this->form_validation->run() == TRUE) {
      $id = $_POST['id'];
      $money = $_POST['money'];
      $this->M_orders->updateMoney($id, $money);

      header("location: /Orders/view/$id");
    }
  }

  public function saveWeek () {
    $this->form_validation->set_rules('week', 'Tydzień realizacji', 'required');
    if ($this->form_validation->run() == TRUE) {
      $id = $_POST['id'];
      $week = $_POST['week'];
      $this->M_orders->updateWeek($id, $week);

      header("location: /Orders/view/$id");
    }
  }

  public function deleteOrder () {
      $id = $_POST['id'];
      $this->M_orders->deleteOrder($id);

      header("location: /Orders");
  }

  public function saveDescription () {
      $description = $_POST['description'];
      $id = $_POST['id'];
      $this->M_orders->updateDescription($id, $description);

      header("location: /Orders/view/$id");
  }
  
  public function addMonter () {
      $monter = $_POST['monter'];
      $id = $_POST['id'];
      $startMonter = $_POST['startMonter'];
      $endMonter = $_POST['endMonter'];
      $description = $_POST['description'];
      $data = array();
      $data['monter'] = $monter;
      $data['id'] = $id;
      $data['startMonter'] = $startMonter;
      $data['endMonter'] = $endMonter;
      $data['description'] = $description;
      $this->M_orders->addMonter($data);

      header("location: /Orders/view/$id");
  }

  public function editUser () {
      $user = $_POST['user'];
      $id = $_POST['id'];
      $this->M_orders->updateUser($id, $user);

      header("location: /Orders/view/$id");
  }



  public function addArchive ($id) {
    $this->M_orders->addArchiveOrder($id);

    header("location: /Orders/view/$id");
  }

  public function UnArchive ($id) {
    if ($this->M_user->permission == 1 || $this->M_user->permission ==  2|| $this->M_user->permission == 3) {
      $this->M_orders->unArchiveOrder($id);

      header("location: /Orders/view/$id");
    }
  }

  public function deleteMonter ($id) {
    $this->load->model('M_monters');
    $monter = $this->M_monters->getIdInstall($id);
    $order = $monter[0]['order'];
    $this->M_monters->deleteIdMonterOrder($id);

    header("location: /Orders/view/$order");
  }

  public function hideDescriptionList() {
    $this->session->set_userdata('viewDescriptionList', FALSE);

    header("location: /Orders");
  }

  public function showDescriptionList() {
    $this->session->set_userdata('viewDescriptionList', true);

    header("location: /Orders");
  }

  public function addFile () {
    $max_rozmiar = 2024*2024;
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
      if ($_FILES['file']['size'] > $max_rozmiar) {
          $data = array();
          $data['error'] = 'Za duży rozmiar pliku';
          $this->load->view('general/top');
          $this->load->view('errors/error',$data);
      } else {
          $src = file_exists($_SERVER['DOCUMENT_ROOT'].'/media/upload/files/'.$_POST['id']);
          if ($src == FALSE) {
            mkdir($_SERVER['DOCUMENT_ROOT'].'/media/upload/files/'.$_POST['id'], 0777);
          };
            move_uploaded_file($_FILES['file']['tmp_name'], 
            $_SERVER['DOCUMENT_ROOT'].'/media/upload/files/'.$_POST['id'].'/'.$_FILES['file']['name']);
            $id = $_POST['id'];
            header("location: /Orders/view/$id");
      }
   } else {
      $data = array();
      $data['error'] = 'Błąd przesyłania pliku';
      $this->load->view('general/top');
      $this->load->view('errors/error',$data);
    }
  }

  public function downloadFile ($order, $file) {
    $filePath = $_SERVER['DOCUMENT_ROOT']."/media/upload/files/".$order."/"; // np: pliki/
    $fileName = $file; // np. program.exe

    $fd = fopen($filePath.$fileName,"r");
    $size = filesize($filePath.$fileName);
    $contents = fread($fd, filesize($filePath.$fileName));

    fclose($fd);

    header("Content-Type: application/octet-stream");
    header("Content-Length: $size;");
    header("Content-Disposition: attachment; filename=$fileName");

    echo $contents;
  }

  public function deleteFile ($order, $file) {
    unlink($_SERVER['DOCUMENT_ROOT']."/media/upload/files/".$order."/".$file);
    header("location: /Orders/view/$order");
  }

  public function editClient ($order) {
    $data = array();
    $data['id'] = $order;

    $this->load->view('general/top');
    $this->load->view('orders/editClient',$data);
  }

  public function saveClient () {
    $order = $_POST['order'];
    $client = $_POST['client'];

    $this->M_orders->saveClient($order, $client);

    header("location: /Orders/view/$order");
  }
}

?>