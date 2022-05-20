<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->library('encryption');
		$this->load->model('sendmail_model', 'sendmail');
	}


	public function register_method(){	

		$data = array('email'=>strtolower($this->input->post('email')),
			'mobile'=>$this->input->post('mobile'),
			'fname'=>$this->input->post('fname'),
			'lname'=>$this->input->post('lname'),
			'password'=>$this->encryption->encrypt($this->input->post('password')),
			'gender'=>$this->input->post('gender'),
			'date_created'=>date('Y-m-d H:i:s'),
			'date_modified'=>date('Y-m-d H:i:s')			
		);

		$this->db->insert('customer',$data);
		
		// $otp = mt_rand(111111,999999);
		// $response = $this->sendmail->send_email_otp($this->input->post('email'), $otp);		

		// if($response['mail_status']=='success'){
			
			// $this->db->insert('customer',$data);
			// $this->session->set_userdata(array('new_register_email'=>$this->input->post('email'), 'otp_email_verification'=>$otp, 'otp_email_verification_attempt'=>1));

			// $response_array['message'] = 'OTP sent to your email id';
			// $response_array['class'] = 'alert-success';
			// $response=$response_array;
			// $response=array('success'=>$response_array);
		// }else{
			// $response_array['message'] = 'OTP Sending Failed';
			// $response_array['class'] = 'alert-danger';
			// $response=$response_array;
			// $response=array('error'=>$response_array);
		// }
		
		$response_array['message'] = 'Account created';
		$response_array['class'] = 'alert-success';
		$response=$response_array;
		$response=array('success'=>$response_array);

		$this->session->set_flashdata('response', $response);

		return $response;
	}


	public function new_email_verify_otp_method(){
		$otp = $this->input->post('new_email_otp');

		if($otp == $this->session->userdata('otp_email_verification')){
			$this->db->where('email', $this->session->userdata('new_register_email'));
			$this->db->update('users', array('email_verified'=>'yes'));

			$this->session->set_userdata(array('email_verified'=>'yes'));			

			$response_array['message'] = 'otp verified';
			$response_array['class'] = 'alert-success';
			$response = $response_array;
			$response = array('success'=>$response_array);
		}else{
			$response_array['message'] = 'Invalid OTP';
			$response_array['class'] = 'alert-danger';
			$response = $response_array;
			$response = array('error'=>$response_array);
		}
		return $response;
	}

	
	public function authentication_method(){

		$email=$this->input->post('login_email');
		$password=$this->input->post('login_password');
		
		$this->db->select('id,email,mobile,fname,lname,password,gender');
		$this->db->where('email',$email);
		$this->db->where('block_status', 'unblocked');
		$query=$this->db->get('customer');

		if($query->num_rows() > 0){

			foreach($query->result() as $row){
				$encrypted_password=$row->password;
				$decrypted_password=$this->encryption->decrypt($encrypted_password);
				if($password==$decrypted_password){

					$customer_info=array(
						'customer_id'=>$row->id,
						'fname'=>$row->fname,
						'lname'=>$row->lname,
						'email'=>$row->email,
						'mobile'=>$row->mobile,
						'gender'=>$row->gender,
						'customer_logged_in'=>'loggedIn'
					);
					$this->session->set_userdata($customer_info);
					
					$response_array['message'] = 'login success';
					$response_array['class'] = 'alert-success';
					$response=$response_array;
					$response=array('success'=>$response_array);

				}else{

					$response_array['error_type'] = 'login';
					$response_array['message'] = 'Invalid Username & Password';
					$response_array['class'] = 'alert-success';
					$response=$response_array;
					$response=array('error'=>$response_array);

				}
			}

		}else{

			$response_array['error_type'] = 'login';
			$response_array['message'] = 'Not registered. Please signup';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('error'=>$response_array);
			
		}

		return $response;
	}


	public function add_to_wishlist_method(){
		$product_id = $this->input->post('product_id');
		$this->db->where('id', $this->session->userdata('customer_id'));		
		$this->db->set('wishlist', 'CONCAT(wishlist,\',\',\''.$product_id.'\')', FALSE);
		if($this->db->update('customer')){
			$response_array['message'] = 'This item has been added to your Wishlist';
			$response_array['class'] = 'alert-success';
			$response=$response_array;
			$response=array('success'=>$response_array);	
		}else{
			$response_array['message'] = 'Unable to add. Please try again';
			$response_array['class'] = 'alert-danger';
			$response=$response_array;
			$response=array('error'=>$response_array);
		}

		$this->session->set_flashdata('response', $response);

		return $response;

	}


	public function forgot_password_process_method(){
		$email = $this->input->post('forgot_password_email');

		$this->db->select('email,fname');
		$this->db->where('email', $email);
		$query = $this->db->get('customer');

		if($query->num_rows() > 0){			
			$otp = mt_rand(111111,999999);
			$row = $query->row();
			$customer_name = $row->fname;

			$response = $this->sendmail->forgot_password($email, $otp);

			if($response['email_status']=='success'){

				if($this->session->userdata('otp_email_verification_attempt')){
					$attempt = $this->session->userdata('otp_email_verification_attempt');
					if($attempt > 3){
						$response_array['message'] = 'Maximum OTP used. Please try after some time.';
						$response_array['class'] = 'alert-danger';
						$response=$response_array;
						$response=array('error'=>$response_array);
					}else{
						$this->session->set_userdata(array('email_forgot_password'=>$email, 'otp_forgot_password'=>$otp, 'otp_email_verification_attempt'=>$attempt+1));
						$response_array['message'] = 'OTP sent to your email id';
						$response_array['class'] = 'alert-success';
						$response=$response_array;
						$response=array('success'=>$response_array);
					}					
				}else{
					$this->session->set_userdata(array('email_forgot_password'=>$email, 'otp_forgot_password'=>$otp, 'otp_email_verification_attempt'=>1));

					$response_array['message'] = 'OTP sent to your email id';
					$response_array['class'] = 'alert-success';
					$response=$response_array;
					$response=array('success'=>$response_array);
				}
			}else{
				$response_array['message'] = 'OTP Sending Failed';
				$response_array['class'] = 'alert-danger';
				$response=$response_array;
				$response=array('error'=>$response_array);
			}

			$this->session->set_userdata(array('otp_email_verification'=>$otp));			

		}else{
			$response_array['message'] = 'Email id not registered';
			$response_array['class'] = 'alert-danger';
			$response=$response_array;
			$response=array('error'=>$response_array);
		}

		return $response;
	}

	public function forgot_password_verify_otp_method(){
		$otp = $this->input->post('otp_forgot_password');

		if($otp == $this->session->userdata('otp_forgot_password')){
			$this->session->set_userdata(array('otp_forgot_password_status'=>'success'));

			$response_array['message'] = 'otp verified';
			$response_array['class'] = 'alert-success';
			$response = $response_array;
			$response = array('success'=>$response_array);
		}else{
			$response_array['message'] = 'Invalid OTP';
			$response_array['class'] = 'alert-danger';
			$response = $response_array;
			$response = array('error'=>$response_array);
		}
		return $response;
	}

	public function set_new_password_method(){	

		if($this->session->userdata('otp_forgot_password_status')=='success'){
			$password = $this->encryption->encrypt($this->input->post('new_password')); 

			$data = array('password'=>$password);

			$this->db->where('email', $this->session->userdata('email_forgot_password'));
			$this->db->update('customer',$data);

			$this->session->unset_userdata('email_forgot_password');
			$this->session->unset_userdata('otp_forgot_password');
			$this->session->unset_userdata('otp_email_verification');
			$this->session->unset_userdata('otp_email_verification_attempt');
			$this->session->sess_destroy();

			$response_array['message'] = 'Successful updated';
			$response_array['class'] = 'alert-success';
			$response = $response_array;
			$response = array('success'=>$response_array);
		}else{

			$response_array['message'] = 'Invalid Request';
			$response_array['class'] = 'alert-success';
			$response = $response_array;
			$response = array('error'=>$response_array);

		}
		

		$this->session->set_flashdata('response', $response);

		return $response;
	}

}
