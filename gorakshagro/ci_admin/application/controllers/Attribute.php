<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attribute extends CI_Controller {	

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')!='loggedIn'){ redirect('login'); }
		$this->load->model(array('attribute_model','common_model'));
		$this->data['title']='Attributes';
		$this->data['selected_menu']='attribute';
	}

	public function index(){
		//Pagination
		$config["base_url"] = base_url().'index.php/attribute/index/';
		$config["total_rows"] = $this->attribute_model->record_count();
		$config["per_page"] = 20;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["result"] = $this->attribute_model->getData_method($config["per_page"], $page);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination
		
		$this->load->template('attribute/index',$this->data);
	}

	public function create(){
		$this->data['result_attribute_groups'] = $this->attribute_model->getData_attribute_groups();
		$this->load->template('attribute/create',$this->data);
	}

	public function store(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name','Name','trim|required|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('name'=>form_error('name','<span>','</span>'),
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->attribute_model->store_method();
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
		$this->data['result']=$this->attribute_model->getDataById_method($dataId);
		$this->data['result_attribute_groups'] = $this->attribute_model->getData_attribute_groups();
		$this->load->template('attribute/edit',$this->data);
	}

	public function delete(){
		$response=$this->attribute_model->delete_method();
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
