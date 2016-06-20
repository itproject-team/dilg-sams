<input type='hidden' id="base_url" value="<?php  echo base_url(); ?>" /> 
<div ng-app='myApp' ng-controller='myCtrl'>
<section class="content">
		<div class="row">
			<div class="col-md-12">
              	<div class="box box-default">
	                <div class="box-header with-border">
	                  	<h3 class="box-title">My Assets</h3>
	                  	<div class="box-tools pull-right">
	                   		<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                 	</div>
	                </div>
	                <div class="box-body">
	                	<div class="nav-tabs-custom">
	                		<div class="nav-tabs-custom">

	                	 <div class="tab-content">
				                  	<div class="tab-pane active" id="pending">
				                  	<input type='hidden' name='user' value="<?php echo $this->session->userdata('user_full_name'); ?>">
					                  	<table id='asset-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>
						                  		<th>Asset</th>
						                  		<th>Description</th>
						                  		<th>Status</th>
						                  		<th>Action</th>
						                  	</thead>
					                  	</table>
				                  	</div>
				                </div>
			              	
		                </div>
		            </div>
	           	</div>
			</div>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
              	<div class="box box-default">
	                <div class="box-header with-border">
	                  	<h3 class="box-title">My Assets in Queue</h3>
	                  	<div class="box-tools pull-right">
	                   		<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                 	</div>
	                </div>
	                <div class="box-body">
	                	<div class="nav-tabs-custom">
	                		<div class="nav-tabs-custom">

	                	 <div class="tab-content">
				                  	<div class="tab-pane active" id="pending">
					                  	<table id='action-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>
						                  		<th>Asset</th>
						                  		<th>Description</th>
						                  		<th>Status</th>
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
			</div>
	</section>

<div id='view-asset-modal' class="modal fade" role='dialog' tabindex='-1'>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;"><input value="Asset No.  " id="view-asset-no" name="view-asset-no" class='form-control' type='text' style='background-color: transparent; border: none; width: 50%; font-size: 18px; font-weight: bold;' readonly></h4>
				</div>
				<div class="modal-body">
					<table class='table table-hover table-bordered table-striped'>		
		            	<thead>
		            		<th>Asset</th>
		            		<th>Date Issued</th>
		            		<th>Status</th>						            		
		            	</thead>
		            	<tbody>
		            		<tr>
		            			<td><input id="view-asset-name" name="view-asset-name" lass='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
		            			<td><input id="view-asset-date-issued" name="asset-date-issued" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
		            			<td><input id="view-asset-status" name="view-asset-status" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
		            		</tr>
			           	</tbody>
		            </table>
       				<table id="parts" class='table table-hover table-bordered table-striped'>		
		            	<thead>
		            		<th>Part</th>
		            		<th>Description</th>
		            		<th>Status</th>						            		
		            	</thead>
		            	<tbody>
		            		<tr>
		            			<td><input id="view-asset-part" name="view-asset-part" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
		            			<td><input id="view-asset-desc" name="view-asset-desc" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
		            			<td><input id="view-asset-status-part" name="view-asset-status-part" class='form-control' type='text' style="border: 1px; background: transparent;" readonly></td>
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

<div id='transfer-modal' class="modal fade" role='dialog' tabindex='-1'>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
				<h4 style="margin: 0;">Invoice Receipt of Property</h4>
			</div>
			<div class="modal-body">
				<form>
					Invoice No:
					<br><br>
					PPE No:
					<br><br>
					Asset:
					<br><br>
					Description:
					<br><br>
					Date:
					<br><br>


					From: <input type="text" size="35" value="Employee 1"> 
					
					To: 
					<select>
						  <option>GSS</option>
						  <option>IT</option>
						  <option>Accounting</option>
						</select>

					<select>
						  <option>Employee 2</option>
						  <option>Employee 3</option>
						  <option>Employee 4</option>
						</select>
					
				</form>
			</div>
			<div class='modal-footer'>
				<button class='btn btn-default'>Generate Invoice</button>
			</div>
		</div>
	</div>
</div>


<div id='repair-modal' class="modal fade" role='dialog' tabindex='-1'>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
				<h4 style="margin: 0;">Office Equipment Job or Work Order</h4>
			</div>
			<div class="modal-body">
				<form>
					OEJ/WO No:
					<br><br>
					PPE No:
					<br><br>
					Asset:
					<br><br>
					Description:
					<br><br>
					Date:
					<br><br>
					Reason: <br>
					<textarea rows="2" cols="110">
							
							</textarea>					
				</form>
			</div>
			<div class='modal-footer'>
				<button class='btn btn-default'>Generate OEJ/WO</button>
			</div>
		</div>
	</div>
</div>



</div>