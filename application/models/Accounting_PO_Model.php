<?php

 class Accounting_PO_Model extends CI_Model{
 	private static $db;

 	function __construct(){
 		parent::__construct();
 		self::$db = &get_instance()->db;
 	}

	private static function get_mapped_items($record){
		if(count($record) > 0){
 			foreach ($record as $key => &$value) {
 				$items = self::$db->get_where('items', ['form_id' => $value->id])->result();
 				$value->items = $items;
 			}
 		}
 		return $record;
	}

	public static function all_po(){
		$pending = self::$db->select('*')->select('po.id')->select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS user_name")->from('po')->join('user_profile', 'po.user_id = user_profile.id')->where('status !=','draft')->where('status !=','cancelled')->get()->result();
 		return self::get_mapped_items($pending);
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


 	public static function post_confirm_po($id){
		$CI =& get_instance();
		if ($CI->session->userdata('user_id')) {
			$user_full_name = $CI->session->userdata('user_full_name');
			self::$db->where('id', $id)->update('po', ['status' => 'confirmed', 'iar_status' => 'pending','modified_by' => $user_full_name, 'date_modified' => date('Y-m-d')]);
		}
 	}
 	public static function post_reject_po($id){
		$CI =& get_instance();
		if ($CI->session->userdata('user_id')) {
			$user_full_name = $CI->session->userdata('user_full_name');
			self::$db->where('id', $id)->update('po', ['status' => 'rejected', 'modified_by' => $user_full_name, 'date_modified' => date('Y-m-d')]);
		}
 	}
}