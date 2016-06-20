<input type='hidden' id="base_url" value="<?php  echo base_url(); ?>" /> 
<div>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
              	<div class="box box-default">
	           

					<div class="box-header with-border">
	                  	<h3 class="box-title">Requisition Issue Slip (User)</h3>
	                </div>
						<div class="box-body">
				            <div class="nav-tabs-custom">
				                <ul class="nav nav-tabs" style="margin-bottom: 20px;">
				                	<li class="active"><a href="#user-all" data-toggle="tab">All</a></li>
				                  	<li><a href="#user-completed" data-toggle="tab">Completed</a></li>
				                  	<li><a href="#user-incomplete" data-toggle="tab">Incomplete</a></li>
				                  	<li><a href="#user-confirmed" data-toggle="tab">Confirmed</a></li>
				                  	<li><a href="#user-pending" data-toggle="tab">Pending</a></li>
				                  	<li><a href="#user-draft" data-toggle="tab">Draft</a></li>
				                  	<li><a href="#user-cancelled" data-toggle="tab">Cancelled</a></li>
				                  	<li><a href="#user-rejected" data-toggle="tab">Rejected</a></li>
				                 	<li style="float: right;"><button id='create-ris-btn' type='button' class='btn btn-default'>Create RIS <i class='fa fa-file'></i></button></li>
				                </ul>
	                	
	                  			<div class="tab-content">
	                  				<div class="tab-pane active" id="user-all">
					                  	<table id='user-all-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>
						                  		<th>RIS No</th>
						                  		<th>Status</th>
						                  		<th>Date Created</th>
						                  		<th>Action</th>
						                  	</thead>
					                  	</table>
				                  	</div>
	                  				<div class="tab-pane" id="user-completed">
					                  	<table id='user-completed-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>
						                  		<th>RIS No</th>
						                  		<th>Status</th>
						                  		<th>Date Created</th>
						                  		<th>Action</th>
						                  	</thead>
					                  	</table>
				                  	</div>
				                  	<div class="tab-pane" id="user-incomplete">
					                  	<table id='user-incomplete-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>
						                  		<th>RIS No</th>
						                  		<th>Status</th>
						                  		<th>Date Created</th>
						                  		<th>Action</th>
						                  	</thead>
					                  	</table>
				                  	</div>
				                  	<div class="tab-pane" id="user-confirmed">
				                    	<table id='user-confirmed-table' class='table table-bordered table-hover table-striped' width="100%">
				                    		<thead>
						                  		<th>RIS No</th>
						                  		<th>Status</th>
						                  		<th>Date Created</th>
						                  		<th>Action</th>
						                  	</thead>
					                  	</table>
				                 	</div>
				                  	<div class="tab-pane" id="user-pending">
					                  	<table id='user-pending-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>
						                  		<th>RIS No</th>
						                  		<th>Status</th>
						                  		<th>Date Created</th>
						                  		<th>Action</th>
						                  	</thead>
					                  	</table>
				                  	</div>
				                  	<div class="tab-pane" id="user-draft">
				                    	<table id='user-draft-table' class='table table-bordered table-hover table-striped' width="100%">
				                    		<thead>
						                  		<th>RIS No</th>
						                  		<th>Status</th>
						                  		<th>Date Created</th>
						                  		<th>Action</th>
						                  	</thead>
					                  	</table>
				                 	</div>
				                 	<div class="tab-pane" id="user-cancelled">
				                    	<table id='user-cancelled-table' class='table table-bordered table-hover table-striped' width="100%">
				                    		<thead>
						                  		<th>RIS No</th>
						                  		<th>Status</th>
						                  		<th>Date Created</th>
						                  		<th>Action</th>
						                  	</thead>
					                  	</table>
				                 	</div>
				                  	<div class="tab-pane" id="user-rejected">
				                    	<table id='user-rejected-table' class='table table-bordered table-hover table-striped' width="100%">
				                    		<thead>
						                  		<th>RIS No</th>
						                  		<th>Status</th>
						                  		<th>Date Created</th>
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

	<form id='save_ris' action="<?php echo base_url(); ?>accounting/head/ris/save_ris" method='post'>
		<div id='create-ris-modal' class="modal" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type='button' class='close close-create-ris-modal'><span aria-hidden='true'>&times; </span></button>
						<h4 style="margin: 0;"><input class='form-control' type='text' name='ris_no'></h4>
						<input id='save_sai_status' type='hidden' name='sai_status' value="pending">
						<input type='hidden' name='sai_date_created' value="{{ date_today }}">
					</div>
					<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
						<div class='row'>
							<div class="col-md-6">
								<div class="box box-primary">
									<div class="box-body">
										<h4 style='background-color: transparent; border: none; width: 50%; font-size: 18px; font-weight: bold;'> PPMP</h4>
										<table id='ppmp-table' class='table table-hover table-bordered table-striped'>
											<thead>
												<th>Code</th>
												<th>Item</th>
												<th>Description</th>
												<th>Qty</th>
												<th>Action</th>
											</thead>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="box box-success">
									<div class="box-body">
										<h4 style='background-color: transparent; border: none; width: 50%; font-size: 18px;font-weight: bold;'> RIS </h4>
										<table id='modal-ris-table' class='table table-hover table-bordered table-striped'>
											<thead>
												<th>Code</th>
												<th>Item</th>
												<th>Description</th>
												<th>Qty</th>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class='modal-footer'>
						<button type='submit' class='btn btn-default'>Generate RIS</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<div id='inventory-item-modal' class="modal" role='dialog' tabindex='-1'>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;">Inventory</h4>
				</div>
				<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
					<div class='row'>
						<div class="col-md-12">
							<div class="box box-default">
				                <div class="box-body">
						            <table class='table table-hover table-bordered table-striped'>
						            	<thead>
						            		<th>Item</th>
						            		<th>Desc</th>
						            		<th>Qty</th>
						            		<th style="width: 72px;">Unit cost</th>
						            		<th style="width: 20px;">Type</th>
						            		<th style="width: 20px;">Action</th>
						            	</thead>
						            	<tbody inventory-item>
							           	</tbody>
						            </table>
				                </div>
				            </div>
						</div>
					</div>
				</div>
				<div class='modal-footer'>
					<button class='btn btn-default' data-dismiss='modal'>Ok</button>
				</div>
			</div>
		</div>
	</div>
	<div id='view-sai-modal' class="modal" role='dialog' tabindex='-1'>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;"><label id='view-sai-sai_no'></label></h4>
				</div>
				<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
					<div class='row'>
						<div class="col-md-6">
				            <div class="box box-default">
				                <div class="box-body">
				                	<table class='table'>
				                		<tr>
				                			<td style="width: 12%;"><label style="color: #D00D0D;">Date Created:</label></td>
				                			<td><p id='view-sai-date_created' style="text-decoration: underline;"></p></td>
				                			<td style="width: 7%;"><label style="color: #D00D0D">Status:</label></td>
				                			<td><p id='view-sai-status' style="text-decoration: underline;"></p></td>
				                		</tr>
				                	</table>
						            <table class='table table-hover table-bordered table-striped'>
						            	<thead>
						            		<th>Item</th>
						            		<th>Description</th>
						            		<th>Type</th>
						            		<th style="width: 80px;">Qty</th>
						            		<th style="width: 80px;">Unit Cost</th>
						            		<th style="width: 150px;">Total Cost</th>
						            	</thead>
						            	<tbody id='view-sai-items'>
							           	</tbody>
						            </table>
				                </div>
				            </div>
				        </div>
				        <div class="col-md-6">
				            <div class="box box-default">
				                <div class="box-body">
				                	<table class='table'>
				                		<tr>
				                			<td style="width: 12%;"><label style="color: #D00D0D;">Date Created:</label></td>
				                			<td><p id='view-sai-date_created' style="text-decoration: underline;"></p></td>
				                			<td style="width: 7%;"><label style="color: #D00D0D">Status:</label></td>
				                			<td><p id='view-sai-status' style="text-decoration: underline;"></p></td>
				                		</tr>
				                	</table>
						            <table class='table table-hover table-bordered table-striped'>
						            	<thead>
						            		<th>Item</th>
						            		<th>Description</th>
						            		<th>Type</th>
						            		<th style="width: 80px;">Qty</th>
						            		<th style="width: 80px;">Unit Cost</th>
						            		<th style="width: 150px;">Total Cost</th>
						            	</thead>
						            	<tbody id='view-sai-items'>
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
	<form id='save_dispense' action="<?php echo base_url(); ?>accounting/head/ris/save_dispense" method='post'>
		<div id='dispense-modal' class="modal" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type='button' class='close close-dispense-modal' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
						<h4 class='modal-title'><input class='form-control' type='text' name='ris_no' style='border: none; background-color: transparent; font-size: 18px; font-weight: bold;' readonly></h4>

						<input type='hidden' name='ris_id'>
					</div>
					<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
						<div class='row'>
							<div class="col-md-12">
								<div class="box box-primary">
									<div class="box-body">
										<table class='table table-hover table-bordered table-striped'>
											<thead>
												<th>Item</th>
												<th>Description</th>
												<th>Qty</th>
												<th>Action &nbsp; <label><input type="checkbox" name='all_qty' value=""></label></th>
											</thead>
											<tbody>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					
					</div>
					<div class='modal-footer'>
						<button type='submit' class='btn btn-default'>Dispense</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<form id='update_dispense' action="<?php echo base_url(); ?>accounting/head/ris/update_dispense" method='post'>
		<div id='edit-dispense-modal' class="modal" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type='button' class='close close-edit-dispense-modal' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
						<h4 class='modal-title'><input class='form-control' type='text' name='ris_no' style='border: none; background-color: transparent; font-size: 18px; font-weight: bold;' readonly></h4>

						<input type='hidden' name='ris_id'>
					</div>
					<div class="modal-body" style="max-height: 480px; overflow-y: auto;">
						<div class='row'>
							<div class="col-md-12">
								<div class="box box-primary">
									<div class="box-body">
										<table class='table table-hover table-bordered table-striped'>
											<thead>
												<th>Item</th>
												<th>Description</th>
												<th>Qty</th>
												<th>Action &nbsp; <label><input type="checkbox" name='all_qty' value=""></label></th>
											</thead>
											<tbody>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					
					</div>
					<div class='modal-footer'>
						<button type='submit' class='btn btn-default'>Dispense</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	
	<div id='view-user-modal' class="modal fade" role='dialog' tabindex='-1'>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 id='view-user-ris-no'></h4>
				</div>
				<div class="modal-body">
					<div class='row'>
						<div class='col-md-12'>
							<table class='table table-bordered table-hover table-striped'>
								<thead>
									<th><label>RIS No</label></th>
									<th><label>Status</label></th>
									<th><label>Date Created</label></th>
									<th><label>Date Modified</label></th>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class='col-md-12'>
							<label class='alert alert-info' role='alert' style="width: 100%; font-size: 18px; text-align: center;">ITEMS</label>
							<table class='table table-hover table-bordered table-striped' width='100%'>
								<thead>
									<th>Item</th>
									<th>Description</th>
									<th>Qty</th>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
				<div class='modal-footer'>
					<button type='button' data-dismiss='modal' class='btn btn-default'>Ok</button>
				</div>
			</div>
		</div>
	</div>
</div>