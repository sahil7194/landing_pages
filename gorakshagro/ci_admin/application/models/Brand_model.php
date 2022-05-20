<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("brand")->num_rows();
	}

	public function getData_method($limit, $start){
		$this->db->select('id,brand');
		$this->db->limit($limit, $start);
		$query=$this->db->get('brand');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function store_method(){

		$data = array('brand'=>$this->input->post('brand'),
			'status'=>$this->input->post('status')
		);

		if($this->input->post('dataId')){
			
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('brand',$data);
			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}else{

			$this->db->insert('brand',$data);
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
		$query=$this->db->get('brand');
		return $query->result();
	}

	public function delete_method(){
		$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"

		$countDataId = count($dataIdArray);
		for($i=0;$i<$countDataId;$i++){
			$DataId=$dataIdArray[$i];
			$this->db->where('id',$DataId); 
			$query=$this->db->delete('brand');
		}

		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);
				
		$this->session->set_flashdata('response', $response);
		return $response;
	}	

}
