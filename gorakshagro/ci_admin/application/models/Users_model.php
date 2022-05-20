<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("users")->num_rows();
	}

	public function getData_method($limit, $start){
		$this->db->select('id,fb_id,first_name,last_name,profile_pic');
		$this->db->order_by('id','desc');
		$this->db->limit($limit, $start);
		$query=$this->db->get('users');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function store_method(){

		$data = array('status'=>$this->input->post('status'),
		'block_status'=>$this->input->post('block_status')
		);

		if($this->input->post('dataId')){
			
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('users',$data);
			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}else{

			$this->db->insert('users',$data);
			$response_array['message'] = 'Successful Added';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}

		$this->session->set_flashdata('response', $response);

		return $response;
	}


	public function getDataById_method($fb_id){
		$this->db->select('users.id,
		users.fb_id,
		users.first_name,
		users.last_name,
		users.profile_pic,
		users.gender,
		users.dob,
		users.sub_caste,
		users.email,
		users.mobile,
		users.status,
		users.step_status,
		users.block_status,
		users.created_at,
		users.updated_at,
		marital_status.status,
		states.name as state,
		cities.name as city,		
		mother_tongue.language,
		religions.religion,
		caste.caste,
		education_levels.level as education_level,
		education_fields.field as education_field,
		working_professions.profession,
		working_sectors.sector as working_sector,
		annual_income.income,
		diet.type as diet_type,
		smoke.type as smoke_type,
		drink.type as drink_type,
		height.height,
		body_type.type as body_type,
		skin.type as skin_type');
		$this->db->from('users');
		$this->db->join('marital_status', 'users.marital_status_id=marital_status.id', 'left');
		$this->db->join('states', 'users.state_id=states.id', 'left');
		$this->db->join('cities', 'users.city_id=cities.id', 'left');		
		$this->db->join('mother_tongue', 'users.mother_tongue_id=mother_tongue.id', 'left');
		$this->db->join('religions', 'users.religion_id=religions.id', 'left');
		$this->db->join('caste', 'users.caste_id=caste.id', 'left');
		$this->db->join('education_levels', 'users.education_level_id=education_levels.id', 'left');
		$this->db->join('education_fields', 'users.education_field_id=education_fields.id', 'left');
		$this->db->join('working_professions', 'users.working_profession_id=working_professions.id', 'left');
		$this->db->join('working_sectors', 'users.working_sector_id=working_sectors.id', 'left');
		$this->db->join('annual_income', 'users.annual_income_id=annual_income.id', 'left');
		$this->db->join('diet', 'users.diet_type_id=diet.id', 'left');
		$this->db->join('smoke', 'users.smoke_type_id=smoke.id', 'left');
		$this->db->join('drink', 'users.drink_type_id=drink.id', 'left');
		$this->db->join('height', 'users.height_id=height.id', 'left');
		$this->db->join('body_type', 'users.body_type_id=body_type.id', 'left');
		$this->db->join('skin', 'users.skin_id=skin.id', 'left');		
		$this->db->where('users.fb_id', $fb_id);
		$this->db->order_by('users.id', 'desc');
		$query=$this->db->get();
		return $query->result();
	}

	public function getData_photos_method($fb_id){
		$this->db->select('imagefile1');
		$this->db->where('fb_id', $fb_id);
		$this->db->order_by('id', 'desc');
		$query=$this->db->get('gallery');
		return $query->result();
	}


	public function getsomeDataById_method($dataId){
		$this->db->select('id,first_name,last_name,status,step_status,block_status');
		$this->db->where('id', $dataId);
		$query=$this->db->get('users');
		return $query->result();
	}


	public function delete_method(){
		$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"
		$countDataId = count($dataIdArray);
		for($i=0;$i<$countDataId;$i++){
			$DataId=$dataIdArray[$i];
			$this->db->where('id',$DataId); 
			$query=$this->db->delete('users');
		}

		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);
		
		$this->session->set_flashdata('response', $response);
		return $response;	
	}	

}
