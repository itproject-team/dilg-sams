var initTables = function(scope, compile){
	var base_url = $('#base_url').val(); 
	var completed_table = $('#completed-table').DataTable({
		ajax: base_url+"/gss/head/are/completed_are",
		columns: [
					{'data': 'are_no'},
					{'data': 'asset'},
					{'data': 'status'},
					{'data': 'date_created'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<button type='button' class='btn btn-success'>Download</button><button type='button' class='btn btn-default view-are'>View</button><button type='button' class='btn btn-default generate-pc'>Generate Property Card</button>";
						}
					}
				],

	});
	var draft_table = $('#draft-table').DataTable({
		ajax: base_url+"/gss/head/are/draft_are",
		columns: [
					{'data': 'are_no'},
					{'data': 'asset'},
					{'data': 'status'},
					{'data': 'date_created'},
					// {'data': 'date_modified'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<button type='button' class='btn btn-warning edit-are'>Edit</button>";
						}
					}
				],
	});

	$('#generate-are-btn').click(function(){
		$('input[type=file]').val('');
		$('#generate-are-modal').modal({backdrop: 'static', keyboard: false});
		$('#generate-are-modal').modal('show');
	});
	$('#add-item-btn').click(function(){
		$('#inventory-item-modal').modal('show');
	});

	$('#add-asset-btn').click(function() {
    $('#current-are-asset-name').toggle();
});

	$('.show-draft-modal').click(function () {
	  	if (confirm('ARE will be saved as DRAFT')) {
	  		 $('#save_are_status').val('draft');
	  		 $.post(base_url+"/gss/head/are/save_are", $('form#save_are').serialize(), function(data) {
	  		 	location.reload();
	  		 });
		}else{
			location.reload();
			$('#generate-are-modal').modal('hide');
		}
	});

	$('#draft-table').on('click', '.edit-are', function(){
		var data = draft_table.row(this.closest('tr')).data();
		$('#edit-are-modal-are_no').val(data.are_no);
		$('#edit-are-modal-are_id').val(data.id);

		$('#current-are-asset-name').val(data.asset);
		$('#current-are-office').val(data.office);
		$('#current-are-employee').val(data.employee);

		$('#edit-are-modal').modal({backdrop: 'static', keyboard: false});
		$('#edit-are-modal').modal('show');
		console.log(data);
	});

	$('#change-asset-btn').click(function(){
		$('#inventory-item-modal').modal('show');
	});

	$('#show-draft-edit-modal').click(function(){
		if (confirm('Changes will not be saved')) {
	  		location.reload();
			$('#edit-po-modal').modal('hide');
		}
	});

	$('#completed-table').on('click', '.view-are', function(){

		var data = completed_table.row(this.closest('tr')).data();
		$('#view-are-are_no').html(data.are_no);
		$('#view-are-date_created').html(data.date_created);
		$('#view-are-status').html(data.status);
		$('#view-are-asset-name').html(data.asset);
		$('#view-are-office').html(data.office);
		$('#view-are-employee').html(data.employee);
		//console.log(data);
		$('#view-are-modal').modal('show');

	});

	$('#completed-table').on('click', '.generate-pc', function(){

		var data = completed_table.row(this.closest('tr')).data();
		var today = new Date();
		var office = ((data.office).toUpperCase()).substring(0, 3);
		$('#ppe_no').val(office+"-"+today.getFullYear()+"-"+data.id);
		$('#pc-asset-name').val(data.asset);
		$('#pc-date-created').val(data.date_created);
		$('#pc-employee').val(data.employee);
		$('#pc-status').val("Serviceable");
		
		console.log(data);
		$('#generate-pc-modal').modal('show');
	});
}