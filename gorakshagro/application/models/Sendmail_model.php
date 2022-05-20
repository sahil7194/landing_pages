<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendmail_model extends CI_Model {

	public function __construct(){
		parent::__construct();

		$config = Array(    
		'protocol' => 'smtp',
		'smtp_host' => 'smtp.mailgun.org',
		'smtp_port' => 587,
		'smtp_user' => 'postmaster@emm.waterindia.co.in',
		'smtp_pass' => 'fc0212eb1c8f17ef380562c9dea8e1f7',
		'smtp_timeout' => '4',
		'mailtype' => 'html',
		'charset' => 'iso-8859-1'
		);

		$this->load->library('email', $config);
	}

	public function send_email_otp($email, $otp){
		
		$subject = 'OTP for email verification';

		$this->email->set_newline("\r\n");

		$this->email->from('noreply@gorakshagro.com', 'Goraksh Agro');
		$data = array(
			'otp'=> $otp
		);

		$this->email->to($email); // replace it with receiver mail id

		$this->email->subject($subject); // replace it with relevant subject

		$body = $this->load->view('emails/otp_email_verification',$data,TRUE);
		$this->email->message($body);

		
		if($this->email->send()){
			$response['mail_status'] = 'success';
		}else{
			$response['mail_status'] = 'failed';
		}

		return $response;

	}

	public function forgot_password($email, $otp){
		
		$subject = 'OTP for email verification';

		$this->email->set_newline("\r\n");

		$this->email->from('noreply@codzera.com', 'Codzera');
		$data = array(
			'otp'=> $otp
		);

		$this->email->to($email); // replace it with receiver mail id

		$this->email->subject($subject); // replace it with relevant subject

		$body = $this->load->view('emails/otp_email_verification',$data,TRUE);

		$this->email->message($body); 		

		//$response['email_status'] = 'success';

		if($this->email->send()){			
			$response['email_status'] = 'success';
		}else{
			$response['email_status'] = 'failed';
		}

		return $response;

	}
}
