
	var base_url = $('#base_url').val(); 

	var ppmp_table = $('#ppmp-table').DataTable({
						ajax: base_url + 'accounting/head/ris/get_ppmp',
						columns: [
										{'data': 'code'},
										{'data': 'name'},
										{'data': 'description'},
										{'data': 'max'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<input id='inventory_"+sourceData.id+"' name='inventory_"+sourceData.id+"' class='checkbox' type='checkbox'>";
											}
										},
									],
						bLengthChange: false,
					});

	var user_all_table = $('#user-all-table').DataTable({
						ajax: base_url + 'accounting/head/ris/user_all_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												if(sourceData.status === 'pending'){
													return "<select class='form-control select-status' name='status'>"+
																"<option value='pending'>Pending</option>"+
																"<option value='cancel'>Cancel</option>"+
															"</select>"+
															"<button type='button' class='btn btn-default view'>View</button>"
												}
												if(sourceData.status === 'cancelled'){
													return "<button type='button' class='btn btn-default view'>View</button>";
												}
												if(sourceData.status === 'rejected'){
													return "<button type='button' class='btn btn-default view'>View</button>";
												}
												if(sourceData.status === 'confirmed'){
													return "<button type='button' class='btn btn-success view'>Download</button><button type='button' class='btn btn-default view'>View</button>";
												}
												if(sourceData.status === 'completed'){
													return "<button class='btn btn-success'>Download</button><button class='btn btn-default view'>View</button>";
												}
												if(sourceData.status === 'incomplete'){
													return "<button class='btn btn-default view'>View</button>";
												}
											}
										},
									],
					});

	var user_pending_table = $('#user-pending-table').DataTable({
						ajax: base_url + 'accounting/head/ris/user_pending_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<select class='form-control select-status' name='status'>"+
															"<option value='pending'>Pending</option>"+
															"<option value='cancel'>Cancel</option>"+
														"</select>"+
														"<button type='button' class='btn btn-default view'>View</button>";
											}
										},
									],
					});

	var user_cancelled_table = $('#user-cancelled-table').DataTable({
						ajax: base_url + 'accounting/head/ris/user_cancelled_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<button type='button' class='btn btn-default view'>View</button>";
											}
										},
									],
					});

	var user_rejected_table = $('#user-rejected-table').DataTable({
						ajax: base_url + 'accounting/head/ris/user_rejected_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<button type='button' class='btn btn-default view'>View</button>";
											}
										},
									],
					});

	var user_confirmed_table = $('#user-confirmed-table').DataTable({
						ajax: base_url + 'accounting/head/ris/user_confirmed_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<button type='button' class='btn btn-success'>Download</button> <button type='button' class='btn btn-default view'>View</button>";
											}
										},
									],
					});

	var user_completed_table = $('#user-completed-table').DataTable({
						ajax: base_url + 'accounting/head/ris/user_completed_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<button type='button' class='btn btn-success'>Download</button> <button type='button' class='btn btn-default view'>View</button>";
											}
										},
									],
					});

	var user_incomplete_table = $('#user-incomplete-table').DataTable({
						ajax: base_url + 'accounting/head/ris/user_incomplete_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<button class='btn btn-default view'>View</button>";
											}
										},
									],
					});




	$('#create-ris-btn').click(function(){
		$.get(base_url+'/accounting/head/ris/last_ris_no').success(function(response){
			if(JSON.parse(response) !== null){
				var ris_no = JSON.parse(response).ris_no;
				var new_ris_no = ris_no.split('-')[0] +'-'+ (parseFloat(ris_no.split('-')[1]) + 1) +'-'+ ris_no.split('-')[2];
				$('input[name=ris_no]').val(new_ris_no);
			}else{
				$('input[name=ris_no]').val("RIS-1-"+ (new Date().getFullYear()));
			}
			
		});
		$('#create-ris-modal').modal('show');
	});

	$('#ppmp-table').on('click', '.checkbox', function(){
		var data = ppmp_table.row(this.closest('tr')).data();

		if($(this).is(':checked')){
			$('#modal-ris-table').find('tbody').append("<tr id='selected_"+data.id+"'>"+
														"<td>"+data.code+"</td>"+
														"<td>"+data.name+"</td>"+
														"<td>"+data.description+"</td>"+
														"<td><input name='item_qty[]' class='form-control' type='number' min='1' max='"+data.max+"' step='1' value='1'></td>"+
														"<td>"+
															"<button id='"+data.id+"' type='button' class='btn btn-danger remove-item'>&times; </button>"+
															"<input type='hidden' name='item_id[]' value='"+data.id+"'>"+
														"</td>"+
														"</tr>");
		}
	});

	$("#ppmp-table").on('click', 'input[name*=inventory_]', function(){
		if(!($(this).is(':checked'))){
			var id = "#selected_"+$(this).attr('id').split('_')[1];
			$(id).remove();
		}
	});

	$('#modal-ris-table').on('click', '.remove-item', function(){
		var id = $(this).attr('id');
		$('#inventory_'+id).prop('checked', false);
		$(this).closest('tr').remove();
	});

	$('.close-create-ris-modal').click(function () {
		$('#create-ris-modal').modal('hide');

		// if (confirm('This SAI Form will be saved as DRAFT')) {
		// 	 $('#save_po_status').val('draft');
		// 	 $.post(base_url+"/Accounting/head/sai/save_po", $('form#save_po').serialize(), function(data) {
		// 		location.reload();
		// 	 });
		// 	 location.reload();
		// 	$('#create-sai-modal').modal('hide');
		// }else{
		// 	location.reload();
		// 	$('#create-sai-modal').modal('hide');
		// }
	});

	$('#user-all-table').on('change', '.select-status', function(){
		if($(this).val() === 'cancel'){
			var data = user_all_table.row($(this).closest('tr')).data();
			$.post(base_url+'accounting/head/ris/cancel_ris', {id: data.id}, function(){
				location.reload();
			});
		}
	});

	$('#user-pending-table').on('change', '.select-status', function(){
		if($(this).val() === 'cancel'){
			var data = user_pending_table.row($(this).closest('tr')).data();
			$.post(base_url+'accounting/head/ris/cancel_ris', {id: data.id}, function(){
				location.reload();
			});
		}
	});

	var view_items_table;
	$('#user-all-table').on('click', '.view', function(){
		var data = user_all_table.row(this.closest('tr')).data();
		var modal = $('#view-user-modal');
		if(view_items_table !== undefined) {
			view_items_table.destroy();
			modal.find('table:eq(1)').find('tbody').html('');
		}
		modal.find('table:eq(0)').find('td:eq(0)').text(data.ris_no);
		modal.find('table:eq(0)').find('td:eq(1)').text(data.status);
		modal.find('table:eq(0)').find('td:eq(2)').text(data.date_created);
		modal.find('table:eq(0)').find('td:eq(3)').text(data.date_modified);
		$('#view-user-ris-no').text(data.ris_no);

		$.each(data.items, function(index, value){
			modal.find('table:eq(1)').find('tbody').append("<tr>"+
															"<td>"+value.name+"</td>"+
															"<td>"+value.description+"</td>"+
															"<td>"+value.qty+"</td>"+
														"</tr>");
		});
		view_items_table = modal.find('table:eq(1)').DataTable({bLengthChange: false});
		modal.modal('show');
	});
	
	$('#user-completed-table').on('click', '.view', function(){
		var data = user_completed_table.row(this.closest('tr')).data();
		var modal = $('#view-user-modal');
		if(view_items_table !== undefined) {
			view_items_table.destroy();
			modal.find('table:eq(1)').find('tbody').html('');
		}
		modal.find('table:eq(0)').find('td:eq(0)').text(data.ris_no);
		modal.find('table:eq(0)').find('td:eq(1)').text(data.status);
		modal.find('table:eq(0)').find('td:eq(2)').text(data.date_created);
		modal.find('table:eq(0)').find('td:eq(3)').text(data.date_modified);
		$('#view-user-ris-no').text(data.ris_no);

		$.each(data.items, function(index, value){
			modal.find('table:eq(1)').find('tbody').append("<tr>"+
															"<td>"+value.name+"</td>"+
															"<td>"+value.description+"</td>"+
															"<td>"+value.qty+"</td>"+
														"</tr>");
		});
		view_items_table = modal.find('table:eq(1)').DataTable({bLengthChange: false});
		modal.modal('show');
	});

	var view_items_table;
	$('#user-pending-table').on('click', '.view', function(){
		var data = user_pending_table.row(this.closest('tr')).data();
		var modal = $('#view-user-modal');
		if(view_items_table !== undefined) {
			view_items_table.destroy();
			modal.find('table:eq(1)').find('tbody').html('');
		}
		modal.find('table:eq(0)').find('td:eq(0)').text(data.ris_no);
		modal.find('table:eq(0)').find('td:eq(1)').text(data.status);
		modal.find('table:eq(0)').find('td:eq(2)').text(data.date_created);
		modal.find('table:eq(0)').find('td:eq(3)').text(data.date_modified);
		$('#view-user-ris-no').text(data.ris_no);

		$.each(data.items, function(index, value){
			modal.find('table:eq(1)').find('tbody').append("<tr>"+
															"<td>"+value.name+"</td>"+
															"<td>"+value.description+"</td>"+
															"<td>"+value.qty+"</td>"+
														"</tr>");
		});
		view_items_table = modal.find('table:eq(1)').DataTable({bLengthChange: false});
		console.log(data);
		modal.modal('show');
	});

	var view_items_table;
	$('#user-cancelled-table').on('click', '.view', function(){
		var data = user_cancelled_table.row(this.closest('tr')).data();
		var modal = $('#view-user-modal');
		if(view_items_table !== undefined) {
			view_items_table.destroy();
			modal.find('table:eq(1)').find('tbody').html('');
		}
		modal.find('table:eq(0)').find('td:eq(0)').text(data.ris_no);
		modal.find('table:eq(0)').find('td:eq(1)').text(data.status);
		modal.find('table:eq(0)').find('td:eq(2)').text(data.date_created);
		modal.find('table:eq(0)').find('td:eq(3)').text(data.date_modified);
		$('#view-user-ris-no').text(data.ris_no);

		$.each(data.items, function(index, value){
			modal.find('table:eq(1)').find('tbody').append("<tr>"+
															"<td>"+value.name+"</td>"+
															"<td>"+value.description+"</td>"+
															"<td>"+value.qty+"</td>"+
														"</tr>");
		});
		view_items_table = modal.find('table:eq(1)').DataTable({bLengthChange: false});
		console.log(data);
		modal.modal('show');
	});

	var view_items_table;
	$('#user-rejected-table').on('click', '.view', function(){
		var data = user_rejected_table.row(this.closest('tr')).data();
		var modal = $('#view-user-modal');
		if(view_items_table !== undefined) {
			view_items_table.destroy();
			modal.find('table:eq(1)').find('tbody').html('');
		}
		modal.find('table:eq(0)').find('td:eq(0)').text(data.ris_no);
		modal.find('table:eq(0)').find('td:eq(1)').text(data.status);
		modal.find('table:eq(0)').find('td:eq(2)').text(data.date_created);
		modal.find('table:eq(0)').find('td:eq(3)').text(data.date_modified);
		$('#view-user-ris-no').text(data.ris_no);

		$.each(data.items, function(index, value){
			modal.find('table:eq(1)').find('tbody').append("<tr>"+
															"<td>"+value.name+"</td>"+
															"<td>"+value.description+"</td>"+
															"<td>"+value.qty+"</td>"+
														"</tr>");
		});
		view_items_table = modal.find('table:eq(1)').DataTable({bLengthChange: false});
		console.log(data);
		modal.modal('show');
	});


	var view_items_table;
	$('#user-confirmed-table').on('click', '.view', function(){
		var data = user_confirmed_table.row(this.closest('tr')).data();
		var modal = $('#view-user-modal');
		if(view_items_table !== undefined) {
			view_items_table.destroy();
			modal.find('table:eq(1)').find('tbody').html('');
		}
		modal.find('table:eq(0)').find('td:eq(0)').text(data.ris_no);
		modal.find('table:eq(0)').find('td:eq(1)').text(data.status);
		modal.find('table:eq(0)').find('td:eq(2)').text(data.date_created);
		modal.find('table:eq(0)').find('td:eq(3)').text(data.date_modified);
		$('#view-user-ris-no').text(data.ris_no);

		$.each(data.items, function(index, value){
			modal.find('table:eq(1)').find('tbody').append("<tr>"+
															"<td>"+value.name+"</td>"+
															"<td>"+value.description+"</td>"+
															"<td>"+value.qty+"</td>"+
														"</tr>");
		});
		view_items_table = modal.find('table:eq(1)').DataTable({bLengthChange: false});
		console.log(data);
		modal.modal('show');
	});
