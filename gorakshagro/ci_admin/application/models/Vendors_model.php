<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("vendors")->num_rows();
	}

	public function getData_method($limit, $start){
		$this->db->select('id,vendor_name');
		$this->db->limit($limit, $start);
		$query=$this->db->get('vendors');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function store_method(){

		$data = array('vendor_name'=>$this->input->post('vendor_name'),
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'email'=>$this->input->post('email'),
			'phone'=>$this->input->post('phone'),
			'mobile'=>$this->input->post('mobile'),
			'fax'=>$this->input->post('fax'),
			'address1'=>$this->input->post('address1'),
			'address2'=>$this->input->post('address2'),
			'pincode'=>$this->input->post('pincode'),
			'country_id'=>$this->input->post('country_id'),
			'state_id'=>$this->input->post('state_id'),
			'city_id'=>$this->input->post('city_id'),
			'status'=>$this->input->post('status')
		);

		if($this->input->post('dataId')){
			
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('vendors',$data);
			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}else{

			$this->db->insert('vendors',$data);
			$response_array['message'] = 'Successful Added';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}

		$this->session->set_flashdata('response', $response);

		return $response;
	}


	public function getDataById_method($dataId){
		$this->db->where('id',$dataId);		
		$query=$this->db->get('vendors');
		return $query->result();
	}

	public function delete_method(){
		$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"

		$countDataId = count($dataIdArray);
		for($i=0;$i<$countDataId;$i++){
			$DataId=$dataIdArray[$i];
			$this->db->where('id',$DataId); 
			$query=$this->db->delete('vendors');
		}

		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);
				
		$this->session->set_flashdata('response', $response);
		return $response;
	}	

}
