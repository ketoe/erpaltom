<?php
class Raports extends CI_Controller {

	function __construct() {
        parent::__construct();
     	$this->load->model('M_raports');
        if ($this->M_user->log == false) header("location: /");
    }

    function index () {
    	$data = array();

    	$data['years'] = $this->config->item('years');
    	$this->load->view('general/top');
    	$this->load->view('raports/home',$data);
    }

     public function generateRaportUserLog ($user = null, $year = null, $mounth = null) {
        if (isset($user) && isset($year) && isset($mounth)) {
            $user = $user;
            $year = $year;
            $mounth = $mounth;
            $print = true;
        }else {
    	   $mounth = $_POST['mounth'];
    	   $year = $_POST['year'];
           $user = $this->session->userdata('user_id');
           $print = false;
        };

    	$data = array (
    		'mounth' => $mounth,
    		'year' => $year,
    		'user' => $user
    	);

    	$dataOrders = $this->M_raports->generateRaportUser($data);

    	$dataView = array (
    		'year' => $year,
    		'mounth' => $mounth,
    		'data' => $year.'-'.$mounth,
    		'user' => $this->M_user->name. ' '.$this->M_user->surname,
    		'sum_money' => $dataOrders['sum_money'],
    		'min_money' => $dataOrders['min_money'],
    		'max_money' => $dataOrders['max_money'],
    		'v_orders' => $dataOrders['v_orders'],
    		'list_orders' => $dataOrders['list_orders']
    	);

        if (!$print) {
            $this->load->view('general/top');
        	$this->load->view('raports/raportUser',$dataView);
        }else {
            $this->load->view('general/topPrint');
        }
    }

    public function generateRaportWeekOrders ($year = null, $start = null, $end = null) {
        if (isset($year) && isset($start) && isset($end)) {
            $year = $year;
            $start_week = $start;
            $end_week = $end;
        }else {
            $start_week = $_POST['start_week'];
            $end_week = $_POST['end_week'];
            $year = $_POST['year'];
        }

        $data = array (
            'start_week' => $start_week,
            'end_week' => $end_week,
            'year' => $year,
        );

        $dataOrders = $this->M_raports->generateRaportWeekOrders($data);

        $dataView = array (
            'year' => $year,
            'start_week' => $start_week,
            'end_week' => $end_week,
            'list_orders' => $dataOrders['list_orders']
        );
        if (isset($year) && isset($start) && isset($end)) {
            $this->load->view('general/topPrint');
            $this->load->view('print/raportMonterWeek',$dataView);
        }else {
            $this->load->view('general/top');
            $this->load->view('raports/raportMonterWeek',$dataView);
        }
    }

    public function raportMoneyYear () {
    	$this->load->view('general/top');
    	$mounth = $this->config->item('numberMounth');

    	$statistics = array();
    	for ($i = 0; $i < count($mounth); $i++) {
    		$data = array (
    			'year' => $_POST['year'],
    			'mounth' => $mounth[$i]
    		);
    		$orders = $this->M_raports->sumStatisticsMounth($data);
    		$statistics[$i]['mounth'] = $data['mounth'];
    		$statistics[$i]['sumMoney'] = $orders['sumMoney'];

    	};

    	$dataView = array (
    		'statistics' => $statistics,
    		'year' => $_POST['year']
    	);
    	
    	$this->load->view('raports/raportMoneyYear',$dataView);
    }

    public function raportMounthMoney () {
        $this->load->model('M_users');

        $year = $_POST['year'];
        $mounth = $_POST['mounth'];

        $data = array (
            'start' => $_POST['year'].'-'.$_POST['mounth'].'-01',
            'end' => $_POST['year'].'-'.$_POST['mounth'].'-31',
            'year' => $year
        );

        $data2 = array (
            'mounth' => $mounth,
            'year' => $data['year']
        );

        $orders = $this->M_raports->getOrdersMounth($data);
        $sum = $this->M_raports->sumStatisticsMounth($data2);

        $dataView = array (
            'year' => $year,
            'mounth' => $mounth,
            'orders' => $orders,
            'users' => $this->M_users->getUsersActive(),
            'sum' => $sum['sumMoney']
        );

        $this->load->view('general/top');
        $this->load->view('raports/raportMounthMoney',$dataView);
    }


}

?>