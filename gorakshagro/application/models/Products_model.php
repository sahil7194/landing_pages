<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count($slug) {
		$this->db->select('product.product_name');
		$this->db->from('product');
		$this->db->join('category','product.category_id=category.id');
		$this->db->where('category.slug', $slug);
		$this->db->where('product.status', 1);
		return  $this->db->get()->num_rows();
	}

	public function getData_products($limit, $start, $slug){
		$this->db->select('product.id,
		product.product_name,
		product.price,
		product.special_price,
		product.product_image,
		product.slug,
		category.meta_title,
		category.meta_description,
		category.meta_keywords');
		$this->db->from('product');
		$this->db->join('category','product.category_id=category.id');
		$this->db->where('category.slug', $slug);
		$this->db->where('product.status', 1);

		if($this->session->userdata('sort_option') == 'high_to_low'){
			$this->db->order_by('product.special_price', 'desc');
		}else if($this->session->userdata('sort_option') == 'low_to_high'){
			$this->db->order_by('product.special_price', 'asc');
		}else{
			$this->db->order_by('product.id', 'desc');
		}

		$this->db->limit($limit, $start);
		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function getData_Other_products($slug, $category_id){
		$this->db->select('product.id,
		product.product_name,
		product.price,
		product.special_price,
		product.product_image,
		product.slug');
		$this->db->from('product');
		$this->db->join('category','product.category_id=category.id');
		$this->db->where('product.slug <>', $slug);
		$this->db->where('product.category_id', $category_id);
		$this->db->where('product.status', 1);
		$this->db->limit(10);
		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function getData_products_BySearch($search_keyword){
		$this->db->select('product.id,
		product.product_name,
		product.price,
		product.special_price,
		product.product_image,
		product.slug');
		$this->db->from('product');
		$this->db->join('category','product.category_id=category.id');
		$this->db->like('product.product_tags', $search_keyword);
		$this->db->where('product.status', 1);
		$this->db->limit(10);
		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	
	public function getData_productDetails($slug){
		$this->db->select('product.id,
		product.category_id,
		product.product_name,
		product.description,
		product.product_model,
		product.price,
		product.special_price,
		product.product_image,
		product.meta_title,
		product.meta_description,
		product.meta_keywords,
		product.product_tags,
		product.slug,
		brand.brand,
		category.category');
		$this->db->from('product');
		$this->db->join('brand','product.brand_id=brand.id', 'left');
		$this->db->join('category','product.category_id=category.id');
		$this->db->where('product.slug', $slug);
		$this->db->where('product.status', 1);		
		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function getData_productImages($slug){
		$this->db->select('product_images.imagefile1');
		$this->db->from('product_images');
		$this->db->join('product','product_images.product_id=product.id', 'left');
		$this->db->where('product.slug', $slug);
		$this->db->where('product.status', 1);		
		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function get_ProductID_bySlug($slug){
		$this->db->select('id');
		$this->db->where('slug', $slug);
		$row=$this->db->get('product')->row();

		return $row->id;

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


	public function get_stock_status($productId){

		$query = $this->db->query('SELECT id, ( SELECT SUM(qty) FROM product_options a WHERE product_id = '.$productId.' ) AS total FROM product_options b WHERE product_id = '.$productId);
		
		$count = $query->num_rows();		

		if($count > 0){
			$row = $query->row();
			$total =  $row->total;

			if($total > 0){
				$stock_status = 'IN';
			}else{
				$stock_status = 'OUT';
			}

		}else{
			$this->db->select('quantity');
			$this->db->where('id', $productId);
			$query = $this->db->get('product');
			$row = $query->row();
			$total =  $row->quantity;

			if($total > 0){
				$stock_status = 'IN';
			}else{
				$stock_status = 'OUT';
			}
		}

		return $stock_status;

	}

	public function set_sort_option_method(){
		$sort_option = $this->input->post('sort_option');
		$this->session->set_userdata(array('sort_option'=>$sort_option));

		$response_array['message'] = 'Sort option changed';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);

		return $response;
	}

}
