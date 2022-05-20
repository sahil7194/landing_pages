<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {	

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')!='loggedIn'){ redirect('login'); }
		$this->load->model(array('product_model','common_model'));
		$this->data['title']='Products';
		$this->data['selected_menu']='product';
	}

	public function index(){
		//Pagination
		$config["base_url"] = base_url().'index.php/product/index/';
		$config["total_rows"] = $this->product_model->record_count();
		$config["per_page"] = 20;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["result"] = $this->product_model->getData_method($config["per_page"], $page);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination
		
		$this->load->template('product/index',$this->data);
	}

	public function search(){
		$search_keyword = $this->security->xss_clean($this->input->get('product_name'));
		$this->data["search_keyword"] = $search_keyword;
		$this->data["result"] = $this->product_model->getData_search_method($search_keyword);
		$this->load->template('product/index',$this->data);
	}

	public function create(){
		$this->data['brands'] = $this->common_model->getData_brands();
		$this->data['result_categories'] = $this->common_model->getData_categories();
		$this->data['result_vendors'] = $this->common_model->getData_vendors();
		$this->load->template('product/create',$this->data);
	}

	public function store(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('vendor_id','Vendor','trim|required|xss_clean');
		$this->form_validation->set_rules('category_id','Category','trim|required|xss_clean');
		$this->form_validation->set_rules('product_name','Product name','trim|required|xss_clean');
		$this->form_validation->set_rules('description','Description','trim|required|xss_clean');
		$this->form_validation->set_rules('product_model','Model','trim|required|xss_clean');
		$this->form_validation->set_rules('price','Price','trim|required|xss_clean');
		//$this->form_validation->set_rules('brand','Brand','trim|required|xss_clean');
		$this->form_validation->set_rules('meta_title','Meta title','trim|required|xss_clean');
		$this->form_validation->set_rules('meta_description','Meta Description','trim|required|xss_clean');
		$this->form_validation->set_rules('meta_keywords','Meta Keywords','trim|required|xss_clean');
		$this->form_validation->set_rules('product_tags','Product Tags','trim|required|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('vendor_id'=>form_error('vendor_id','<span>','</span>'),
			'category_id'=>form_error('category_id','<span>','</span>'),
			'product_name'=>form_error('product_name','<span>','</span>'),
			'description'=>form_error('description','<span>','</span>'),
			'product_model'=>form_error('product_model','<span>','</span>'),
			'price'=>form_error('price','<span>','</span>'),
			//'brand'=>form_error('brand','<span>','</span>'),
			'meta_title'=>form_error('meta_title','<span>','</span>'),
			'meta_description'=>form_error('meta_description','<span>','</span>'),
			'meta_keywords'=>form_error('meta_keywords','<span>','</span>'),
			'product_tags'=>form_error('product_tags','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->product_model->store_method();
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
		$this->data['result']=$this->product_model->getDataById_method($dataId);
		$this->data['result_vendors'] = $this->common_model->getData_vendors();
		$this->data['images'] = $this->product_model->getData_images($dataId);
		$this->data['brands'] = $this->common_model->getData_brands();
		$this->data['result_categories'] = $this->common_model->getData_categories();
		$this->data['result_option_groups'] = $this->common_model->getData_option_groups();
		$this->data['result_options'] = $this->common_model->getData_options();
		$this->data['result_product_option_groups'] = $this->product_model->getData_product_options_groups($dataId);
		$this->data['result_product_options'] = $this->product_model->getData_product_options($dataId);
		$this->load->template('product/edit',$this->data);
	}

	public function delete(){
		$response=$this->product_model->delete_method();
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


	public function storeImage(){
		$response=$this->product_model->storeImage_method();
		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}	

	public function delete_image(){

		$dataId = $this->input->post('data_id');
		$productId = $this->input->post('product_id');
		$response=$this->product_model->delete_file_method($dataId,$productId);
		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}



	
	public function storeOptions(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('option_id','Option','trim|required|xss_clean');
		$this->form_validation->set_rules('qty','Qty','trim|required|xss_clean');
		$this->form_validation->set_rules('option_amount','Amount','trim|required|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('option_id'=>form_error('option_id','<span>','</span>'),
			'qty'=>form_error('qty','<span>','</span>'),
			'option_amount'=>form_error('option_amount','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->product_model->storeOptions_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function update_product_option(){
		
		$response=$this->product_model->update_product_option_method();
		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function remove_product_option(){

		$product_option_id = $this->input->post('product_option_id');
		$productId = $this->input->post('product_id');
		$response=$this->product_model->remove_product_option_method($product_option_id,$productId);
		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}


	public function set_display_image(){

		$response=$this->product_model->set_display_image_method();
		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	

	public function updateStatus(){
		$response=$this->product_model->updateStatus_method();
		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	
}
