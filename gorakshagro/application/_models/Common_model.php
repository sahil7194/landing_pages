<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getData_banners($slug){	
		
		$this->load->library('user_agent');
		if ($this->agent->is_mobile()){
			$device = 'mobile';
		}else{
			$device = 'desktop';
		}
		//$this->db->where('category_slug', 'home');
		$this->db->where('status', 's_act');
		$this->db->where('device', $device);
		$this->db->order_by('sort_order', 'asc');
		$query = $this->db->get('banners');
		return $query->result();
	}
	
	public function getData_featured_products(){	
		
		$this->db->select('product.id,
		product.product_name,
		product.price,
		product.special_price,
		product.product_image,
		product.slug');
		$this->db->from('product');
		$this->db->join('featured','product.id=featured.product_id');
		$this->db->where('product.status', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function getData_promos(){	
		$this->db->where('status', 1);
		$this->db->order_by('sort_order', 'asc');
		$query = $this->db->get('promo');
		return $query->result();
	}

}
