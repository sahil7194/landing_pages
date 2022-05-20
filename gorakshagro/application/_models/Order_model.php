<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->library('encryption');
	}


	public function save_method(){	

		if($this->cart->total_items() > 0){

			$order_ref_id = date('Ymdhis').mt_rand(111,999);

			if($this->session->userdata('delivery_address_id')){

				$this->db->where('customer_id', $this->session->userdata('customer_id'));
				$this->db->where('id', $this->session->userdata('delivery_address_id'));
				$address_row = $this->db->get('customer_address')->row();

				$order_data = array('order_ref_id'=>$order_ref_id,
					'payment_mode'=>$this->input->post('payment_mode'),
					'transaction_id'=>$this->input->post('upi_transaction_id'),
					'customer_id'=>$this->session->userdata('customer_id'),
					'firstname'=>$this->session->userdata('fname'),
					'lastname'=>$this->session->userdata('lname'),
					'email'=>$this->session->userdata('email'),
					'mobile'=>$this->session->userdata('mobile'),
					'total'=>$this->cart->format_number($this->cart->total()),
					'delivery_contact_name'=>$address_row->contact_name,
					'delivery_mobile'=>$address_row->mobile,
					'delivery_pincode'=>$address_row->pincode,
					'delivery_locality'=>$address_row->locality,
					'delivery_address'=>$address_row->address,
					'delivery_city'=>$address_row->city,
					'delivery_state'=>$address_row->state,
					'delivery_landmark'=>$address_row->landmark,
					'delivery_alternate_phone'=>$address_row->alternate_phone,
					'delivery_address_type'=>$address_row->address_type,
					'order_status_id'=>1,
					'ip'=>$this->getUserIP(),
					'user_agent'=>$_SERVER['HTTP_USER_AGENT'],
					'date_created'=>date('Y-m-d H:i:s'),
					'date_modified'=>date('Y-m-d H:i:s')
				);

				$this->db->insert('orders',$order_data);

				
				foreach ($this->cart->contents() as $items){
					$product_options = null;

					if ($this->cart->has_options($items['rowid']) == TRUE){
						foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value){
							$product_options .= $option_name.' : '.$option_value.'--';

							$this->db->select('product_options.id as product_option_id');
							$this->db->from('product_options');
							$this->db->join('option', 'product_options.option_id=option.id');
							$this->db->where('option.name', $option_value);
							$this->db->where('product_options.product_id', $items['id']);
							$row = $this->db->get()->row();
					
							$this->db->where('id', $row->product_option_id);
							$this->db->set('qty', 'qty-1', FALSE);
							$this->db->update('product_options');
						}
					}else{
						$this->db->where('id', $items['id']);
						$this->db->set('quantity', 'quantity-1', FALSE);
						$this->db->update('product');
					}

					$order_product_data = array('order_ref_id'=>$order_ref_id,
					'product_id'=>$items['id'],
					'product_options'=>$product_options,
					'quantity'=>$items['qty'],
					'price'=>$items['price'],
					'total'=>$items['subtotal'],
					);

					$this->db->insert('orders_product',$order_product_data);

				}

				$this->session->set_userdata(array('order_status'=>'success', 'order_ref_id'=>$order_ref_id));
				$this->cart->destroy();

				$response_array['message'] = 'Order placed';
				$response_array['class'] = 'alert-success';
				$response=$response_array;
				$response=array('success'=>$response_array);

			}else{

				$response_array['error_type'] = 'delivery_address';
				$response_array['message'] = 'Select address';
				$response_array['class'] = 'alert-danger';
				$response=$response_array;
				$response=array('error'=>$response_array);			
			}
		}else{

			$response_array['message'] = 'Cart empty';
			$response_array['class'] = 'alert-danger';
			$response=$response_array;
			$response=array('error'=>$response_array);

		}
		

		$this->session->set_flashdata('response', $response);

		return $response;
		
	}

	
	public function getUserIP(){
	    // Get real visitor IP behind CloudFlare network
	    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
	              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	    }
	    $client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];

	    if(filter_var($client, FILTER_VALIDATE_IP))
	    {
	        $ip = $client;
	    }
	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
	    {
	        $ip = $forward;
	    }
	    else
	    {
	        $ip = $remote;
	    }

	    return $ip;
	}


}
