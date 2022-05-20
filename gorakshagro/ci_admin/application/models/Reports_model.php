<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}


	public function record_count_filter_sales($data) {

		if($this->input->get('search')){

			$sql = "SELECT MIN(o.date_created) AS date_start, MAX(o.date_created) AS date_end, COUNT(*) AS `no_of_orders`, SUM((SELECT SUM(op.quantity) FROM `orders_product` op WHERE op.order_ref_id = o.order_ref_id GROUP BY op.order_ref_id)) AS products, SUM(o.total) AS `total` FROM `orders` o";			

			if (!empty($data['filter_order_status_id'])) {
				$sql .= "  WHERE o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
			}else{
				$sql .= " WHERE o.order_status_id > '0'";
			}

			if (!empty($data['filter_date_start'])) {
				$sql .= " AND DATE(o.date_created) >= '" . $data['filter_date_start'] . "'";
			}

			if (!empty($data['filter_date_end'])) {
				$sql .= " AND DATE(o.date_created) <= '" . $data['filter_date_end'] . "'";
			}

			if (!empty($data['filter_group'])) {
				$group = $data['filter_group'];
			} else {
				$group = 'week';
			}

			switch($group) {
				case 'day';					
					$sql .= " GROUP BY YEAR(o.date_created), MONTH(o.date_created), DAY(o.date_created)";
					break;
				default:
				case 'week':
					$sql .= " GROUP BY YEAR(o.date_created), WEEK(o.date_created)";
					break;
				case 'month':
					$sql .= " GROUP BY YEAR(o.date_created), MONTH(o.date_created)";
					break;
				case 'year':
					$sql .= " GROUP BY YEAR(o.date_created)";
					break;
			}
			

			$query = $this->db->query($sql);
		
			return $query->num_rows();
		}
		
	}

	public function filter_sales_method($limit, $start, $data){

		if($this->input->get('search')){

			$sql = "SELECT MIN(o.date_created) AS date_start, MAX(o.date_created) AS date_end, COUNT(*) AS `no_of_orders`, SUM((SELECT SUM(op.quantity) FROM `orders_product` op WHERE op.order_ref_id = o.order_ref_id GROUP BY op.order_ref_id)) AS products, SUM(o.total) AS `total` FROM `orders` o";			

			if (!empty($data['filter_order_status_id'])) {
				$sql .= "  WHERE o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
			}else{
				$sql .= " WHERE o.order_status_id > '0'";
			}

			if (!empty($data['filter_date_start'])) {
				$sql .= " AND DATE(o.date_created) >= '" . $data['filter_date_start'] . "'";
			}

			if (!empty($data['filter_date_end'])) {
				$sql .= " AND DATE(o.date_created) <= '" . $data['filter_date_end'] . "'";
			}

			if (!empty($data['filter_group'])) {
				$group = $data['filter_group'];
			} else {
				$group = 'week';
			}						

			switch($group) {
				case 'day';					
					$sql .= " GROUP BY YEAR(o.date_created), MONTH(o.date_created), DAY(o.date_created)";
					break;
				default:
				case 'week':
					$sql .= " GROUP BY YEAR(o.date_created), WEEK(o.date_created)";
					break;
				case 'month':
					$sql .= " GROUP BY YEAR(o.date_created), MONTH(o.date_created)";
					break;
				case 'year':
					$sql .= " GROUP BY YEAR(o.date_created)";
					break;
			}



			$sql .= " ORDER BY o.date_created DESC";
			
			$sql .= " LIMIT ".$start.", ".$limit;

			$query = $this->db->query($sql);
		
			return $query->result();
		}

	}




	public function record_count_filter_product_purchased($data) {

		if($this->input->get('search')){


			$sql1 = "SELECT product_id, product_name, product_options FROM orders_product GROUP BY product_id";

			$query1 = $this->db->query($sql1);

			$data = array();

			foreach($query1->result() as $row1){

				$sql2 = "SELECT MIN(o.date_created)  AS date_start, MAX(o.date_created) AS date_end, op.product_name, op.product_options, op.quantity, SUM((op.price) * op.quantity) AS total FROM `orders_product` op LEFT JOIN `orders` o ON (op.order_ref_id = o.order_ref_id) WHERE op.product_id = '".$row1->product_id."'";

				if (!empty($data['filter_order_status_id'])) {
					$sql2 .= "  AND o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
				}else{
					$sql2 .= " AND o.order_status_id > '0'";
				}

				if (!empty($data['filter_date_start'])) {
					$sql2 .= " AND DATE(o.date_created) >= '" . $data['filter_date_start'] . "'";
				}

				if (!empty($data['filter_date_end'])) {
					$sql2 .= " AND DATE(o.date_created) <= '" . $data['filter_date_end'] . "'";
				}

				$sql2 .= " GROUP BY op.product_options";

				$query2 = $this->db->query($sql2);

				foreach($query2->result() as $row2){

					$data[] = array('date_start'=>$row2->date_start, 'date_end'=>$row2->date_end, 'product_name'=>$row2->product_name, 'product_options'=>$row2->product_options, 'quantity'=>$row2->quantity, 'total'=>$row2->total) ;

				}

				
			}

		
			return count($data);
		}
		
	}

	public function filter_product_purchased_method($limit, $start, $data){

		if($this->input->get('search')){

			$sql1 = "SELECT product_id, product_name, product_options FROM orders_product GROUP BY product_id ORDER BY product_name ASC LIMIT ".$start.", ".$limit;

			$query1 = $this->db->query($sql1);			

			foreach($query1->result() as $row1){

				$sql2 = "SELECT op.product_name, op.product_options, op.price, SUM(op.quantity) as quantity, SUM((op.price) * op.quantity) AS total FROM `orders_product` op LEFT JOIN `orders` o ON (op.order_ref_id = o.order_ref_id) WHERE op.product_id = '".$row1->product_id."'";

				if (!empty($data['filter_order_status_id'])) {
					$sql2 .= "  AND o.order_status_id = '" . (int)$data['filter_order_status_id'] . "'";
				}else{
					$sql2 .= " AND o.order_status_id > '0'";
				}

				if (!empty($data['filter_date_start'])) {
					$sql2 .= " AND DATE(o.date_created) >= '" . $data['filter_date_start'] . "'";
				}

				if (!empty($data['filter_date_end'])) {
					$sql2 .= " AND DATE(o.date_created) <= '" . $data['filter_date_end'] . "'";
				}

				$sql2 .= " GROUP BY op.product_options";				

				$query2 = $this->db->query($sql2);

				foreach($query2->result() as $row2){

					$report_data[] = array('product_name'=>$row2->product_name, 'product_options'=>$row2->product_options, 'price'=>$row2->price, 'quantity'=>$row2->quantity, 'total'=>$row2->total) ;

				}

				
			}
		
			return $report_data;
		}

	}




	public function record_count_filter_customers($data) {

		if($this->input->get('search')){

			$sql = "SELECT MIN(c.date_created) AS date_start, MAX(c.date_created) AS date_end, COUNT(*) AS `no_of_customers`  FROM `customer` c";

			if (!empty($data['email_verified'])) {
				$sql .= "  WHERE c.email_verified = '" . $data['email_verified'] . "'";
			}else{
				$sql .= " WHERE c.email_verified = 'yes'";
			}

			if (!empty($data['filter_date_start'])) {
				$sql .= " AND DATE(c.date_created) >= '" . $data['filter_date_start'] . "'";
			}

			if (!empty($data['filter_date_end'])) {
				$sql .= " AND DATE(c.date_created) <= '" . $data['filter_date_end'] . "'";
			}

			if (!empty($data['gender'])) {
				$sql .= "  AND c.gender = '" . $data['gender'] . "'";
			}

			if (!empty($data['filter_group'])) {
				$group = $data['filter_group'];
			} else {
				$group = 'week';
			}

			switch($group) {
				case 'day';					
					$sql .= " GROUP BY YEAR(c.date_created), MONTH(c.date_created), DAY(c.date_created)";
					break;
				default:
				case 'week':
					$sql .= " GROUP BY YEAR(c.date_created), WEEK(c.date_created)";
					break;
				case 'month':
					$sql .= " GROUP BY YEAR(c.date_created), MONTH(c.date_created)";
					break;
				case 'year':
					$sql .= " GROUP BY YEAR(c.date_created)";
					break;
			}
			

			$query = $this->db->query($sql);
		
			return $query->num_rows();
		}
		
	}

	public function filter_customers_method($limit, $start, $data){

		if($this->input->get('search')){

			$sql = "SELECT MIN(c.date_created) AS date_start, MAX(c.date_created) AS date_end, COUNT(*) AS `no_of_customers`  FROM `customer` c";

			if (!empty($data['email_verified'])) {
				$sql .= "  WHERE c.email_verified = '" . $data['email_verified'] . "'";
			}else{
				$sql .= " WHERE c.email_verified = 'yes'";
			}

			if (!empty($data['filter_date_start'])) {
				$sql .= " AND DATE(c.date_created) >= '" . $data['filter_date_start'] . "'";
			}

			if (!empty($data['filter_date_end'])) {
				$sql .= " AND DATE(c.date_created) <= '" . $data['filter_date_end'] . "'";
			}

			if (!empty($data['gender'])) {
				$sql .= "  AND c.gender = '" . $data['gender'] . "'";
			}

			if (!empty($data['filter_group'])) {
				$group = $data['filter_group'];
			} else {
				$group = 'week';
			}

			switch($group) {
				case 'day';					
					$sql .= " GROUP BY YEAR(c.date_created), MONTH(c.date_created), DAY(c.date_created)";
					break;
				default:
				case 'week':
					$sql .= " GROUP BY YEAR(c.date_created), WEEK(c.date_created)";
					break;
				case 'month':
					$sql .= " GROUP BY YEAR(c.date_created), MONTH(c.date_created)";
					break;
				case 'year':
					$sql .= " GROUP BY YEAR(c.date_created)";
					break;
			}



			$sql .= " ORDER BY c.date_created DESC";
			
			$sql .= " LIMIT ".$start.", ".$limit;

			$query = $this->db->query($sql);
		
			return $query->result();
		}

	}



}
