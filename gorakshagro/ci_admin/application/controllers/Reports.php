<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {	

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')!='loggedIn'){ redirect('login'); }
		$this->load->model(array('reports_model','common_model'));		
		$this->data['title']='Filter';
		$this->data['selected_menu']='reports';
	}

	public function sales(){
		$this->data['order_status_list'] = $this->common_model->getData_orderStatusList();
		$this->load->template('reports/sales',$this->data);
	}

	
	public function filter_sales(){		

		if (null !== $this->input->get('filter_date_start')) {
			$filter_date_start = $this->input->get('filter_date_start');
		} else {
			$filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
		}

		if (null !== $this->input->get('filter_date_end')) {
			$filter_date_end = $this->input->get('filter_date_end');
		} else {
			$filter_date_end = date('Y-m-d');
		}

		if (null !== $this->input->get('filter_group')) {
			$filter_group = $this->input->get('filter_group');
		} else {
			$filter_group = 'week';
		}		

		if (null !== $this->input->get('filter_order_status_id')) {
			$filter_order_status_id = $this->input->get('filter_order_status_id');
		} else {
			$filter_order_status_id = 0;
		}

		
		$this->data['filter_date_start'] = $filter_date_start;
		$this->data['filter_date_end'] = $filter_date_end;
		$this->data['filter_group'] = $filter_group;
		$this->data['filter_order_status_id'] = $filter_order_status_id;


		//Pagination
		$config["base_url"] = base_url().'index.php/reports/filter_sales/';
		$config["total_rows"] = $this->reports_model->record_count_filter_sales($this->data);
		$config["per_page"] = 25;
		$config["uri_segment"] = 3;
		$config['reuse_query_string'] = true;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["result"] = $this->reports_model->filter_sales_method($config["per_page"], $page, $this->data);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination

		$this->data['order_status_list'] = $this->common_model->getData_orderStatusList();
		$this->load->template('reports/sales',$this->data);
	}


	public function product_purchased(){
		$this->data['order_status_list'] = $this->common_model->getData_orderStatusList();
		$this->load->template('reports/product_purchased',$this->data);
	}

	
	public function filter_product_purchased(){		

		if (null !== $this->input->get('filter_date_start')) {
			$filter_date_start = $this->input->get('filter_date_start');
		} else {
			$filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
		}

		if (null !== $this->input->get('filter_date_end')) {
			$filter_date_end = $this->input->get('filter_date_end');
		} else {
			$filter_date_end = date('Y-m-d');
		}	

		if (null !== $this->input->get('filter_order_status_id')) {
			$filter_order_status_id = $this->input->get('filter_order_status_id');
		} else {
			$filter_order_status_id = 0;
		}

		
		$this->data['filter_date_start'] = $filter_date_start;
		$this->data['filter_date_end'] = $filter_date_end;
		$this->data['filter_order_status_id'] = $filter_order_status_id;


		//Pagination
		$config["base_url"] = base_url().'index.php/reports/filter_product_purchased/';
		$config["total_rows"] = $this->reports_model->record_count_filter_product_purchased($this->data);
		$config["per_page"] = 25;
		$config["uri_segment"] = 3;
		$config['reuse_query_string'] = true;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["result"] = $this->reports_model->filter_product_purchased_method($config["per_page"], $page, $this->data);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination

		$this->data['order_status_list'] = $this->common_model->getData_orderStatusList();
		$this->load->template('reports/product_purchased',$this->data);
	}


	public function customers(){		
		$this->load->template('reports/customers',$this->data);
	}


	public function filter_customers(){		

		if (null !== $this->input->get('filter_date_start')) {
			$filter_date_start = $this->input->get('filter_date_start');
		} else {
			$filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
		}

		if (null !== $this->input->get('filter_date_end')) {
			$filter_date_end = $this->input->get('filter_date_end');
		} else {
			$filter_date_end = date('Y-m-d');
		}

		if (null !== $this->input->get('filter_group')) {
			$filter_group = $this->input->get('filter_group');
		} else {
			$filter_group = 'week';
		}

		if (null !== $this->input->get('email_verified')) {
			$email_verified = $this->input->get('email_verified');
		} else {
			$email_verified = 'yes';
		}

		if (null !== $this->input->get('gender')) {
			$gender = $this->input->get('gender');
		} else {
			$gender = 'male';
		}

		
		$this->data['filter_date_start'] = $filter_date_start;
		$this->data['filter_date_end'] = $filter_date_end;
		$this->data['filter_group'] = $filter_group;
		$this->data['email_verified'] = $email_verified;
		$this->data['gender'] = $gender;

		//Pagination
		$config["base_url"] = base_url().'index.php/reports/filter_customers/';
		$config["total_rows"] = $this->reports_model->record_count_filter_customers($this->data);
		$config["per_page"] = 25;
		$config["uri_segment"] = 3;
		$config['reuse_query_string'] = true;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["result"] = $this->reports_model->filter_customers_method($config["per_page"], $page, $this->data);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination
		
		$this->load->template('reports/customers',$this->data);
	}




	public function test(){

		$sql1 = "SELECT product_id, product_name, product_options FROM orders_product GROUP BY product_id";

		$query1 = $this->db->query($sql1);

		$data = array();

		foreach($query1->result() as $row1){

			$sql2 = "SELECT MIN(o.date_created)  AS date_start, MAX(o.date_created) AS date_end, op.product_name, op.product_options, op.quantity, SUM((op.price) * op.quantity) AS total FROM `orders_product` op LEFT JOIN `orders` o ON (op.order_ref_id = o.order_ref_id) WHERE op.product_id = '".$row1->product_id."' GROUP BY op.product_options";

			$query2 = $this->db->query($sql2);

			foreach($query2->result() as $row2){

				$data[] = array('date_start'=>$row2->date_start, 'date_end'=>$row2->date_end, 'product_name'=>$row2->product_name, 'product_options'=>$row2->product_options, 'quantity'=>$row2->quantity, 'total'=>$row2->total) ;

			}

			
		}

		var_dump($data);

	}
	
}
