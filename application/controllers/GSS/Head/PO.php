<?php

class PO extends MY_Controller{

	function __construct(){
		parent::__construct('GSS');
	}

	public function get_po(){
		$this->checkIfLoggedIn(1,'head');
		$this->load->view($this->layout, ['content' => 'GSS/content/PO', 'js' => 'GSS/js/PO', 'nav' => 'po']);
	}

	public function last_po(){
		echo json_encode(GSS_PO_Model::last_po());
	}
	public function all_po(){
		echo json_encode(['data' => GSS_PO_Model::all_po()]);
	}
	public function pending_po(){
		echo json_encode(['data' => GSS_PO_Model::pending_po()]);
	}
	public function completed_po(){
		echo json_encode(['data' => GSS_PO_Model::completed_po()]);
	}
	public function confirmed_po(){
		echo json_encode(['data' => GSS_PO_Model::confirmed_po()]);
	}
	public function rejected_po(){
		echo json_encode(['data' => GSS_PO_Model::rejected_po()]);
	}
	public function draft_po(){
		echo json_encode(['data' => GSS_PO_Model::draft_po()]);
	}
	public function cancelled_po(){
		echo json_encode(['data' => GSS_PO_Model::cancelled_po()]);
	}
	public function read_csv(){
		$data = [];
	 	if($_FILES["file"]["size"] > 0){
		 	$filename=$_FILES["file"]["tmp_name"];
		  	$file = fopen($filename, "r");
     	 	while (($emapData = fgetcsv($file, 10000, "\r")) !== FALSE){
	    		foreach ($emapData as $key => $value) {
	    			$item = explode(';', $value);
					$code = GSS_PO_Model::item_code($item[0],$item[1]);
	    			array_push($data, ['code' => $code, 'name' => $item[0], 'description' => $item[1], 'qty' => $item[2], 'unit_cost' => $item[3], 'total_cost' => $item[4],'item_type' => $item[5],'unit' => $item[6]]);
	    		}
	        }
	        fclose($file);
		}
		echo json_encode($data);
	}
	
	public function po_print2(){
		parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
		$code = $_GET['code']; 
		$data['po'] = GSS_PO_Model::po_print($code);
		$this->load->view('GSS/content/PO_print.php',$data);
	}
	
	public function inventory(){
		$this->checkIfLoggedIn(1,'head');
		echo json_encode(GSS_PO_Model::inventory());
	}
	public function save_po(){
		$this->checkIfLoggedIn(1,'head');
		$po_no = $this->input->post('po_no');
		$po_status = $this->input->post('po_status');
		$po_supplier = $this->input->post('po_supplier');
		$po_purpose = $this->input->post('po_purpose');
		$po_source = $this->input->post('po_source');
		$po_address = $this->input->post('po_address');
		$po_tin = $this->input->post('po_tin');
		$po_mode = $this->input->post('po_mode');
		$po_pdelivery = $this->input->post('po_pdelivery');
		$po_ddelivery = $this->input->post('po_ddelivery');
		$po_dterm = $this->input->post('po_dterm');
		$po_pterm = $this->input->post('po_pterm');
		$po_sign = $this->input->post('po_sign');
		$po_signby = $this->input->post('po_signby');
		$po_files = $this->input->post('total_files');
		$po_date_created = $this->input->post('po_date_created2');
		$po = ['po_no' => $po_no, 'status' => $po_status, 'source' => $po_source, 'purpose' => $po_purpose, 'supplier' => $po_supplier, 'date_created' => $po_date_created, 'user_id' => $this->session->userdata('user_id'), 'address' => $po_address, 'tin' => $po_tin, 'mode' => $po_mode, 'pdelivery' => $po_pdelivery, 'ddelivery' => $po_ddelivery,'dterm' => $po_dterm,'pterm' => $po_pterm,'sign' => $po_sign,'signby' => $po_signby,];
		
		$uploaded_po = [];
		if(count($po_files) > 0){
			for($i=0; $i<$po_files; $i++){
				array_push($uploaded_po, ['filename' => $this->input->post('file_name_'.$i), 'items' => []]);
			}
			foreach($uploaded_po as $key_1 => $value_1){
				foreach($this->input->post('upload_item_'.$key_1) as $key_2 => $value_2){
					array_push($uploaded_po[$key_1]['items'], [
														'name' 			=> $value_2,
														'form_type' 	=> 'po',
														'source' 		=> 'csv',
														'code' 			=> $this->input->post('upload_item_code_'.$key_1)[$key_2],
														'filename' 		=> $uploaded_po[$key_1]['filename'][0],
														'description' 	=> $this->input->post('upload_desc_'.$key_1)[$key_2],
														'qty'			=> $this->input->post('upload_qty_'.$key_1)[$key_2],
														'unit' 			=> $this->input->post('upload_unit_'.$key_1)[$key_2],
														'unit_cost'		=> str_replace(',', '', $this->input->post('upload_unit_cost_'.$key_1))[$key_2],
														'total_cost'	=> str_replace(',', '', $this->input->post('upload_total_cost_'.$key_1))[$key_2],
														'item_type'		=> strtolower($this->input->post('upload_type_'.$key_1)[$key_2])
										]);
				}
				
			}
		}
		GSS_PO_Model::save_po($po, $uploaded_po);
		return redirect('gss/head/po');
	}

	public function post_cancel_po(){
		$this->checkIfLoggedIn(1,'head');
		$id = $this->input->post('id');
		GSS_PO_Model::post_cancel_po($id);
	}
	public function post_delete_po(){
		$this->checkIfLoggedIn(1,'head');
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		GSS_PO_Model::post_delete_po($id,$status);
	}
	public function po_exist(){
		$id = $_POST['data'];
		echo GSS_PO_Model::po_exist($id);
	}
	public function edit_po(){
		$this->checkIfLoggedIn(1,'head');
		$po_no = $this->input->post('po_no');
		$po_status = $this->input->post('po_status');
		$po_supplier = $this->input->post('po_supplier');
		$po_purpose = $this->input->post('po_purpose');
		$po_source = $this->input->post('po_source');
		$po_address = $this->input->post('po_address');
		$po_tin = $this->input->post('po_tin');
		$po_mode = $this->input->post('po_mode');
		$po_pdelivery = $this->input->post('po_pdelivery');
		$po_ddelivery = $this->input->post('po_ddelivery');
		$po_dterm = $this->input->post('po_dterm');
		$po_pterm = $this->input->post('po_pterm');
		$po_sign = $this->input->post('po_sign');
		$po_signby = $this->input->post('po_signby');
		$po_files = $this->input->post('total_files');
		$po_date_created = $this->input->post('po_date_created2');
		$po = ['po_no' => $po_no, 'status' => 'pending','date_modified' => date('Y-m-d'), 'source' => $po_source, 'purpose' => $po_purpose, 'supplier' => $po_supplier, 'date_created' => $po_date_created, 'modified_by' => $this->session->userdata('user_full_name'), 'address' => $po_address, 'tin' => $po_tin, 'mode' => $po_mode, 'pdelivery' => $po_pdelivery, 'ddelivery' => $po_ddelivery,'dterm' => $po_dterm,'pterm' => $po_pterm,'sign' => $po_sign, 'signby' => $po_signby,];
		
		$uploaded_po = [];
		if(count($po_files) > 0){
			for($i=0; $i<$po_files; $i++){
				array_push($uploaded_po, ['filename' => $this->input->post('file_name_'.$i), 'items' => []]);
			}
			foreach($uploaded_po as $key_1 => $value_1){
				foreach($this->input->post('upload_item_'.$key_1) as $key_2 => $value_2){
					array_push($uploaded_po[$key_1]['items'], [
														'name' 			=> $value_2,
														'form_type' 	=> 'po',
														'source' 		=> 'csv',
														'code' 			=> $this->input->post('upload_item_code_'.$key_1)[$key_2],
														'filename' 		=> $uploaded_po[$key_1]['filename'][0],
														'description' 	=> $this->input->post('upload_desc_'.$key_1)[$key_2],
														'qty'			=> $this->input->post('upload_qty_'.$key_1)[$key_2],
														'unit' 			=> $this->input->post('upload_unit_'.$key_1)[$key_2],
														'unit_cost'		=> str_replace(',', '', $this->input->post('upload_unit_cost_'.$key_1))[$key_2],
														'total_cost'	=> str_replace(',', '', $this->input->post('upload_total_cost_'.$key_1))[$key_2],
														'item_type'		=> strtolower($this->input->post('upload_type_'.$key_1)[$key_2])
										]);
				}
				
			}
		}
		GSS_PO_Model::edit_po($po, $uploaded_po);
		return redirect('gss/head/po');
	}
}