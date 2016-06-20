var initTables = function(scope, compile){
	var base_url = $('#base_url').val(); 
	var pc_table = $('#pc-table').DataTable({
		ajax: base_url+"/gss/head/pc/generated_pc",
		columns: [
					{'data': 'asset_no'},
					{'data': 'employee'},
					{'data': 'status'},
					{'data': 'date_created'},
					{'data': 'date_modified'},
					{'data': 'modified_by'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<button type='button' class='btn btn-success'>Download</button>"+
							"<button type='button' class='btn btn-default view-pc'>View</button>"+
							"<button type='button' class='btn btn-default update-pc'>Update</button>";
						}
					}
				],
		//columnDefs: [{targets: 6, 'width': '100px'}],
	});

	$('#pc-table').on('click', '.view-pc', function(){

		var data = pc_table.row(this.closest('tr')).data();
		$('#view-pc-pc_no').val(data.asset_no);
		// $('#view-pc-date-created').val(data.date_created);
		// $('#view-pc-status').val(data.status);
		// $('#view-pc-employee').val(data.employee);
		// $('#view-pc-remarks').val(data.remarks);
		$('#view-pc-asset-name').html(data.asset_name +" - "+ data.asset_description);
		$('#view-pc-office').html(data.office);
		$('#view-pc-asset-part').val(data.asset_part_name);
		$('#view-pc-asset-desc').val(data.asset_part_description);
		$('#view-pc-status-part').val(data.part_status);
		$('#view-pc-remarks-part').val(data.part_remarks);
		$('#user').html(data.created_by);
		//console.log(data);
		$('#view-pc-modal').modal('show');

	});

	$('#pc-table').on('click', '.update-pc', function(){

		var data = pc_table.row(this.closest('tr')).data();
		$('#update-pc_no').val(data.asset_no);
		$('#update-pc-date-created').val(data.date_created);
		$('#update-pc-status').val(data.status);
		$('#update-pc-asset-name').html(data.asset_name +" - "+ data.asset_description);
		$('#update-pc-office').html(data.office);
		$('#update-pc-employee').val(data.employee);
		$('#current-pc-status').val(data.status);
		$('#current-pc-remarks').val(data.remarks);
		$('#update-pc-asset-part').val(data.asset_part_name);
		$('#update-pc-asset-desc').val(data.asset_part_description);
		$('#update-pc-status-part').val(data.part_status);
		$('#current-pc-remarks-part').val(data.part_remarks);
		$('#update-user').html(data.created_by);
		//console.log(data);
		$('#update-pc-modal').modal('show');

	});


		var next = 1;
    $('#update-pc-modal').on('click', '.add-asset-row',function(e){
        e.preventDefault();
		$(this).replaceWith("<button id='remove'" + (next) + "' class='btn btn-danger remove-me pull-right'>-</button>");
		var addto = "#field" + next;
        next = next + 1;
		var str = "<tr id='field" + next + "'><input class='form-control' type='hidden' name='inventory_id[]' value='0'>"+
					"<td><input autocomplete='off' class='input form-control' id='item" + next + "' name='inventory_item[]' type='text' data-items='8'/></td>"+
					"<td><input autocomplete='off' class='input form-control' id='desc" + next + "' name='inventory_desc[]' type='text' data-items='8'/></td>"+
					"<td><select class='form-control' name='update-pc-part-status' id='update-pc-status'>"+
										"<option value='Serviceable'>Serviceable</option>"+
										"<option value='Transferred'>Transferred</option>"+
										"<option value='Under Repair'>Under Repair</option>"+
										"<option value='Unserviceable'>Unserviceable</option>"+
										"<option value='Disposed'>Disposed</option>"+
									"</select></td>"+
					"<td><button id='b1' class='btn add-asset-row pull-right' type='button'>+</button></td></tr>";
        $(addto).after(str);
		$("#field" + next).attr('data-source',$(addto).attr('data-source'));
		$("#count").val(next); 
		$('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.replace( /^\D+/g, '');
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
        });
    });

	// var view_pc_table = $('#view-pc-table').DataTable({
	// 	ajax: base_url+"/gss/head/pc/pc_list",
	// 	columns: [
	// 				{'data': 'date_modified'},
	// 				{'data': 'employee'},
	// 				{'data': 'status'},
	// 				{'data': 'remarks'}
	// 			],
	// });

}