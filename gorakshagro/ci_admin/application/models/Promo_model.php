<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("promo")->num_rows();
	}

	public function getData_method($limit, $start){
		$this->db->select('id,imagefile1,title');
		$this->db->limit($limit, $start);
		$query=$this->db->get('promo');

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function store_method(){

		$this->load->library('upload');
		
		/*Start Imagefile1 Upload*/
		if($this->input->post('imageexist1')){
			$filename1=$this->input->post('imageexist1');
		}else{
			$destination='promo';
			$filename1=str_replace(' ', '', date('Ymdhis').'_'.$_FILES['imagefile1']['name']);
			$max_size='500';
			$max_width='1600';
			$max_height='950';
			$min_width='430';
			$min_height='589';

			$this->upload->initialize($this->set_upload_options($destination,$filename1,$max_size,$max_width,$max_height,$min_width,$min_height));

			if(!$this->upload->do_upload('imagefile1')){

				$response_array['error_type'] = 'file';
				$response_array['errors'] = $this->upload->display_errors();
				$response_array['error_field'] = 'imagefile1';
				$response_array['message'] = 'Successful Added';
				$response_array['class'] = 'alert-success';
				$response=$response_array;
				$response=array('error'=>$response_array);

				return $response;
	        }
		}		
        /*End Imagefile1 Upload*/


		$data = array('imagefile1'=>$filename1,
		'title'=>$this->input->post('title'),
		'subtitle'=>$this->input->post('subtitle'),
		'url'=>$this->input->post('url'),
		'sort_order'=>$this->input->post('sort_order'),
		'status'=>$this->input->post('status')
		);

		if($this->input->post('dataId')){
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('promo',$data);

			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			
		}else{
			$this->db->insert('promo',$data);

			$response_array['message'] = 'Successful Added';
			$response_array['class'] = 'alert-success';
		}

		$response=$response_array;
		$response=array('success'=>$response_array);

		$this->session->set_flashdata('response', $response);
		
		return $response;
	}


	public function getDataById_method($dataId){
		$this->db->select('id,imagefile1,title,subtitle,url,sort_order,status');	
		$this->db->where('id',$dataId);		
		$query=$this->db->get('promo');
		return $query->result();
	}	


	private function set_upload_options($destination,$filename,$max_size,$max_width,$max_height,$min_width,$min_height){   
	//  upload an image options
		$config = array();
		$config['file_name'] = $filename;
		$config['upload_path'] = '../images/'.$destination.'/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = $max_size;
		$config['max_width'] = $max_width;
		$config['max_height'] = $max_height;	
		$config['min_width'] = $min_width;
		$config['min_height'] = $min_height;	
		$config['overwrite'] = FALSE;

		return $config;
	}

	public function imageresize($filename){
		$this->load->library('image_lib');

		$this->resize_thumb($filename);

	}

	public function resize_thumb($filename){

		$imagesource1='../images/promo/'.$filename;
		$newimagesource1='../images/promo/thumbs/'.$filename;
		// Configuration 
		$config1['image_library'] = 'gd2'; 
		$config1['source_image'] = $imagesource1; 
		$config1['new_image'] = $newimagesource1; 
		$config1['create_thumb'] = TRUE; 
		$config1['maintain_ratio'] = TRUE; 
		$config1['width'] = 300; 
		$config1['height'] = 240; 

		// Load the Library 
		$this->image_lib->initialize($config1);

		// resize image
		$this->image_lib->resize(); 

		// handle if there is any problem 
		if ( ! $this->image_lib->resize()){ 
			echo $this->image_lib->display_errors(); 
		} 
	}

	public function delete_method(){
		$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"
		$countDataId = count($dataIdArray);
		for($i=0;$i<$countDataId;$i++){
			$DataId=$dataIdArray[$i];

			$this->delete_file_method($DataId,$data_field1='imagefile1');

			$this->db->where('id',$DataId); 
			$query=$this->db->delete('promo');
		}
	
		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';		
		$response=$response_array;
		$response=array('success'=>$response_array);

		$this->session->set_flashdata('response', $response);
		return $response;	
	}	


	public function delete_file_method($dataId,$data_field1='no_field'){
		if($data_field1=='no_field'){
			$data_field=$this->input->post('data_field');
		}else{
			$data_field=$data_field1;
		}

		$this->db->select($data_field);
		$this->db->where('id',$dataId); 
		$query=$this->db->get('promo',1);
		$row=$query->row();		

		$data=array($data_field=>'no_file');
		$this->db->where('id',$dataId);
		if($this->db->update('promo',$data)){
			unlink(WEBSITEPATH.'/images/promo/'.$row->$data_field);
		}

		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';		
		$response=$response_array;
		$response=array('success'=>$response_array);
		return $response;
	}

}
