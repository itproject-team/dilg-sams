<?php

class Asset extends MY_Controller{

	function __construct(){
		parent::__construct('IT');
	}

	public function get_asset(){
		$this->load->view($this->layout, ['content' => 'IT/content/Asset', 'js' => 'IT/js/Asset', 'nav' => 'asset']);
	}
}