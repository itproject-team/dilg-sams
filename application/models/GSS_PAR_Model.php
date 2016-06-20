<?php

 class GSS_PAR_Model extends CI_Model{
 	private static $db;

 	function __construct(){
 		parent::__construct();
 		self::$db = &get_instance()->db;
 	}

	private static function get_mapped_items($record){
		if(count($record) > 0){
 			foreach ($record as $key => &$value) {
 				$items = self::$db->get_where('items', ['type' => 'par', 'form_id' => $value->id])->result();
 				$value->items = $items;
 			}
 		}
 		return $record;
	}

	public static function last_par(){
 		return self::$db->select('*')->order_by('id','desc')->limit(1)->get('par')->result();
 	}

 	public static function inventory(){
 		$asset_inventory = self::$db->select('asset_inventory.asset_no')->select('asset_name')->select('asset_description')->select('asset_inventory.emp_id')->select('asset_inventory.distinction_no')->
		select('asset_part_no')->select('asset_part_name')->select('asset_part_description')->select('asset_part.asset_no')->select('asset_part.status AS part_status')->from('asset_inventory')
 		->join('asset_part', 'asset_inventory.id = asset_part.asset_no', 'left')
 		->get()->result();	

 		return $asset_inventory;
 	}

	public static function all_par(){
		$par = self::$db->select('par.*')->
		select('asset_inventory.asset_no')->select('asset_name')->select('asset_description')->select('asset_inventory.emp_id')->select('asset_inventory.distinction_no')->
		select('asset_part_no')->select('asset_part_name')->select('asset_part_description')->select('asset_part.asset_no')->select('asset_part.status AS part_status')->
		select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS employee")->
		select('name')->from('par')
		->join('asset_inventory', 'par.asset_no = asset_inventory.asset_no')
		->join('asset_part', 'asset_inventory.asset_no = asset_part.asset_no', 'left')
		->join('user_profile', 'asset_inventory.emp_id = user_profile.id')
		->join('user_account', 'user_profile.user_account = user_account.id')
		->join('department', 'department.id = user_account.department')
		->get()->result();	

 		return $par;
 	}

	public static function completed_par(){
		$completed = self::$db->select('par.*')->
		select('asset_inventory.asset_no')->select('asset_name')->select('asset_description')->select('asset_inventory.emp_id')->select('asset_inventory.distinction_no')->
		select('asset_part_no')->select('asset_part_name')->select('asset_part_description')->select('asset_part.asset_no')->select('asset_part.status AS part_status')->
		select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS employee")->
		select('name')->from('par')
		->join('asset_inventory', 'par.asset_no = asset_inventory.asset_no')
		->join('asset_part', 'asset_inventory.asset_no = asset_part.asset_no')
		->join('user_profile', 'asset_inventory.emp_id = user_profile.id')
		->join('user_account', 'user_profile.user_account = user_account.id')
		->join('department', 'department.id = user_account.department')
		->where('par.status','completed')
		->get()->result();	

 		return $completed;
 	}

 	public static function draft_par(){
 		$draft = self::$db->select('par.*')->
		select('asset_inventory.asset_no')->select('asset_name')->select('asset_description')->select('asset_inventory.emp_id')->select('asset_inventory.distinction_no')->
		select('asset_part_no')->select('asset_part_name')->select('asset_part_description')->select('asset_part.asset_no')->select('asset_part.status AS part_status')->
		select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS employee")->
		select('name')->from('par')
		->join('asset_inventory', 'par.asset_no = asset_inventory.asset_no')
		->join('asset_part', 'asset_inventory.asset_no = asset_part.asset_no')
		->join('user_profile', 'asset_inventory.emp_id = user_profile.id')
		->join('user_account', 'user_profile.user_account = user_account.id')
		->join('department', 'department.id = user_account.department')
		->where('par.status','draft')
		->get()->result();

 		return $draft;
 	}

 	public static function all_emp(){
 		return self::$db->select('firstname, middlename, lastname')->order_by('id')->get('user_profile')->result();
 	}

 	public static function all_dept(){
 		return self::$db->select('*')->order_by('name')->get('department')->result();
 	}


 	public static function save_par($asset_no, $par, $asset, $part, $asset_part_no_id, $employee, $distinction_no){
 		self::$db->insert('par', $par);
 		$id = self::$db->insert_id();
 		self::$db->where('distinction_no', $distinction_no)->update('asset_inventory', $asset);
 		$emp_id = self::$db->query("SELECT id from dilg.user_profile WHERE CONCAT(user_profile.firstname, ' ' , user_profile.middlename, ' ' , user_profile.lastname) = '".$employee."';");
		$id = $emp_id->row()->id;
		self::$db->where('distinction_no', $distinction_no)->update('asset_inventory', ['emp_id' => $id]);
		self::$db->where('asset_part_no', $asset_part_no_id)->update('asset_part', $part);

 	}

 	public static function edit_par($par_id, $asset_no, $par, $asset, $employee){
 		self::$db->where('id', $par_id)->update('par', $par);
 		self::$db->update('asset_inventory', $asset);
 		$emp_id = self::$db->query("SELECT id from dilg.user_profile WHERE CONCAT(user_profile.firstname, ' ' , user_profile.middlename, ' ' , user_profile.lastname) = '".$employee."';");
		$id = $emp_id->row()->id;
		self::$db->update('asset_inventory', ['emp_id' => $id]);
 	}
 	
 }