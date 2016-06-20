<input type='hidden' id="base_url" value="<?php  echo base_url(); ?>" /> 
<div ng-app='myApp' ng-controller='myCtrl'>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
	          	<div class="box box-default">
	                <div class="box-header with-border">
	                  	<h3 class="box-title">Inventory - Supply</h3>
	                  	<div class="box-tools pull-right">
	                   		<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                 	</div>
	                </div>

	                 <div class="box-body">
	                  	<div class="nav-tabs-custom">
				                <ul class="nav nav-tabs" style="margin-bottom: 20px;">
				                  	<li class="active"><a href="#inventory" data-toggle="tab">All</a></li>
				                  	<li><a href="#gss" data-toggle="tab">GSS</a></li>
				                  	<li><a href="#acc" data-toggle="tab">Accounting</a></li>
				                  	<li><a href="#it" data-toggle="tab">IT</a></li>
				                </ul>
	                	
	                  	<div class="tab-content">
				                  	<div class="tab-pane active" id="inventory">
				                  		<div class='row'>
	                  					<table class='table'>
					                  		<a style="float: right; padding-left: 6px;  padding-right: 15px;"><button id='generate-purchase-btn' type='button' class='btn btn-default'>Generate Purchase Report <i class='fa fa-file'></i></button></a>
					                  	 	<a style="float: right;"><button id='generate-balance-btn' type='button' class='btn btn-default'>Generate Balance Report <i class='fa fa-file'></i></button></a>
					                  	</table>
	                  					</div>
					                  	<table id='inventory-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>	
												<th>Stock No</th>
												<th>Item</th>
						                  		<th>Description</th>
						                  		<th>Qty</th>
						                  		<th>Actions</th>
						                  	</thead>
					                  	</table>
				                  	</div>
				                  	<div class="tab-pane" id="gss">
				                  		<table class='table'>
					                  		<a style="float: right; padding-left: 6px;  padding-right: 15px;"><button id='generate-rsmi-btn' type='button' class='btn btn-default'>Generate RSMI <i class='fa fa-file'></i></button></a>
					                  	</table>
				                    	<table id='gss-table' class='table table-bordered table-hover table-striped' width="100%">
				                    		<thead>
												<th>Stock No</th>
						                  		<th>Item</th>
		                  						<th>Description</th>
		                  						<th>Qty</th>
						                  	</thead>
					                  	</table>
				                 	</div>
				                  	<div class="tab-pane" id="acc">
				                  		<table class='table'>
					                  		<a style="float: right; padding-left: 6px;  padding-right: 15px;"><button id='generate-rsmi-btn' type='button' class='btn btn-default'>Generate RSMI <i class='fa fa-file'></i></button></a>
					                  	</table>
				                    	<table id='accounting-table' class='table table-bordered table-hover table-striped' width="100%">
				                    		<thead>
												<th>Stock No</th>
						                  		<th>Item</th>
		                  						<th>Description</th>
		                  						<th>Qty</th>
						                  	</thead>
					                  	</table>
				                  	</div>
				                  	<div class="tab-pane" id="it">
				                  		<table class='table'>
					                  		<a style="float: right; padding-left: 6px;  padding-right: 15px;"><button id='generate-rsmi-btn' type='button' class='btn btn-default'>Generate RSMI <i class='fa fa-file'></i></button></a>
					                  	</table>
				                    	<table id='it-table' class='table table-bordered table-hover table-striped' width="100%">
				                    		<thead>
												<th>Stock No</th>
						                  		<th>Item</th>
		                  						<th>Description</th>
		                  						<th>Qty</th>
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
</div>

<section class="content">
		<div class="row">
			<div class="col-md-12">
	          	<div class="box box-default">
	                <div class="box-header with-border">
	                  	<h3 class="box-title">Inventory - Asset</h3>
	                  	<div class="box-tools pull-right">
	                   		<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                 	</div>
	                </div>

	                 <div class="box-body">    	
	                  	<div class="tab-content">
				                  	<div class="tab-pane active" id="inventory">
					                  	<table id='asset-table' class='table table-bordered table-hover table-striped' width="100%">
					                  		<thead>	
					                  			<th>Asset No</th>
					                  			<th>Serial No / Distinction No</th>
												<th>Asset</th>
						                  		<th>Description</th>
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

	<form id='add_parts' action="<?php echo base_url(); ?>gss/head/inventory/add_parts" method='post'>
		<div id='add-modal' class="modal fade" role='dialog' tabindex='-1'>
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
						<input type='hidden' id='asset_id' name='asset_id' style='background-color: transparent; border: none; width: 50%; font-size: 18px; font-weight: bold;' readonly>
						<h4 style='font-size: 18px; font-weight: bold; margin: 0;'>Asset No: <input type='text' id='asset_no' name='asset_no' style='background-color: transparent; border: none; width: 50%; font-size: 18px; font-weight: bold;' readonly></h4>
						<h4 style='font-size: 18px; font-weight: bold; margin: 0;'>Serial No / Distinction No: <input type='text' id='distinction_no' name='distinction_no' style='background-color: transparent; border: none; width: 50%; font-size: 18px; font-weight: bold;' readonly></h4>
					</div>
					<div class="modal-body">
						<table class='table table-hover table-bordered table-striped'>
			            	<thead>
			            		<th>Asset</th>
			            		<th>Description</th>
			            		<th colspan=3>Parts</th>				            		
			            	</thead>
			            	<tbody>
				           		 <tr>
				           			<td>
				           				<input class='form-control' type='text' name='asset_name' id='asset_name' style="border: none; background: transparent;" readonly>
				           			</td>
				           			<td>
				           				<input class='form-control' type='text' name='asset_desc' id='asset_desc' style="border: none; background: transparent;" readonly>
				           			</td>
				           			<td>
					           			<table>
					           				<thead>
					           					<th id='dist_no' width="120px">Distinction No</th>
							           			<th id='name' width="140px">Name</th>
							           			<th id='desc' width="140px">Description</th>
							           			<th id='action' width="20px"> 
							           				<button id='add-part-btn' type="button" class='btn btn-default btn-sm'> <i class='fa fa-plus'></i></button>	   
							           			</th>
					           				</thead>
					           				<tbody id='parts'>
					           				</tbody>
					           			</table>
				           			</td>
				           		</tr> 
				           	</tbody>
			            </table>
					</div>
					<div class='modal-footer'>
						<button class='btn btn-danger' data-dismiss='modal'>Cancel</button>
						<button class='btn btn-success'>Save</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<div id='view-modal' class="modal fade" role='dialog' tabindex='-1'>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<input type='hidden' id='asset_id' name='asset_id' style='background-color: transparent; border: none; width: 50%; font-size: 18px; font-weight: bold;' readonly>
					<h4 style='font-size: 18px; font-weight: bold; margin: 0;'>Asset No: <input type='text' id='view-asset_no' name='view-asset_no' style='background-color: transparent; border: none; width: 50%; font-size: 18px; font-weight: bold;' readonly></h4>
					<h4 style='font-size: 18px; font-weight: bold; margin: 0;'>Serial No / Distinction No: <input type='text' id='view-distinction_no' name='view-distinction_no' style='background-color: transparent; border: none; width: 50%; font-size: 18px; font-weight: bold;' readonly></h4>
				</div>
				<div class="modal-body">
					<table class='table table-hover table-bordered table-striped'>
		            	<thead>
		            		<th>Asset</th>
		            		<th>Description</th>
		            		<th colspan=3>Parts</th>				            		
		            	</thead>
		            	<tbody>
			           		 <tr>
			           			<td>
			           				<input class='form-control' type='text' name='view-asset_name' id='view-asset_name' style="border: none; background: transparent;" readonly>
			           			</td>
			           			<td>
			           				<input class='form-control' type='text' name='view-asset_desc' id='view-asset_desc' style="border: none; background: transparent;" readonly>
			           			</td>
			           			<td>
				           			<table>
				           				<thead>
				           					<th id='dist_no' width="120px">Distinction No</th>
						           			<th id='name' width="140px">Name</th>
						           			<th id='desc' width="140px">Description</th>
				           				</thead>
				           				<tbody id='parts'>	
					           				<tr>
					           					<td id="view-part-dist-no"></td>
					           					<td id="view-part-name"></td>
					           					<td id="view-part-desc"></td>	
					           				</tr>
				           				</tbody>
				           			</table>
			           			</td>
			           		</tr> 
			           	</tbody>
		            </table>
				</div>
				<div class='modal-footer'>
					<button class='btn btn-default' data-dismiss='modal'>Close</button>
				</div>
			</div>
		</div>
	</div>

<div id='update-modal' class="modal" role='dialog' tabindex='-1'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
                    <h4 style="margin: 0;">Update Inventory</h4>
                </div>
                <div class="modal-body" style="max-height: 480px; overflow-y: auto;">
                    <div class='row'>
                        <div class="col-md-12">
                                <div class="box-body">
                                    <table class='table table-hover table-bordered table-striped'>
                                    <tr width="150px">
                                   
                                      <td width="100px"><label><input type="radio" name="option">&nbsp;Add</label>
                                      <label><input type="radio" name="option">&nbsp;Dispose</label> </td>
                                       <td width="150px"><input name='item_qty[]' class='form-control' type='number' min='1' max='"+data.qty+"' step='1' value='1'> </td>
                                       <td> <label> Total items: </label> </td>
                                    </tr>
                                  </table>
                                </div>
                            <div class="box box-default">
                                <div class="box-body">
                                    <table class='table table-hover table-bordered table-striped'>
                                        <thead>
                                            <th width="200px">Item</th>
                                            <th width="250px">Desc</th>
                                            <th>Qty</th>
                                        </thead>
                                        <tr>
                                            <td>
                                                Pencil
                                            </td>
                                            <td> Mongold </td>
                                            <td> <input class='form-control' type='text' value="50"readonly></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button class='btn btn-success' data-dismiss='modal'>Save</button>
                </div>
            </div>
        </div>
    </div>
	<form id='gen-purchase' method='post'>
    <div id='generate-purchase-modal' class="modal fade" role='dialog' tabindex='-1'>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;">Summary of Purchase Report</h4>
					<h5 style="margin: 0;">As of <input type="text" class="form-control" name="purchase-date" id="purchase-date" style="background:transparent;border:none;" /></h5>
				</div>
				<div class="modal-body">
					<table id='inventory-table' class='table table-bordered table-hover table-striped' width="100%">
					    <thead>	
							<th>Stock No</th>
							<th>Item</th>
						    <th>Description</th>
						    <th>Quantity</th>
						    <th>Unit Measure</th>
						    <th>Unit Cost</th>
						    <th>Total Cost</th>
						</thead>
						<tbody id="purchase-table">
						</tbody>
					</table>
					<div class="box box-default">
					    <div class="box-body">
							<table class='table'>
								<tbody>
									<tr>
										<td>Prepared by: <input type="textfield" class='form-control' name="purchase-prepared"></td>
										<td>Division/Position: <input type="textfield" class='form-control' name="purchase-prepared-position"></td>
									</tr>
									<tr>
										<td>Checked by: <input type="textfield" class='form-control' name="purchase-checked"></td>
										<td>Division/Position: <input type="textfield" class='form-control' name="purchase-checked-position"></td>
									</tr>	
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class='modal-footer'>
					<h4><b class='pull-left'>Total Quantity: <input type="text" class="" name="purchase-qty" id="purchase-qty" style="background:transparent;border:none;" readonly /></b></h4></b> <button type='submit' class='btn btn-success generate-purchase'>Generate</button> <br>
					<h4><b class='pull-left'>Total Amount: &#8369; <u><input type="text"  name="purchase-amount" id="purchase-amount" style="background:transparent;border:none;" readonly /></u></b></h4></b>
				</div>
			</div>
		</div>
	</div>
	</form>

	<form id='gen-balance' method='post'>
	<div id='generate-balance-modal' class="modal fade" role='dialog' tabindex='-1'>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;">Office Supplies Balance Report</h4>
					<h5 style="margin: 0;">As of <div id="balance-date"></div></h5>
				</div>
				<div class="modal-body">
					<table id='inventory-table' class='table table-bordered table-hover table-striped' width="100%">
					    <thead>	
							<th>Stock No</th>
							<th>Item</th>
						    <th>Description</th>
						    <th>Quantity</th>
						    <th>Unit Measure</th>
						    <th>Unit Cost</th>
						    <th>Total Cost</th>
						</thead>
						<tbody id="balance-table">
						</body>
					</table>
					<div class="box box-default">
					    <div class="box-body">
							<table class='table'>
								<tbody>
									<tr>
										<td>Prepared by: <input type="textfield" class='form-control' name="balance-prepared"></td>
										<td>Division/Position: <input type="textfield" class='form-control' name="balance-prepared-position"></td>
									</tr>
									<tr>
										<td>Checked by: <input type="textfield" class='form-control' name="balance-checked"></td>
										<td>Division/Position: <input type="textfield" class='form-control' name="balance-checked-position"></td>
									</tr>	
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class='modal-footer'>
					<h4><b class='pull-left'>Total Quantity: <input type="text" class="" name="balance-qty" id="balance-qty" style="background:transparent;border:none;" readonly /></b></h4></b> <button type='submit' class='btn btn-success' >Generate</button>
					<br>
					<h4><b class='pull-left'>Total Amount: &#8369; <u><input type="text" class="" name="balance-amount" id="balance-amount" style="background:transparent;border:none;" readonly /></u></b></h4></b>
				</div>
			</div>
		</div>
	</div>
	</form>
	<form id='gen-rsmi' method='post'>
	<div id='generate-rsmi-modal' class="modal fade" role='dialog' tabindex='-1'>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
					<h4 style="margin: 0;">Report of Supplies and Material Issued (RSMI)</h4>
					<h5 style="margin: 0;">As of <div id="rsmi-date"></div></h5>
				</div>
				<div class="modal-body">
					<table id='inventory-table' class='table table-bordered table-hover table-striped' width="100%">
					    <thead>
					    	<th>Division: <div id="rsmi-division" ></div></th>
					    </thead>
					    <thead>	
							<th>RIS No</th>
							<th>Stock No</th>
						    <th>Description</th>
						    <th>Unit Measure</th>
						    <th>Quantity</th>
						    <th>Unit Cost</th>
						    <th>Total Cost</th>
						</thead>
						<tbody id="rsmi-table">
						</tbody>
					</table>
					<div class="box box-default">
					    <div class="box-body">
							<table class='table'>
								<tbody>
									<tr>
										<td>Prepared by: <input type="textfield" class='form-control' name="rsmi-prepared"></td>
										<td>Division/Position: <input type="textfield" class='form-control' name="rsmi-prepared-position"></td>
									</tr>
									<tr>
										<td>Checked by: <input type="textfield" class='form-control' name="rsmi-checked"></td>
										<td>Division/Position: <input type="textfield" class='form-control' name="rsmi-checked-position"></td>
									</tr>	
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class='modal-footer'>
					<h4><b class='pull-left'>Total Quantity: <input type="text" class="" name="rsmi-qty" id="rsmi-qty" style="background:transparent;border:none;" readonly /></b></h4></b> <button type='submit' class='btn btn-success' >Generate</button>
					<br>
					<h4><b class='pull-left'>Total Amount: &#8369; <u><input type="text" class="" name="rsmi-amount" id="rsmi-amount" style="background:transparent;border:none;" readonly /></u></b></h4></b>
				</div>
			</div>
		</div>
	</div>
	</form>