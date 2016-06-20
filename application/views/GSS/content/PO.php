<input type='hidden' id="base_url" value="<?php  echo base_url(); ?>" /> 
<div ng-app='myApp' ng-controller='myCtrl'>
	<section class="content">
	<?php
		if($this->session->flashdata('error')){
			echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>';
		}
	?>
		<div class="row">
			<div class="col-md-12">
	      <div class="box box-default">
		      <div class="box-header with-border">
		        <h3 class="box-title">Purchase Order</h3>
		        <div class="box-tools pull-right">
		          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		        </div>
		      </div>
					<div class="box-body">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs" style="margin-bottom: 20px;">
				        <li class="active"><a href="#all" data-toggle="tab">All</a></li>
								<li><a href="#completed" data-toggle="tab">Completed</a></li>
								<li><a href="#confirmed" data-toggle="tab">Confirmed</a></li>
								<li><a href="#pending" data-toggle="tab">Pending</a></li>
								<li><a href="#draft" data-toggle="tab">Draft</a></li>
								<li><a href="#cancelled" data-toggle="tab">Cancelled</a></li>
								<li><a href="#rejected" data-toggle="tab">Rejected</a></li>
				        <li style="float: right;"><button id='generate-po-btn' type='button' class='btn btn-default'>Generate PO <i class='fa fa-file'></i></button></li>
				      </ul>
						<div class="tab-content">
				      <div class="tab-pane active" id="all">
					      <table id='all-table' class='table table-bordered table-hover table-striped' width="100%">
					        <thead>
						        <th>Purchase Order</th>
										<th>Status</th>
						        <th>Created By</th>
						        <th>Date Created</th>
										<th>Date Modified</th>
						        <th>Action</th>
						      </thead>
					      </table>
				      </div>
				      <div class="tab-pane" id="completed">
					      <table id='completed-table' class='table table-bordered table-hover table-striped' width="100%">
					        <thead>
										<th>Purchase Order</th>
										<th>Created By</th>
										<th>Date Created</th>
										<th>Date Modified</th>
						        <th>Action</th>
						      </thead>
					      </table>
				      </div>
				      <div class="tab-pane" id="confirmed">
				        <table id='confirmed-table' class='table table-bordered table-hover table-striped' width="100%">
				          <thead>
										<th>Purchase Order</th>
										<th>Created By</th>
										<th>Date Created</th>
										<th>Date Modified</th>
						        <th>Action</th>
						      </thead>
					      </table>
				      </div>
				      <div class="tab-pane" id="pending">
					      <table id='pending-table' class='table table-bordered table-hover table-striped' width="100%">
					        <thead>
										<th>Purchase Order</th>
										<th>Created By</th>
										<th>Date Created</th>
										<th>Date Modified</th>
						        <th>Action</th>
						      </thead>
					      </table>
				      </div>
				      <div class="tab-pane" id="draft">
				        <table id='draft-table' class='table table-bordered table-hover table-striped' width="100%">
				          <thead>
										<th>Purchase Order</th>
										<th>Created By</th>
										<th>Date Created</th>
										<th>Date Modified</th>
										<th>Action</th>
						      </thead>
					      </table>
				      </div>
				        <div class="tab-pane" id="cancelled">
				          <table id='cancelled-table' class='table table-bordered table-hover table-striped' width="100%">
				            <thead>
											<th>Purchase Order</th>
											<th>Created By</th>
											<th>Date Created</th>
											<th>Date Modified</th>
						          <th>Action</th>
						        </thead>
					        </table>
				        </div>
				        <div class="tab-pane" id="rejected">
				          <table id='rejected-table' class='table table-bordered table-hover table-striped' width="100%">
				            <thead>
											<th>Purchase Order</th>
											<th>Created By</th>
											<th>Date Created</th>
											<th>Date Modified</th>
						          <th>Action</th>
						        </thead>
					        </table>
				        </div>
				      </div>
			      </div>
		      </div>
		    </div>
	    </div>
		</div>
	</section>

	<form id='save_po' action="<?php echo base_url(); ?>gss/head/po/save_po" method='post'>
		<div id='generate-po-modal' class="modal" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type='button' class='close show-draft-modal'><span aria-hidden='true'>&times; </span></button>
						<h4 style="margin: 0;"><h4 class="inline"><strong>PO No.</strong></h4> &nbsp; <input class='form-control inline' type='text' name='po_no' value="{{ po_date_today }}-{{ last_po_id }}" required style='background-color: transparent; width: 50%; font-size: 18px; font-weight: bold;left:10px;'></h4>
						<input id='save_po_status' type='hidden' name='po_status' value="pending">
						<input id="total_files" name="total_files" value="{{total_files}}" type="hidden"/>
						<label class='alert alert-danger error-upload' style='margin-top:20px;padding: 6px 12px; background-color: red !important; width: 100%; display: none;'></label>
					</div>
					<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
            <div class='row'>
              <div class="col-md-4">
                Date Created:
								<div class="form-group">
									<div class='input-group date' id='datetimepicker1'>
										<input type='text' class="form-control" name="po_date_created2" value="{{ po_date_today2 }}" required />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>	
									</div>
								</div>
							</div>
						</div>
          </div>
					<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
						<div class='row'>
							<div class="col-md-12">
								<label class="custom-file-upload">
									<input id="upload" type="file" file-model='myFile'/>
									<i class="fa fa-cloud-upload"></i> Upload Abstract
								</label>
								<div class="box box-primary" ng-repeat="item in files track by $index">
					        <div class="box-body">
										<div class="form-group">
											<h4><label>File Name: </label> </h4>
											<div class='input-group'>
												<input id="filename" value="{{filenames[$index]}}" onfocus="this.oldvalue = this.value;" name="file_name_{{$index}}[]" type="text" class='form-control file-name' />
												<span style='border:none;' class='input-group-addon'><button type='button' ng-click="removeFile($index)" class='btn btn-danger remove-abstract btn-xs'>-</button></span>
											</div>
										</div>
							      <table class='table table-hover table-bordered table-striped'>
							        <thead>
												<th style="width: 100px;">Stock No</th>
													<th style="width: 140px;">Item</th>
													<th>Desc</th>
													<th style="width: 60px;">Qty</th>
													<th style="width: 40px;">Unit Measures</th>
													<th style="width: 110px;text-align:right;">Unit Cost</th>
													<th style="width: 120px;text-align:right;">Total Cost</th>
													<th style="width: 80px;">Type</th>
							        </thead>
							        <tbody>
								        <tr ng-repeat="items in item track by $index">
													<td><input class='form-control' type='text' name='upload_item_code_{{$parent.$index}}[]'  ng-readonly="items.item_type == 'asset'" value='{{items.code}}' required /></td>
								          <td><input class='form-control' type='text' name='upload_item_{{$parent.$index}}[]' value='{{ items.name }}' style="border: none; background: transparent;" readonly ></td>
								          <td><input class='form-control' type='text' name='upload_desc_{{$parent.$index}}[]' value='{{ items.description }}' style="border: none; background: transparent;" readonly ></td>
								          <td><input class='form-control' type='text' name='upload_qty_{{$parent.$index}}[]' value='{{ items.qty }}' style="border: none; background: transparent;" readonly ></td>
										  <td><input class='form-control' type='text' name='upload_unit_{{$parent.$index}}[]' value='{{ items.unit }}' style="border: none; background: transparent;" readonly ></td>
								          <td>
														<div class="input-group"><span class="input-group-addon" style="border: none; background: transparent;font-size:18px;">&#8369;</span>
														<input class='form-control text-right' type='text' name='upload_unit_cost_{{$parent.$index}}[]' value='{{ items.unit_cost }}' style="padding:0;border: none; background: transparent;" readonly ></div></td>
								          <td>
														<div class="input-group"><span class="input-group-addon" style="border: none; background: transparent;font-size:18px;">&#8369;</span>
														<input class='form-control text-right' type='text' name='upload_total_cost_{{$parent.$index}}[]' value='{{ items.total_cost }}' style="padding:0;border: none; background: transparent;" readonly ></div></td>
								          <td><input class='form-control' type='text' name='upload_type_{{$parent.$index}}[]' value='{{ items.item_type }}' style="border: none; background: transparent;" readonly ></td>
								        </tr>
								      </tbody>
							      </table>
					        </div>
					      </div>
								<div class="box box-default">
					        <div class="box-body">
										<table class='table table-hover table-bordered table-striped'>
											<thead>
												<th>Additional Information</th>
											</thead>
											<tbody>
												<tr>
													<td>Supplier: <input type="textfield" class='form-control' name="po_supplier" required></td>
													<td width="250px">Address: <input type="textfield" class='form-control' name="po_address" required></td>
													<td>TIN: <input type="textfield" class='form-control' name="po_tin"></td>
												</tr>
												<tr>
													<td>Purpose: <input type="textfield" class='form-control' name="po_purpose"></td>
													<td>Mode of Procurement: <input type="textfield" class='form-control' name="po_mode"></td>
													<td>Source of funds: <input type="textfield" class='form-control' name="po_source"></td>
												</tr>
												<tr>
													<td>Place of Delivery: <input type="textfield" class='form-control' name="po_pdelivery"></td>
													<td>Date of Delivery: 
														<div class='input-group date'>
															<input type="text" class='form-control' name="po_ddelivery">
															<span class="input-group-addon">
																<span class="glyphicon glyphicon-calendar"></span>
															</span>
														</div>
													</td>
													<td>Delivery Term: <input type="textfield" class='form-control' name="po_dterm"></td>
												</tr>
												<tr>
													<td>Payment Term: <input type="textfield" class='form-control' name="po_pterm"></td>
													<td>Approved by: <input  type="textfield" class='form-control' name="po_signby"></td>
													</td>
													<td>Position:
														<select class='form-control' id="po-modal-sign" name="po_sign">
															<option value="Regional Director">Regional Director</option>
															<option value="Assistant Regional Director">Assistant Regional Director</option>
														</select>
													</td>
												</tr>
											</tbody>
										</table>
					        </div>
					      </div>
							</div>
						</div>
					</div>
					<div class='modal-footer'>
						<h4><b class='pull-left'>Total Amount: &#8369; <u>{{ gen_po_total }}</u></b></h4>
						<button type='submit' class='btn btn-default'>Generate PO</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<form id='edit_po' action="<?php echo base_url(); ?>gss/head/po/edit_po" method='post'>
		<div id='edit-po-modal' class="modal" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type='button' class='close show-draft-modal-edit'><span aria-hidden='true'>&times; </span></button>
						<h4 style="margin: 0;"><h4 class="inline"><strong>PO No.</strong></h4> &nbsp; <input id='edit-po-modal-po_no' class='form-control inline' type='text' name='po_no' value="" required style='background-color: transparent; width: 50%; font-size: 18px; font-weight: bold;left:10px;'></h4>
						<input id='save_po_status' type='hidden' name='po_status' value="pending">
						<input id="total_files" name="total_files" value="{{total_files}}" type="hidden"/>
						<label class='alert alert-danger error-upload' style='margin-top:20px;padding: 6px 12px; background-color: red !important; width: 100%; display: none;'></label>
					</div>
					<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
            <div class='row'>
              <div class="col-md-4">
                Date Created:
								<div class="form-group">
									<div class='input-group date' id='datetimepicker1'>
										<input type='text' id="edit-po-modal-date_created" class="form-control" name="po_date_created2" value="{{ po_date_today2 }}" required />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>	
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
						<div class='row'>
							<div class="col-md-12">
								<label class="custom-file-upload">
									<input id="upload" type="file" file-model='myFile'/>
									<i class="fa fa-cloud-upload"></i> Upload Abstract
								</label>
								<div class="box box-primary" ng-repeat="item in files track by $index">
					        <div class="box-body">
										<div class="form-group">
											<h4><label>File Name: </label> </h4>
											<div class='input-group'>
												<input id="filename" value="{{filenames[$index]}}" onfocus="this.oldvalue = this.value;" name="file_name_{{$index}}[]" type="text" class='form-control file-name' />
												<span style='border:none;' class='input-group-addon'><button type='button' ng-click="removeFile($index)" class='btn btn-danger remove-abstract btn-xs'>-</button></span>
											</div>
										</div>
							      <table class='table table-hover table-bordered table-striped'>
							        <thead>
												<th style="width: 100px;">Stock No</th>
													<th style="width: 140px;">Item</th>
													<th>Desc</th>
													<th style="width: 60px;">Qty</th>
													<th style="width: 40px;">Unit Measures</th>
													<th style="width: 110px;text-align:right;">Unit Cost</th>
													<th style="width: 120px;text-align:right;">Total Cost</th>
													<th style="width: 80px;">Type</th>
							        </thead>
							        <tbody>
								        <tr ng-repeat="items in item track by $index">
													<td><input class='form-control' type='text' name='upload_item_code_{{$parent.$index}}[]'  ng-readonly="items.item_type == 'asset'" value='{{items.code}}' required /></td>
								          <td><input class='form-control' type='text' name='upload_item_{{$parent.$index}}[]' value='{{ items.name }}' style="border: none; background: transparent;" readonly ></td>
								          <td><input class='form-control' type='text' name='upload_desc_{{$parent.$index}}[]' value='{{ items.description }}' style="border: none; background: transparent;" readonly ></td>
								          <td><input class='form-control' type='text' name='upload_qty_{{$parent.$index}}[]' value='{{ items.qty }}' style="border: none; background: transparent;" readonly ></td>
								          <td><input class='form-control' type='text' name='upload_unit_{{$parent.$index}}[]' value='{{ items.unit }}' style="border: none; background: transparent;" readonly ></td>
										  <td>
														<div class="input-group"><span class="input-group-addon" style="border: none; background: transparent;font-size:18px;">&#8369;</span>
														<input class='form-control text-right' type='text' name='upload_unit_cost_{{$parent.$index}}[]' value='{{ items.unit_cost }}' style="padding:0;border: none; background: transparent;" readonly ></div></td>
								          <td>
														<div class="input-group"><span class="input-group-addon" style="border: none; background: transparent;font-size:18px;">&#8369;</span>
														<input class='form-control text-right' type='text' name='upload_total_cost_{{$parent.$index}}[]' value='{{ items.total_cost }}' style="padding:0;border: none; background: transparent;" readonly ></div></td>
								          <td><input class='form-control' type='text' name='upload_type_{{$parent.$index}}[]' value='{{ items.item_type }}' style="border: none; background: transparent;" readonly ></td>
								        </tr>
								      </tbody>
							      </table>
					        </div>
					      </div>
								<div class="box box-default">
					        <div class="box-body">
										<table class='table table-hover table-bordered table-striped'>
											<thead>
												<th>Additional Information</th>
											</thead>
											<tbody>
												<tr>
													<td>Supplier: <input id="edit-po-modal-supplier" type="textfield" class='form-control' name="po_supplier" required></td>
													<td width="250px">Address: <input id="edit-po-modal-address" type="textfield" class='form-control' name="po_address" required></td>
													<td>TIN: <input id="edit-po-modal-tin" type="textfield" class='form-control' name="po_tin"></td>
												</tr>
												<tr>
													<td>Purpose: <input id="edit-po-modal-purpose" type="textfield" class='form-control' name="po_purpose"></td>
													<td>Mode of Procurement: <input id="edit-po-modal-mode"type="textfield"  class='form-control' name="po_mode"></td>
													<td>Source of funds: <input id="edit-po-modal-source" type="textfield" class='form-control' name="po_source"></td>
												</tr>
												<tr>
													<td>Place of Delivery: <input id="edit-po-modal-pdelivery" type="textfield" class='form-control' name="po_pdelivery"></td>
													<td>Date of Delivery: 
														<div class='input-group date'>
															<input id="edit-po-modal-ddelivery" type="textfield" class='form-control' name="po_ddelivery">
															<span class="input-group-addon">
																<span class="glyphicon glyphicon-calendar"></span>
															</span>
														</div>
													</td>
													<td>Delivery Term: <input id="edit-po-modal-dterm" type="textfield" class='form-control' name="po_dterm"></td>
												</tr>
												<tr>
													<td>Payment Term: <input id="edit-po-modal-pterm" type="textfield" class='form-control' name="po_pterm"></td>
													<td>Approved by: <input id="edit-po-modal-signby" type="textfield" class='form-control' name="po_signby"></td>
													</td>
													<td>Position:
														<select class='form-control' id="edit-po-modal-sign" name="po_sign">
															<option value="Regional Director">Regional Director</option>
															<option value="Assistant Regional Director">Assistant Regional Director</option>
														</select>
													</td>
												</tr>
											</tbody>
										</table>
					        </div>
					      </div>
							</div>
						</div>
					</div>
					<div class='modal-footer'>
						<h4><b class='pull-left'>Total Amount: &#8369; <u>{{ gen_po_total }}</u></b></h4>
						<button type='submit' class='btn btn-default'>Save PO</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div id='view-po-modal' class="modal" role='dialog' tabindex='-1'>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
				<div class="modal-header">
          <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
          <h4 style="margin: 0;"><strong>PO No.</strong> &nbsp; <label id='view-po-po_no'></label></h4>
        </div>
				<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
          <div class='row'>
            <div class="col-md-12">
							<div class="box box-success">
								<div class="box-body">
									<table class='table'>
										<tr>
											<td style="width: 14%;"><label style="color: #D00D0D ">Created By:</label></td>
											<td><p id='view-po-created_by' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ">Status:</label></td>
											<td><p id='view-po-status' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Date Created:</label></td>
											<td><p id='view-po-date_created' style="text-decoration: underline;"></p></td>
										</tr>
										<tr>
											<td id='view-po-status-by' style="width: 14%;"></td>
											<td><p id='view-po-statusby' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Date Modified:</label></td>
											<td><p id='view-po-date_modified' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ;">IAR Status:</label></td>
											<td><p id='view-po-iar_status' style="text-decoration: underline;"></p></td>
										</tr>
									</table>
									<table class='table'>
										<tr>
											<td style="width: 14%;"><label style="color: #D00D0D ">Supplier:</label></td>
											<td><p id='view-po-supplier' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ">Address:</label></td>
											<td><p id='view-po-address' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ">Tin:</label></td>
											<td><p id='view-po-tin' style="text-decoration: underline;"></p></td>
										</tr>
										<tr>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Purpose:</label></td>
											<td><p id='view-po-purpose' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Mode of Procurement:</label></td>
											<td><p id='view-po-mode' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Source of funds:</label></td>
											<td><p id='view-po-source' style="text-decoration: underline;"></p></td>
										</tr>
										<tr>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Place of Delivery:</label></td>
											<td><p id='view-po-pdelivery' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Date of Delivery:</label></td>
											<td><p id='view-po-ddelivery' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Delivery Term:</label></td>
											<td><p id='view-po-dterm' style="text-decoration: underline;"></p></td>
										</tr>
										<tr>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Payment Term:</label></td>
											<td><p id='view-po-pterm' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Approved by:</label></td>
											<td><p id='view-po-signby' style="text-decoration: underline;"></p></td>
											<td style="width: 14%;"><label style="color: #D00D0D ;">Position:</label></td>
											<td><p id='view-po-sign' style="text-decoration: underline;"></p></td>
										</tr>
									</table>
								</div>
							</div>
							<div class="box box-default">
				        <div class="box-body">
						      <table class='table table-hover table-bordered table-striped'>
										<thead>
											<th style="width: 100px;">Stock No</th>
											<th style="width: 140px;">Item</th>
											<th>Desc</th>
											<th style="width: 60px;">Qty</th>
											<th style="width: 40px;">Unit Measures</th>
											<th style="width: 110px;text-align:right;">Unit Cost</th>
											<th style="width: 120px;text-align:right;">Total Cost</th>
											<th style="width: 80px;">Type</th>
										</thead>
										<tbody id='view-po-items'>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
				</div>
			</div>
		</div>
	</div>
	<div id='draft-modal' class='modal fade' role='dialog' tabindex='-1'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;"><i class='fa fa-warning text-yellow'></i> Alert</h4>
				</div>
				<div class='modal-body'>
					<h3 style='text-align: center;'>Save Purchase Order as Draft?</h3>
				</div>
				<div class='modal-footer'>
					<button class='btn btn-primary save-draft'>Yes</button>
					<button onclick='location.reload()' class='btn btn-default'>No</button>
				</div>
			</div>
		</div>
	</div>
	<div id='draft-modal-edit' class='modal fade' role='dialog' tabindex='-1'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;"><i class='fa fa-warning text-yellow'></i> Alert</h4>
				</div>
				<div class='modal-body'>
					<h3 style='text-align: center;'>Changes will not be saved... Continue ?</h3>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-primary' onclick='location.reload()'>Ok</button>
				</div>
			</div>
		</div>
	</div>
	<div id='error-po-modal' class='modal fade' role='dialog' tabindex='-1'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;"><i class='fa fa-warning text-yellow'></i> Alert</h4>
				</div>
				<div class='modal-body'>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>
				</div>
			</div>
		</div>
	</div>
</div>