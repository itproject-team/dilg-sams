<input type='hidden' id="base_url" value="<?php  echo base_url(); ?>" /> 
<div ng-app='myApp' ng-controller='myCtrl'>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
              	<div class="box box-default">
	                <div class="box-header with-border">
	                  	<h3 class="box-title">Inspection and Acceptance Reiarrt</h3>
	                  	<div class="box-tools pull-right">
	                   		<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                 	</div>
	                </div>
	                <div class="box-body">
	                	<div class="nav-tabs-custom">
			                <ul class="nav nav-tabs" style="margin-bottom: 20px;">
			                  	<li class="active"><a href="#completed" data-toggle="tab">Completed</a></li>
			                </ul>

			                <div class="tab-content">
			                  	<div class="tab-pane active" id="completed">
				                  	<table id='completed-table' class='table table-bordered table-hover table-striped' width="100%">
				                  		<thead>
					                  		<th>IAR NO</th>
					                  		<th>Status</th>
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

	<div id='view-iar-modal' class="modal" role='dialog' tabindex='-1'>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times; </span></button>
                    <h4 style="margin: 0;"><strong>IAR No.</strong> &nbsp; <label id='view-iar-iar_no'></label></h4>
                </div>
                <div class="modal-body" style="max-height: 480px; overflow-y: auto;">
                    <div class='row'>
                        <div class="col-md-12">
                            <div class="box box-success">
                                <div class="box-body">
                                    <table class='table'>
                                        <tr>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Created By:</label></td>
                                            <td><p id='view-iar-created_by' style="text-decoration: underline;"></p></td>
                                            <td style="width: 14%;"><label style="color: #D00D0D ">Status:</label></td>
                                            <td><p id='view-iar-status' style="text-decoration: underline;"></p></td>
                                            <td style="width: 14%;"><label style="color: #D00D0D ;">Date Created:</label></td>
                                            <td><p id='view-iar-date_created' style="text-decoration: underline;"></p></td>
                                            
                                        </tr>
                                        <tr>
                                            <td id='view-iar-status-by' style="width: 14%;"></td>
                                            <td><p id='view-iar-statusby' style="text-decoration: underline;"></p></td>
                                            <td style="width: 14%;"><label style="color: #D00D0D ;">Date Modified:</label></td>
                                            <td><p id='view-iar-date_modified' style="text-decoration: underline;"></p></td>
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
                                <div class="box-body">
                                    <table class='table table-hover table-bordered table-striped'>
                                        <thead>
                                            <th style="width: 100px;">Stock No</th>
                                            <th style="width: 140px;">Item</th>
                                            <th>Desc</th>
                                            <th style="width: 120px;">Type</th>
                                            <th style="width: 60px;"></th>
                                            <th style="width: 60px;">Qty</th>
                                            <th style="width: 110px;text-align:right;">Unit Cost</th>
                                            <th style="width: 120px;text-align:right;">Total Cost</th>
                                        </thead>
                                        <tbody id='view-iar-items'>
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
