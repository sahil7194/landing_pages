<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public $data=array();
	public $statusCode=200;
	
	public function __construct(){
		parent::__construct();		
		$this->load->model(array('account_model'));
		if($this->session->userdata('customer_logged_in')!='loggedIn'){ redirect('cart/'); }
		if($this->cart->total_items() <= 0){ redirect('cart'); }
	}

	public function index(){
		$this->data['addresses'] = $this->account_model->getData_Addresses();
		$this->data['addresse_codes'] = $this->account_model->getData_AddressCodes();
		$this->data['states'] = $this->account_model->getData_States();
		$this->data["meta_title"] = 'Checkout';
		$this->data["meta_description"] = 'Checkout';
		$this->data["meta_keywords"] = 'Checkout';
		$this->load->template('checkout',$this->data);
	}

	

}
