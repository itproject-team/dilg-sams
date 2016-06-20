<?php

class GSS_Inventory_Model extends CI_Model{
 	private static $db;

 	function __construct(){
 		parent::__construct();
 		self::$db = &get_instance()->db;
 	}

 	public static function inventory_record(){
 		$supply = self::$db->get('supply_inventory')->result();

 		$data = [];
 		foreach ($supply as $key => $value) {
 			array_push($data, ['max' => ($value->qty - $value->dispense_qty), 'code' => $value->code, 'name' => $value->name, 'description' => $value->description, 'qty' => $value->qty]);
 		}
 		return $data;
 	}

 	public static function gss_ppmp(){
 		$ppmp = self::$db->select('items.*')->select('(supply_inventory.qty - supply_inventory.dispense_qty) as max')->from('items')->join('ppmp', 'ppmp.ppmp_id = items.form_id')->join('supply_inventory', 'supply_inventory.code = items.code')->join('department', 'department.id = ppmp.dept_id')->where(['ppmp.flag' => '1', 'department.name' => 'GSS'])->where('form_type','ppmp')->where('items.code !=','')->get()->result();
 		return $ppmp;
 	}

 	public static function accounting_ppmp(){
 		$ppmp = self::$db->select('items.*')->select('(supply_inventory.qty - supply_inventory.dispense_qty) as max')->from('items')->join('ppmp', 'ppmp.ppmp_id = items.form_id')->join('supply_inventory', 'supply_inventory.code = items.code')->join('department', 'department.id = ppmp.dept_id')->where(['ppmp.flag' => '1', 'department.name' => 'Accounting'])->where('form_type','ppmp')->where('items.code !=','')->get()->result();
 		return $ppmp;
 	}

 	public static function it_ppmp(){
 		$ppmp = self::$db->select('items.*')->select('(supply_inventory.qty - supply_inventory.dispense_qty) as max')->from('items')->join('ppmp', 'ppmp.ppmp_id = items.form_id')->join('supply_inventory', 'supply_inventory.code = items.code')->join('department', 'department.id = ppmp.dept_id')->where(['ppmp.flag' => '1', 'department.name' => 'IT'])->where('form_type','ppmp')->where('items.code !=','')->get()->result();
 		return $ppmp;
 	}


 	public static function asset_inventory(){
 		$part = self::$db->select('asset_inventory.id')->select('asset_inventory.asset_no')->select('asset_name')->select('asset_description')->select('asset_inventory.emp_id')->select('asset_inventory.distinction_no')->
		select('asset_part_no')->select('asset_part_name')->select('asset_part_description')->select('asset_part.distinction_no AS part_dist_no')->from('asset_inventory')
 		->join('asset_part', 'asset_inventory.id = asset_part.asset_no', 'left')
 		->get()->result();

 		return $part;
 	}

 	public static function add_parts($asset_id, $asset_no, $asset, $asset_part){
 		 foreach ($asset_part as $key => &$value) {
 			self::$db->where('asset_no', $asset_id)->insert('asset_part', $value);
 		}
 	}
	
	public static function balance(){
 		$balance = self::$db->select('*')->select('(qty - dispense_qty) as max')->from('supply_inventory')->get()->result();
 		return $balance;
 	}

	public static function purchase(){
 		$balance = self::$db->select('*')->from('supply_inventory')->get()->result();
 		return $balance;
 	}
	
	public static function rsmi($division){
 		$rsmi = self::$db->select('items.*')->where('department.name = "'.$division.'"')->where('items.form_type = "ris"')->from('items')->join('ris','ris.id=items.form_id')->join('department','ris.dept_id=department.id')->get()->result();
 		return $rsmi;
 	}
}