<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $data=array();

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')!='loggedIn'){ redirect('login'); }
		$this->data['selected_menu']='dashboard';
	}

	public function index(){
		$this->data['title'] = "Dashboard";
		$this->load->template('dashboard',$this->data);
	}

	
}
