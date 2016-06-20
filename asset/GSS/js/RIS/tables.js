
	var base_url = $('#base_url').val(); 

	var ppmp_table = $('#ppmp-table').DataTable({
						ajax: base_url + 'gss/head/ris/get_ppmp',
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
						ajax: base_url + 'gss/head/ris/user_all_ris',
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
						ajax: base_url + 'gss/head/ris/user_pending_ris',
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
						ajax: base_url + 'gss/head/ris/user_cancelled_ris',
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
						ajax: base_url + 'gss/head/ris/user_rejected_ris',
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
						ajax: base_url + 'gss/head/ris/user_confirmed_ris',
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
						ajax: base_url + 'gss/head/ris/user_completed_ris',
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
						ajax: base_url + 'gss/head/ris/user_incomplete_ris',
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
		$.get(base_url+'/gss/head/ris/last_ris_no').success(function(response){
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
		// 	 $.post(base_url+"/gss/head/sai/save_po", $('form#save_po').serialize(), function(data) {
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
			$.post(base_url+'gss/head/ris/cancel_ris', {id: data.id}, function(){
				location.reload();
			});
		}
	});

	$('#user-pending-table').on('change', '.select-status', function(){
		if($(this).val() === 'cancel'){
			var data = user_pending_table.row($(this).closest('tr')).data();
			$.post(base_url+'gss/head/ris/cancel_ris', {id: data.id}, function(){
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





// ADMIN
	
	var admin_all_table = $('#admin-all-table').DataTable({
						ajax: base_url + 'gss/head/ris/admin_all_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{
											mRender: function(rowData, settings, sourceData){
												return sourceData.firstname+' '+sourceData.middlename+', '+sourceData.lastname;
											}
										},
										{'data': 'modified_by'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												if(sourceData.status === 'pending'){
													return "<select class='form-control select-status' name='status'>"+
																"<option value='pending'>Pending</option>"+
																"<option value='confirm'>Confirm</option>"+
																"<option value='reject'>Reject</option>"+
															"</select>"+
															"<button type='button' class='btn btn-default view'>View</button>"
												}
												if(sourceData.status === 'cancelled'){
													return "<button type='button' class='btn btn-default view'>View</button>";
												}
												if(sourceData.status === 'rejected'){
													return "<button class='btn btn-danger delete'>Delete</button><button type='button' class='btn btn-default view'>View</button>";
												}
												if(sourceData.status === 'confirmed'){
													return "<button class='btn btn-danger dispense'>Dispense</button><button type='button' class='btn btn-default view'>View</button>";
												}
												if(sourceData.status === 'completed'){
													return "<button type='button' class='btn btn-success'>Download</button> <button type='button' class='btn btn-default view'>View</button>";
												}
												if(sourceData.status === 'incomplete'){
													return "<button class='btn btn-info edit-dispense'>Update</button><button type='button' class='btn btn-default view'>View</button>";
												}
											}
										},
									],
					});

	var admin_pending_table = $('#admin-pending-table').DataTable({
						ajax: base_url + 'gss/head/ris/admin_pending_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{
											mRender: function(rowData, settings, sourceData){
												return sourceData.firstname+' '+sourceData.middlename+', '+sourceData.lastname;
											}
										},
										{'data': 'modified_by'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
													return "<select class='form-control select-status' name='status'>"+
																"<option value='pending'>Pending</option>"+
																"<option value='confirm'>Confirm</option>"+
																"<option value='reject'>Reject</option>"+
															"</select>"+
															"<button type='button' class='btn btn-default view'>View</button>"
											}
										},
									],
					});

	var admin_rejected_table = $('#admin-rejected-table').DataTable({
						ajax: base_url + 'gss/head/ris/admin_rejected_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{
											mRender: function(rowData, settings, sourceData){
												return sourceData.firstname+' '+sourceData.middlename+', '+sourceData.lastname;
											}
										},
										{'data': 'modified_by'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<button class='btn btn-danger delete'>Delete</button> <button type='button' class='btn btn-default view'>View</button>";
											}
										},
									],
					});

	var admin_confirmed_table = $('#admin-confirmed-table').DataTable({
						ajax: base_url + 'gss/head/ris/admin_confirmed_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{
											mRender: function(rowData, settings, sourceData){
												return sourceData.firstname+' '+sourceData.middlename+', '+sourceData.lastname;
											}
										},
										{'data': 'modified_by'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<button class='btn btn-danger dispense'>Dispense</button><button type='button' class='btn btn-default view'>View</button>";
											}
										},
									],
					});

	var admin_completed_table = $('#admin-completed-table').DataTable({
						ajax: base_url + 'gss/head/ris/admin_completed_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{
											mRender: function(rowData, settings, sourceData){
												return sourceData.firstname+' '+sourceData.middlename+', '+sourceData.lastname;
											}
										},
										{'data': 'modified_by'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<button type='button' class='btn btn-success'>Download</button> <button type='button' class='btn btn-default view'>View</button>";
											}
										},
									],
					});

	var admin_incomplete_table = $('#admin-incomplete-table').DataTable({
						ajax: base_url + 'gss/head/ris/admin_incomplete_ris',
						columns: [
										{'data': 'ris_no'},
										{'data': 'status'},
										{
											mRender: function(rowData, settings, sourceData){
												return sourceData.firstname+' '+sourceData.middlename+', '+sourceData.lastname;
											}
										},
										{'data': 'modified_by'},
										{'data': 'date_created'},
										{
											mRender: function(rowData, settings, sourceData){
												return "<button class='btn btn-info edit-dispense'>Update</button><button type='button' class='btn btn-default view'>View</button>";
											}
										},
									],
					});

	$('#admin-all-table').on('change', '.select-status', function(){
		if($(this).val() === 'confirm'){
			var data = admin_all_table.row($(this).closest('tr')).data();
			$.post(base_url+'gss/head/ris/confirm_ris', {id: data.ris_id}, function(){
				location.reload();
			});
		}

		if($(this).val() === 'reject'){
			var data = admin_all_table.row($(this).closest('tr')).data();
			$.post(base_url+'gss/head/ris/reject_ris', {id: data.ris_id}, function(){
				location.reload();
			});
		}

	});

	$('#admin-pending-table').on('change', '.select-status', function(){
		if($(this).val() === 'confirm'){
			var data = user_pending_table.row($(this).closest('tr')).data();
			$.post(base_url+'gss/head/ris/confirm_ris', {id: data.id}, function(){
				location.reload();
			});
		}

		if($(this).val() === 'reject'){
			var data = user_pending_table.row($(this).closest('tr')).data();
			$.post(base_url+'gss/head/ris/reject_ris', {id: data.id}, function(){
				location.reload();
			});
		}

	});

	var view_items_table;
	$('#admin-all-table').on('click', '.view', function(){
		var data = admin_all_table.row(this.closest('tr')).data();
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

	$('#admin-completed-table').on('click', '.view', function(){
		var data = admin_completed_table.row(this.closest('tr')).data();
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
	$('#admin-pending-table').on('click', '.view', function(){
		var data = admin_pending_table.row(this.closest('tr')).data();
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
	$('#admin-rejected').on('click', '.view', function(){
		var data = admin_rejected_table.row(this.closest('tr')).data();
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

	$('#admin-confirmed').on('click', '.view', function(){
		var data = admin_confirmed_table.row(this.closest('tr')).data();
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
	$('#admin-confirmed-table').on('click', '.dispense', function(){
		var data = admin_confirmed_table.row($(this).closest('tr')).data();
		var modal = $('#dispense-modal');

		modal.find('input[name=ris_no]').val(data.ris_no);
		//modal.find('input[name=ris_id]').val(data.);
		modal.find('table').find('tbody').html("");
		$.each(data.items, function(index, value){
			modal.find('table').find('tbody').append(
												"<tr>"+
													"<td>"+value.name+"</td>"+
													"<td>"+value.description+"</td>"+
													"<td style='width: 200px;'>"+
														"<div class='input-group'>"+
															"<input class='form-control' type='number' value='0' max='"+value.qty+"' readonly style='float: left;' required >"+
															"<span class='input-group-addon'>/ "+value.qty+"</span>"+
														"</div>"+
													"<td>"+
													"<input type='hidden' name='max_qty[]' value='"+value.qty+"'>"+
													"<label><input type='checkbox' name='item_id[]' value='"+value.id+"'></label>"+
													"</td>"+
												"</tr>"
									);
		});
		
		modal.modal('show');
	});

	$('#admin-all-table').on('click', '.dispense', function(){
		var data = admin_all_table.row($(this).closest('tr')).data();
		var modal = $('#dispense-modal');

		modal.find('input[name=ris_no]').val(data.ris_no);
		//modal.find('input[name=ris_id]').val(data.);
		modal.find('table').find('tbody').html("");
		$.each(data.items, function(index, value){
			modal.find('table').find('tbody').append(
												"<tr>"+
													"<td>"+value.name+"</td>"+
													"<td>"+value.description+"</td>"+
													"<td style='width: 200px;'>"+
														"<div class='input-group'>"+
															"<input class='form-control' type='number' value='0' max='"+value.qty+"' readonly style='float: left;' required >"+
															"<span class='input-group-addon'>/ "+value.qty+"</span>"+
														"</div>"+
													"<td>"+
													"<input type='hidden' name='max_qty[]' value='"+value.qty+"'>"+
													"<label><input type='checkbox' name='item_id[]' value='"+value.id+"'></label>"+
													"</td>"+
												"</tr>"
									);
		});
		
		modal.modal('show');
	});
	$('#admin-incomplete-table').on('click', '.edit-dispense', function(){
		var data = admin_incomplete_table.row($(this).closest('tr')).data();
		var modal = $('#edit-dispense-modal');

		modal.find('input[name=ris_no]').val(data.ris_no);
		modal.find('input[name=ris_id]').val(data.id);
		modal.find('table').find('tbody').html("");
		$.each(data.items, function(index, value){
			modal.find('table').find('tbody').append(
												"<tr>"+
													"<td>"+value.name+"</td>"+
													"<td>"+value.description+"</td>"+
													"<td style='width: 200px;'>"+
														"<div class='input-group'>"+
															"<input class='form-control' type='number' value='0' max='"+(value.qty - value.dispense_qty)+"' readonly style='float: left;' required >"+
															"<span class='input-group-addon'>/ "+(value.qty - value.dispense_qty)+"</span>"+
														"</div>"+
													"<td>"+
													"<input type='hidden' name='max_qty[]' value='"+(value.qty - value.dispense_qty)+"'>"+
													"<label><input type='checkbox' name='item_id[]' value='"+value.id+"'></label>"+
													"</td>"+
												"</tr>"
									);
		});
		
		modal.modal('show');
	});
	$('#dispense-modal').on('click', 'input[name*=item_id]', function(index, value){
		if($(this).is(':checked')){
			var max_qty = $(this).closest('tr').find('input[name*=max_qty]').val();
			$(this).closest('tr').find('input[type=number]').attr('name', 'item_qty[]');
			$(this).closest('tr').find('input[type=number]').val(max_qty);
			$(this).closest('tr').find('input[type=number]').attr('min', '1');
			$(this).closest('tr').find('input[type=number]').removeAttr('readonly');
		}else{
			$(this).closest('tr').find('input[type=number]').removeAttr('name');
			$(this).closest('tr').find('input[type=number]').attr('min', '0');
			$(this).closest('tr').find('input[type=number]').val(0);
			$(this).closest('tr').find('input[type=number]').attr('readonly', true);
		}
	});
	$('#edit-dispense-modal').on('click', 'input[name*=item_id]', function(index, value){
		if($(this).is(':checked')){
			var max_qty = $(this).closest('tr').find('input[name*=max_qty]').val();
			$(this).closest('tr').find('input[type=number]').attr('name', 'item_qty[]');
			$(this).closest('tr').find('input[type=number]').val(max_qty);
			$(this).closest('tr').find('input[type=number]').attr('min', '1');
			$(this).closest('tr').find('input[type=number]').removeAttr('readonly');
		}else{
			$(this).closest('tr').find('input[type=number]').removeAttr('name');
			$(this).closest('tr').find('input[type=number]').attr('min', '0');
			$(this).closest('tr').find('input[type=number]').val(0);
			$(this).closest('tr').find('input[type=number]').attr('readonly', true);
		}
	});
	$('#dispense-modal').on('click', 'input[name=all_qty]', function(index, value){
		var checkboxes = $('#dispense-modal').find('input[name*=item_id]');

		if($(this).is(':checked')){
			$.each(checkboxes, function(index, value){
				if(!($(this).is(':checked'))){
					$(this).trigger('click');
				}
			});
		}else{
			$.each(checkboxes, function(index, value){
				if($(this).is(':checked')){
					$(this).trigger('click');
				}
			});
		}

	});
	$('#edit-dispense-modal').on('click', 'input[name=all_qty]', function(index, value){
		var checkboxes = $('#edit-dispense-modal').find('input[name*=item_id]');

		if($(this).is(':checked')){
			$.each(checkboxes, function(index, value){
				if(!($(this).is(':checked'))){
					$(this).trigger('click');
				}
			});
		}else{
			$.each(checkboxes, function(index, value){
				if($(this).is(':checked')){
					$(this).trigger('click');
				}
			});
		}

	});
	
	$('#admin-all-table').on('click', '.delete', function(index, value){
		var data = admin_all_table.row(this.closest('tr')).data();
		$.post(base_url+"/gss/head/ris/post_delete_ris", {id: data.ris_no, status:'rejected'}).done(function(){
			location.reload();
		});
	});
	
	$('#admin-rejected-table').on('click', '.delete', function(index, value){
		var data = admin_rejected_table.row(this.closest('tr')).data();
		$.post(base_url+"/gss/head/ris/post_delete_ris", {id: data.ris_no, status:'rejected'}).done(function(){
			location.reload();
		});
	});