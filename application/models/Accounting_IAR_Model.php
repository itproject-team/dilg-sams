<?php

class Accounting_IAR_Model extends CI_Model{
 	private static $db;

 	function __construct(){
 		parent::__construct();
 		self::$db = &get_instance()->db;
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
 		$completed = self::$db->select('*')->select('iar.id')->from('iar')->where('status','completed')->get()->result();
		return self::get_mapped_items($completed);
 	}
}