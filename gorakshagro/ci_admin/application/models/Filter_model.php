<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getData_state_method(){
		$this->db->select('id,name');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get('states');
		return $query->result();
	}

	public function getData_city_ByState_method(){
		$this->db->select('id,name');		
		$this->db->where('state_id', $this->input->post('state_id'));
		$this->db->order_by('name', 'asc');
		$query=$this->db->get('cities');
		return $query->result();
	}


	public function getData_religion_method(){
		$this->db->select('id,religion');		
		$query=$this->db->get('religions');
		return $query->result();
	}

	public function search_user_method(){

		if($this->input->post('search')){

			$this->db->select('id,fb_id,first_name,last_name,profile_pic');
			$this->db->order_by('id','desc');

			if($this->input->post('gender')){
				$this->db->where('gender', $this->input->post('gender'));
			}

			if($this->input->post('state_id')){
				$this->db->where('state_id', $this->input->post('state_id'));
			}

			if($this->input->post('city_id')){
				$this->db->where('city_id', $this->input->post('city_id'));
			}

			if($this->input->post('religion_id')){
				$this->db->where('religion_id', $this->input->post('religion_id'));
			}

			if($this->input->post('block_status')){
				$this->db->where('block_status', $this->input->post('block_status'));
			}

			$query=$this->db->get('users');

			return $query->result();
		}
	}


}
