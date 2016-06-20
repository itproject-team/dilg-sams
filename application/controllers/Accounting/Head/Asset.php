<?php

class Asset extends MY_Controller{

	function __construct(){
		parent::__construct('Accounting');
	}

	public function get_asset(){
		$this->load->view($this->layout, ['content' => 'Accounting/content/Asset', 'js' => 'Accounting/js/Asset', 'nav' => 'asset']);
	}

	public function all_assets(){
		$user = $this->session->userdata('user_full_name');
		echo json_encode(['data' => Asset_Model::all_assets(), 'user' => $user]);
	}
}