<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class order_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("orders")->num_rows();
	}

	public function getData_method($limit, $start){

		$this->db->select('orders.id,
		orders.order_ref_id,
		orders.firstname,
		orders.lastname,
		orders.total,
		orders.address_code,
		orders.date_created,
		order_status.status');
		$this->db->from('orders');
		$this->db->join('order_status','orders.order_status_id=order_status.id');
		$this->db->order_by('orders.id', 'desc');
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

	public function getProducts_method(){ 
		$this->db->select('id,product_name');
		$this->db->order_by('product_name', 'asc');
		$query = $this->db->get('product');
		return $query->result();
	}

	public function getData_address_codes(){ 
		$this->db->select('id,code');
		$this->db->order_by('code', 'asc');
		$query = $this->db->get('addresscode');
		return $query->result();
	}

	public function getProduct_options_method(){ 
		$this->db->select('option.id,
		option.name,
		option_groups.name as option_group,
		product_options.qty,
		product_options.amount');
		$this->db->from('option');
		$this->db->join('product_options','option.id=product_options.option_id');
		$this->db->join('option_groups','option.option_group_id=option_groups.id');
		$this->db->where('product_options.product_id', $this->input->post('product_id'));
		$this->db->order_by('option.id', 'asc');
		$query = $this->db->get();
		
		$product_options = array();
		$i=0;
		foreach($query->result() as $row){
			$product_options['product_options'][$i]['id'] = $row->id;			
			$product_options['product_options'][$i]['option_name'] = $row->name;
			$product_options['product_options'][$i]['option_group'] = $row->option_group;
			$product_options['product_options'][$i]['option_qty'] = $row->qty;
			$product_options['product_options'][$i]['option_amount'] = $row->amount;
			$i++;
		}

		$this->session->set_userdata(array('product_name'=>$this->input->post('product_name')));
		$this->session->set_userdata(array('product_id'=>$this->input->post('product_id')));
		$this->session->set_userdata($product_options);

		$response_array['message'] = 'Success';
		$response_array['class'] = 'alert-success';
		$response=array('success'=>$response_array);
		$this->session->set_flashdata('response', $response);

		return $response;

	}


	public function getData_filter_method(){

		$this->db->select('orders.id,
		orders.order_ref_id,
		orders.firstname,
		orders.lastname,
		orders.total,
		orders.address_code,
		orders.date_created,
		order_status.status');
		$this->db->from('orders');
		$this->db->join('order_status','orders.order_status_id=order_status.id');
		$this->db->order_by('orders.id', 'desc');
		
		if($this->input->get('date_created')){
			$this->db->where('DATE(orders.date_created)', $this->input->get('date_created'));
		}
		if($this->input->get('address_code')){
			$this->db->where('address_code', $this->input->get('address_code'));
		}
		if($this->input->get('order_ref_id')){
			$this->db->where('order_ref_id', $this->input->get('order_ref_id'));
		}
		
		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function store_method(){			

		if($this->input->post('dataId')){	

			$data = array(
				'order_status_id'=>$this->input->post('order_status'),
				'address_code'=>$this->input->post('address_code')
			);
			$this->db->where('id', $this->input->post('dataId'));
			$this->db->update('orders',$data);


			$array_order_status = array(3,5,7,8,9,12,14);

			if(!in_array($this->input->post('current_order_status'), $array_order_status)){

				if(in_array($this->input->post('order_status'), $array_order_status)){

					$this->db->select('orders_product.id,
					orders_product.product_id,
					orders_product.quantity');
					$this->db->from('orders_product');
					$this->db->where('orders_product.order_ref_id', $this->input->post('order_ref_id'));
					$query = $this->db->get();

					foreach($query->result() as $row){
						$this->db->where('product_id', $row->product_id);
						$this->db->set('qty', 'qty+'.$row->quantity, FALSE);
						$this->db->update('product_options');
					}
				}
			}

			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);

			$this->session->set_flashdata('response', $response);

			return $response;

		}

		
	}


	public function getDataById_method($order_id){
		$this->db->select('orders.*, order_status.status as order_status');
		$this->db->from('orders');
		$this->db->join('order_status', 'orders.order_status_id=order_status.id');
		$this->db->where('orders.order_ref_id',$order_id);		
		$query=$this->db->get();
		return $query->result();
	}

	public function getData_products_method($order_id){
		$this->db->select('orders_product.product_options,
		orders_product.quantity,
		orders_product.price,
		orders_product.total,
		product.product_name,
		product.product_image,
		product.slug');
		$this->db->from('orders_product');
		$this->db->join('product','orders_product.product_id=product.id');
		$this->db->where('orders_product.order_ref_id', $order_id);
		$query=$this->db->get();
		return $query->result();
	}

	public function getData_orderStatusList(){
		$this->db->select('id,status');
		$query = $this->db->get('order_status');
		return $query->result();	
	}

	// public function delete_method(){
	// 	$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"

	// 	$countDataId = count($dataIdArray);
	// 	for($i=0;$i<$countDataId;$i++){
	// 		$DataId=$dataIdArray[$i];
	// 		$this->db->where('id',$DataId); 
	// 		$query=$this->db->delete('orders');
	// 	}

	// 	$response_array['message'] = 'Successful Deleted';
	// 	$response_array['class'] = 'alert-success';
	// 	$response=$response_array;
	// 	$response=array('success'=>$response_array);

	// 	$this->session->set_flashdata('response', $response);
	// 	return $response;
	// }		


	public function cart_add_method(){
		$product_id = $this->input->post('product_id');
		$product_price = $this->input->post('product_price');
		$product_name = $this->input->post('product_name');
		$product_qty = $this->input->post('product_qty');

		$product_options = $this->input->post('product_options');		

		if(count($product_options) > 0){
			foreach ($product_options as $key => $value) {
				$options[$key] = $this->input->post($key);
			}

			$data = array(
				'id' => $product_id,
				'qty' => $product_qty,
				'price' => $product_price,
				'name' => $product_name,
				'options' => $options
			);			

		}else{

			$data = array(
				'id' => $product_id,
				'qty' => $product_qty,
				'price' => $product_price,
				'name' => $product_name
			);
		}

		
		$cart_response = $this->cart->insert($data);		

		if($cart_response){
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


	public function getCustomers_method(){
		$this->db->select('id,email,mobile,fname,lname');
		$this->db->where('block_status','unblocked');
		$query = $this->db->get('customer');
		return $query->result();
	}

	public function getCustomer_address_method(){

		$this->db->select('id,email,mobile,fname,lname');
		$this->db->where('id', $this->input->post('customer_id'));
		$row = $this->db->get('customer')->row();

		$order_customer_details = array('order_customer_email'=> $row->email,
			'order_customer_mobile'=> $row->mobile,
			'order_customer_fname'=> $row->fname,
			'order_customer_lname'=> $row->lname
		);
		$this->session->set_userdata($order_customer_details);


		$this->db->where('customer_id', $this->input->post('customer_id'));
		$query = $this->db->get('customer_address');		

		foreach($query->result() as $row){
			$customer_address_array['addresses'][] = array('address_id'=>$row->id,
				'address'=>$row->address
			);
		}		

		$this->session->set_userdata(array('order_customer_id'=>$this->input->post('customer_id')));
		$this->session->set_userdata($customer_address_array);

		$response_array['message'] = 'Success';
		$response_array['class'] = 'alert-success';
		$response=array('success'=>$response_array);

		return $response;
	}


	public function place_order_method(){	

		if($this->cart->total_items() > 0){

			$this->db->select('order_ref_id');
			$this->db->order_by('id', 'desc');
			$query = $this->db->get('orders', 1);
			if($query->num_rows() > 0){
				$row = $query->row();
				$order_ref_id = ($row->order_ref_id + 1);
			}else{
				$order_ref_id = 100000001;
			}

			if($this->input->post('address_id')){

				$this->db->where('customer_id', $this->session->userdata('order_customer_id'));
				$this->db->where('id', $this->input->post('address_id'));
				$address_row = $this->db->get('customer_address')->row();

				$order_data = array('order_ref_id'=>$order_ref_id,
					'payment_mode'=>'COD',
					'customer_id'=>$this->session->userdata('order_customer_id'),
					'firstname'=>$this->session->userdata('order_customer_fname'),
					'lastname'=>$this->session->userdata('order_customer_lname'),
					'email'=>$this->session->userdata('order_customer_email'),
					'mobile'=>$this->session->userdata('order_customer_mobile'),
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
					'product_name'=>$items['name'],
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

	public function getData_order_ByProducts_method(){

		$date_created = $this->input->get('date_created');
		$product_id = $this->input->get('product_id');
		
		$this->db->select('orders_product.id,
		orders_product.product_options,
		orders_product.quantity,
		SUM(orders_product.quantity) as cnt,
		product.product_name,
		orders.date_created');
		$this->db->from('orders_product');
		$this->db->join('product','orders_product.product_id=product.id');
		$this->db->join('orders','orders_product.order_ref_id=orders.order_ref_id');
		if(!empty($product_id)){
			$this->db->where('orders_product.product_id', $product_id);			
		}
		$this->db->like('orders.date_created',$date_created);
		$this->db->group_by('orders_product.product_options');
		$this->db->group_by('orders_product.product_id');
		$this->db->order_by('product.product_name');
		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;		
		
	}
	
	public function export_order_ByProducts_method(){

		$date_created = '2021-07-25';
		$product_id = $this->input->get('product_id');
		
		$this->db->select('
		orders.date_created,
		product.product_name,
		orders_product.product_options,
		SUM(orders_product.quantity) as cnt');
		$this->db->from('orders_product');
		$this->db->join('product','orders_product.product_id=product.id');
		$this->db->join('orders','orders_product.order_ref_id=orders.order_ref_id');
		if(!empty($product_id)){
			$this->db->where('orders_product.product_id', $product_id);			
		}
		$this->db->like('orders.date_created',$date_created);
		$this->db->group_by('orders_product.product_options');
		$this->db->group_by('orders_product.product_id');
		$this->db->order_by('product.product_name');
		$query=$this->db->get();
		
		$response = $query->result_array();
		
		$filename = 'leads_'.date('Ymdhis').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");

		$handle = fopen('php://output', 'w');
		$header = array("date_created", "product_name", "product_options", "cnt"); 
		fputcsv($handle, $header);

		foreach ($response as $data) {
			fputcsv($handle, $data);
		}
		fclose($handle);

		exit;
		
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
