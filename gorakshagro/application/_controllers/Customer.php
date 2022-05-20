<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		$this->load->model(array('customer_model'));
	}	

	public function register(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[customer.email]|xss_clean', array('is_unique'=>'Already exist'));
		$this->form_validation->set_rules('mobile','Mobile','trim|required|numeric|exact_length[10]|xss_clean');
		$this->form_validation->set_rules('fname','First Name','trim|required|alpha|xss_clean');		
		$this->form_validation->set_rules('lname','Last Name','trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('gender','Gender','trim|required|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('email'=>form_error('email','<span>','</span>'),
			'mobile'=>form_error('mobile','<span>','</span>'),
			'fname'=>form_error('fname','<span>','</span>'),
			'lname'=>form_error('lname','<span>','</span>'),
			'password'=>form_error('password','<span>','</span>'),
			'gender'=>form_error('gender','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->customer_model->register_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}


	public function new_email_verify_otp(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('new_email_otp','OTP','trim|required|numeric|exact_length[6]|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('new_email_otp'=>form_error('new_email_otp','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->customer_model->new_email_verify_otp_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}
	

	public function authentication(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('login_email','Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('login_password','Password','trim|required|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('login_email'=>form_error('login_email','<span>','</span>'),
			'login_password'=>form_error('login_password','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->customer_model->authentication_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}


	public function checkout(){

		$response = $this->check_login();

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function add_to_wishlist(){

		$response = $this->check_login();

		if($response['success']['message']!='login_false'){

			$this->load->library('form_validation');
			$this->form_validation->set_rules('product_id','Product','trim|required|numeric|xss_clean');
			if($this->form_validation->run()==FALSE){
				$this->statusCode=400;
				$form_error_array = array('product_id'=>form_error('product_id','<span>','</span>')
				);

				$response_array['error_type'] = 'form';
				$response_array['errors'] = $form_error_array;
				$response_array['message'] = 'Invalid Inputs';
				$response=array('error'=>$response_array);
			}else{
				$response = $this->customer_model->add_to_wishlist_method();
			}			

		}		

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function check_login(){

		if($this->session->userdata('customer_logged_in')){
			$response_array['message'] = 'login_true';
		}else{
			$response_array['message'] = 'login_false';
		}

		$response=$response_array;
		$response=array('success'=>$response_array);

		return $response;
	}


	public function forgot_password_email_process(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('forgot_password_email','Email','trim|required|valid_email|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('forgot_password_email'=>form_error('forgot_password_email','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->customer_model->forgot_password_process_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function forgot_password_verify_otp(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('otp_forgot_password','OTP','trim|required|numeric|exact_length[6]|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('otp_forgot_password'=>form_error('otp_forgot_password','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->customer_model->forgot_password_verify_otp_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}


	public function set_new_password(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('new_password','Password','trim|required|min_length[6]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('confirm_new_password','Confirm password','trim|required|matches[new_password]');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('new_password'=>form_error('new_password','<span>','</span>'),
			'confirm_new_password'=>form_error('confirm_new_password','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->customer_model->set_new_password_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}


}
