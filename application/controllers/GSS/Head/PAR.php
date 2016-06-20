<?php

class PAR extends MY_Controller{

	function __construct(){
		parent::__construct('GSS');
	}

	public function get_par(){
		$this->load->view($this->layout, ['content' => 'GSS/content/PAR', 'js' => 'GSS/js/PAR', 'nav' => 'par']);
	}

	public function last_par(){
		echo json_encode(GSS_PAR_Model::last_par());
	}

	public function inventory(){
		echo json_encode(GSS_PAR_Model::inventory());
	}

	public function all_par(){
		echo json_encode(['data' => GSS_PAR_Model::all_par()]);
	}

	public function completed_par(){
		echo json_encode(['data' => GSS_PAR_Model::completed_par()]);
	}

	public function draft_par(){
		echo json_encode(['data' => GSS_PAR_Model::draft_par()]);
	}

	public function all_dept(){
		echo json_encode(GSS_PAR_Model::all_dept());
	}

	public function all_emp(){
		echo json_encode(GSS_PAR_Model::all_emp());
	}

	public function save_par(){
		$par_no = $this->input->post('par_no');
		$distinction_no = $this->input->post('distinction_no');
		$asset_name = $this->input->post('asset_name');
		$asset_desc = $this->input->post('asset_desc');
		$office = $this->input->post('office');
		$employee = $this->input->post('employee');
		$par_status = $this->input->post('par_status');
		$par_date_created = $this->input->post('par_date_created');

		$par_receivedBy = $this->input->post('par_receivedBy');
		$par_positionBy = $this->input->post('par_positionBy');
		$par_receivedFrom = $this->input->post('par_receivedFrom');
		$par_positionFrom = $this->input->post('par_positionFrom');
		$today =  date('Y-m-d');

		$office = substr((strtoupper($office)), 0, 3);
		$year = date('Y');
		$code = substr($par_no, 8, 1);
		$asset_no = $office.'-'.$year.'-'.$code;

		$asset_part_no_id = $this->input->post('asset_part_no');
		$asset_part_no = $asset_no .'-'. $asset_part_no_id;
		$asset_part_name = $this->input->post('asset_part_name');
		$asset_part_desc = $this->input->post('asset_part_desc');
		$created_by = "Carl Thomas Rivera";

		$par = ['par_no' => $par_no, 'asset_no' => $asset_no, 'status' => $par_status, 'date_created' => $today, 'emp_id' => $this->session->userdata('user_id'), 'received_by' => $par_receivedBy, 'position_by' => $par_positionBy, 'received_from' => $par_receivedFrom, 'position_from' => $par_positionFrom, 'created_by' => $this->session->userdata('user_full_name')];
		$asset = ['asset_no' => $asset_no, 'asset_name' => $asset_name, 'asset_description' => $asset_desc, 'distinction_no' => $distinction_no];
		$part = ['asset_part_no' => $asset_part_no, 'asset_part_name' => $asset_part_name, 'asset_part_description' => $asset_part_desc, 'asset_no' => $asset_no];
		// var_dump($par);
		// die();
		GSS_PAR_Model::save_par($asset_no, $par, $asset, $part, $asset_part_no_id, $employee, $distinction_no);

		return redirect('gss/head/par');
	}

	public function edit_par(){
		$par_id = $this->input->post('par_id');

		$par_no = $this->input->post('edited_par_no');
		$distinction_no = $this->input->post('current-distinction_no');
		$asset_name = $this->input->post('current-par-asset-name');
		$asset_desc = $this->input->post('current-par-asset-desc');
		$office = $this->input->post('current-par-office');
		$employee = $this->input->post('current-par-employee');
		$par_status = $this->input->post('par_status');
		$par_date_created = $this->input->post('par_date_created');
		$today =  date('Y-m-d');

		$office = substr((strtoupper($office)), 0, 3);
		$year = date('Y');
		$code = substr($par_no, 4, 1);
		$asset_no = $office.'-'.$year.'-'.$code;

		$par = ['par_no' => $par_no, 'asset_no' => $asset_no, 'status' => $par_status, 'date_created' => $today, 'emp_id' => $this->session->userdata('user_id')];
		$asset = ['asset_no' => $asset_no, 'asset_name' => $asset_name, 'asset_description' => $asset_desc];

		GSS_PAR_Model::edit_par($par_id, $asset_no, $par, $asset, $employee);

		return redirect('gss/head/par');
	}
}