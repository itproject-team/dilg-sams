<div ng-app='myApp' ng-controller='myCtrl'>
<section class="content">
		<div class="row">
			<div class="col-md-12">
              	<div class="box box-default">
	                <div class="box-header with-border">
	                  	<h3 class="box-title">Waste Material Report</h3>
	                  	<div class="box-tools pull-right">
	                   		<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                 	</div>
	                </div>
	                <div class="box-body">
	                	<div class="nav-tabs-custom">
				                <ul class="nav nav-tabs" style="margin-bottom: 20px;">
				                	<li class="active"><a href="#i-all" data-toggle="tab">All</a></li>
				                	<li><a href="#i-completed" data-toggle="tab">Completed</a></li>
				                  	<li><a href="#i-draft" data-toggle="tab">Draft</a></li>
				                  	<li style="float: right;"><button id='wmr-btn' type='button' class='btn btn-default'>Create WMR <i class='fa fa-file'></i></button></li>
				                </ul>

	                  	<div class="tab-content">
	                  				<div class="tab-pane active" id="i-all">
					                  	<table id='i-all-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>
						                  		<th>WMR No</th>
		                  						<th>Created By</th>
		                  						<th>Date Created</th>
						                  		<th>Status</th>
		                  						<th>Action</th>
						                  	</thead>
					                  	</table>
				                  	</div>
				                  	<div class="tab-pane" id="i-completed">
					                  	<table id='i-completed-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>
						                  		<th>WMR No</th>
		                  						<th>Created By</th>
		                  						<th>Date Created</th>
		                  						<th>Action</th>
						                  	</thead>
					                  	</table>
				                  	</div>
				                  	<div class="tab-pane" id="i-draft">
					                  	<table id='i-draft-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>
						                  		<th>WMR No</th>
		                  						<th>Created By</th>
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

<div id='wmr-modal' class="modal fade" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;">WMR No</h4>
				</div>
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
				<div class="modal-body">
					<table id='inventory-table' class='table table-bordered table-hover' width="100%">
						<a style="float: right;"><button id='add-disposed-btn' type='button' class='btn btn-default'>Add <i class='fa fa-plus'></i></button> </a>
					    <thead>	
							<th width="100px">Item No</th>
							<th width="100px">Quantity</th>
						    <th>Unit</th>
						    <th>Description</th>
						</thead>
						<tbody>
							<tr><td>1</td></tr>
							<tr><td>2</td></tr>
							<tr><td>3</td></tr>
							<tr><td>4</td></tr>
							<tr><td>5</td></tr>
							<tr><td>6</td></tr>
							<tr><td>7</td></tr>
							<tr><td>8</td></tr>
							<tr><td>9</td></tr>
							<tr><td>10</td></tr>

						</tbody>
					</table>
					<div class="box box-default">
					    <div class="box-body">
							<table class='table'>
								<tbody>
									<tr>
										<td>Place of Storage: <input type="textfield" class='form-control' name="po_pdelivery"></td>
										<td>Entity Name: <input type="textfield" class='form-control' name="po_pdelivery"></td>
										<td>Find Cluster: <input type="textfield" class='form-control' name="po_pdelivery"></td>
									</tr>
									<tr>
										<td>Cerified Correct: <input type="textfield" class='form-control' name="po_pdelivery"></td>
										<td>Division/Position: <input type="textfield" class='form-control' name="po_pdelivery"></td>
									</tr>
									<tr>
										<td>Disposal Approved: <input type="textfield" class='form-control' name="po_pdelivery"></td>
										<td>Division/Position: <input type="textfield" class='form-control' name="po_pdelivery"></td>
									</tr>	
								</tbody>
							</table>
							<h4 style="margin: 0;">Certificate of Inspection</h4>
							<table class='table'>
								<tbody>
									<tr>
										<td width="150px">Item: <input type="textfield" class='form-control' name="po_pdelivery"> Destroyed</td>
										<td width="150px">Item: <input type="textfield" class='form-control' name="po_pdelivery"> Sold at private sale</td>
										<td width="150px">Item: <input type="textfield" class='form-control' name="po_pdelivery"> Sold at public auction</td>
										<td width="150px">Item: <input type="textfield" class='form-control' name="po_pdelivery"></td>
										<td >&nbsp;<input type="textfield" class='form-control' name="po_pdelivery" value="Name of the Agency/Entity"> Transferred without cost to</td> 
									</tr>	
								</tbody>
								</table>
						</div>
					</div>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-success' data-dismiss='modal'>Generate</button>
				</div>
			</div>
		</div>
</div>

<div id='add-disposed-modal' class="modal fade" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;">Disposed Assets</h4>
				</div>
				<div class="modal-body">
					<table class='table'>
						<thead>
							<th>Asset No</th>
							<th>Asset</th>
							<th>Serial No / Distinction No</th>
							<th>Description</th>
							<th>Action</th>
						</thead>
					</table>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-success' data-dismiss='modal'>Ok</button>
				</div>
			</div>
		</div>
	</div>

	<style type="text/css">
		
		.modal{
		    overflow-y: auto !important;
			}

			.modal-open{
			   overflow:auto !important;
			   overflow-x:hidden !important;
			   padding-right: 0 !important;
			}

</style>