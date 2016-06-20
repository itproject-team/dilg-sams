<?php

class RIS extends MY_Controller{

	function __construct(){
		parent::__construct('Accounting');
	}

	public function get_ris(){
		$this->load->view($this->layout, ['content' => 'accounting/content/RIS', 'js' => 'accounting/js/RIS', 'nav' => 'ris']);
	}

	public function get_ppmp(){
		echo json_encode(['data' => Accounting_RIS_Model::get_ppmp()]);
	}

	public function last_ris_no(){
		echo json_encode(Accounting_RIS_Model::last_ris_no());
	}

	public function save_ris(){
		$user_id = $this->session->userdata('user_id');
		$dept_id = $this->session->userdata('department');
		$ris_no = $this->input->post('ris_no');
		$id = $this->input->post('item_id');
		$qty = $this->input->post('item_qty');
		Accounting_RIS_Model::save_ris($ris_no, $user_id, $dept_id, $id, $qty);
		return redirect('accounting/head/ris', 'refresh');
	}

	public function user_all_ris(){
		echo json_encode(['data' => Accounting_RIS_Model::user_all_ris($this->session->userdata('user_id'))]);
	}

	public function user_pending_ris(){
		echo json_encode(['data' => Accounting_RIS_Model::user_pending_ris($this->session->userdata('user_id'))]);
	}

	public function user_cancelled_ris(){
		echo json_encode(['data' => Accounting_RIS_Model::user_cancelled_ris($this->session->userdata('user_id'))]);
	}

	public function user_rejected_ris(){
		echo json_encode(['data' => Accounting_RIS_Model::user_rejected_ris($this->session->userdata('user_id'))]);
	}

	public function user_confirmed_ris(){
		echo json_encode(['data' => Accounting_RIS_Model::user_confirmed_ris($this->session->userdata('user_id'))]);
	}

	public function user_completed_ris(){
		echo json_encode(['data' => Accounting_RIS_Model::user_completed_ris($this->session->userdata('user_id'))]);
	}

	public function user_incomplete_ris(){
		echo json_encode(['data' => Accounting_RIS_Model::user_incomplete_ris($this->session->userdata('user_id'))]);
	}

	public function cancel_ris(){
		Accounting_RIS_Model::cancel_ris($this->input->post('id'), $this->session->userdata('user_full_name'));
	}

	public function confirm_ris(){
		Accounting_RIS_Model::confirm_ris($this->input->post('id'), $this->session->userdata('user_full_name'));
	}

	public function reject_ris(){
		Accounting_RIS_Model::reject_ris($this->input->post('id'), $this->session->userdata('user_full_name'));
	}

	public function save_dispense(){
		$ris_id = $this->input->post('ris_no');
		$item_qty = $this->input->post('item_qty');
		$item_id = $this->input->post('item_id');

		Accounting_RIS_Model::save_dispense($ris_id, $item_qty, $item_id);

		return redirect('accounting/head/ris', 'refresh');
	}

	public function post_delete_ris(){
		$id = $this->input->post('id');
		$status = "rejected";
		Accounting_RIS_Model::post_delete_ris($id,$status);
	}
	

}