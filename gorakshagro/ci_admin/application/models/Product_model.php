<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("product")->num_rows();
	}

	public function getData_method($limit, $start){
		$this->db->select('id,product_name,slug');
		$this->db->limit($limit, $start);
		$this->db->order_by('id', 'desc');
		$query=$this->db->get('product');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function getData_search_method($search_keyword) {
		$this->db->select('id,product_name,slug');
		$this->db->like('product.product_tags', $search_keyword);		
		$query=$this->db->get('product');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function store_method(){	

		$slug = $this->string_filter($this->input->post('product_name'));

		if($slug!=$this->input->post('existing_slug')){
			$slug = $this->get_slug($this->input->post('product_name'));
		}else{
			if($this->input->post('existing_slug')){
				$slug = $this->input->post('existing_slug');
			}else{
				$slug = $this->get_slug($this->input->post('product_name'));
			}						
		}

		$data = array('vendor_id'=>$this->input->post('vendor_id'),
			'category_id'=>$this->input->post('category_id'),
			'product_name'=>$this->input->post('product_name'),
			'description'=>$this->input->post('description'),
			'product_model'=>$this->input->post('product_model'),
			'sku'=>$this->input->post('sku'),
			'price'=>$this->input->post('price'),
			'special_price'=>$this->input->post('special_price'),
			'quantity'=>0,
			'brand_id'=>$this->input->post('brand'),
			'meta_title'=>$this->input->post('meta_title'),
			'meta_description'=>$this->input->post('meta_description'),
			'meta_keywords'=>$this->input->post('meta_keywords'),
			'product_tags'=>$this->input->post('product_tags'),
			'slug'=>$slug,
		);

		if($this->input->post('dataId')){
			
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('product',$data);

			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}else{			
			$this->db->insert('product',$data);

			$response_array['message'] = 'Successful Added';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}

		$this->session->set_flashdata('response', $response);

		return $response;
	}

	public function string_filter($string){

		$string = preg_replace('/[^A-Za-z0-9\-\']/', '', str_replace(' ', '-', strtolower($string)));		

		return $string;
	}

	public function get_slug($slug){

		$slug = preg_replace('/[^A-Za-z0-9\-\']/', '', str_replace(' ', '-', strtolower($slug)));

		$this->db->where('slug',$slug);
		$count = $this->db->get('product')->num_rows();
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
		$query=$this->db->get('product');
		return $query->result();
	}


	public function delete_method(){
		$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"

		$countDataId = count($dataIdArray);
		for($i=0;$i<$countDataId;$i++){
			$DataId=$dataIdArray[$i];
			$this->db->where('id',$DataId); 
			$query=$this->db->delete('product');
		}

		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);
				
		$this->session->set_flashdata('response', $response);
		return $response;
	}

	
	public function getData_images($dataId) {
		$this->db->select('id,imagefile1');
		$this->db->where('product_id', $dataId);
		$query = $this->db->get("product_images");

		return $query->result();
	}

	public function storeImage_method(){

		$this->load->library('upload');
		
		/*Start Imagefile1 Upload*/
		if($this->input->post('imageexist1')){
			$filename1=$this->input->post('imageexist1');
		}else{
			$destination='products';
			$filename1=str_replace(' ', '', date('Ymdhis').'_'.$_FILES['imagefile1']['name']);
			$max_size='500';
			$max_width='800';
			$max_height='947';
			$min_width='570';
			$min_height='675';

			$this->upload->initialize($this->set_upload_options($destination,$filename1,$max_size,$max_width,$max_height,$min_width,$min_height));

			if(!$this->upload->do_upload('imagefile1')){

				$response_array['error_type'] = 'file';
				$response_array['error_field'] = 'imagefile1';
				$response_array['errors'] = $this->upload->display_errors();
				$response=array('error'=>$response_array);

				return $response;
	        }

	        $this->imageresize($filename1);
		}		
        /*End Imagefile1 Upload*/


		$data = array('product_id'=>$this->input->post('dataId'),
		'imagefile1'=>$filename1,
		);

		$this->db->insert('product_images',$data);

		$response_array['message'] = 'Successful Added';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);

		$this->session->set_flashdata('response', $response);
		
		return $response;
	}

	private function set_upload_options($destination,$filename,$max_size,$max_width,$max_height,$min_width,$min_height){   
	//  upload an image options
		$config = array();
		$config['file_name'] = $filename;
		$config['upload_path'] = '../images/uploads/'.$destination.'/';
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

		$imagesource1='../images/uploads/products/'.$filename;
		$newimagesource1='../images/uploads/products/thumbs/'.$filename;
		// Configuration 
		$config1['image_library'] = 'gd2'; 
		$config1['source_image'] = $imagesource1; 
		$config1['new_image'] = $newimagesource1; 
		$config1['create_thumb'] = TRUE; 
		$config1['thumb_marker'] = ''; 
		$config1['maintain_ratio'] = TRUE; 
		$config1['width'] = 300; 
		$config1['height'] = 355; 

		// Load the Library 
		$this->image_lib->initialize($config1);

		// resize image
		$this->image_lib->resize(); 

		// handle if there is any problem 
		if ( ! $this->image_lib->resize()){ 
			echo $this->image_lib->display_errors(); 
		} 
	}


	public function delete_file_method($dataId,$productId){		

		$this->db->select('imagefile1');
		$this->db->where('id',$dataId); 
		$this->db->where('product_id',$productId); 
		$query=$this->db->get('product_images',1);
		$row=$query->row();		

		
		$this->db->where('id',$dataId);
		$this->db->where('product_id',$productId);
		$this->db->delete('product_images');

		unlink(WEBSITEPATH.'/images/uploads/products/'.$row->imagefile1);

		if(unlink(WEBSITEPATH.'/images/uploads/products/thumbs/'.$row->imagefile1)){
			$response_array['message'] = 'Successful Deleted';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);	
		}else{
			$response_array['error_type'] = 'file';
			$response_array['errors'] = 'Unable to delete image';
			$response=array('error'=>$response_array);
		}

		
		return $response;
	}


	public function set_display_image_method(){
		$data = array('product_image'=>$this->input->post('image'));
		$this->db->where('id',$this->input->post('product_id'));
		$this->db->update('product',$data);

		$response_array['message'] = 'Successful Updated';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);

		return $response;
	}


	public function storeOptions_method(){	

		if($this->input->post('dataId')){

			$product_id = $this->input->post('dataId');

			$this->db->select('option_group_id');
			$this->db->where('id',$this->input->post('option_id'));
			$row = $this->db->get('option')->row();
			$option_group_id = $row->option_group_id;

			$data = array('product_id'=>$product_id,
				'option_id'=>$this->input->post('option_id'),
				'option_group_id'=>$option_group_id,
				'qty'=>$this->input->post('qty'),
				'amount'=>$this->input->post('option_amount')			
			);			
			
			$this->db->insert('product_options',$data);
			$attribute_id = $this->db->insert_id();


			$response_array['message'] = 'Successful Added';
			$response_array['class'] = 'alert-success';
			$response_array['attribute_id'] = $this->input->post('attribute_id');
			$response_array['attribute_value'] = $this->input->post('attribute_value');
			$response=$response_array;
			$response=array('success'=>$response_array);
		}

		$this->session->set_flashdata('response', $response);

		return $response;
	}

	public function getData_product_options_groups($productId){

		$this->db->select('option_groups.id as option_group_id, option_groups.name as group');
		$this->db->from('option_groups');
		$this->db->join('product_options','option_groups.id=product_options.option_group_id','inner');
		$this->db->where('product_options.product_id', $productId);
		$this->db->group_by('option_group_id');
		$this->db->group_by('group');
		$query=$this->db->get();

		return $query->result();

	}

	public function getData_product_options($productId){

		$this->db->select('product_options.id as product_option_id,
		product_options.option_group_id,
		product_options.qty,
		product_options.amount,
		option.id as option_id,
		option.name as option');
		$this->db->from('product_options');
		$this->db->join('option','product_options.option_id=option.id');
		$this->db->where('product_options.product_id', $productId);	
		$query=$this->db->get();

		return $query->result();

	}

	public function update_product_option_method(){		
		
		$product_option_id = $this->input->post('product_option_id');
		$productId = $this->input->post('product_id');

		$data = array(
			'amount'=>$this->input->post('product_option_price'),
			'qty'=>$this->input->post('product_option_qty')
		);

		$this->db->where('id', $product_option_id);
		$this->db->where('product_id', $productId);
		$this->db->update('product_options', $data);

		$response_array['message'] = 'Successful Updated';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);

		$this->session->set_flashdata('responseOptions', $response);
		
		return $response;
	}

	public function remove_product_option_method($product_option_id,$productId){		
	
		$this->db->where('id',$product_option_id);
		$this->db->where('product_id',$productId);
		$this->db->delete('product_options');

		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);	
		
		return $response;
	}



	public function updateStatus_method(){	

		$data = array(
			'status'=>$this->input->post('status')
		);

		if($this->input->post('dataId')){
			
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('product',$data);

			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}

		$this->session->set_flashdata('responseStatus', $response);

		return $response;
	}



}
