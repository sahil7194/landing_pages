<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		$this->load->model(array('common_model'));
	}
	
	public function index(){
		$this->data["banners"] = $this->common_model->getData_banners($slug='home');
		$this->data["featured_products"] = $this->common_model->getData_featured_products();
		$this->data["promos"] = $this->common_model->getData_promos();
		$this->load->template('home', $this->data);
	}


	public function p($page='about-us'){
		if($page=='about-us'){

		}else if($page=='terms-and-condtions'){
			$this->data["meta_title"] = 'Terms & Condtions';
			$this->data["meta_description"] = 'Terms & Condtions';
			$this->data["meta_keywords"] = 'Terms & Condtions';
			$this->load->template('terms-and-condtions', $this->data);
		}else if($page=='privacy-policy'){
			$this->data["meta_title"] = 'Privacy Policy';
			$this->data["meta_description"] = 'Privacy Policy';
			$this->data["meta_keywords"] = 'Privacy Policy';
			$this->load->template('privacy-policy', $this->data);
		}		
	}


	public function activate_select_location(){
		$this->session->set_userdata(array('select_location'=>'active'));

		$response_array['message'] = 'Activated';
		$response=$response_array;
		$response=array('success'=>$response_array);

		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));
	}


}
