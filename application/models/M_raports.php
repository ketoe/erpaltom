<?php
class M_raports extends CI_Model {
	public function generateRaportUser ($data) {
		$start_date = $data['year'].'-'.$data['mounth'].'-01';
		$end_date = $data['year'].'-'.$data['mounth'].'-31';
		$sql = "SELECT o.*, max(o.money) as max_money, min(o.money) as min_money, sum(o.money) as sum_money, count(*) as v_orders FROM orders as o INNER JOIN clients as c ON c.id = o.client WHERE o.date_create >= ? and o.date_create <= ? and o.autor = ?"; 
                $sql2 = "SELECT o.*, c.name as clientName, o.money as money, o.name as orderName FROM orders as o INNER JOIN clients as c ON c.id = o.client WHERE o.date_create >= ? and o.date_create <= ? and o.autor = ?"; //zapytanie zbierające listę zleceń

                $query = $this->db->query($sql, array($start_date, $end_date, $data['user']));
                $query2 = $this->db->query($sql2, array($start_date, $end_date, $data['user']));
		$return = $query->result_array();
                $return2 = $query2->result_array();
        $array = array (
        	'max_money' => $return[0]['max_money'],
        	'sum_money' => $return[0]['sum_money'],
        	'min_money' => $return[0]['min_money'],
        	'v_orders' => $return[0]['v_orders'],
        	'list_orders' => $return2
        );
        return $array;
	}

        public function generateRaportWeekOrders ($data) {

                 $sql = "SELECT o.*, c.name as clientName, o.money as money, o.name as orderName FROM orders as o INNER JOIN clients as c ON c.id = o.client WHERE o.year = ? and o.week >= ? and o.week <= ? ORDER BY o.week"; 
                $query = $this->db->query($sql, array($data['year'], $data['start_week'], $data['end_week']));
                $return = $query->result_array();
        
        $array = array (
                'start_week' => $data['start_week'],
                'end_week' => $data['end_week'],
                'year' => $data['year'],
                'list_orders' => $return
        );
        return $array;
        }


        public function getOrdersWeek ($data) {
                $sql = "SELECT o.orderMonter, o.dateMonter, o.monter, c.name as clientName, o.money as money, o.name as orderName FROM orders as o INNER JOIN clients as c ON c.id = o.client WHERE week = ? and year = ?"; 
        $query = $this->db->query($sql, array($data['week'], $data['year']));
                $return = $query->result_array();
        $array = array (
                'list_orders' => $return
        );
        return $array;
        }

        public function getOrdersMounth ($data) {
            $sql = "SELECT * FROM orders WHERE date_create >= ? and date_create <= ? and year = ?"; 
            $query = $this->db->query($sql, array($data['start'],$data['end'],$data['year']));
            $return = $query->result_array();
        
        return $return;
        }

	public function sumStatisticsMounth ($data) {
		$start_date = $data['year'].'-'.$data['mounth'].'-01';
		$end_date = $data['year'].'-'.$data['mounth'].'-31';
		$sql = "SELECT sum(money) as sumMoney FROM orders WHERE date_create >= ? and date_create <= ?"; 
        $query = $this->db->query($sql, array($start_date, $end_date));
		$return = $query->result_array();
        $array = array (
        	'sumMoney' => $return[0]['sumMoney']
        );
        return $array;
	}



}
