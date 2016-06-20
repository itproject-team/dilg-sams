<?php

class GSS_IAR_Model extends CI_Model{
 	private static $db;

 	function __construct(){
 		parent::__construct();
 		self::$db = &get_instance()->db;
 	}

 	private static function get_mapped_items_po($record){
		if(count($record) > 0){
 			foreach ($record as $key => &$value) {
 				$items = self::$db->get_where('items', ['form_type' => 'po', 'form_id' => $value->id])->result();
 				$value->items = $items;
 			}
 		}
 		return $record;
	}

 	private static function get_mapped_items($record){
		if(count($record) > 0){
 			foreach ($record as $key => &$value) {
 				$items = self::$db->get_where('items', ['form_type' => 'iar', 'form_id' => $value->id])->result();
 				$value->items = $items;
 			}
 		}
 		return $record;
	}

	public static function completed_iar(){
 		$completed = self::$db->select('iar.*')->select('po.po_no')->where(['iar.status' => 'completed'])->from('iar')->join('po','iar.po_id = po.id')->get()->result();
		return self::get_mapped_items($completed);
 	}
	
	public static function last_iar(){
 		return self::$db->select('*')->order_by('id', 'desc')->limit(1)->get('iar')->result();
 	}
	
	public static function all_iar(){
 		$all = self::$db->select('iar.*')->select('po.po_no')->from('iar')->join('po','iar.po_id = po.id')->get()->result();
		return self::get_mapped_items($all);
 	}
	
	public static function incomplete_iar(){
 		$incomplete = self::$db->select('iar.*')->select('po.po_no')->where(['iar.status' => 'incomplete'])->from('iar')->join('po','iar.po_id = po.id')->get()->result();
		return self::get_mapped_items($incomplete);
 	}

 	public static function all_po(){
 		$all_po = self::$db->get_where('po', ['status' => 'confirmed', 'iar_status' => 'pending'])->result();
 		return self::get_mapped_items_po($all_po);
 	}

 	public static function inventory(){
 		return self::$db->get('inventory')->result();
 	}

 	public static function save_iar($po_id, $iar, $supply, $asset, $inventory){
 		self::$db->insert('iar', ['iar_no' => $iar['iar_no'], 'date_created' => $iar['date_created'], 'po_id' => $po_id, 'created_by' => $iar['created_by'], 'inspected_by' => $iar['inspected_by'], 'inspected_position' => $iar['inspected_position'], 'requisitioning' => $iar['requisitioning'], 'accepted_by' => $iar['accepted_by'], 'accepted_position' => $iar['accepted_position'], 'invoice_no' => $iar['invoice_no'], 'date_received' => $iar['date_received'], 'date_inspected' => $iar['date_inspected'], 'responsibility_code' => $iar['responsibility_code'], 'entity_naming' => $iar['entity_naming'], 'fund_cluster' => $iar['fund_cluster']]);
 		$iar_id = self::$db->insert_id();

 		$iar_status = 'completed';
 		foreach ($supply as $key => $value) {
 			$item = self::$db->get_where('items', ['id' => $value['id']])->result()[0];

 			self::$db->insert('items', ['code' => $item->code,'name' => $item->name, 'description' => $item->description, 'qty' => $item->qty, 'unit_cost' => $item->unit_cost, 'total_cost' => $item->total_cost, 'form_type' => 'iar', 'source' => $item->source, 'item_type' => $item->item_type, 'form_id' => $iar_id]);

 			$iar_item_id = self::$db->insert_id();

 			if($value['qty'] !== '0'){
				self::$db->where('id', $iar_item_id)->set('delivered_qty', 'delivered_qty+'.$value['qty'], FALSE)->update('items');
 			}

 			$item = self::$db->get_where('items', ['id' => $iar_item_id])->result()[0];
 			if(floatval($item->qty) > floatval($item->delivered_qty)){
 				$iar_status = 'incomplete';
 			}
 		}

 		$filtered_asset = [];

 		foreach ($asset as $key => $value) {
 			if(count($filtered_asset) > 0){
 				$does_exist = false;
 				$key_exist = 0;
 				foreach ($filtered_asset as $key_1 => $value_1) {
	 				if($value['id'] === $value_1['id']){
	 					$does_exist = true;
	 					$key_exist = $key_1;
	 				}
	 			}
	 			if($does_exist){
	 				$filtered_asset[$key_exist]['qty'] = floatval($filtered_asset[$key_exist]['qty']) + 1;
	 			}else{
	 				array_push($filtered_asset, $value);
	 			}
 			}else{
 				array_push($filtered_asset, $value);
 			}
 			
 		}

 		foreach ($filtered_asset as $key => $value) {
 			$item = self::$db->get_where('items', ['id' => $value['id']])->result()[0];

 			self::$db->insert('items', ['name' => $item->name, 'description' => $item->description, 'qty' => $item->qty, 'unit_cost' => $item->unit_cost, 'total_cost' => $item->total_cost, 'form_type' => 'iar', 'source' => $item->source, 'item_type' => $item->item_type, 'form_id' => $iar_id]);

 			$iar_item_id = self::$db->insert_id();

 			if($value['distinct_number'] !== ''){
 				self::$db->where('id', $iar_item_id)->set('delivered_qty', 'delivered_qty+'.$value['qty'], FALSE)->update('items');
 			}
 			
 			$item = self::$db->get_where('items', ['id' => $iar_item_id])->result()[0];
 			if(floatval($item->qty) > floatval($item->delivered_qty)){
 				$iar_status = 'incomplete';
 			}

 		}
		if($iar_status == "completed"){
			$CI =& get_instance();
			self::$db->where('id', $iar_id)->update('iar', ['status' => $iar_status, 'modified_by' => $CI->session->userdata('user_full_name')]);
			self::$db->where('id', $po_id)->update('po', ['status' => $iar_status]);
		}else{
			self::$db->where('id', $iar_id)->update('iar', ['status' => $iar_status]);
		}
 		

 		foreach ($inventory as $key => $value) {
 			self::$db->insert('items', ['name' => $value['name'], 'description' => $value['description'], 'qty' => $value['qty'], 'unit_cost' => $value['unit_cost'], 'total_cost' => $value['total_cost'], 'form_type' => 'iar', 'source' => 'csv', 'item_type' => $value['type'], 'form_id' => $iar_id, 'delivered_qty' => $value['qty']]);
 		}

 		foreach ($asset as $key => $value) {
 			$item = self::$db->get_where('items', ['id' => $value['id']])->result()[0];
 			self::$db->insert('asset_inventory', ['asset_name' => $item->name, 'asset_description' => $item->description, 'distinction_no' => $value['distinct_number'],'form_id' => $iar['iar_no']]);
 		}

 		foreach ($supply as $key => $value) {
 			$item = self::$db->get_where('items', ['id' => $value['id']])->result();
 			$supply_inventory = self::$db->get('supply_inventory')->result();

 			foreach ($item as $key_1 => $value_1) {
 				$does_exist = false;
 				$id_exist = 0;
 				foreach ($supply_inventory as $key_2 => $value_2) {
	 				if($value_1->name === $value_2->name && $value_1->description === $value_2->description){
	 					$does_exist = true;
	 					$id_exist = $value_2->id;
	 				}
	 			}
	 			if($does_exist){
	 				self::$db->where('id', $id_exist)->set('qty', 'qty+'.$value['qty'], FALSE)->update('supply_inventory');
	 			}else{
	 				self::$db->insert('supply_inventory', ['code' => $value_1->code,'unit' => $value_1->unit,'total_cost' => $value_1->total_cost,'name' => $value_1->name, 'description' => $value_1->description, 'qty' => $value['qty'], 'unit_cost' => $value_1->unit_cost]);
	 			}
 			}
 			
 		}
 	}

 	// public static function save_iar($po_id, $inventory_items, $iar_date_created, $iar_status,$iar_no,$save_supply_inventory,$save_asset_inventory,$iar_inspected_by,$iar_inspected_position,$iar_requisitioning,$iar_accepted_by,$iar_accepted_position,$iar_invoice_no,$iar_date_received,$iar_date_inspected,$iar_responsibility_code,$iar_entity_naming,$iar_fund_cluster){
		// $CI =& get_instance();
		// if ($CI->session->userdata('user_id')) {
		// 	$po = self::$db->get_where('po', ['id' => $po_id], 1)->result();
		// 	if(count($po) > 0){
		// 		$po_no = $po[0]->po_no;
		// 		if($iar_status == "completed"){
		// 			$status="completed";
		// 			self::$db->where('id', $po_id)->update('po', ['status' => $status]);
		// 		}
		// 		self::$db->where('id', $po_id)->update('po', ['iar_status' => $status]);
		// 		self::$db->insert('iar', ['iar_no' => $iar_no, 'status' => $iar_status, 'date_created' => $iar_date_created, 'po_id' => $po_id, 'created_by' => $CI->session->userdata('user_id'),
		// 															'inspected_by' => $iar_inspected_by, 'inspected_position' => $iar_inspected_position, 'requisitioning' => $iar_requisitioning, 'accepted_by' => $iar_accepted_by,
		// 															'accepted_position' => $iar_accepted_position, 'invoice_no' => $iar_invoice_no, 'date_received' => $iar_date_received,'date_inspected' => $iar_date_inspected,
		// 															'responsibility_code' => $iar_responsibility_code, 'entity_naming' => $iar_entity_naming, 'fund_cluster' => $iar_fund_cluster
		// 															]);
		// 		$iar_id = self::$db->insert_id();
		// 		$po_items = [];
		// 		if(count($inventory_items) > 0){
		// 			foreach ($inventory_items as $key => $value) {
		// 				if((!isset($value['qty'])) || ($value['qty'] == "")){
		// 					$value['qty'] = 0;
		// 				}
		// 				self::$db->insert('items', ['code' => $value['code'], 'name' => $value['name'], 'description' => $value['description'], 'qty' => $value['qty'], 'unit_cost' => $value['unit_cost'], 'total_cost' => $value['total_cost'], 'item_type' => $value['item_type'], 'form_type' => 'iar', 'source' => 'inventory',  'form_id' => $po[0]->id]);

		// 			}
		// 		}
		// 		if(($iar_status != "draft") && ($iar_status != "completed") ){
		// 			self::$db->where('id', $po_id)->update('po', ['iar_status' => 'delivered']);
		// 		}
		// 		if($iar_status == "completed"){
		// 			foreach($save_supply_inventory as $key_1 => $value_1){
		// 				$duplicate = self::$db->get_where('supply_inventory', ['code' => $value_1['code']], 1)->result();
		// 				if(count($duplicate) > 0){
		// 					self::$db->where('code', $value_1['code'])->set('qty', 'qty+'.$value_1['qty'], FALSE)->update('supply_inventory');
		// 				}else{
		// 					self::$db->insert('supply_inventory', ['code' => $value_1['code'], 'name' => $value_1['name'], 'description' => $value_1['description'], 'qty' => $value_1['qty'], 'unit_cost' => $value_1['unit_cost'], 'total_cost' => $value_1['total_cost']]);
		// 				}
		// 			}
		// 			foreach($save_asset_inventory as $key_1 => $value_1){
		// 				for($i=0;$i<$value_1['qty'];$i++){
		// 					self::$db->insert('asset_inventory', ['asset_name' => $value_1['name'], 'asset_description' => $value_1['description']]);
		// 				}
		// 			}
		// 		}
		// 	}
		// }
 	// }

 	public static function edit_iar($iar_no,$po_no,$inventory_items,$iar_date_created,$iar_status,$save_supply_inventory,$save_asset_inventory){
 		$CI =& get_instance();
		if ($CI->session->userdata('user_id')) {
			$po = self::$db->get_where('po', ['po_no' => $po_no], 1)->result();
			if(count($po) > 0){
				$status = "delivered";
				$po_id = $po[0]->id;
				if($iar_status == "completed"){
					$status="completed";
					self::$db->where('id', $po_id)->update('po', ['status' => $status]);
				}
				self::$db->where('id', $po_id)->update('po', ['iar_status' => $status]);
				self::$db->where('iar_no', $iar_no)->update('iar', ['status' => $iar_status, 'date_created' => $iar_date_created, 'date_modified' => date('Y-m-d', time()), 'modified_by' => $CI->session->userdata('user_id')]);
				
				foreach ($inventory_items as $key => $value) {
					self::$db->where('form_id', $po_id)->where('code', $value['code'])->where('form_type', 'iar')->set('qty', $value['qty'], FALSE)->update('items');
				}
			
				if($iar_status == "completed"){
					foreach($save_supply_inventory as $key_1 => $value_1){
						$duplicate = self::$db->get_where('supply_inventory', ['code' => $value_1['code']], 1)->result();
						if(count($duplicate) > 0){
							self::$db->where('code', $value_1['code'])->set('qty', 'qty+'.$value_1['qty'], FALSE)->update('supply_inventory');
						}else{
							self::$db->insert('supply_inventory', ['code' => $value_1['code'],'name' => $value_1['name'], 'description' => $value_1['description'], 'qty' => $value_1['qty'], 'unit_cost' => $value_1['unit_cost'], 'total_cost' => $value_1['total_cost']]);
						}
					}
					foreach($save_asset_inventory as $key_1 => $value_1){
						for($i=0;$i<$value_1['qty'];$i++){
							self::$db->insert('asset_inventory', ['asset_name' => $value_1['name'], 'asset_description' => $value_1['description']]);
						}
					}
				}
			}
		}
 	}
	
	public static function iar_exist($id){
 		$query = self::$db->query("Select id from iar where iar_no='".$id."'");
		if($query->num_rows() > 0){
			return "Duplicate IAR No.";
		}else{
			return "Successful";
		} 
 	}

}