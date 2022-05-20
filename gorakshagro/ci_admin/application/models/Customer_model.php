<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("customer")->num_rows();
	}

	public function getData_method($limit, $start){

		$this->db->select('id,email,mobile,fname,lname,date_created');
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit, $start);
		$query=$this->db->get('customer');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function store_method(){			

		if($this->input->post('dataId')){	

			$data = array(
				'block_status'=>$this->input->post('block_status')
			);
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('customer',$data);

			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);

			$this->session->set_flashdata('response', $response);

			return $response;

		}

		
	}


	public function getDataById_method($dataId){
		$this->db->where('id',$dataId);		
		$query=$this->db->get('customer');
		return $query->result();
	}

	public function getData_addressById_method($dataId){
		$this->db->where('customer_id',$dataId);		
		$query=$this->db->get('customer_address');
		return $query->result();
	}

	// public function delete_method(){
	// 	$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"

	// 	$countDataId = count($dataIdArray);
	// 	for($i=0;$i<$countDataId;$i++){
	// 		$DataId=$dataIdArray[$i];
	// 		$this->db->where('id',$DataId); 
	// 		$query=$this->db->delete('customer');
	// 	}

	// 	$response_array['message'] = 'Successful Deleted';
	// 	$response_array['class'] = 'alert-success';
	// 	$response=$response_array;
	// 	$response=array('success'=>$response_array);

	// 	$this->session->set_flashdata('response', $response);
	// 	return $response;
	// }	

}
