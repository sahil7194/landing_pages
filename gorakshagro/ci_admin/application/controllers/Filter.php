<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller {	

	public $data=array();
	public $statusCode=200;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')!='loggedIn'){ redirect('login'); }
		$this->load->model(array('filter_model','common_model'));
		$this->data['title']='Filter';
		$this->data['selected_menu']='filter';
	}

	public function users(){
		$this->data['result_states'] = $this->filter_model->getData_state_method();
		$this->data['result_religion'] = $this->filter_model->getData_religion_method();
		$this->load->template('filter/users',$this->data);
	}

	public function getData_city_ByState(){
		$result = $this->filter_model->getData_city_ByState_method();
		$response = array('success'=>$result);
		return $this->output
			->set_status_header($this->statusCode)
			->set_content_type('application/json', 'utf-8')			
			->set_output(json_encode($response));

	}

	public function search_user(){
		$this->data['result'] = $this->filter_model->search_user_method();
		$this->data['result_states'] = $this->filter_model->getData_state_method();
		$this->data['result_cities'] = $this->filter_model->getData_city_ByState_method();
		$this->data['result_religion'] = $this->filter_model->getData_religion_method();
		
		$this->load->template('filter/users',$this->data);
	}

	
}
