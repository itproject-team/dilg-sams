<?php

class PPMP extends MY_Controller{

	function __construct(){
		parent::__construct('Head');
	}

	public function get_ppmp(){
		$this->load->view($this->layout, ['content' => 'Head/content/PPMP', 'js' => 'Head/js/PPMP', 'nav' => 'ppmp']);
	}

	public function first_quarter(){
		$quarter = '1';
		$date = date('Y');
		$dept_id = $this->session->userdata('department');

		echo json_encode(['data' => PPMP_Model::first_quarter(['dept_id' => $dept_id, 'quarter' => $quarter, 'year' => $date])]);
	}

	public function first_quarter_filename(){
		$quarter = '1';
		$date = date('Y');
		$dept_id = $this->session->userdata('department');
		echo json_encode(PPMP_Model::first_quarter_filename(['dept_id' => $dept_id, 'quarter' => $quarter, 'year' => $date]));
	}

	public function second_quarter(){
		$quarter = '2';
		$date = date('Y');
		$dept_id = $this->session->userdata('department');

		echo json_encode(['data' => PPMP_Model::second_quarter(['dept_id' => $dept_id, 'quarter' => $quarter, 'year' => $date])]);
	}

	public function second_quarter_filename(){
		$quarter = '2';
		$date = date('Y');
		$dept_id = $this->session->userdata('department');
		echo json_encode(PPMP_Model::second_quarter_filename(['dept_id' => $dept_id, 'quarter' => $quarter, 'year' => $date]));
	}

	public function third_quarter(){
		$quarter = '3';
		$date = date('Y');
		$dept_id = $this->session->userdata('department');

		echo json_encode(['data' => PPMP_Model::third_quarter(['dept_id' => $dept_id, 'quarter' => $quarter, 'year' => $date])]);
	}

	public function third_quarter_filename(){
		$quarter = '3';
		$date = date('Y');
		$dept_id = $this->session->userdata('department');
		echo json_encode(PPMP_Model::third_quarter_filename(['dept_id' => $dept_id, 'quarter' => $quarter, 'year' => $date]));
	}

	public function fourth_quarter(){
		$quarter = '4';
		$date = date('Y');
		$dept_id = $this->session->userdata('department');

		echo json_encode(['data' => PPMP_Model::fourth_quarter(['dept_id' => $dept_id, 'quarter' => $quarter, 'year' => $date])]);
	}

	public function fourth_quarter_filename(){
		$quarter = '4';
		$date = date('Y');
		$dept_id = $this->session->userdata('department');
		echo json_encode(PPMP_Model::fourth_quarter_filename(['dept_id' => $dept_id, 'quarter' => $quarter, 'year' => $date]));
	}

	public function save_ppmp(){
		$quarter = $this->input->post('quarter');
		$dept_id = $this->session->userdata('department');

	 	if($_FILES["file"]["size"] > 0){
		 	$filename=$_FILES["file"]["tmp_name"];
		  	$file = fopen($filename, "r");
     	 	

     	 	$ppmp = ['year' => date('Y'), 'quarter' => $quarter, 'dept_id' => $dept_id, 'filename' => $_FILES["file"]['name']];
     	 	$items = [];

     	 	while (($emapData = fgetcsv($file, 10000, "\r")) !== FALSE){
	    		foreach ($emapData as $key => $value) {
	    			$item = explode(';', $value);
					if(sizeOf($item) < 8){
						$item[7] = $item[5];
						$item[5] = $item[4];
						$item[4] = $item[3];
						$item[3] = $item[2];
						$item[2] = $item[1];
						$item[1] = $item[0];
						$item[0] = "";
					}
	    			array_push($items, ['code' => $item[0], 'name' => $item[1], 'description' => $item[2], 'qty' => $item[3], 'unit_cost' => $item[4], 'total_cost' => $item[5],'unit' => $item[7], 'form_type' => 'ppmp', 'source' => 'csv', 'item_type' => 'supply']);
	    		}
	          
	        }
	        fclose($file);
	        PPMP_Model::save_ppmp($ppmp, $items);
		 }

		 return redirect('head/ppmp');
	}

	public function add_ppmp(){
			$quarter = $this->input->post('quarter');
			$dept_id = $this->session->userdata('department');
     	 	$items = [];
			if($_FILES["file_add".$quarter]["size"] > 0){
				$filename=$_FILES["file_add".$quarter]["tmp_name"];
				$file = fopen($filename, "r");
				while (($emapData = fgetcsv($file, 10000, "\r")) !== FALSE){
					foreach ($emapData as $key => $value) {
						$item = explode(';', $value);
						if(sizeOf($item) < 8){
							$item[7] = $item[5];
							$item[5] = $item[4];
							$item[4] = $item[3];
							$item[3] = $item[2];
							$item[2] = $item[1];
							$item[1] = $item[0];
							$item[0] = "";
						}
						array_push($items, ['code' => $item[0], 'name' => $item[1], 'description' => $item[2], 'qty' => $item[3], 'unit_cost' => $item[4], 'total_cost' => $item[5], 'unit' => $item[7], 'form_type' => 'ppmp', 'source' => 'csv', 'item_type' => 'supply']);
					}
				  
				}
				fclose($file);
				PPMP_Model::add_ppmp($quarter,$dept_id, $items);
			}
		return redirect('head/ppmp');
	}
	
	public function delete_ppmp(){
		$id = $this->input->post('form_id');
		PPMP_Model::delete_ppmp($id);
		return redirect('head/ppmp');
	}

	public function activate_ppmp(){
		$id = $this->input->post('form_id');
		$dept_id = $this->session->userdata('department');
		
		PPMP_Model::activate_ppmp($id, $dept_id);
		return redirect('head/ppmp');
	}

	public function deactivate_ppmp(){
		$id = $this->input->post('form_id');
		$dept_id = $this->session->userdata('department');
		
		PPMP_Model::deactivate_ppmp($id, $dept_id);
		return redirect('head/ppmp');
	}
}