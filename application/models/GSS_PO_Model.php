<?php

 class GSS_PO_Model extends CI_Model{
 	private static $db;

 	function __construct(){
 		parent::__construct();
 		self::$db = &get_instance()->db;
 	}

	private static function get_mapped_items($record){
		if(count($record) > 0){
 			foreach ($record as $key => &$value) {
 				$items = self::$db->get_where('items', ['form_type' => 'po', 'form_id' => $value->id])->result();
 				$value->items = $items;
 			}
 		}
 		return $record;
	}

 	public static function last_po(){
 		return self::$db->select('*')->order_by('id', 'desc')->limit(1)->get('po')->result();
 	}
	
	public static function item_code($name,$desc){
 		return self::$db->select('code')->where('name',$name)->where('description',$desc)->get('supply_inventory')->row('code');
 	}
	
	public static function po_print($code){
		$pending = self::$db->select('*')->select('po.id')->select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS user_name")->from('po')->join('user_profile', 'po.user_id = user_profile.id')->where('po.po_no',$code)->get()->result();
 		return self::get_mapped_items($pending);
	}
	
	public static function all_po(){
		$all = self::$db->select('*')->select('po.id')->select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS user_name")->from('po')->join('user_profile', 'po.user_id = user_profile.id')->get()->result();
 		return self::get_mapped_items($all);
 	}
 	public static function pending_po(){
		$pending = self::$db->select('*')->select('po.id')->select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS user_name")->from('po')->join('user_profile', 'po.user_id = user_profile.id')->where('status','pending')->get()->result();
 		return self::get_mapped_items($pending);
 	}
	public static function completed_po(){
		$pending = self::$db->select('*')->select('po.id')->select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS user_name")->from('po')->join('user_profile', 'po.user_id = user_profile.id')->where('status','completed')->get()->result();
 		return self::get_mapped_items($pending);
 	}
 	public static function confirmed_po(){
 		$confirmed = self::$db->select('*')->select('po.id')->select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS user_name")->from('po')->join('user_profile', 'po.user_id = user_profile.id')->where('status','confirmed')->get()->result();
 		return self::get_mapped_items($confirmed);
 	}
 	public static function rejected_po(){
 		$rejected = self::$db->select('*')->select('po.id')->select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS user_name")->from('po')->join('user_profile', 'po.user_id = user_profile.id')->where('status','rejected')->get()->result();
 		return self::get_mapped_items($rejected);
 	}
 	public static function draft_po(){
 		$draft = self::$db->select('*')->select('po.id')->select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS user_name")->from('po')->join('user_profile', 'po.user_id = user_profile.id')->where('status','draft')->get()->result();
 		return self::get_mapped_items($draft);
 	}
 	public static function cancelled_po(){
 		$cancelled = self::$db->select('*')->select('po.id')->select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS user_name")->from('po')->join('user_profile', 'po.user_id = user_profile.id')->where('status','cancelled')->get()->result();
 		return self::get_mapped_items($cancelled);
 	}
 	public static function inventory(){
 		return self::$db->get('inventory')->result();
 	}
 	public static function save_po($po, $uploaded_items){
 		self::$db->insert('po', $po);
 		$id = self::$db->insert_id();
		
		foreach($uploaded_items as $key => $value){
			foreach($uploaded_items[$key]['items'] as $key_2 => $value_2){
					$uploaded_items[$key]['items'][$key_2]['form_id'] = $id;
					self::$db->insert('items', $uploaded_items[$key]['items'][$key_2]);
			}
		}
 	}
 	public static function post_cancel_po($id){
		$CI =& get_instance();
		if ($CI->session->userdata('user_id')) {
			$user_id = $CI->session->userdata('user_full_name');
			self::$db->where('id', $id)->update('po', ['status' => 'cancelled','modified_by' => $user_id, 'date_modified' => date('Y-m-d')]);
		}
 	}
	
	public static function post_delete_po($id,$status){
		$CI =& get_instance();
		if ($CI->session->userdata('user_id')) {
			self::$db->delete('items', array('form_id' => $id, 'form_type' => 'po')); 
			self::$db->delete('po', array('id' => $id, 'status' => $status)); 
		}
 	}

 	public static function edit_po($po, $uploaded_items){
		$id = self::$db->select('id')->where('po_no', $po['po_no'])->limit(1)->get('po')->row('id');
 		self::$db->where('form_id', $id)->delete('items');
 		self::$db->where('po_no', $po['po_no'])->update('po', $po);

		foreach($uploaded_items as $key => $value){
			foreach($uploaded_items[$key]['items'] as $key_2 => $value_2){
					$uploaded_items[$key]['items'][$key_2]['form_id'] = $id;
					self::$db->insert('items', $uploaded_items[$key]['items'][$key_2]);
			}
		}
 	}
	
	public static function po_exist($id){
 		$query = self::$db->query("Select id from po where po_no='".$id."'");
		if($query->num_rows() > 0){
			return "Duplicate Purchase Order No.";
		}else{
			return "Successful";
		} 
 	}
 }