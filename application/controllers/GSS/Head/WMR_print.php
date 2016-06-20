<?php

class WMR_print extends MY_Controller{

	function __construct(){
		parent::__construct('GSS');
	}

	public function get_wmr_print(){
		$this->load->view('GSS/content/WMR_print');
	}
}
