<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->library('encryption');
	}


	public function address_store_method(){	

		$data = array('customer_id'=>$this->session->userdata('customer_id'),
			'contact_name'=>$this->input->post('contact_name'),
			'mobile'=>$this->input->post('mobile'),
			'pincode'=>$this->input->post('pincode'),
			'locality'=>$this->input->post('locality'),
			'address'=>$this->input->post('address'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'landmark'=>$this->input->post('landmark'),
			'alternate_phone'=>$this->input->post('alternate_phone'),
			'address_type'=>$this->input->post('address_type')
		);

		if($this->input->post('address_id')){
			$this->db->where('id', $this->input->post('address_id'));
			$this->db->update('customer_address',$data);

			$response_array['message'] = 'Successful updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}else{
			$this->db->insert('customer_address',$data);

			$response_array['message'] = 'Successful Added';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}				

		$this->session->set_flashdata('response', $response);

		return $response;
	}


	public function getData_Addresses(){	
		$this->db->where('customer_id', $this->session->userdata('customer_id'));
		$query = $this->db->get('customer_address');
		return $query->result();
	}

	public function getData_States(){	
		$this->db->where('country_id', 101);
		$query = $this->db->get('states');
		return $query->result();
	}


	public function orders_record_count() {
		$this->db->select('id');
		$this->db->where('customer_id', $this->session->userdata('customer_id'));		
		return  $this->db->get('orders')->num_rows();
	}


	// public function getData_Orders(){
	// 	$this->db->select('orders.order_ref_id,
	// 	orders_product.product_options,
	// 	orders_product.quantity,
	// 	orders_product.price,
	// 	orders_product.total
	// 	');
	// 	$this->db->from('orders');
	// 	$this->db->join('orders_product', 'orders.order_ref_id=orders_product.order_ref_id');
	// 	$this->db->where('orders.customer_id', $this->session->userdata('customer_id'));
	// 	$this->db->group_by('order_ref_id');
	// 	$query = $this->db->get();

	// 	echo $query->num_rows();

	// 	return $query->result();

	// }

	public function getData_Orders($limit, $start){
		$this->db->select('orders.order_ref_id,
		orders.total,
		orders.date_created,
		order_status.status');
		$this->db->from('orders');
		$this->db->join('order_status', 'orders.order_status_id=order_status.id');
		$this->db->where('orders.customer_id', $this->session->userdata('customer_id'));
		$this->db->order_by('orders.id', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;		

	}

	public function getData_Wishlist() {
		$this->db->select('wishlist');
		$this->db->where('id', $this->session->userdata('customer_id'));		
		$row = $this->db->get('customer')->row();
		$wishlist_array = array_unique(explode(',', $row->wishlist));
		$wishlist_array = array_filter($wishlist_array);

		if(count($wishlist_array)>0){
			$this->db->select('id, product_name, special_price, product_image, slug');
			$this->db->where_in('id', $wishlist_array);
			$query = $this->db->get('product');
			return $query->result();	
		}else{
			return array();
		}
		
	}


	public function remove_wishlist_item_method(){

		$this->db->select('wishlist');
		$this->db->where('id', $this->session->userdata('customer_id'));
		$row = $this->db->get('customer')->row();

		$wishlist_array = array_unique(explode(',', $row->wishlist));
		$wishlist_array = array_filter($wishlist_array);

		$wishlist_array = array_diff($wishlist_array,array($this->input->post('product_id')));
		$wishlist = implode(',', $wishlist_array);

		$this->db->where('id', $this->session->userdata('customer_id'));
		$this->db->update('customer', array('wishlist'=>$wishlist));

		$response_array['message'] = 'Successful updated';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);

		return $response;
	}

	public function getData_profile_method(){

		$this->db->select('mobile,fname,lname,gender');
		$this->db->where('id', $this->session->userdata('customer_id'));
		$query = $this->db->get('customer');

		return $query->result();
	}


	public function profile_store_method(){

		$data = array('mobile'=>$this->input->post('profile_mobile'),
		'fname'=>$this->input->post('profile_fname'),
		'lname'=>$this->input->post('profile_lname'),
		'gender'=>$this->input->post('profile_gender'));


		$this->db->where('id', $this->session->userdata('customer_id'));
		$this->db->update('customer', $data);

		$response_array['message'] = 'Successful updated';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);

		$this->session->set_flashdata('response', $response);
		
		return $response;

	}

	public function change_password_method(){
		$old_password=$this->input->post('old_password');

		$this->db->select('password');
		$this->db->where('id', $this->session->userdata('customer_id'));
		$query=$this->db->get('customer');
		$row=$query->row();
		$real_encrypted_password=$row->password;

		$decrypt_password=$this->encryption->decrypt($real_encrypted_password);

		if($old_password==$decrypt_password){
			$new_password=$this->encryption->encrypt($this->input->post('new_password'));
			$data=array(
				'password'=>$new_password
			);				
			$this->db->where('id', $this->session->userdata('customer_id'));
			$this->db->update('customer',$data);
			
			$response_array['message'] = 'Successful updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);

		}else{

			$response_array['message'] = 'Invalid current password';
			$response_array['class'] = 'alert-danger';
			$response=$response_array;
			$response=array('error'=>$response_array);

		}

		$this->session->set_flashdata('response', $response);

		return $response;
	}
}
