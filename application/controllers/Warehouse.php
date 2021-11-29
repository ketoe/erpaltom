<?php
class Warehouse extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('M_warehouse');
        
        if ($this->M_user->log == false) header("location: /");
    }

    public function index () {
    	$ordersAluprof = $this->M_warehouse->getOrdersAluprofMounth(date('m'), date('Y'));
    	$nameZam = $this->M_warehouse->createNameZamAluprof(count($ordersAluprof));
    	$date = array();
    	$date['nameZam'] = $nameZam;
    	$this->load->view('general/top');
    	$this->load->view('warehouse/home',$date);
    }
	
	public function listZamAluprof() {
		$zam = $this->M_warehouse->getZamAluprof();
		$data = array();
		$data['zam'] = $zam;
		
		$this->load->view('general/top');
		$this->load->view('warehouse/listZam',$data);
	}
	
	public function viewZam ($id) {
		$zam = $this->M_warehouse->getIdZam($id);
		$articles = $this->M_warehouse->getZamArticleZam($id);
		
		$data = array();
		$data['articles'] = $articles;
		$data['name'] = $zam[0]['name'];
		
		$this->load->view('general/top');
		$this->load->view('warehouse/viewZam',$data);
	}
	
    public function getWarehouseJson () {
		$article = $this->M_warehouse->getArticles(); //cały magazyn
    	echo json_encode($article);
    }

    public function delete ($id) {
    	$this->M_warehouse->deleteArticle($id);

    	header("location: /Warehouse");
    }

    public function addArticle () {
    	$this->form_validation->set_rules('name', 'Nazwa', 'required');
    	$this->form_validation->set_rules('code', 'Oznaczenie', 'required');
    	$this->form_validation->set_rules('value', 'Ilość', 'required');
    	if ($this->form_validation->run() == TRUE) {
    		$name = $_POST['name'];
    		$code = $_POST['code'];
    		$jm = $_POST['jm'];
   			$value = $_POST['value'];
    		$spr = $this->M_warehouse->getCodeArticle($code);
    		if (count($spr) == 0) {
    			$data = array();
    			$data['name'] = $name;
    			$data['code'] = $code;
    			$data['jm'] = $jm;
    			$data['value'] = $value;
    			$this->M_warehouse->addArticle($data);
    			header("location: /Warehouse");
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
    	$article = $this->M_warehouse->getIdArticle($id);

    	$data = array();
    	$data['name'] = $article[0]['name'];
    	$data['code'] = $article[0]['code'];
    	$data['value'] = $article[0]['value'];
    	$data['id'] = $article[0]['id'];

    	$this->load->view('general/top');
    	$this->load->view('warehouse/edit',$data);
    }

    public function save () {
    	 $this->form_validation->set_rules('name', 'Nazwa', 'required');
    	 $this->form_validation->set_rules('code', 'Oznaczenie', 'required');
    	 $this->form_validation->set_rules('value', 'Ilość', 'required');
   		 if ($this->form_validation->run() == TRUE) {
   		 	$name = $_POST['name'];
   		 	$code = $_POST['code'];
   		 	$value = $_POST['value'];
   			$data = array();
   			$data['name'] = $name;
   			$data['code'] = $code;
   			$data['value'] = (int)$value;
   			$data['id'] = $_POST['id'];
      		$this->M_warehouse->updateArticle($data);

      		header("location: /Warehouse");
      	}
    }

    public function addAutomaticZamAluprof () { //tworzenie zamówienia na podstawie pliku XML do Aluprof S.A
    	move_uploaded_file($_FILES['fileZam']['tmp_name'],
        $_SERVER['DOCUMENT_ROOT'].'/media/upload/'.$_FILES['fileZam']['name']);
        $doc = $_SERVER['DOCUMENT_ROOT'].'/media/upload/'.$_FILES['fileZam']['name'];
    	$xml = simplexml_load_file($doc); //plik xml z zamówieniem

    	$year = date('Y'); //Rok
    	$mounth = date('m'); //Miesiąc
    	$day = date('d'); //dzień
    	$hour = date('H'); //godzina
    	$minuts = date('i'); //minuta
    	$nrEdi = $this->M_user->nrEdi;
    	$nameUser = $this->M_user->name;
    	$surnameUser = $this->M_user->surname;
    	$title = $_POST['title']; //nagłówek zamówienia;
    	$name = $_POST['name']; //nr zamówienia




    	/*----------SPRAWDZANIE STANÓW MAGAZYNOWYCH ---------------*/
    	$i = 1;
		$this->M_warehouse->addZamAluprof($name, date("Y-m-d"), $this->M_user->id);
		$zam = $this->M_warehouse->getZamName($name, $this->M_user->id);
    	foreach ($xml->Vendor[0]->Materials[0]->Material as $article) {
    		if ($article->Category == 'USZCZELKI' || $article->Category == 'AKCESORIA') {  //Dopuszczanie tylko uszczelek i akcesori
    			$magArticle = $this->M_warehouse->getCodeArticle($article->NrGmSys);
    			if (count($magArticle) == 1) {
    				if ($magArticle[0]['value'] >= $article->CountReal) { //więcej na magazynie niż potrzebne
    					$newValue = (int)$magArticle[0]['value']-((int)$article->CountReal); //nowa ilość na maagazynie po obniżeniu ilości
    					
    					$article->CountReal = 0;
    					$article->CountAll = 0;
						$article->CountPack1 = 0;

    					$this->M_warehouse->updateValueArticle($magArticle[0]['id'], $newValue); //aktualizacja wartości w magazynie
    				}else { //na magazynie za mała ilość
    					$newValue = ((int)$article->CountReal)-(int)$magArticle[0]['value']; //nowa ilość na maagazynie po obniżeniu ilości
    					
    					$article->CountReal = $newValue; //aktualizacja w XML nowej wartości
    					$article->CountAll = $this->M_warehouse->zaokrWGore($newValue, $article->Pack1Size);
						$article->CountPack1 = $article->CountAll/$article->Pack1Size;

    					$newValue2 = (int)$article->CountAll-(int)$article->CountReal; //Ilość po sprawdzeniu paczkowanej ilości względem realnej
    					$this->M_warehouse->updateValueArticle($magArticle[0]['id'], ($newValue2)); //aktualizacja wartości w magazynie

    				}
    			}else { //brak artykułu na magazynie
    				$newValue = $article->CountAll-$article->CountReal;
    				$data = array();
    				$data['code'] = $article->NrGmSys;
    				$data['name'] = $article->Desc;
    				$data['jm'] = $article->JM;
    				$data['value'] = $newValue;
    				$this->M_warehouse->addArticle($data);
    			}
			}
			
    		if ($article->CountAll > 0) {
				$sql = array();
				$sql['id_zam'] = $zam[0]['id'];
				$sql['article'] = $article->NrGmSys;
				$sql['jm'] = $article->JM;
				$sql['value'] = $article->CountAll;
				$sql['pack'] = $article->CountPack1;
				$this->M_warehouse->addArticleZam($sql);
			};
			
    		
    	}
		$tmpl = array();
		$tmpl['article'] = $xml;
		$tmpl['name'] = $name;
		$this->load->view('general/top');
		$this->load->view('warehouse/zam',$tmpl);
	}
}
?>