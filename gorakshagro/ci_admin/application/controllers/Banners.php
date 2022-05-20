<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {	

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')!='loggedIn'){ redirect('login'); }
		$this->load->model('banners_model');
		$this->data['title']='Banners';
		$this->data['selected_menu']='banners';
	}

	public function index(){		
		//Pagination
		$config["base_url"] = base_url().'index.php/banners/index/';
		$config["total_rows"] = $this->banners_model->record_count();
		$config["per_page"] = 20;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["result"] = $this->banners_model->getData_method($config["per_page"], $page);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination

		$this->load->template('banners/index',$this->data);
	}

	public function create(){		
		$this->load->template('banners/create',$this->data);
	}

	public function store(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('alt','Alt','trim|required|xss_clean');
		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('alt'=>form_error('alt','<span>','</span>'));

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);
			
		}else{			
			$response=$this->banners_model->store_method();
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
		$this->data['result']=$this->banners_model->getDataById_method($dataId);
		$this->load->template('banners/edit',$this->data);
	}

	public function delete(){
		$response=$this->banners_model->delete_method();
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function delete_file($dataId){

		$response=$this->banners_model->delete_file_method($dataId);
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}
	
}
