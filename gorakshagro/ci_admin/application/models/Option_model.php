<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("option_groups")->num_rows();
	}

	public function getData_method($limit, $start){
		$this->db->select('id,name');
		$this->db->limit($limit, $start);
		$query=$this->db->get('option_groups');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function store_method(){

		$data = array('name'=>$this->input->post('name'));

		if($this->input->post('dataId')){
			
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('option_groups',$data);

			$options = $this->input->post('options');

			$options_id = $this->input->post('options_id');
			$i=0;

			foreach ($options as $option) {
				$data_options = array('name'=>$option);
				$this->db->where('id',$options_id[$i]);
				$this->db->update('option',$data_options);
				$i++;
			}

			$options_new = $this->input->post('options_new');
			if($options_new>0){
				foreach ($options_new as $option) {
					$this->db->insert('option',array('option_group_id'=>$this->input->post('dataId'), 'name'=>$option));
				}
			}			

			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}else{

			$this->db->insert('option_groups',$data);
			$group_id = $this->db->insert_id();

			$options = $this->input->post('options');
			foreach ($options as $option) {
				$this->db->insert('option',array('option_group_id'=>$group_id, 'name'=>$option));
			}
						
			$response_array['message'] = 'Successful Added';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}

		$this->session->set_flashdata('response', $response);

		return $response;
	}


	public function getDataById_method($dataId){
		$this->db->select('option.id,
		option.option_group_id,
		option.name as option,
		option_groups.id as group_id,
		option_groups.name as group');
		$this->db->from('option');
		$this->db->join('option_groups','option.option_group_id=option_groups.id');
		$this->db->where('option_groups.id',$dataId);
		$query=$this->db->get();
		return $query->result();
	}

	public function delete_method(){
		$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"

		$countDataId = count($dataIdArray);
		for($i=0;$i<$countDataId;$i++){
			$DataId=$dataIdArray[$i];
			$this->db->where('id',$DataId); 
			$query=$this->db->delete('option_groups');
		}

		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);
				
		$this->session->set_flashdata('response', $response);
		return $response;
	}

	public function remove_option_value_name_method(){
		$dataId = $this->input->post('data_id'); 

		$this->db->where('id',$dataId); 
		if($this->db->delete('option')){
			$response_array['message'] = 'Successful Deleted';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}else{
			$response_array['message'] = 'Unable to delete';
			$response_array['class'] = 'alert-danger';
			$response=$response_array;
			$response=array('error'=>$response_array);
		}
				
		$this->session->set_flashdata('response', $response);
		return $response;
	}
	

}
