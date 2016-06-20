<input type='hidden' id="base_url" value="<?php  echo base_url(); ?>" /> 
<div ng-app='myApp' ng-controller='myCtrl'>
<section class="content">
		<div ng-view class="row">
			<div class="col-md-12">
              	<div class="box box-default">
	                <div class="box-header with-border">
	                  	<h3 class="box-title">Property Card</h3>
	                  	<div class="box-tools pull-right">
	                   		<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                 	</div>
	                </div>
	                <div class="box-body">
	                  	<table id='pc-table' class='table table-bordered table-hover table-striped' width="100%">
	                  		<thead>
		                  		<th>Asset No</th>
		                  		<th>Employee</th>
		                  		<th>Status</th>		                  		
		                  		<th>Date Created</th>
		                  		<th>Date Modified</th>
		                  		<th>Modified By</th>
		                  		<th>Action</th>
		                  	</thead>
	                  	</table>
	                </div>
	            </div>
           	</div>
		</div>
</section>

	<div id='view-pc-modal' class="modal fade" role='dialog' tabindex='-1'>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;"><strong>Asset No.</strong> &nbsp;<input ng-model='asset_no' id="view-pc-pc_no" name="view-pc-pc_no"  value ="a" class='form-control inline' type='text' style='background-color: transparent; border: none; width: 50%; font-size: 18px; font-weight: bold;' readonly></h4>
				</div>
				<div class="modal-body">
					<table>
						<tr>
							<td style="width: 10%;"><label style="color: #D00D0D;">Asset:</label></td>
							<td><p id="view-pc-asset-name" name="pc-asset-name" style="text-decoration: underline;"></p></td>
							<td style="width: 12%;"><label style="color: #D00D0D;">Created By:</label></td>
				            <td><p id='user' style="text-decoration: underline;"></p></td>
						</tr>
					</table>
					<table id='view-pc-table' class='table table-hover table-bordered table-striped'>		
		            	<thead>
		            		<th>Date Issued</th>
		            		<th>Employee</th>
		            		<th>Status</th>	
		            		<th>Remarks</th>						            		
		            	</thead>
		            	<tbody inventory-item>
		            	<tr input ng-repeat="pc in view_pc_list track by $index">
							<td>{{ pc[0].date_created }}</td>
							<td>{{ pc[0].employee }}</td>
							<td>{{ pc[0].status }}</td>
							<td>{{ pc[0].remarks }}</td>
						</tr>
		            		<!-- <tr>
		            			<td><input ng-repeat="item in view_pc_list track by $index" class='form-control' type='text' id='view-pc-date-created' name='pc-date-created' value='{{ item.date_created }}' style="border: none; background: transparent;" readonly ></td>
		            			<td><input ng-repeat="item in view_pc_list track by $index" class='form-control' type='text' id='view-pc-employee' name='pc-employee' value='{{ item.employee }}' style="border: 1px; background: transparent;" readonly></td>
		            			<td><input ng-repeat="item in view_pc_list track by $index" class='form-control' type='text' id='view-pc-status' name='pc-status'value='{{ item.status }}' style="border: 1px; background: transparent;" readonly></td>
		            			<td><input ng-repeat="item in view_pc_list track by $index" class='form-control' type='text' id='view-pc-remarks' name='pc-remarks'value='{{ item.remarks }}' style="border: 1px; background: transparent;" readonly></td>
		            		</tr> -->
			           	</tbody>
		            </table>
       				<table id="parts" class='table table-hover table-bordered table-striped'>		
		            	<thead>
		            		<th>Part</th>
		            		<th>Description</th>
		            		<th>Status</th>		
		            		<th>Remarks</th>					            		
		            	</thead>
		            	<tbody>
		            		<tr>
		            			<td><input id="view-pc-asset-part" name="pc-asset-part" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
		            			<td><input id="view-pc-asset-desc" name="pc-asset-desc" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
		            			<td><input id="view-pc-status-part" name="pc-status-part" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
		            			<td><input id="view-pc-remarks-part" name="pc-remarks-part" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
		            		</tr>
			           	</tbody>
		            </table>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
				</div>
			</div>
		</div>
	</div>

	<form id='update_pc' action="<?php echo base_url(); ?>gss/head/pc/update_pc" method='post'>
		<div id='update-pc-modal' class="modal fade" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
						<h4 style="margin: 0;"><strong>Asset No.</strong> &nbsp;<input id="update-pc_no" name="update-pc_no" class='form-control inline' type='text' style='background-color: transparent; border: none; width: 50%; font-size: 18px; font-weight: bold;' readonly></h4>
					</div>
					<div class="modal-body">
						<table>
							<tr>
								<td style="width: 10%;"><label style="color: #D00D0D;">Asset:</label></td>
								<td><p id="update-pc-asset-name" name="update-pc-asset-name" style="text-decoration: underline;"></p></td>
								<td style="width: 12%;"><label style="color: #D00D0D;">Created By:</label></td>
					            <td><p id='update-user' name="update-user" style="text-decoration: underline;"></p></td>
							</tr>
						</table>
						<table class='table table-hover table-bordered table-striped'>		
			            	<thead>
			            		<th width='150'>Date Issued</th>
			            		<th width='180'>Employee</th>
			            		<th width='180'>Status</th>	
			            		<th width='230'>Remarks</th>	
			            		<th width='25'> </th>			            		
			            	</thead>
			            	<tbody>
			            		<tr>
			            			<td><input id="update-pc-date-created" name="update-pc-date-created" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
			            			<td><input id="update-pc-employee" name="update-pc-employee" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
			            			<td><input id="current-pc-status" name="current-pc-status" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
			            			<td><input id="current-pc-remarks" name="current-pc-remarks" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
			            			<td></td>
			            		</tr>
			            		<input type="hidden" name="count" value="1" />
								<tr id="field1">
									<input class='form-control' type='hidden' name='pc_id[]'>
									<td>
										<input autocomplete="off" class="input form-control" id="pc_date[]" name="pc_date[]" type="text" data-items="8"/>
									</td>
									<td>
										<input autocomplete="off" class="input form-control" id="pc_employee[]" name='pc_employee[]' type="text" data-items="8"/>
									</td>
									<td>
										<select class='form-control' name='update-pc-status' id="update-pc-status">
											<option value="Serviceable">Serviceable</option>
											<option value="Transferred">Transferred</option>
											<option value="Under Repair">Under Repair</option>
											<option value="Unserviceable">Unserviceable</option>
											<option value="Disposed">Disposed</option>
										</select>
									</td>
									<td>
										<input autocomplete="off" class="input form-control" id="pc_remarks[]" name='pc_remarks[]' type="text" data-items="8"/>
									</td>
									<td>
										<button id="add-asset-row" class="btn add-asset-row pull-right" type="button">+</button>
									</td>
								</tr>
				           	</tbody>
			            </table>
	       				<table id="parts" class='table table-hover table-bordered table-striped'>		
			            	<thead>
			            		<th width='150'>Part</th>
			            		<th width='180'>Description</th>
			            		<th width='180'>Status</th>	
			            		<th width='230'>Remarks</th>	
			            		<th width='25'></th>					            		
			            	</thead>
			            	<tbody>
			            		<tr>
			            			<td><input id="update-pc-asset-part" name="update-pc-asset-part" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
			            			<td><input id="update-pc-asset-desc" name="update-pc-asset-desc" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
			            			<td><input id="update-pc-status" name="current-pc-status" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
			            			
			            			<td><input id="current-pc-remarks-part" name="current-pc-remarks-part" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
			            			<td></td>
			            		</tr>
			            		<input type="hidden" name="count" value="1" />
								<tr id="field1">
									<input class='form-control' type='hidden' name='pc_part_id[]' value='0'>
									<td>
										<input autocomplete="off" class="input form-control" id="pc_part_date[]" name="pc_part_date[]" type="text" data-items="8"/>
									</td>
									<td>
										<input autocomplete="off" class="input form-control" id="pc_part_employee[]" name='pc_part_employee[]' type="text" data-items="8"/>
									</td>
									<td>
										<select class='form-control' name='update-pc-part-status' id="update-pc-part-status">
											<option value="Serviceable">Serviceable</option>
											<option value="Transferred">Transferred</option>
											<option value="Under Repair">Under Repair</option>
											<option value="Unserviceable">Unserviceable</option>
											<option value="Disposed">Disposed</option>
										</select>
									</td>
									<td>
										<input autocomplete="off" class="input form-control" id="pc_part_remarks[]" name='pc_part_remarks[]' type="text" data-items="8"/>
									</td>
									<td>
										<button id="add-asset-row" class="btn add-asset-row pull-right" type="button">+</button>
									</td>
								</tr>
			            	</tbody>
			            </table>
					</div>
					<div class='modal-footer'>
						<button type='submit' class='btn btn-default'>Save</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

</div>

