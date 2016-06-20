 var initTables = function(scope, compile){
	var base_url = $('#base_url').val(); 
	var all_table = $('#all-table').DataTable({
		ajax: base_url+"/gss/head/par/all_par",
		columns: [
					{'data': 'par_no'},
					{'data': 'asset_name'},
					{'data': 'status'},
					{'data': 'created_by'},
					{'data': 'date_created'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							if(rowData.status == "completed"){
								return  "<button type='button' class='btn btn-success'>Download</button> "+
									"<button type='button' class='btn btn-default view-par'>View</button>"+
									"<button type='button' class='btn btn-default generate-pc'>Generate Property Card</button>";
							}else if(rowData.status == "draft"){
								return "<button type='button' class='btn btn-warning edit-par'>Edit</button>";
							}

						}
					}
				],
		columnDefs: [{targets: 5}],

	});

	var completed_table = $('#completed-table').DataTable({
		ajax: base_url+"/gss/head/par/completed_par",
		columns: [
					{'data': 'par_no'},
					{'data': 'asset_name'},
					{'data': 'created_by'},
					{'data': 'date_created'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<button type='button' class='btn btn-success'>Download</button>"+
							"<button type='button' class='btn btn-default view-par'>View</button>"+
							"<button type='button' class='btn btn-default generate-pc'>Generate Property Card</button>";
						}
					}
				],
		columnDefs: [{targets: 4, 'width': '200px'}],

	});
	var draft_table = $('#draft-table').DataTable({
		ajax: base_url+"/gss/head/par/draft_par",
		columns: [
					{'data': 'par_no'},
					{'data': 'asset_name'},
					{'data': 'created_by'},
					{'data': 'date_created'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<button type='button' class='btn btn-warning edit-par'>Edit</button>";
						}
					}
				],
		columnDefs: [{targets: 4, 'width': '200px'}],
	});

	$('#generate-par-btn').click(function(){
		$('input[type=file]').val('');
		$('#generate-par-modal').modal({backdrop: 'static', keyboard: false});
		$('#generate-par-modal').modal('show');
	});
	$('#add-item-btn').click(function(){
		$('#inventory-item-modal').modal('show');
	});

	$('#add-asset-btn').click(function() {
	    $('#current-par-asset-name').toggle();
	});

	$('#draft-table').on('click', '.edit-par', function(){
		var data = draft_table.row(this.closest('tr')).data();
		$('#edit-par-modal-par_no').val(data.par_no);
		$('#edit-par-modal-par_id').val(data.id);

		$('#current-par-asset-name').val(data.asset_name);
		$('#current-par-asset-desc').val(data.asset_description);
		$('#current-par-office').val(data.name).attr('selected', 'selected');
		$('#current-par-employee').val(data.employee).attr('selected', 'selected');

		$('#edit-par-modal').modal('show');
		console.log(data);
	});

	$('#all-table').on('click', '.edit-par', function(){
		var data = all_table.row(this.closest('tr')).data();
		$('#edit-par-modal-par_no').val(data.par_no);
		$('#edit-par-modal-par_id').val(data.id);

		$('#current-par-asset-name').val(data.asset_name);
		$('#current-par-asset-desc').val(data.asset_description);
		$('#current-par-office').val(data.name).attr('selected', 'selected');
		$('#current-par-employee').val(data.employee).attr('selected', 'selected');

		$('#edit-par-modal').modal('show');
		console.log(data);
	});

	$('#change-asset-btn').click(function(){
		$('#inventory-item-modal').modal('show');
	});

	$('#show-draft-edit-modal').click(function(){
		$('#draft-modal-edit').modal('show');
	});
	
	$('.show-draft-modal').click(function () {
		$('#draft-modal').modal('show');
	});
	
	$('.save-draft').click(function(){
 		$('#save_par_status').val('draft');
	  		 $.post(base_url+"/gss/head/par/save_par", $('form#save_par').serialize(), function(data) {
	  		 	location.reload();
	  		 });
	});
	$('#completed-table').on('click', '.view-par', function(){

		var data = completed_table.row(this.closest('tr')).data();
		$('#view-par-par_no').html(data.par_no);
		$('#view-par-date_created').html(data.date_created);
		$('#view-par-status').html(data.status);
		$('#view-par-asset-name').html(data.asset_name);
		$('#view-par-asset-desc').html(data.asset_description);
		$('#view-par-office').val(data.name);
		$('#view-par-employee').val(data.employee);
		$('#view-par-asset-part').val(data.asset_part_name);
		$('#view-par-asset-part-desc').val(data.asset_part_description);
		$('#view-par-received-by').html(data.received_by);
		$('#view-par-received-from').html(data.received_from);
		$('#view-par-position-by').html(data.position_by);
		$('#view-par-position-from').html(data.position_from);

		$('#user').html(data.created_by);
		//console.log(data);
		$('#view-par-modal').modal('show');

	});
	$('#all-table').on('click', '.view-par', function(){

		var data = all_table.row(this.closest('tr')).data();
		$('#view-par-par_no').html(data.par_no);
		$('#view-par-date_created').html(data.date_created);
		$('#view-par-status').html(data.status);
		$('#view-par-asset-name').html(data.asset_name);
		$('#view-par-asset-desc').html(data.asset_description);
		$('#view-par-office').html(data.name);
		$('#view-par-employee').html(data.employee);
		$('#view-par-asset-part').val(data.asset_part_name);
		$('#view-par-asset-part-desc').val(data.asset_part_description);
		$('#view-par-received-by').html(data.received_by);
		$('#view-par-received-from').html(data.received_from);
		$('#view-par-position-by').html(data.position_by);
		$('#view-par-position-from').html(data.position_from);
		$('#user').html(data.created_by);
		//console.log(data);
		$('#view-par-modal').modal('show');

	});

	$('#completed-table').on('click', '.generate-pc', function(){

		var data = completed_table.row(this.closest('tr')).data();
		$('#ppe_no').val(data.asset_no);
		$('#pc-asset-name').html(data.asset_name +" - "+ data.asset_description);
		$('#pc-date-created').val(data.date_created);
		$('#pc-employee').val(data.employee);
		$('#pc-status').val("Serviceable");
		$('#pc-asset-part').val(data.asset_part_name);
		$('#pc-asset-part-desc').val(data.asset_part_description);
		$('#pc-asset-part-status').val("Serviceable");
		console.log(data);
		$('#generate-pc-modal').modal('show');
	});

	$('#all-table').on('click', '.generate-pc', function(){

		var data = all_table.row(this.closest('tr')).data();
		$('#ppe_no').val(data.asset_no);
		$('#pc-asset-name').html(data.asset_name +" - "+ data.asset_description);
		$('#pc-date-created').val(data.date_created);
		$('#pc-employee').val(data.employee);
		$('#pc-status').val("Serviceable");
		$('#pc-asset-part-no').val(data.asset_part_no);
		$('#pc-asset-part').val(data.asset_part_name);
		$('#pc-asset-part-desc').val(data.asset_part_description);
		$('#pc-asset-part-status').val("Serviceable");
		
		//console.log(data);
		$('#generate-pc-modal').modal('show');
	});
}