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
						<h3 class="box-title">Inspection and Acceptance Report</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs" style="margin-bottom: 20px;">
								<li class="active"><a href="#all" data-toggle="tab">All</a></li>
								<li><a href="#completed" data-toggle="tab">Completed</a></li>
								<li><a href="#incomplete" data-toggle="tab">Incomplete</a></li>
								<li style="float: right;"><button id='create-iar-btn' type='button' class='btn btn-default'>Generate IAR <i class='fa fa-file'></i></button></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="all">
									<table id='all-table' class='table table-bordered table-hover table-striped' width="100%">
										<thead>
											<th>IAR No.</th>
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
											<th>IAR No.</th>
											<th>Created By</th>
											<th>Date Created</th>
											<th>Date Modified</th>
											<th>Action</th>
										</thead>
									</table>
								</div>
								<div class="tab-pane" id="incomplete">
									<table id='incomplete-table' class='table table-bordered table-hover table-striped' width="100%">
										<thead>
											<th>IAR No.</th>
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
	<form id='save_iar' action="<?php echo base_url(); ?>gss/head/iar/save_iar" method='post'>
		<div id='create-iar' class="modal" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type='button' class='close show-draft-modal'><span aria-hidden='true'>&times; </span></button>
						<h4 style="margin: 0;"><h4 class="inline"><strong>IAR No.</strong></h4> &nbsp; <input class='form-control inline' type='text' name='iar_no' value="{{ iar_date_today }}-{{ last_iar_id }}" style='background-color: transparent; width: 50%; font-size: 18px; font-weight: bold;left:10px;' required /></h4>
						<input id='save_iar_status' type='hidden' name='iar_status' value="completed">
						<input type='hidden' name='iar_date_created' value="{{ date_today }}">
					</div>
					<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
						<div class='row'>
							<div class="col-md-4">
								Date Created:
								<div class="form-group">
									<div class='input-group date' id='datetimepicker1'>
										<input type='text' class="form-control" name="iar_date_created2" value="{{ date_today }}"/>
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
								<div class="row" style="margin-bottom: 10px;">
									<div class='col-md-1' style="padding-right: 0;">
										<label style="text-align: right; margin-top: 10px;">PO no:</label>
									</div>
									<div class='col-md-4' style="padding-left: 0;">
										<select name='po_id' class='form-control' ng-model="po_select" ng-init="po_select = null" ng-change="po_select_change()" required >
											<option value="{{ po.id }}" ng-repeat="po in po_list track by $index">{{ po.po_no }}</option>
										</select>
									</div>
								</div>
								<div class="box box-primary">
					        <div class="box-body">
							      <table class='table table-hover table-bordered table-striped'>
							        <thead>
												<th style="width: 100px;">Stock No</th>
							          <th style="width: 120px;">Item</th>
							          <th>Desc</th>
												<th style="width: 60px;"></th>
												<th style="width: 60px;">Qty</th>
												<th style="width: 110px;text-align:right;">Unit Cost</th>
												<th style="width: 120px;text-align:right;">Total Cost</th>
												<th style="width: 80px;">Type</th>
												<th style="width: 40px;">Action <input type="checkbox" id="select-all" /></th>
							        </thead>
							        <tbody>
								        <tr ng-repeat="item in selected_po_items track by $index">
													<td><input class='form-control' type='text' name='item_code[]' value='{{ item.code }}' style="border: none; background: transparent;" readonly ></td>
													<td><input class='form-control' type='text' name='item_name[]' value='{{ item.name }}' style="border: none; background: transparent;" readonly ></td>
													<td><input class='form-control' type='text' name='item_description[]' value='{{ item.description }}' style="border: none; background: transparent;" readonly ></td>
													<td><input class='form-control' type='text' name='item_dqty[]' value='0' readonly ></td>
													<td>
														<span class="inline">/</span><input class='form-control inline' type='text' name='item_qty[]' value='{{ item.qty }}' style="border: none; background: transparent;" readonly >
													</td>
								          <td>
														<div class="input-group"><span class="input-group-addon" style="border: none; background: transparent;font-size:18px;">&#8369;</span>
															<input class='form-control text-right' type='text' name='item_unit_cost[]' value='{{ item.unit_cost }}' style="padding:0;border: none; background: transparent;" readonly >
														</div>
													</td>
													<td>
														<div class="input-group"><span class="input-group-addon" style="border: none; background: transparent;font-size:18px;">&#8369;</span>
															<input class='form-control text-right' type='text' name='item_total[]' value='{{ item.total_cost }}' style="padding:0;border: none; background: transparent;" readonly >
														</div>
													</td>
								          <td>
														<input class='form-control' type='text' name='item_type[]' value='{{ item.item_type }}' style="border: none; background: transparent;" readonly >
													</td>
													<td>
														<input class='item-delivered' type="checkbox" name='item_delivered[]' />
														<input type="hidden" name="supply_id[]" value="{{ item.id }}">
													</td>
												</tr>
								      </tbody>
							      </table>
					        </div>
					      </div>
								<div class="box box-default">
									<div class="box-body">
										<h4><b>Assets</b></h4>
										<table class='table table-hover table-bordered table-striped'>
											<thead>
												<th style="width: 160px;">Name</th>
												<th style="width: 160px;">Desc</th>
												<th style="width: 100px;">Unit Cost</th>
												<th style="width: 160px;">Serial No / Distinction No</th>
											</thead>
											<tbody>
												<tr ng-repeat='asset in selected_po_items_assets track by $index'>
													<td><input class='form-control' type="text" name="asset_name[]" value="{{ asset.name }}" style='border: none; background-color: transparent;'></td>
													<td><input class='form-control' type="text" name="asset_description[]" value="{{ asset.description }}" style='border: none; background-color: transparent;'></td>
													<td><input class='form-control' type="text" name="asset_unit_cost[]" value="{{ asset.unit_cost }}" style='border: none; background-color: transparent;'></td>
													<td>
														<input class="input form-control" id="iar-asset-distinction-no" name="distinct_number[]" type="text"/>
														<input type="hidden" name="asset_id[]" value="{{ asset.id }}">
													</td>
												</tr>
											</tbody>
										</table>
									 </div>
								</div>
								<!-- Additonal Items -->
								<!-- End of Additonal Items -->
					        <div class="box box-default">
										<div class="box-body">
											<table class='table table-hover table-bordered table-striped'>
												<thead>
													<th>Additional Information</th>
												</thead>
												<tbody>
													<tr>
														<td width="280px">Inspected By:<input type="textfield" class='form-control' name="iar_inspected_by"></td>
														<td width="280px">Position:<input type="textfield" class='form-control' name="iar_inspected_position"></td>
														<td>Requisitioning Office/Dept: <input type="textfield" class='form-control' name="iar_requisitioning"></td>
													</tr>
													<tr>
														<td>Accepted By:<input type="textfield" class='form-control' name="iar_accepted_by"></td>
														<td>Position:<input type="textfield" class='form-control' name="iar_accepted_position"></td>
														<td>Invoice No: <input type="textfield" class='form-control' name="iar_invoice_no"></td>
													</tr>
													<tr>    
													</tr>
													<tr>
														<td>Date Received: 
															<div class='input-group date' id='datetimepicker1'>
																<input type='text' class="form-control" name="iar_date_received" value=""/>
																<span class="input-group-addon">
																	<span class="glyphicon glyphicon-calendar"></span>
																</span>
															</div>
														</td>
														<td>Date Inspected: 
															<div class='input-group date' id='datetimepicker1'>
																<input type='text' class="form-control" name="iar_date_inspected" value=""/>
																<span class="input-group-addon">
																	<span class="glyphicon glyphicon-calendar"></span>
																</span>
															</div>
														</td>
														<td>Responsibility Center Code: 
																<input type="textfield" class='form-control' name="iar_responsibility_code">
														</td>
													</tr>
													<tr>
														<td>Entity Naming: <input type="textfield" class='form-control' name="iar_entity_naming" ></td>
														<td>Fund Cluster: <input type="textfield" class='form-control' name="iar_fund_cluster" ></td>
													</tr>
												</tbody>
											</table>
										</div>
								</div>
							</div>
						</div>
					</div>
					<div class='modal-footer'>
						<h4>
							<b class='pull-left'>Total Amount: &#8369; <u>{{ gen_total }}</u></b>
							<button type='submit' class='btn btn-default'>Generate IAR</button>
						</h4>
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
                    <h4 style="margin: 0;"><strong>IAR No.</strong> &nbsp; <label id='view-po-iar_no'></label></h4>
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
                                        </tr>
                                    </table>
                                    <table class='table'>
                                        <tr>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Inspected By:</label></td>
                                            <td><p id='view-iar-inspected_by' style="text-decoration: underline;"></p></td>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Position:</label></td>
                                            <td><p id='view-iar-inspected_position' style="text-decoration: underline;"></p></td>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Requisitioning Office/Dept:</label></td>
                                            <td><p id='view-iar-requisitioning' style="text-decoration: underline;"></p></td>
                                            
                                        </tr>
																				<tr>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Accepted By:</label></td>
                                            <td><p id='view-iar-accepted_by' style="text-decoration: underline;"></p></td>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Position:</label></td>
                                            <td><p id='view-iar-accepted_position' style="text-decoration: underline;"></p></td>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Invoice No:</label></td>
                                            <td><p id='view-iar-invoice_no' style="text-decoration: underline;"></p></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Date Received:</label></td>
                                            <td><p id='view-iar-date_received' style="text-decoration: underline;"></p></td>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Date Inspected:</label></td>
                                            <td><p id='view-iar-date_inspected' style="text-decoration: underline;"></p></td>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Responsibility Center Code:</label></td>
                                            <td><p id='view-iar-responsibility_code' style="text-decoration: underline;"></p></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Entity Naming:</label></td>
                                            <td><p id='view-iar-entity_naming' style="text-decoration: underline;"></p></td>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Fund Cluster:</label></td>
                                            <td><p id='view-iar-fund_cluster' style="text-decoration: underline;"></p></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="box box-default">
                                <div class="box-body" style="overflow: auto;">
                                    <table class='table table-hover table-bordered table-striped' style="width: 1200px;">
                                        <thead>
                                            <th style="width: 100px;">Stock No / Distinction No</th>
                                            <th style="width: 140px;">Item</th>
                                            <th>Desc</th>
                                            <th style="width: 120px;">Type</th>
                                            <th style="width: 60px;"></th>
                                            <th style="width: 60px;">Qty</th>
                                            <th style="width: 110px;text-align:right;">Unit Cost</th>
                                            <th style="width: 120px;text-align:right;">Total Cost</th>
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
	<form id='edit-iar' action="<?php echo base_url(); ?>gss/head/iar/edit_iar" method='post'>
		<div id='edit-iar-modal' class="modal" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type='button' class='close draft-modal-edit'><span aria-hidden='true'>&times; </span></button>
						<h4 style="margin: 0;"><h4 class="inline"><strong>IAR No.</strong></h4> &nbsp; <input class='form-control inline' type='text' name='iar_no' style='width: 50%; font-size: 18px; font-weight: bold;left:10px;'></h4>
						<input id='save_iar_status' type='hidden' name='iar_status' value="completed">
						<input type='hidden' name='iar_date_created' value="{{ date_today }}">
					</div>
					<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
						<div class='row'>
							<div class="col-md-12">
								<div class="row" style="margin-bottom: 10px;">
									<div class='col-md-1' style="padding-right: 0;">
										<label style="text-align: right; margin-top: 10px;">PO no:</label>
									</div>
									<div class='col-md-4' style="padding-left: 0;">
										<input type="text" name='edit_po_id' class='form-control' readonly />
									</div>
								</div>
								<table class='table'>
									<tr>
										<td style="width: 14%;"><label style="color: #D00D0D">Status:</label></td>
										<td><p id='edit-iar-status' style="text-decoration: underline;"></p></td>
										<td style="width: 14%;"><label style="color: #D00D0D">Created By:</label></td>
										<td><p id='edit-iar-created-by' style="text-decoration: underline;"></p></td>
									</tr>
								</table>
								<div class="box box-primary">
					                <div class="box-body" style="overflow: auto;">
							            <table class='table table-hover table-bordered table-striped' style="width: 1200px;">
							            	<thead>
												<th style="width: 120px;">Stock No</th>
							            		<th style="width: 140px;">Item</th>
							            		<th>Desc</th>
												<th style="width: 120px;"></th>
												<th style="width: 120px;">Qty</th>
							            		<th style="width: 110px;text-align:right;">Unit Cost</th>
							            		<th style="width: 120px;text-align:right;">Total Cost</th>
							            		<th style="width: 120px;">Type</th>
												<th style="width: 40px;">Action <input type="checkbox" id="select-all-edit" /></th>
							            	</thead>
							            	<tbody id="edit-iar-items">
								           	</tbody>
							            </table>
					                </div>
					            </div>
								
								<div class="box box-default">
									<div class="box-body">
										<h4><b>Assets</b></h4>
										<table class='table table-hover table-bordered table-striped'>
											<thead>
												<th style="width: 160px;">Name</th>
												<th style="width: 160px;">Desc</th>
												<th style="width: 100px;">Unit Cost</th>
												<th style="width: 160px;">Serial No / Distinction No</th>
											</thead>
											<tbody id="eit-iar-items-asset">
											</tbody>
										</table>
									 </div>
								</div>
								
								<div class="box box-danger">
					                <div class="box-body">
					                	<h4>Additional Information</h4>
										Date Created:
										<div class="form-group">
											<div class='input-group date' id='datetimepicker1'>
												<input type='text' class="form-control" name="edit_iar_date_created2" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
					                </div>
					            </div>
							</div>
						</div>
					</div>

					

					<div class='modal-footer'>
					<h4><b class='pull-left'>Total Amount: &#8369; <u>{{ gen_total }}</u></b></h4></b><button type='submit' class='btn btn-default'>Save IAR</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<div id='draft-modal' class='modal fade' role='dialog' tabindex='-1'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;"><i class='fa fa-warning text-yellow'></i> Alert</h4>
				</div>
				<div class='modal-body'>
					<h3 style='text-align: center;'>Save Inspection and Acceptance Report as Draft</h3>
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