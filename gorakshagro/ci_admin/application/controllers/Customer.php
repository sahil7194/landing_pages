<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {	

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')!='loggedIn'){ redirect('login'); }
		$this->load->model(array('customer_model','common_model'));
		$this->data['title']='Customer';
		$this->data['selected_menu']='customer';
	}

	public function index(){
		//Pagination
		$config["base_url"] = base_url().'index.php/customer/index/';
		$config["total_rows"] = $this->customer_model->record_count();
		$config["per_page"] = 20;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["result"] = $this->customer_model->getData_method($config["per_page"], $page);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination
		
		$this->load->template('customer/index',$this->data);
	}

	public function create(){
		$this->data['result_package']=$this->customer_model->getPackage_method();
		$this->load->template('customer/create',$this->data);
	}

	public function store(){
		// $this->load->library('form_validation');

		// $this->form_validation->set_rules('block_status','Order status','trim|required|xss_clean');

		// if($this->form_validation->run()==FALSE){
		// 	$this->statusCode=400;

		// 	$form_error_array = array('block_status'=>form_error('block_status','<span>','</span>'));
			
		// 	$response_array['error_type'] = 'form';
		// 	$response_array['errors'] = $form_error_array;
		// 	$response_array['message'] = 'Invalid Inputs';
		// 	$response=array('error'=>$response_array);

		// }else{

			$response=$this->customer_model->store_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}

		// }

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function edit($dataId){
		$this->data['result']=$this->customer_model->getDataById_method($dataId);		
		$this->load->template('customer/edit',$this->data);
	}

	public function view($dataId){
		$this->data['result']=$this->customer_model->getDataById_method($dataId);
		$this->data['result_address']=$this->customer_model->getData_addressById_method($dataId);
		$this->load->template('customer/view',$this->data);
	}

	public function delete(){
		$response=$this->customer_model->delete_method();
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function regionsGetData(){
		$result = $this->common_model->regionsGetData_method();
		$response = array('success'=>$result);
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	
}
