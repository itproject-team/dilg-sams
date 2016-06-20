<?php

class Asset_Model extends CI_Model{
 	private static $db;

 	function __construct(){
 		parent::__construct();
 		self::$db = &get_instance()->db;
 	}

 	public static function all_assets(){

		$asset = self::$db->select('asset_inventory.asset_no')->select('asset_name')->select('asset_description')->select('date_created')->select('asset_inventory.emp_id')->
		select('user_profile.id')->select("CONCAT(user_profile.firstname,' ',user_profile.middlename,' ',user_profile.lastname) AS employee")->
		select('asset_part_no')->select('asset_part_name')->select('asset_part_description')->select('asset_part.status AS part_status')->
		select('pc.status AS asset_status')->from('asset_inventory')
		->join('user_profile', 'asset_inventory.emp_id = user_profile.id')
		->join('asset_part', 'asset_inventory.asset_no = asset_part.asset_no')
		->join('pc', 'asset_inventory.asset_no = pc.asset_no')->get()->result();	
 		return $asset;

 		//return self::$db->get('asset')->result();
 	}

}