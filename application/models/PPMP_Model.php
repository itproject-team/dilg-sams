<?php

class PPMP_Model extends CI_Model{
 	private static $db;

 	function __construct(){
 		parent::__construct();
 		self::$db = &get_instance()->db;
 	}

 	private static function get_mapped_items($record){
 		$ppmp_items = [];

		if(count($record) > 0){
 			foreach ($record as $key => &$value) {
 				$items = self::$db->get_where('items', ['form_type' => 'ppmp', 'form_id' => $value->ppmp_id])->result();
 				$ppmp_items = $items;
 			}
 		}
 		return $ppmp_items;
	}

 	public static function first_quarter($condition){
 		$data = self::$db->get_where('ppmp', $condition)->result();
 		return self::get_mapped_items($data);
 	}

 	public static function first_quarter_filename($condition){
 		return $data = self::$db->get_where('ppmp', $condition)->result();
 	}

 	public static function second_quarter($condition){
 		$data = self::$db->get_where('ppmp', $condition)->result();
 		return self::get_mapped_items($data);
 	}

 	public static function second_quarter_filename($condition){
 		return $data = self::$db->get_where('ppmp', $condition)->result();
 	}

 	public static function third_quarter($condition){
 		$data = self::$db->get_where('ppmp', $condition)->result();
 		return self::get_mapped_items($data);
 	}

 	public static function third_quarter_filename($condition){
 		return $data = self::$db->get_where('ppmp', $condition)->result();
 	}

 	public static function fourth_quarter($condition){
 		$data = self::$db->get_where('ppmp', $condition)->result();
 		return self::get_mapped_items($data);
 	}

 	public static function fourth_quarter_filename($condition){
 		return $data = self::$db->get_where('ppmp', $condition)->result();
 	}

 	public static function save_ppmp($ppmp, $items){
 		self::$db->insert('ppmp', $ppmp);
 		$id = self::$db->insert_id();
 		foreach ($items as $key => &$value) {
 			$value['form_id'] = $id;
 			self::$db->insert('items', $value);
 		}
 	}
	
	public static function add_ppmp($quarter,$dept_id, $items){
		$id = self::$db->select('ppmp_id')->get_where('ppmp',['quarter' => $quarter, 'dept_id' => $dept_id])->row('ppmp_id');
		$items_in_ppmp = self::$db->get_where('items',['form_id' => $id, 'form_type' => 'ppmp'])->result();
 		
		 foreach ($items as $key => &$value) {
			$value['form_id'] = $id;
			$isSame = false;
			foreach($items_in_ppmp as $key_1 => $value_1){
				if($value['code'] == $value_1->code){
					$isSame = true;
				}
			}
			if(isSame){
				self::$db->where(['form_id' => $id, 'form_type' => 'ppmp','code' => $value['code']])->set('qty', 'qty+'.$value['qty'], FALSE)->update('items');
			}else{
				self::$db->insert('items', $value);
			}
 		}
 	}

 	public static function delete_ppmp($id){
 		self::$db->delete('items', ['form_id' => $id]);
 		self::$db->delete('ppmp', ['ppmp_id' => $id]);
 	}

 	public static function activate_ppmp($id, $dept_id){
 		self::$db->where('dept_id', $dept_id)->update('ppmp', ['flag' => '0']);
 		self::$db->where(['ppmp_id' => $id, 'dept_id' => $dept_id])->update('ppmp', ['flag' => '1']);
 	}

 	public static function deactivate_ppmp($id, $dept_id){
 		self::$db->where('dept_id', $dept_id)->update('ppmp', ['flag' => '0']);
 	}
}