<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptions extends CI_Controller {	

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')!='loggedIn'){ redirect('login'); }
		$this->load->model(array('subscriptions_model','common_model'));
		$this->data['title']='Subscriptions';
		$this->data['selected_menu']='subscriptions';
	}

	public function index(){
		//Pagination
		$config["base_url"] = base_url().'index.php/subscriptions/index/';
		$config["total_rows"] = $this->subscriptions_model->record_count();
		$config["per_page"] = 20;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["result"] = $this->subscriptions_model->getData_method($config["per_page"], $page);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination
		
		$this->load->template('subscriptions/index',$this->data);
	}

	public function create(){
		$this->data['result_package']=$this->subscriptions_model->getPackage_method();
		$this->load->template('subscriptions/create',$this->data);
	}

	public function store(){
		$this->load->library('form_validation');

		if($this->input->post('dataId')){
			$this->form_validation->set_rules('order_status','Order status','trim|required|xss_clean');
		}else{
			$this->form_validation->set_rules('fb_id','FB-PSID','trim|required|xss_clean');
			$this->form_validation->set_rules('package','Package','trim|required|xss_clean');
			$this->form_validation->set_rules('order_status','Order status','trim|required|xss_clean');
		}

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			if($this->input->post('dataId')){
				$form_error_array = array('order_status'=>form_error('order_status','<span>','</span>'));
			}else{
				$form_error_array = array('fb_id'=>form_error('fb_id','<span>','</span>'),
				'package'=>form_error('package','<span>','</span>'),
				'order_status'=>form_error('order_status','<span>','</span>')
				);
			}
			
			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->subscriptions_model->store_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function edit($dataId){
		$this->data['result']=$this->subscriptions_model->getDataById_method($dataId);		
		$this->load->template('subscriptions/edit',$this->data);
	}

	public function view($dataId){
		$this->data['result']=$this->subscriptions_model->getOrderDetails_method($dataId);		
		$this->load->template('subscriptions/view',$this->data);
	}

	public function delete(){
		$response=$this->subscriptions_model->delete_method();
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
