<?php

class PO_print extends MY_Controller{

	function __construct(){
		parent::__construct('GSS');
	}

	public function get_po_print(){
		$this->load->view('GSS/content/PO_print');
	}
}