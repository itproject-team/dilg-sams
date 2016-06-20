<?php

class RIS extends MY_Controller{

	function __construct(){
		parent::__construct('GSS');
		$this->checkIfLoggedIn(1,'head');
	}

	public function get_ris(){
		$this->load->view($this->layout, ['content' => 'GSS/content/RIS', 'js' => 'GSS/js/RIS', 'nav' => 'ris']);
	}

	public function get_ppmp(){
		echo json_encode(['data' => GSS_RIS_Model::get_ppmp()]);
	}

	public function last_ris_no(){
		echo json_encode(GSS_RIS_Model::last_ris_no());
	}

	public function save_ris(){
		$user_id = $this->session->userdata('user_id');
		$dept_id = $this->session->userdata('department');
		$ris_no = $this->input->post('ris_no');
		$id = $this->input->post('item_id');
		$qty = $this->input->post('item_qty');
		GSS_RIS_Model::save_ris($ris_no, $user_id, $dept_id, $id, $qty);
		return redirect('gss/head/ris', 'refresh');
	}

	public function admin_all_ris(){
		echo json_encode(['data' => GSS_RIS_Model::admin_all_ris()]);
	}

	public function admin_pending_ris(){
		echo json_encode(['data' => GSS_RIS_Model::admin_pending_ris()]);
	}

	public function admin_rejected_ris(){
		echo json_encode(['data' => GSS_RIS_Model::admin_rejected_ris()]);
	}

	public function admin_confirmed_ris(){
		echo json_encode(['data' => GSS_RIS_Model::admin_confirmed_ris()]);
	}

	public function admin_completed_ris(){
		echo json_encode(['data' => GSS_RIS_Model::admin_completed_ris()]);
	}

	public function admin_incomplete_ris(){
		echo json_encode(['data' => GSS_RIS_Model::admin_incomplete_ris()]);
	}

	public function user_all_ris(){
		echo json_encode(['data' => GSS_RIS_Model::user_all_ris($this->session->userdata('user_id'))]);
	}

	public function user_pending_ris(){
		echo json_encode(['data' => GSS_RIS_Model::user_pending_ris($this->session->userdata('user_id'))]);
	}

	public function user_cancelled_ris(){
		echo json_encode(['data' => GSS_RIS_Model::user_cancelled_ris($this->session->userdata('user_id'))]);
	}

	public function user_rejected_ris(){
		echo json_encode(['data' => GSS_RIS_Model::user_rejected_ris($this->session->userdata('user_id'))]);
	}

	public function user_confirmed_ris(){
		echo json_encode(['data' => GSS_RIS_Model::user_confirmed_ris($this->session->userdata('user_id'))]);
	}

	public function user_completed_ris(){
		echo json_encode(['data' => GSS_RIS_Model::user_completed_ris($this->session->userdata('user_id'))]);
	}

	public function user_incomplete_ris(){
		echo json_encode(['data' => GSS_RIS_Model::user_incomplete_ris($this->session->userdata('user_id'))]);
	}

	public function cancel_ris(){
		GSS_RIS_Model::cancel_ris($this->input->post('id'), $this->session->userdata('user_full_name'));
	}

	public function confirm_ris(){
		GSS_RIS_Model::confirm_ris($this->input->post('id'), $this->session->userdata('user_full_name'));
	}

	public function reject_ris(){
		GSS_RIS_Model::reject_ris($this->input->post('id'), $this->session->userdata('user_full_name'));
	}

	public function save_dispense(){
		$ris_id = $this->input->post('ris_no');
		$item_qty = $this->input->post('item_qty');
		$item_id = $this->input->post('item_id');

		GSS_RIS_Model::save_dispense($ris_id, $item_qty, $item_id);

		return redirect('gss/head/ris', 'refresh');
	}

	public function post_delete_ris(){
		$id = $this->input->post('id');
		$status = "rejected";
		GSS_RIS_Model::post_delete_ris($id,$status);
	}
	
	/*
	
	public function pending_sai(){
		echo json_encode(['data' => SAI_Model::pending_sai()]);
	}
	
	public function cancelled_sai(){
		echo json_encode(['data' => SAI_Model::cancelled_sai()]);
	}
	
	public function rejected_sai(){
		echo json_encode(['data' => SAI_Model::rejected_sai()]);
	}
	
	public function confirmed_sai(){
		echo json_encode(['data' => SAI_Model::confirmed_sai()]);
	}
	
	public function draft_sai(){
		echo json_encode(['data' => SAI_Model::draft_sai()]);
	}
	
	public function all_pending_sai(){
		echo json_encode(['data' => SAI_Model::all_pending_sai()]);
	}
	
	public function all_rejected_sai(){
		echo json_encode(['data' => SAI_Model::all_rejected_sai()]);
	}
	
	public function all_confirmed_sai(){
		echo json_encode(['data' => SAI_Model::all_confirmed_sai()]);
	}
	
	public function post_cancel_sai(){
		$id = $this->input->post('id');
		SAI_Model::post_cancel_sai($id);
	}
	public function post_confirm_ris(){
		$this->checkIfLoggedIn(3,'head');
		$id = $this->input->post('id');
		SAI_Model::post_confirm_ris($id);
	}
	public function post_reject_ris(){
		$this->checkIfLoggedIn(3,'head');
		$id = $this->input->post('id');
		SAI_Model::post_reject_ris($id);
	}
	
	public function last_sai(){
		echo json_encode(SAI_Model::last_sai());
	}
	
	public function save_sai(){
		$user_id = $this->session->userdata('user_id');
		$dept = $this->session->userdata('department');
		$sai_no = $this->input->post('sai_no');
		$sai_no = substr($sai_no, 8);
		$sai_status = $this->input->post('sai_status');
		$sai_date_created = $this->input->post('sai_date_created');
		$sai = ['sai_no' => $sai_no, 'status' => $sai_status, 'date_created' => $sai_date_created, 'user_id' => $user_id, 'dept_id' => $dept];

		$inventory_item = $this->input->post('inventory_item');
		$inventory_desc = $this->input->post('inventory_desc');
		$inventory_qty = $this->input->post('inventory_qty');
		$inventory_unit_cost = $this->input->post('inventory_unit_cost');
		$inventory_total_cost = $this->input->post('inventory_total_cost');
		$inventory_type = $this->input->post('inventory_type');
		$inventory_id = $this->input->post('inventory_id');
		
		$inventory_items = [];
		if(count($inventory_item) > 0){
			foreach($inventory_item as $key => $value){
				array_push($inventory_items, ['name' => $value, 'description' => $inventory_desc[$key], 'qty' => $inventory_qty[$key], 'unit_cost' => $inventory_unit_cost[$key], 'total_cost' => $inventory_total_cost[$key], 'item_type' => $inventory_type[$key], 'inventory_id' => $inventory_id[$key], 'type' => 'sai', 'source' => 'inventory']);
			}
		}
		SAI_Model::save_sai($sai,$inventory_items);
		return redirect('gss/head/ris');
	}
	
	public function inventory(){
		echo json_encode(SAI_Model::ppmp_items($this->session->userdata('department')));
	} **/

}