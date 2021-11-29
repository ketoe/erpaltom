<?php
class WarehouseRoto extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('M_warehouseRoto');
        
        if ($this->M_user->log == false) header("location: /");
    }

    public function index () {
    	$data = array();
    	$this->load->view('general/top');
    	$this->load->view('warehouseRoto/home',$data);
    }

    public function listZamRoto() {
		$zam = $this->M_warehouseRoto->getZamRoto();
		$data = array();
		$data['zam'] = $zam;
		
		$this->load->view('general/top');
		$this->load->view('warehouseRoto/listZam',$data);
	}
	
	public function viewZam ($id) {
		$zam = $this->M_warehouseRoto->getIdZam($id);
		$articles = $this->M_warehouseRoto->getZamArticleZam($id);
		
		$data = array();
		$data['articles'] = $articles;
		$data['name'] = $zam[0]['name'];
		
		$this->load->view('general/top');
		$this->load->view('warehouseroto/viewZam',$data);
	}
	
    public function getWarehouseJson () {
		$article = $this->M_warehouseRoto->getArticles(); //cały magazyn
    	echo json_encode($article);
    }

    public function delete ($id) {
    	$this->M_warehouseRoto->deleteArticle($id);

    	header("location: /WarehouseRoto");
    }

    public function addArticle () {
    	$this->form_validation->set_rules('name', 'Nazwa', 'required');
    	$this->form_validation->set_rules('sap', 'Oznaczenie', 'required');
    	$this->form_validation->set_rules('value', 'Ilość', 'required');
    	$this->form_validation->set_rules('pack', 'paczkowanie', 'required');
    	if ($this->form_validation->run() == TRUE) {
    		$name = $_POST['name'];
    		$sap = $_POST['sap'];
   			$value = $_POST['value'];
   			$pack = $_POST['pack'];
    		$spr = $this->M_warehouseRoto->getCodeArticle($sap);
    		if (count($spr) == 0) {
    			$data = array();
    			$data['name'] = $name;
    			$data['sap'] = $sap;
    			$data['pack'] = $pack;
    			$data['value'] = $value;
    			$this->M_warehouseRoto->addArticle($data);
    			header("location: /WarehouseRoto");
    		}else {
    			$data['error'] = 'Artykuł o podanym indeksie już istnieje';
    			$this->load->view('general/top');
    			$this->load->view('errors/error',$data);
    		}
    	}else {
    		$data['error'] = 'Błąd tworzenia artykułu';
    		$this->load->view('general/top');
    		$this->load->view('errors/error',$data);
    	}
    }

    public function edit ($id) {
    	$article = $this->M_warehouseRoto->getIdArticle($id);

    	$data = array();
    	$data['name'] = $article[0]['name'];
    	$data['sap'] = $article[0]['sap'];
    	$data['value'] = $article[0]['value'];
    	$data['id'] = $article[0]['id'];
    	$data['pack'] = $article[0]['pack'];

    	$this->load->view('general/top');
    	$this->load->view('warehouseRoto/edit',$data);
    }

    public function save () {
    	 $this->form_validation->set_rules('name', 'Nazwa', 'required');
    	 $this->form_validation->set_rules('sap', 'Oznaczenie', 'required');
    	 $this->form_validation->set_rules('value', 'Ilość', 'required');
    	 $this->form_validation->set_rules('pack', 'paczkowanie', 'required');
   		 if ($this->form_validation->run() == TRUE) {
   		 	$name = $_POST['name'];
   		 	$sap = $_POST['sap'];
   		 	$value = $_POST['value'];
   		 	$pack = $_POST['pack'];
   			$data = array();
   			$data['name'] = $name;
   			$data['sap'] = $sap;
   			$data['value'] = (int)$value;
   			$data['pack'] = (int)$pack;
   			$data['id'] = $_POST['id'];
      		$this->M_warehouseRoto->updateArticle($data);

      		header("location: /WarehouseRoto");
      	}
    }

    public function addAutomaticZamRoto () { //tworzenie zamówienia na podstawie pliku CSV
    	move_uploaded_file($_FILES['fileZam']['tmp_name'],
        $_SERVER['DOCUMENT_ROOT'].'/media/upload/'.$_FILES['fileZam']['name']);
        $doc = $_SERVER['DOCUMENT_ROOT'].'/media/upload/'.$_FILES['fileZam']['name'];

        $this->form_validation->set_rules('name', 'Nazwa', 'required');

        if ($this->form_validation->run() == TRUE) {

            $nameZam = $_POST['name'];
            $this->M_warehouseRoto->addZamRoto($nameZam, date("Y-m-d"), $this->M_user->id);
            $lastZam = $this->M_warehouseRoto->getZamRoto();

            $uchwyt = fopen ($doc,"r");
            $tekst = trim(fread($uchwyt,1000000));
            $tekst = str_replace(" ","",$tekst); //usuwanie spacji;

            $article = explode(";",$tekst);
            $tab = array(); //tablica z danymi [0] - nr sap [1] - ilość
            for ($i = 0; $i < count($article); $i++) {
                $tt = explode(",",$article[$i]);
                $tab[$i] = $tt;
            }

            $zam = array(); //zamówienie w formie tablicy
      
            for ($i = 0; $i < count($tab)-1; $i++) {

            $mag = $this->M_warehouseRoto->getCodeArticle($tab[$i][0]);
            
            if (count($mag) == 0) { //gdy nie ma artykułu w magazynie
                $data = array();
                $data['id_zam'] = $lastZam[0]['id'];
                $data['article'] = $tab[$i][0];
                $data['value'] = $tab[$i][1];
                $this->M_warehouseRoto->addArticleZam($data);
            }elseif ($mag[0]['pack'] == 0) { //gdy paczkowanie = 0;
                    $data['id_zam'] = $lastZam[0]['id'];
                    $data['article'] = $tab[$i][0];
                    $data['value'] = $tab[$i][1];
                    $this->M_warehouseRoto->addArticleZam($data);
            }elseif ($mag[0]['value'] >= $tab[$i][1]) {
                    $newValue = (int)$mag[0]['value'] - (int)$tab[$i][1];
                    $this->M_warehouseRoto->updateValueArticle($mag[0]['id'], $newValue);
                }elseif ($mag[0]['value'] < $tab[$i][1]) {
                    $data = array();
                    $valueZam = (int)$tab[$i][1] - (int)$mag[0]['value'];
                    $valueZamPack = $this->M_warehouseRoto->zaokrWGore($valueZam, $mag[0]['pack']);
                    $reszta = (int)$valueZamPack - (int)$valueZam;

                    $data['id_zam'] = $lastZam[0]['id'];
                    $data['article'] = $tab[$i][0];
                    $data['value'] = $valueZamPack;
                    $this->M_warehouseRoto->updateValueArticle($mag[0]['id'], $reszta);
                    $this->M_warehouseRoto->addArticleZam($data);
                }
            }

            $id = $lastZam[0]['id'];
            header("location: /WarehouseRoto/viewZam/$id");
        }
    }

      
 }
 ?>