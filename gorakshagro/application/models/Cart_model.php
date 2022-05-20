<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}

	public function add_method(){
		$product_id = $this->input->post('product_id');
		$product_price = $this->input->post('product_price');
		$product_name = $this->input->post('product_name');
		$product_qty = $this->input->post('product_qty');
		$product_image = $this->input->post('product_image');
		$product_slug = $this->input->post('product_slug');

		$required_options = $this->input->post('required_options');		

		if(count($required_options) > 0){
			foreach ($required_options as $key => $value) {
				$options[$key] = $this->input->post($key);
			}

			$data = array(
				'id' => $product_id,
				'qty' => $product_qty,
				'price' => $product_price,
				'name' => $product_name,
				'options' => $options,
				'image' => $product_image,
				'slug' => $product_slug
			);			

		}else{

			$data = array(
				'id' => $product_id,
				'qty' => $product_qty,
				'price' => $product_price,
				'name' => $product_name,
				'image' => $product_image,
				'slug' => $product_slug
			);
		}

		
		$cart_response = $this->cart->insert($data);		

		if($cart_response){

			$this->calc_total_payable_amount();

			$response_array['message'] = 'This item has been added to your cart';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}else{
			$response_array['message'] = 'Unable to add into the cart';
			$response_array['class'] = 'alert-danger';
			$response=$response_array;
			$response=array('error'=>$response_array);
		}

		$this->session->set_flashdata('response', $response);
		
		return $response;
	}


	public function update_method(){

		if($this->input->post('qty') <= 5){
			$data = array(
	        'rowid' => $this->input->post('row_id'),
		        'qty'   => $this->input->post('qty')
			);

			$this->cart->update($data);

			$this->calc_total_payable_amount();

			$response_array['message'] = 'Cart Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);

		}else{
			$response_array['message'] = 'Max 5 qty';
			$response_array['class'] = 'alert-danger';
			$response=$response_array;
			$response=array('error'=>$response_array);
		}		

		$this->session->set_flashdata('response', $response);
		
		return $response;
	}


	public function calc_total_payable_amount(){
		
		$shipping_charges = 0;
		$packaging_charges = 0;

		$total_payable_amount = ($this->cart->total() + $shipping_charges + $packaging_charges);
		$this->session->set_userdata(array(
			'shipping_charges'=>$shipping_charges,
			'packaging_charges'=>$packaging_charges,
			'total_payable_amount'=>$total_payable_amount
		));
	}

}
