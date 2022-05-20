<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();		
		$this->load->model(array('cart_model'));
	}
	
	public function index(){
		//$this->data['cart'] = $this->cart_model->getData_Cart();
		$this->data["meta_title"] = 'Your Cart';
		$this->data["meta_description"] = 'Your Cart';
		$this->data["meta_keywords"] = 'Your Cart';
		$this->load->template('cart', $this->data);
	}

	public function add(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('product_id','Product Id','trim|required|xss_clean');
		$this->form_validation->set_rules('product_price','Price','trim|required|xss_clean');
		$this->form_validation->set_rules('product_name','Product name','trim|required|xss_clean');
		$this->form_validation->set_rules('product_qty','Qty','trim|required|xss_clean|less_than_equal_to[5]');

		$required_options = $this->input->post('required_options');

		if(count($required_options) > 0){
			foreach ($required_options as $key => $value) {
				$this->form_validation->set_rules($key,$key,'trim|required|xss_clean');
			}
		}		
		

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('product_id'=>form_error('product_id','<span>','</span>'),
			'product_price'=>form_error('product_price','<span>','</span>'),
			'product_name'=>form_error('product_name','<span>','</span>'),
			'product_qty'=>form_error('product_qty','<span>','</span>')
			);

			if(count($required_options) > 0){
				foreach ($required_options as $key => $value) {
					$form_error_array[$key] = form_error($key,'<span>','</span>');
				}
			}

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->cart_model->add_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
		
	}

	public function update(){
		$response=$this->cart_model->update_method();
		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	
	public function destroy(){
		$this->cart->destroy();
	}

}
