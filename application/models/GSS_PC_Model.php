<?php

 class GSS_PC_Model extends CI_Model{
 	private static $db;

 	function __construct(){
 		parent::__construct();
 		self::$db = &get_instance()->db;
 	}

	public static function generated_pc(){
 		$pc = self::$db->select('pc.*')->
		select('asset_inventory.asset_no')->select('asset_name')->select('asset_description')->select('asset_inventory.emp_id')->select('asset_inventory.distinction_no')->select('asset_inventory.remarks')->
		select('asset_part_no')->select('asset_part_name')->select('asset_part_description')->select('asset_part.status AS part_status')->select('asset_part.remarks AS part_remarks')->
		select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS user_name")->
		select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS employee")->from('pc')
		->join('asset_inventory', 'pc.asset_no = asset_inventory.asset_no')		
		->join('asset_part', 'asset_inventory.asset_no = asset_part.asset_no')
		->join('user_profile', 'asset_inventory.emp_id = user_profile.id')
		->join('user_account', 'user_profile.user_account = user_account.id')
		->join('department', 'department.id = user_account.department')->group_by('pc.asset_no')
		->get()->result();

 		return $pc;
 	}

	public static function last_pc(){
 		return self::$db->select('*')->order_by('id')->limit(1)->get('pc')->result();
 	}

 	public static function pc_list(){
 		$asset_no = self::$db->query("SELECT asset_no from dilg.pc;");
		$asset_no = $asset_no->row()->asset_no;
 		return self::$db->select('pc.*')->
 		select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS employee")
 		->join('user_profile', 'pc.emp_id = user_profile.id')
 		->where('asset_no', $asset_no)->from('pc')->get()->result();
 	}

 	public static function save_pc($asset_no, $pc, $part, $asset_part_no, $pc_remarks){
 		self::$db->insert('pc', $pc);
 		$id = self::$db->insert_id();
 		self::$db->where('asset_part_no', $asset_part_no)->update('asset_part', $part);
 		self::$db->where('asset_no', $asset_no)->update('asset_inventory', ['remarks' => $pc_remarks]);		
 	}

 	public static function update_pc($pc, $pc_employee){
 		 foreach ($pc as $key => $value) {
 			self::$db->insert('pc', $value);
 		}
 		
 	}

 }
 // i am currently inserting asset_no to pc table. 
 // updating pc!