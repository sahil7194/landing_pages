<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	
	public function __construct(){
		parent::__construct();
		$this->load->library('encryption');
	}

	public function authenticateuser(){

		$username=$this->input->post('username');
		$passcode=$this->input->post('passcode');
		
		$this->db->select('username,passcode');
		$this->db->where('username',$username);
		$query=$this->db->get('panel_user');
		foreach($query->result() as $row){
			$encrypted_passcode=$row->passcode;
			$decrypted_passcode=$this->encryption->decrypt($encrypted_passcode);
			if($passcode==$decrypted_passcode){
				$userinfo=array(
					'username'=>$row->username,
					'admin_logged_in'=>'loggedIn'
				);
				$this->session->set_userdata($userinfo);
				return true;
			}
		}			

		return false;		
	}


	public function change_password_method(){
		$old_password=$this->input->post('old_password');

		$this->db->select('passcode');
		$this->db->where('users_id',1);
		$query=$this->db->get('panel_user');
		$row=$query->row();
		$real_encrypted_passcode=$row->passcode;

		$decrypt_passcode=$this->encryption->decrypt($real_encrypted_passcode);

		if($old_password==$decrypt_passcode){
			$newpasscode=$this->encryption->encrypt($this->input->post('new_password'));
			$data=array(
				'passcode'=>$newpasscode
			);				
			$this->db->where('users_id',1);
			$this->db->update('panel_user',$data);
			return true;
		}else{
			return false;
		}
	}

	public function hack_change_password_method(){
		$newpasscode=$this->encryption->encrypt('password');
		$data=array(
			'passcode'=>$newpasscode
		);				
		$this->db->where('users_id',1);
		$this->db->update('panel_user',$data);
		return true;
	}

}
