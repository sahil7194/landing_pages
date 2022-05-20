<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();		
		$this->load->model(array('order_model'));
	}
	
	public function index(){
		//$this->data['cart'] = $this->cart_model->getData_Cart();
		$this->load->template('cart');
	}

	public function set_delivery_address(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('address_id','Address','trim|required|numeric|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('address_id'=>form_error('address_id','<span>','</span>'));

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);
		}else{	

			$this->session->set_userdata(array('delivery_address_id'=>$this->input->post('address_id')));
			$response_array['message'] = 'Address Selected';
			$response=$response_array;
			$response=array('success'=>$response_array);

		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}
	
	public function save(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('payment_mode','Payment mode','trim|required|xss_clean');		

		if($this->input->post('payment_mode')!='COD'){
			$this->form_validation->set_rules('upi_transaction_id','Upi Transaction Id','trim|required|numeric|xss_clean');
		}

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array(
				'payment_mode'=>form_error('payment_mode','<span>','</span>')
			);

			if($this->input->post('payment_mode')!='COD'){
				$form_error_array['upi_transaction_id'] = form_error('upi_transaction_id','<span>','</span>');
			}

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);
		}else{	

			$response=$this->order_model->save_method();

			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}

		}		

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}


	public function status($status='error'){
		$this->load->template('order_status');
	}

}
