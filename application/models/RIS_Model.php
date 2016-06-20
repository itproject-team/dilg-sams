<?php

 class RIS_Model extends CI_Model{
 	private static $db;

 	function __construct(){
 		parent::__construct();
 		self::$db = &get_instance()->db;
 	}

	private static function get_mapped_items($record){
		if(count($record) > 0){
 			foreach ($record as $key => &$value) {
 				$items = self::$db->get_where('items', ['form_type' => 'ris', 'form_id' => $value->id])->result();
 				$value->items = $items;
 			}
 		}
 		return $record;
	}

	private static function admin_get_mapped_items($record){
		if(count($record) > 0){
 			foreach ($record as $key => &$value) {
 				$items = self::$db->get_where('items', ['form_type' => 'ris', 'form_id' => $value->ris_id])->result();
 				$value->items = $items;
 			}
 		}
 		return $record;
	}

	public static function get_ppmp(){
		$CI =& get_instance();
 		$ppmp = self::$db->select('items.*')->select('(supply_inventory.qty - supply_inventory.dispense_qty) as max')->where('form_type','ppmp')->from('items')->join('ppmp', 'ppmp.ppmp_id = items.form_id')->join('supply_inventory', 'supply_inventory.code = items.code')->join('department', 'department.id = ppmp.dept_id')->where(['ppmp.flag' => '1', 'department.id' => $CI->session->userdata('department')])->where('(supply_inventory.qty - supply_inventory.dispense_qty) >','0')->get()->result();
 		return $ppmp;
 	}

 	public static function last_ris_no(){
 		return self::$db->select('ris_no')->order_by('id',"desc")->limit(1)->get('ris')->row();
 	}

 	public  static function save_ris($ris_no, $user_id, $dept_id, $id, $qty){
 			self::$db->insert('ris', ['ris_no' => $ris_no, 'status' => 'pending', 'date_created' => date('Y-m-d'), 'user_id' => $user_id, 'dept_id' => $dept_id]);
 			$ris_id = self::$db->insert_id();

 		$all_items = [];


 		foreach ($id as $key => $value) {
 			array_push($all_items, self::$db->get_where('items', ['id' => $value])->result()[0]);
 		}

 		foreach ($all_items as $key => $value) {
 			self::$db->insert('items', ['unit' => $value->unit,'code' => $value->code,'name' => $value->name, 'description' => $value->description, 'qty' => $qty[$key], 'unit_cost' => $value->unit_cost, 'total_cost' => (floatval($value->total_cost) * floatval($qty[$key])), 'form_type' => 'ris', 'source' => 'csv', 'item_type' => 'supply', 'form_id' => $ris_id, 'filename' => $value->filename ]);
 		}
 	}

 	public static function user_all_ris($user_id){
 		$ris = self::$db->get_where('ris', ['user_id' => $user_id, 'flag' => '1'])->result();
 		return self::get_mapped_items($ris);
 	}

 	public static function user_pending_ris($user_id){
 		$ris = self::$db->get_where('ris', ['user_id' => $user_id, 'flag' => '1', 'status' => 'pending'])->result();
 		return self::get_mapped_items($ris);
 	}

 	public static function user_cancelled_ris($user_id){
 		$ris = self::$db->get_where('ris', ['user_id' => $user_id, 'flag' => '1', 'status' => 'cancelled'])->result();
 		return self::get_mapped_items($ris);
 	}

 	public static function user_rejected_ris($user_id){
 		$ris = self::$db->get_where('ris', ['user_id' => $user_id, 'flag' => '1', 'status' => 'rejected'])->result();
 		return self::get_mapped_items($ris);
 	}

 	public static function user_confirmed_ris($user_id){
 		$ris = self::$db->get_where('ris', ['user_id' => $user_id, 'flag' => '1', 'status' => 'confirmed'])->result();
 		return self::get_mapped_items($ris);
 	}

 	public static function user_completed_ris($user_id){
 		$ris = self::$db->get_where('ris', ['user_id' => $user_id, 'flag' => '1', 'status' => 'completed'])->result();
 		return self::get_mapped_items($ris);
 	}

 	public static function user_incomplete_ris($user_id){
 		$ris = self::$db->get_where('ris', ['user_id' => $user_id, 'flag' => '1', 'status' => 'incomplete'])->result();
 		return self::get_mapped_items($ris);
 	}

 	public static function cancel_ris($id, $modified_by){
 		self::$db->where('id', $id)->update('ris', ['status' => 'cancelled', 'flag' => '1', 'modified_by' => $modified_by]);
 	}

 	public static function save_dispense($ris_id, $item_qty, $item_id){
 		$ris_status = 'completed';

 		
 		foreach ($item_id as $key => $value) {
 			self::$db->where('id', $value)->set('dispense_qty', 'dispense_qty+'.$item_qty[$key], FALSE)->update('items');
 		}
 		foreach ($item_id as $key => $value) {
 			$item = self::$db->get_where('items', ['id' => $value])->result()[0];
			self::$db->where('code', $item->code)->set('dispense_qty', 'dispense_qty+'.$item_qty[$key], FALSE)->update('supply_inventory');
 			if(floatval($item->qty[$key]) > floatval($item->dispense_qty[$key])){
 				$ris_status = 'incomplete';
 			}
 		}
		
 		self::$db->where('ris_no', $ris_id)->update('ris', ['status' => $ris_status]);

 		
 	}
	
	public static function post_delete_ris($id,$status){
		$form_id = self::$db->select('id')->from('ris')->where('ris_no',$id)->get()->row('id');
		$CI =& get_instance();
		if ($CI->session->userdata('user_id')) {
			self::$db->delete('items', array('form_id' => $form_id, 'form_type' => 'ris')); 
			self::$db->delete('ris', array('ris_no' => $id, 'status' => $status)); 
		}
 	}

 	

 }