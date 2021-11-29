<?php
class Timetable extends CI_Controller {

	public function __construct() {
		parent::__construct();
     if ($this->M_user->log == false) header("location: /");
	}

	public function index($year = null) {
		$this->load->model('M_orders');
		$this->load->model('M_lacks');

		$listOrders = array();
		if ($year == null) {
			$selectYear = FALSE;
			$archivalYear = 0;
			for ($i = date("W")-6; $i <= date("W")+6; $i++) {
				$listOrders[$i] = $this->M_orders->getOrdersWeek(date("Y"), $i, $i);
			};
		}else {
			$selectYear = TRUE;
			$archivalYear = $year;
			for ($i = 1; $i <= 52; $i++) {
				$listOrders[$i] = $this->M_orders->getOrdersWeek($year, $i, $i);
			};
		}

		$lacks = array();
		if ($year == null) {
			for ($i = date("W")-6; $i <= date("W")+6; $i++) {
				foreach ($listOrders[$i] as $l) {
					$spr = $this->M_lacks->getCountLackActiveOrder($l['id']);
					if ($spr > 0) {
						$lacks[$l['id']] = true;
					}else {
						$lacks[$l['id']] = false;
					}
				}
			};
		}else {
			for ($i = 1; $i <= 52; $i++) {
				foreach ($listOrders[$i] as $l) {
					$spr = $this->M_lacks->getCountLackActiveOrder($l['id']);
					if ($spr > 0) {
						$lacks[$l['id']] = true;
					}else {
						$lacks[$l['id']] = false;
					}
				}
			};
		}

		$data = array (
			'years' => $this->config->item('years'),
			'archivalYear' => $archivalYear,
			'actualWeek' => date("W"),
			'listOrders' => $listOrders,
			'lacks' => $lacks,
			'selectYear' => $selectYear
		);

		$this->load->view('general/top');
		$this->load->view('timetable/home',$data);
	}
};
?>
