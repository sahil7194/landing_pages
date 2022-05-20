<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends CI_Controller {	

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')!='loggedIn'){ redirect('login'); }
		$this->load->model(array('vendors_model','common_model'));
		$this->data['title']='vendors';
		$this->data['selected_menu']='vendors';
	}

	public function index(){
		//Pagination
		$config["base_url"] = base_url().'index.php/vendors/index/';
		$config["total_rows"] = $this->vendors_model->record_count();
		$config["per_page"] = 20;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["result"] = $this->vendors_model->getData_method($config["per_page"], $page);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination
		
		$this->load->template('vendors/index',$this->data);
	}

	public function create(){
		$this->data['result_countries'] = $this->common_model->getData_countries();
		$this->load->template('vendors/create',$this->data);
	}

	public function store(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('vendor_name','Vendor name','trim|required|xss_clean');
		$this->form_validation->set_rules('first_name','First Name','trim|required|xss_clean');
		$this->form_validation->set_rules('last_name','Last Name','trim|required|xss_clean');
		if($this->input->post('dataId')){
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');
		}else{
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[vendors.email]|xss_clean');
		}
		//$this->form_validation->set_rules('phone','Phone','trim|required|xss_clean');
		$this->form_validation->set_rules('mobile','Mobile','trim|required|xss_clean');
		//$this->form_validation->set_rules('fax','Fax','trim|required|xss_clean');
		//$this->form_validation->set_rules('address1','Address 1','trim|required|xss_clean');
		//$this->form_validation->set_rules('pincode','Pincode','trim|required|xss_clean');
		$this->form_validation->set_rules('country_id','Country','trim|required|xss_clean');
		$this->form_validation->set_rules('state_id','State','trim|required|xss_clean');
		$this->form_validation->set_rules('city_id','City','trim|required|xss_clean');
		$this->form_validation->set_rules('status','Status','trim|required|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('vendor_name'=>form_error('vendor_name','<span>','</span>'),
			'first_name'=>form_error('first_name','<span>','</span>'),
			'last_name'=>form_error('last_name','<span>','</span>'),
			'email'=>form_error('email','<span>','</span>'),
			//'phone'=>form_error('phone','<span>','</span>'),
			'mobile'=>form_error('mobile','<span>','</span>'),
			//'fax'=>form_error('fax','<span>','</span>'),
			//'address1'=>form_error('address1','<span>','</span>'),
			//'address2'=>form_error('address2','<span>','</span>'),
			//'pincode'=>form_error('pincode','<span>','</span>'),
			'country_id'=>form_error('country_id','<span>','</span>'),
			'state_id'=>form_error('state_id','<span>','</span>'),
			'city_id'=>form_error('city_id','<span>','</span>'),
			'status'=>form_error('status','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->vendors_model->store_method();
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
		$this->data['result']=$this->vendors_model->getDataById_method($dataId);
		$this->data['result_countries'] = $this->common_model->getData_countries();
		$this->data['result_states'] = $this->common_model->getData_states_method($this->data['result'][0]->country_id);
		$this->data['result_cities'] = $this->common_model->getData_cities_method($this->data['result'][0]->state_id);
		$this->load->template('vendors/edit',$this->data);
	}

	public function delete(){
		$response=$this->vendors_model->delete_method();
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function getData_states(){
		$result = $this->common_model->getData_states_method($this->input->post('country_id'));
		$response = array('success'=>$result);
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function getData_cities(){
		$result = $this->common_model->getData_cities_method($this->input->post('state_id'));
		$response = array('success'=>$result);
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	
}
