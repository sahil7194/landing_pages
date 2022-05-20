<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {	

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')!='loggedIn'){ redirect('login'); }
		$this->load->model(array('order_model','common_model'));
		$this->data['title']='Order';
		$this->data['selected_menu']='order';
	}

	public function index(){
		//Pagination
		$config["base_url"] = base_url().'index.php/order/index/';
		$config["total_rows"] = $this->order_model->record_count();
		$config["per_page"] = 20;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["result"] = $this->order_model->getData_method($config["per_page"], $page);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination

		$this->data['result_address_codes'] = $this->order_model->getData_address_codes();
		$this->load->template('order/index',$this->data);
	}

	public function create(){
		$this->data['result_products']=$this->order_model->getProducts_method();
		$this->data['result_customers']=$this->order_model->getCustomers_method();
		$this->load->template('order/create',$this->data);
	}

	public function getProduct_options(){
		$response=$this->order_model->getProduct_options_method();
		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function filter(){		
		$this->data["result"] = $this->order_model->getData_filter_method();
		$this->data['result_address_codes'] = $this->order_model->getData_address_codes();
		$this->load->template('order/index',$this->data);
	}

	public function store(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('order_status','Order status','trim|required|xss_clean');
		$this->form_validation->set_rules('address_code','Address code','trim|required|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('order_status'=>form_error('order_status','<span>','</span>'),
			'address_code'=>form_error('address_code','<span>','</span>'));
			
			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{

			$response=$this->order_model->store_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}

		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function edit($order_id){
		$this->data['order_ref_id']=$order_id;
		$this->data['result']=$this->order_model->getDataById_method($order_id);
		$this->data['order_status_list'] = $this->order_model->getData_orderStatusList();
		$this->data['result_address_codes'] = $this->order_model->getData_address_codes();
		$this->load->template('order/edit',$this->data);
	}

	public function view($order_id){
		$this->data['result']=$this->order_model->getDataById_method($order_id);
		$this->data['products']=$this->order_model->getData_products_method($order_id);
		$this->load->template('order/view',$this->data);
	}

	public function invoice($order_id){
		$this->data['result']=$this->order_model->getDataById_method($order_id);
		$this->data['products']=$this->order_model->getData_products_method($order_id);
		$this->load->view('order/invoice',$this->data);
	}

	public function delete(){
		$response=$this->order_model->delete_method();
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

	public function cart_add(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('product_id','Product Id','trim|required|xss_clean');
		$this->form_validation->set_rules('product_price','Price','trim|required|xss_clean');
		$this->form_validation->set_rules('product_name','Product name','trim|required|xss_clean');
		$this->form_validation->set_rules('product_qty','Qty','trim|required|xss_clean|less_than_equal_to[5]');
	

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('product_id'=>form_error('product_id','<span>','</span>'),
			'product_price'=>form_error('product_price','<span>','</span>'),
			'product_name'=>form_error('product_name','<span>','</span>'),
			'product_qty'=>form_error('product_qty','<span>','</span>')
			);			

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->order_model->cart_add_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
		
	}


	public function cart_destroy(){
		$this->cart->destroy();
	}

	public function getCustomer_address(){
		$response=$this->order_model->getCustomer_address_method();
		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function place_order(){

		$response=$this->order_model->place_order_method();

		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}	

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}


	public function order_ByProducts(){
		$this->data['selected_menu']='order_ByProducts';
		$this->data['result_products']=$this->order_model->getProducts_method();
		$this->data["result"] = $this->order_model->getData_order_ByProducts_method();
		$this->load->template('order/order_ByProducts',$this->data);
	}
	
	public function export_ByProducts(){
		$this->data['selected_menu']='order_ByProducts';
		$this->data['result_products']=$this->order_model->getProducts_method();
		$this->data["result"] = $this->order_model->export_order_ByProducts_method();		
	}


	public function print_order_ByProducts(){
		$this->data['selected_menu']='order_ByProducts';
		$this->data["result"] = $this->order_model->getData_order_ByProducts_method();
		$this->load->view('order/print_order_ByProducts',$this->data);
	}

	
}
