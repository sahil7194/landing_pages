<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addresscode_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("addresscode")->num_rows();
	}

	public function getData_method($limit, $start){
		$this->db->select('id,code');
		$this->db->limit($limit, $start);
		$query=$this->db->get('addresscode');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function store_method(){

		$data = array(
			'code'=>strtoupper($this->input->post('code'))
		);

		if($this->input->post('dataId')){
			
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('addresscode',$data);
			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}else{

			$this->db->insert('addresscode',$data);
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
		$query=$this->db->get('addresscode');
		return $query->result();
	}

	public function delete_method(){
		$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"

		$countDataId = count($dataIdArray);
		for($i=0;$i<$countDataId;$i++){
			$DataId=$dataIdArray[$i];
			$this->db->where('id',$DataId); 
			$query=$this->db->delete('addresscode');
		}

		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);
				
		$this->session->set_flashdata('response', $response);
		return $response;
	}	

}
