<?php

class PC extends MY_Controller{

	function __construct(){
		parent::__construct('GSS');
	}

	public function get_pc(){
		$this->load->view($this->layout, ['content' => 'GSS/content/PC', 'js' => 'GSS/js/PC', 'nav' => 'pc']);
	}

	public function generated_pc(){
		echo json_encode(['data' => GSS_PC_Model::generated_pc()]);
	}

	public function pc_list(){
		echo json_encode(['data' => GSS_PC_Model::pc_list()]);
	}

	public function last_pc(){
		echo json_encode(GSS_PC_Model::last_pc());
	}
	public function save_pc(){
		$asset_no = $this->input->post('ppe_no');
		$asset_name = $this->input->post('pc-asset-name');
		$employee = $this->input->post('pc-employee');
		$pc_status = $this->input->post('pc-status');
		$pc_remarks = $this->input->post('pc-remarks');
		$pc_date_created = $this->input->post('pc-date-created');
		$pc_date_created = $this->input->post('pc-date-created');
		$user = $this->input->post('user');
		$asset_part_no = $this->input->post('pc-asset-part-no');
		$pc_asset_part = $this->input->post('pc-asset-part');
		$pc_asset_part_desc = $this->input->post('pc-asset-part-desc');
		$pc_asset_part_status = $this->input->post('pc-asset-part-status');
		$pc_asset_part_remarks = $this->input->post('pc-asset-part-remarks');

		$today =  date('Y-m-d');
		$pc = ['asset_no' => $asset_no, 'status' => $pc_status, 'remarks' => $pc_remarks, 'date_created' => $pc_date_created, 'emp_id' => $this->session->userdata('user_id'), 'created_by' => $this->session->userdata('user_full_name'), 'modified_by' => $this->session->userdata('user_full_name')];
		$part = ['status' => $pc_asset_part_status, 'remarks' => $pc_asset_part_remarks];

		GSS_PC_Model::save_pc($asset_no, $pc, $part, $asset_part_no, $pc_remarks);

		return redirect('gss/head/pc');
	}

	public function update_pc(){
		$asset_no = $this->input->post('update-pc_no');
		$pc_id = $this->input->post('pc_id');
		$pc_date = $this->input->post('pc_date');
		$pc_employee = $this->input->post('pc_employee');
		$update_pc_status = $this->input->post('update-pc-status');
		$pc_remarks = $this->input->post('pc_remarks');

		$pc = [];
		if(count($pc_id) > 0){
			foreach($pc_id as $key => $value){
				array_push($pc, ['asset_no' => $asset_no, 'pc_no' => $pc_id[$key], 'date_modified' => $pc_date[$key], 'status' => $update_pc_status, 'remarks' => $pc_remarks[$key],]);
			}
		}

		GSS_PC_Model::update_pc($pc, $pc_employee);

		return redirect('gss/head/pc');

	}
}

//cant update status
// employee not yet updated