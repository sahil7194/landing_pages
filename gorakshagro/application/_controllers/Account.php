<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('customer_logged_in')!='loggedIn'){ redirect(base_url()); }
		$this->load->model(array('account_model'));		
	}

	public function index(){
		$this->data['title']='dashboard';
		$this->data['selected_menu']='dashboard';
		$this->load->template('account/index', $this->data);
	}


	public function orders(){
		$this->data['title']='orders';
		$this->data['selected_menu']='orders';

		//Pagination
		$config["base_url"] = base_url().'index.php/account/orders/';
		$config["total_rows"] = $this->account_model->orders_record_count();
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
		$this->data["orders"] = $this->account_model->getData_Orders($config["per_page"], $page);
		$this->data["links"] = $this->pagination->create_links();
		//End Pagination
		
		$this->load->template('account/orders', $this->data);

	}

	public function wishlist(){
		$this->data['title']='wishlist';
		$this->data['selected_menu']='wishlist';
		$this->data["products"] = $this->account_model->getData_Wishlist();
		$this->load->template('account/wishlist', $this->data);
	}

	public function remove_wishlist_item(){
		$response=$this->account_model->remove_wishlist_item_method();

		if(array_key_exists('error', $response)){
			$this->statusCode=400;
		}
			
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function addresses(){
		$this->data['title']='Address Book';
		$this->data['selected_menu']='addresses';
		$this->data['addresses'] = $this->account_model->getData_Addresses();
		$this->data['states'] = $this->account_model->getData_States();
		$this->load->template('account/addresses/index', $this->data);
	}

	public function addresses_create(){
		$this->data['title']='Address Book';
		$this->data['selected_menu']='addresses';
		$this->data['states'] = $this->account_model->getData_States();
		$this->load->template('account/addresses/create', $this->data);
	}

	public function address_store(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('contact_name','Name','trim|required|xss_clean');
		$this->form_validation->set_rules('mobile','Mobile','trim|required|numeric|exact_length[10]|xss_clean');
		$this->form_validation->set_rules('pincode','Pincode','trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('address','Address','trim|required|xss_clean');
		$this->form_validation->set_rules('city','City','trim|required|xss_clean');
		$this->form_validation->set_rules('state','State','trim|required|xss_clean');
		$this->form_validation->set_rules('address_type','Address type','trim|required|xss_clean');
		$this->form_validation->set_rules('alternate_phone','Alternate Phone','trim|xss_clean|numeric');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('contact_name'=>form_error('contact_name','<span>','</span>'),
			'mobile'=>form_error('mobile','<span>','</span>'),
			'pincode'=>form_error('pincode','<span>','</span>'),
			'address'=>form_error('address','<span>','</span>'),
			'city'=>form_error('city','<span>','</span>'),
			'state'=>form_error('state','<span>','</span>'),
			'address_type'=>form_error('address_type','<span>','</span>'),
			'alternate_phone'=>form_error('alternate_phone','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->account_model->address_store_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}			
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function profile(){
		$this->data['title']='My Profile';
		$this->data['selected_menu']='profile';
		$this->data['profile_info'] = $this->account_model->getData_profile_method();
		$this->load->template('account/profile', $this->data);
	}

	public function profile_store(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('profile_fname','First Name','trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('profile_lname','Last Name','trim|required|alpha|xss_clean');
		$this->form_validation->set_rules('profile_mobile','Mobile','trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('profile_gender','Gender','trim|required|xss_clean');

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('profile_fname'=>form_error('profile_fname','<span>','</span>'),
			'profile_lname'=>form_error('profile_lname','<span>','</span>'),
			'profile_mobile'=>form_error('profile_mobile','<span>','</span>'),
			'profile_gender'=>form_error('profile_gender','<span>','</span>')
			);

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response=$this->account_model->profile_store_method();
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}
		}

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}

	public function change_password(){
		$this->data['title']='Change Password';
		$this->data['selected_menu']='change_password';
		$this->load->template('account/change_password', $this->data);
	}

	public function change_password_process(){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('current_password','Current Password','trim|required|xss_clean');
		$this->form_validation->set_rules('new_password','Password','trim|required|min_length[8]|max_length[12]|matches[confirm_password]|xss_clean');
		$this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|xss_clean');	

		if($this->form_validation->run()==FALSE){
			$this->statusCode=400;

			$form_error_array = array('current_password'=>form_error('current_password','<span>','</span>'),
			'new_password'=>form_error('new_password','<span>','</span>'),
			'confirm_password'=>form_error('confirm_password','<span>','</span>'));

			$response_array['error_type'] = 'form';
			$response_array['errors'] = $form_error_array;
			$response_array['message'] = 'Invalid Inputs';
			$response=array('error'=>$response_array);

		}else{			
			$response = $this->account_model->change_password_method();
			
			if(array_key_exists('error', $response)){
				$this->statusCode=400;
			}
			
		}
		
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
		
	}


	public function logout(){

		$this->session->unset_userdata('customer_id');
		$this->session->unset_userdata('fname');
		$this->session->unset_userdata('lname');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('customer_logged_in');

		$this->session->sess_destroy();

		$response_array['message'] = 'success';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}



}
