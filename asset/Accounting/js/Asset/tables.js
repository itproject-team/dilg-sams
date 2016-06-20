var initTables = function(scope, compile){
	var base_url = $('#base_url').val(); 
	var asset_table = $('#asset-table').DataTable({
		ajax: base_url+"accounting/head/asset/all_assets",
		columns: [
					{'data': 'asset_name'},
					{'data': 'asset_description'},
					{'data': 'asset_status'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<button type='button' class='btn btn-default view-btn'>View</button>";
						}
					}
				],
		columnDefs: [{targets: 3, width: '200px'}],
	});
$('#asset-table').on('click', '.view-btn', function(){
		var data = asset_table.row(this.closest('tr')).data();
		$('#view-asset-no').val(data.asset_no);
		$('#view-asset-date-issued').val(data.date_created);
		$('#view-asset-status').val(data.asset_status);
		$('#view-asset-name').val(data.asset_name +" - "+ data.asset_description);
		$('#view-asset-office').html(data.office);
		$('#view-asset-employee').val(data.employee);
		$('#view-asset-part').val(data.asset_part_name);
		$('#view-asset-desc').val(data.asset_part_description);
		$('#view-asset-status-part').val(data.part_status);
		$('#user').html(data.user_name);
		console.log(data);
	$('#view-asset-modal').modal('show');
});

$('#asset-table').on('click', '.repair-btn', function(){
	$('#repair-modal').modal('show');
});

$('#asset-table').on('click', '.transfer-btn', function(){
	$('#transfer-modal').modal('show');
});

}