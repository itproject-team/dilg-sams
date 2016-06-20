<?php

class IAR extends MY_Controller{

	function __construct(){
		parent::__construct('GSS');
	}

	public function get_iar(){
		$this->load->view($this->layout, ['content' => 'GSS/content/IAR', 'js' => 'GSS/js/IAR', 'nav' => 'iar']);
	}

	public function completed_iar(){
		echo json_encode(['data' => GSS_IAR_Model::completed_iar()]);
	}
	
	public function all_iar(){
		echo json_encode(['data' => GSS_IAR_Model::all_iar()]);
	}
	
	public function incomplete_iar(){
		echo json_encode(['data' => GSS_IAR_Model::incomplete_iar()]);
	}

	public function draft_iar(){
		echo json_encode(['data' => GSS_IAR_Model::draft_iar()]);
	}

	public function all_po(){
		echo json_encode(GSS_IAR_Model::all_po());
	}

	public function inventory(){
		echo json_encode(GSS_IAR_Model::inventory());
	}
	
	public function last_iar(){
		$this->checkIfLoggedIn(1,'head');
		echo json_encode(GSS_IAR_Model::last_iar());
	}
	
	public function iar_exist(){
		$id = $_POST['data'];
		echo GSS_IAR_Model::iar_exist($id);
	}

	public function save_iar(){
		// $iar_status = $this->input->post('iar_status');
		$iar_no = $this->input->post('iar_no');
		$iar_date_created = $this->input->post('iar_date_created2');
		
		$iar_inspected_by = $this->input->post('iar_inspected_by');
		$iar_inspected_position = $this->input->post('iar_inspected_position');
		$iar_requisitioning = $this->input->post('iar_requisitioning');
		$iar_accepted_by = $this->input->post('iar_accepted_by');
		$iar_accepted_position = $this->input->post('iar_accepted_position');
		$iar_invoice_no = $this->input->post('iar_invoice_no');
		$iar_date_received = $this->input->post('iar_date_received');
		$iar_date_inspected = $this->input->post('iar_date_inspected');
		$iar_responsibility_code = $this->input->post('iar_responsibility_code');
		$iar_entity_naming = $this->input->post('iar_entity_naming');
		$iar_fund_cluster = $this->input->post('iar_fund_cluster');

		$iar = [
				'iar_no' => $iar_no,
				'date_created' => $iar_date_created,
				'created_by' => $this->session->userdata('user_full_name'),
				'inspected_by' => $iar_inspected_by,
				'inspected_position' => $iar_inspected_position,
				'requisitioning' => $iar_requisitioning,
				'accepted_by' => $iar_accepted_by,
				'accepted_position' => $iar_accepted_position,
				'invoice_no' => $iar_invoice_no,
				'date_received' => $iar_date_received,
				'date_inspected' => $iar_date_inspected,
				'responsibility_code' => $iar_responsibility_code,
				'entity_naming' => $iar_entity_naming,
				'fund_cluster' => $iar_fund_cluster
				];
		
		$po_id = $this->input->post('po_id');

		$supply_id = $this->input->post('supply_id');
		$supply_qty = $this->input->post('item_dqty');
		$supply_code = $this->input->post('item_code');
		$supply = [];

		foreach ($supply_id as $key => $value) {
			array_push($supply, ['id' => $value, 'qty' => $supply_qty[$key], 'code' => $supply_code[$key]]);
		}

		$asset_id = $this->input->post('asset_id');
		$asset_distinct_no = $this->input->post('distinct_number');
		$asset = [];

		foreach ($asset_id as $key => $value) {
			array_push($asset, ['id' => $value, 'distinct_number' => $asset_distinct_no[$key], 'qty' => '1']);
		}

		$inventory_item = $this->input->post('inventory_item');
		$inventory_desc = $this->input->post('inventory_desc');
		$inventory_qty  = $this->input->post('inventory_qty');
		$inventory_unit_cost = $this->input->post('inventory_unit_cost');
		$inventory_total_cost = $this->input->post('inventory_total_cost');
		$inventory_type = $this->input->post('inventory_type');
		$inventory = [];

		foreach ($inventory_item as $key => $value) {
			array_push($inventory, [
									'name' => $value,
									'description' => $inventory_desc[$key],
									'qty' => $inventory_qty[$key],
									'unit_cost'	=> $inventory_unit_cost[$key],
									'total_cost' => $inventory_total_cost[$key],
									'type'	=> $inventory_type[$key]
									]);
		}

		GSS_IAR_Model::save_iar($po_id, $iar, $supply, $asset, $inventory);
		return redirect('gss/head/iar');
	}

	public function edit_iar(){
		$iar_status = $this->input->post('iar_status');
		$iar_no = $this->input->post('iar_no');
		$iar_date_created = $this->input->post('edit_iar_date_created2');
		$po_id = $this->input->post('edit_po_id');
		$post_inventory_item = $this->input->post('item_name');
		$post_inventory_desc = $this->input->post('item_description');
		$post_item_type = $this->input->post('item_type');
		$post_inventory_code = $this->input->post('item_code');
		$post_inventory_qty = $this->input->post('item_dqty');
		$post_inventory_unit_cost = $this->input->post('item_unit_cost');
		$post_inventory_total_cost = $this->input->post('item_total');
		$inventory_items = [];
		$save_supply_inventory = [];
		$save_asset_inventory = [];
		if(count($post_inventory_item) > 0){
			foreach ($post_inventory_item as $key => $value) {
				array_push($inventory_items, ['code' => $post_inventory_code[$key],'name' =>  $value, 'description' => $post_inventory_desc[$key], 'qty' => $post_inventory_qty[$key], 'unit_cost' => str_replace(',', '', $post_inventory_unit_cost[$key]), 'total_cost' => str_replace(',', '', $post_inventory_total_cost[$key]), 'item_type' => $post_item_type[$key]]);
				if($post_inventory_qty[$key] != (str_replace(',', '', $post_inventory_total_cost[$key])/str_replace(',', '', $post_inventory_unit_cost[$key]))){
					if($iar_status != "draft"){
						$iar_status="incomplete";
					}
				}
				if($post_item_type[$key] == "supply"){
					array_push($save_supply_inventory, ['code' => $post_inventory_code[$key],'name' =>  $value, 'description' => $post_inventory_desc[$key], 'qty' => $post_inventory_qty[$key], 'unit_cost' => str_replace(',', '', $post_inventory_unit_cost[$key]), 'total_cost' => str_replace(',', '', $post_inventory_total_cost[$key])]);
				}else if($post_item_type[$key] == "asset"){
					array_push($save_asset_inventory, ['name' =>  $value, 'description' => $post_inventory_desc[$key], 'qty' => $post_inventory_qty[$key], 'unit_cost' => str_replace(',', '', $post_inventory_unit_cost[$key]), 'total_cost' => str_replace(',', '', $post_inventory_total_cost[$key])]);
				}
			}
		}
		GSS_IAR_Model::edit_iar($iar_no,$po_id, $inventory_items, $iar_date_created, $iar_status,$save_supply_inventory,$save_asset_inventory);

		return redirect('gss/head/iar');
	}
}