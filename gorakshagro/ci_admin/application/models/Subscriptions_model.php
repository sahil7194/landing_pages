<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptions_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function record_count() {
		return  $this->db->get("subscriptions")->num_rows();
	}

	public function getData_method($limit, $start){

		$this->db->select('subscriptions.id,
		subscriptions.receipt,
		subscriptions.amount,
		subscriptions.order_status,
		subscriptions.datentime,
		users.first_name,
		users.last_name,
		package_pricing.package_name
		');
		$this->db->from('subscriptions');
		$this->db->join('users','subscriptions.fb_id=users.fb_id','left');
		$this->db->join('package_pricing','subscriptions.package_id=package_pricing.id','left');
		$this->db->limit($limit, $start);
		$this->db->order_by('subscriptions.id', 'desc');
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
				'order_status'=>$this->input->post('order_status')
			);
			$this->db->where('id',$this->input->post('dataId'));
			$this->db->update('subscriptions',$data);
			$response_array['message'] = 'Successful Updated';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);

		}else{
			$package = $this->input->post('package');
			$package_array = explode('_', $package);
			$package_id = $package_array[0];
			$months = $package_array[1];
			$price = $package_array[2];

			$today = time();
			$expiry_time = strtotime("+$months months", $today);
			$expiry_date = date('Y-m-d', $expiry_time);	

			$data = array('fb_id'=>$this->input->post('fb_id'),
				'receipt'=>'MZ-'.date('Ymdhis').mt_rand(11111,99999),
				'package_id'=>$package_id,
				'amount'=>$price,
				'order_status'=>$this->input->post('order_status'),
				'expire_date'=>$expiry_date,
				'datentime' => date('Y-m-d H:i:s')
			);

			$this->db->insert('subscriptions',$data);
			$response_array['message'] = 'Successful Added';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);
		}

		$this->session->set_flashdata('response', $response);

		return $response;
	}


	public function getDataById_method($dataId){
		$this->db->where('id',$dataId);		
		$query=$this->db->get('subscriptions');
		return $query->result();
	}

	public function getPackage_method() {
		$this->db->select('id,package_name,price,months');		
		$query = $this->db->get("package_pricing");
		return $query->result();
	}

	public function getOrderDetails_method($dataId){
		$this->db->select('subscriptions.id,
		subscriptions.fb_id,
		subscriptions.receipt,
		subscriptions.razorpay_order_id,
		subscriptions.razorpay_payment_id,
		subscriptions.razorpay_signature,
		subscriptions.amount,
		subscriptions.order_status,
		subscriptions.expire_date,
		subscriptions.datentime,
		users.first_name,
		users.last_name,
		package_pricing.package_name
		');
		$this->db->from('subscriptions');
		$this->db->join('users','subscriptions.fb_id=users.fb_id','left');
		$this->db->join('package_pricing','subscriptions.package_id=package_pricing.id','left');
		$this->db->where('subscriptions.id',$dataId);
		$query=$this->db->get();
		return $query->result();

	}

	public function delete_method(){
		$dataIdArray = $this->input->post('dataId'); //from name="checkbox[]"

		$countDataId = count($dataIdArray);
		for($i=0;$i<$countDataId;$i++){
			$DataId=$dataIdArray[$i];
			$this->db->where('id',$DataId); 
			$query=$this->db->delete('subscriptions');
		}

		$response_array['message'] = 'Successful Deleted';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);

		$this->session->set_flashdata('response', $response);
		return $response;
	}	

}
