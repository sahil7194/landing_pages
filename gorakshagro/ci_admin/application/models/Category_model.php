<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("category")->num_rows();
	}

	public function getData_method($limit, $start){
		$this->db->select('id,category,parent_id');
		$this->db->limit($limit, $start);
		$query=$this->db->get('category');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	

	public function store_method(){

		$slug = preg_replace('/[^A-Za-z0-9\-\']/', '', str_replace(' ', '-', strtolower($this->input->post('category'))));

		if($slug!=$this->input->post('existing_slug')){			
			$slug = $this->get_slug($slug);
		}else{
			if($this->input->post('existing_slug')){
				$slug = $this->input->post('existing_slug');
			}else{
				$slug = $this->get_slug($slug);
			}						
		}

		$data = array('category'=>$this->input->post('category'),
			'parent_id'=>$this->input->post('parent_id'),
			'meta_title'=>$this->input->post('meta_title'),
			'meta_description'=>$this->input->post('meta_description'),
			'meta_keywords'=>$this->input->post('meta_keywords'),
			'slug'=>$slug,
			'status'=>$this->input->post('status')
		);

		if($this->input->post('dataId')){
			
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('category',$data);
			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}else{

			$this->db->insert('category',$data);
			$response_array['message'] = 'Successful Added';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}

		$this->session->set_flashdata('response', $response);

		return $response;
	}

	public function get_slug($slug){
		$this->db->where('slug',$slug);
		$count = $this->db->get('category')->num_rows();
		if($count>0){
			$random_string = $this->generateRandomString();
			$slug.='---'.$random_string;
			$this->get_slug($slug);
		}

		return $slug;
	}

	public function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}


	public function getDataById_method($dataId){
		$this->db->where('id',$dataId);		
		$query=$this->db->get('category');
		return $query->result();
	}

	public function delete_method(){
		$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"

		$countDataId = count($dataIdArray);
		for($i=0;$i<$countDataId;$i++){
			$DataId=$dataIdArray[$i];
			$this->db->where('id',$DataId); 
			$query=$this->db->delete('category');
		}

		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);
				
		$this->session->set_flashdata('response', $response);
		return $response;
	}	

}
