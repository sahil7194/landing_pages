<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

	public function template($template_name, $vars = array(), $return = FALSE)
	{
		if($return){
	        $content  = $this->view('layout/header', $vars, $return);
	        $content .= $this->view($template_name, $vars, $return);
	        $content .= $this->view('layout/footer', $vars, $return);
	        return $content;
	    }else{
	    	$this->view('layout/header', $vars);
	        $this->view($template_name, $vars);
	        $this->view('layout/footer', $vars);
	    }
	}
}
