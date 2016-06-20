var initTables = function(scope, compile){
	var base_url = $('#base_url').val(); 
	var all_table = $('#all-table').DataTable({
		ajax: base_url+"/gss/head/po/all_po",
		columns: [
					{'data': 'po_no'},
					{'data': 'status'},
					{'data': 'user_name'},
					{'data': 'date_created'},
					{'data': 'date_modified'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							if(rowData.status == "completed"){
								return  "<a class='btn btn-success' href='"+base_url+"/gss/head/po/po_print2?code="+rowData.po_no+"' target='output'>Download</a>"+
												"<button type='button' class='btn btn-danger delete-po-co'>Delete</button> "+
												"<button type='button' class='btn btn-default view-po'>View</button>";
							}else if(rowData.status == "pending"){
								return "<select class='form-control cancel-po'>"+
										"<option value='pending'>Pending</option>"+
										"<option value='cancel'>Cancel</option>"+
									"</select>"+
									"<button type='button' class='btn btn-default view-po'>View</button>";
							}else if(rowData.status == "confirmed"){
								return  "<a class='btn btn-success' href='"+base_url+"/gss/head/po/po_print2?code="+rowData.po_no+"' target='output'>Download</a>"+
										"<button type='button' class='btn btn-default view-po'>View</button>";
							}else if(rowData.status == "rejected"){
								return "<button type='button' class='btn btn-default view-po'>View</button>";
							}else if(rowData.status == "draft"){
								return "<button type='button' class='btn btn-warning edit-po'>Edit</button>";
							}else if(rowData.status == "cancelled"){
								return "<button type='button' class='btn btn-danger delete-po-ca'>Delete</button> "+
									"<button type='button' class='btn btn-default view-po'>View</button>";
							}
						}
					}
				],
		columnDefs: [{targets: 4, 'width': '200px'}],

	});
	var pending_table = $('#pending-table').DataTable({
		ajax: base_url+"/gss/head/po/pending_po",
		columns: [
					{'data': 'po_no'},
					{'data': 'user_name'},
					{'data': 'date_created'},
					{'data': 'date_modified'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<select class='form-control cancel-po'>"+
										"<option value='pending'>Pending</option>"+
										"<option value='cancel'>Cancel</option>"+
									"</select>"+
									"<button type='button' class='btn btn-default view-po'>View</button>";
						}
					}
				],
		columnDefs: [{targets: 3, 'width': '200px'}],

	});
	var completed_table = $('#completed-table').DataTable({
		ajax: base_url+"/gss/head/po/completed_po",
		columns: [
					{'data': 'po_no'},
					{'data': 'user_name'},
					{'data': 'date_created'},
					{'data': 'date_modified'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return  "<a class='btn btn-success' href='"+base_url+"/gss/head/po/po_print2?code="+rowData.po_no+"' target='output'>Download</a>"+
											"<button type='button' class='btn btn-danger delete-po'>Delete</button> "+
											"<button type='button' class='btn btn-default view-po'>View</button>";
						}
					}
				],
		columnDefs: [{targets: 3, 'width': '200px'}],

	});
	var confirmed_table = $('#confirmed-table').DataTable({
		ajax: base_url+"/gss/head/po/confirmed_po",
		columns: [
					{'data': 'po_no'},
					{'data': 'user_name'},
					{'data': 'date_created'},
					{'data': 'date_modified'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return  "<a class='btn btn-success' href='"+base_url+"/gss/head/po/po_print2?code="+rowData.po_no+"' target='output'>Download</a>"+
									"<button type='button' class='btn btn-default view-po'>View</button>";
						}
					}
				],

	});
	var rejected_table = $('#rejected-table').DataTable({
		ajax: base_url+"/gss/head/po/rejected_po",
		columns: [
					{'data': 'po_no'},
					{'data': 'user_name'},
					{'data': 'date_created'},
					{'data': 'date_modified'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<button type='button' class='btn btn-default view-po'>View</button>";
						}
					}
				],

	});
	var draft_table = $('#draft-table').DataTable({
		ajax: base_url+"/gss/head/po/draft_po",
		columns: [
					{'data': 'po_no'},
					{'data': 'user_name'},
					{'data': 'date_created'},
					{'data': 'date_modified'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<button type='button' class='btn btn-warning edit-po'>Edit</button>";
						}
					}
				],
	});
	var cancelled_table = $('#cancelled-table').DataTable({
		ajax: base_url+"/gss/head/po/cancelled_po",
		columns: [
					{'data': 'po_no'},
					{'data': 'user_name'},
					{'data': 'date_created'},
					{'data': 'date_modified'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<button type='button' class='btn btn-danger delete-po'>Delete</button> "+
									"<button type='button' class='btn btn-default view-po'>View</button>";
						}
					}
				],
	});

	$('#generate-po-btn').click(function(){
		$('input[type=file]').val('');
		$('#generate-po-modal').modal({backdrop: 'static', keybaord: false});
		$('#generate-po-modal').modal('show');
	});
	$('#add-item-btn').click(function(){
		$('#inventory-item-modal').modal('show');
	});
	$('.show-draft-modal').click(function () {
		$('#draft-modal').modal('show');
	});
	$('#pending-table').on('change', '.cancel-po', function(){
		var data = pending_table.row(this.closest('tr')).data();
		if($(this).val() === 'cancel'){
			$(this).attr('disabled', true);
			$.post(base_url+"/gss/head/po/post_cancel_po", {id: data.id}).done(function(){
				location.reload();
			});
		}
	});
	$('#all-table').on('change', '.cancel-po', function(){
		var data = all_table.row(this.closest('tr')).data();
		if($(this).val() === 'cancel'){
			$(this).attr('disabled', true);
			$.post(base_url+"/gss/head/po/post_cancel_po", {id: data.id}).done(function(){
				location.reload();
			});
		}
	});
	$('#draft-table').on('click', '.edit-po', function(){
		var data = draft_table.row(this.closest('tr')).data();
		scope.$apply(function(){
			$.each(data.items, function(index, value){
				if(jQuery.inArray(data.items[index]['filename'],scope.filenames) > -1){
				}else{
					scope.filenames.push(data.items[index]['filename']);
					scope.files.push([]);
				}
				var i = jQuery.inArray(data.items[index]['filename'],scope.filenames);
				scope.files[i].push(data.items[index]);
			});
			scope.calculateTotal();
			$('input[name="total_files"').val(scope.filenames.length);
		});
		$('#edit-po-modal-po_no').val(data.po_no);
		$('#edit-po-modal-po_date_created').val(data.date_created);
		$('#edit-po-modal-po_id').val(data.id);
		
		$('#edit-po-modal-supplier').val(data.supplier);
		$('#edit-po-modal-address').val(data.address);
		$('#edit-po-modal-tin').val(data.tin);
		$('#edit-po-modal-purpose').val(data.purpose);
		$('#edit-po-modal-mode').val(data.mode);
		$('#edit-po-modal-source').val(data.source);
		$('#edit-po-modal-pdelivery').val(data.pdelivery);
		$('#edit-po-modal-ddelivery').val(data.ddelivery);
		$('#edit-po-modal-dterm').val(data.dterm);
		$('#edit-po-modal-pterm').val(data.pterm);
		$('#edit-po-modal-sign').val(data.sign);
		$('#edit-po-modal-signby').val(data.signby);
		$('#edit-po-modal').modal({backdrop: 'static', keybaord: false});
		$('#edit-po-modal').modal('show');
	});
	$('#all-table').on('click', '.edit-po', function(){
		var data = all_table.row(this.closest('tr')).data();
		scope.$apply(function(){
			$.each(data.items, function(index, value){
				if(jQuery.inArray(data.items[index]['filename'],scope.filenames) > -1){
				}else{
					scope.filenames.push(data.items[index]['filename']);
					scope.files.push([]);
				}
				var i = jQuery.inArray(data.items[index]['filename'],scope.filenames);
				scope.files[i].push(data.items[index]);
			});
			scope.calculateTotal();
			$('input[name="total_files"').val(scope.filenames.length);
		});
		$('#edit-po-modal-po_no').val(data.po_no);
		$('#edit-po-modal-po_date_created').val(data.date_created);
		$('#edit-po-modal-po_id').val(data.id);
		
		$('#edit-po-modal-supplier').val(data.supplier);
		$('#edit-po-modal-address').val(data.address);
		$('#edit-po-modal-tin').val(data.tin);
		$('#edit-po-modal-purpose').val(data.purpose);
		$('#edit-po-modal-mode').val(data.mode);
		$('#edit-po-modal-source').val(data.source);
		$('#edit-po-modal-pdelivery').val(data.pdelivery);
		$('#edit-po-modal-ddelivery').val(data.ddelivery);
		$('#edit-po-modal-dterm').val(data.dterm);
		$('#edit-po-modal-pterm').val(data.pterm);
		$('#edit-po-modal-sign').val(data.sign);
		$('#edit-po-modal-signby').val(data.signby);
		$('#edit-po-modal').modal({backdrop: 'static', keybaord: false});
		$('#edit-po-modal').modal('show');
	});
	$('tbody').on('click', '.remove_curent_item', function(){
		$(this).closest('tr').remove();
	});
	$('#edit-item-btn').click(function(){
		$('#inventory-item-modal').modal('show');
	});
	$('.show-draft-modal-edit').click(function(){
		$('#draft-modal-edit').modal('show');
	});
	$('#pending-table').on('click', '.view-po', function(){
		$('#view-po-items').html('');
		$('#view-po-modal .modal-footer').html('');
		var data = pending_table.row(this.closest('tr')).data();
		$('#view-po-po_no').html(data.po_no);
		$('#view-po-date_created').html(data.date_created);
		$('#view-po-status').html(data.status);
		var firstChar = data.status.charAt(0);
        var remainingStr = data.status.slice(1);
        var status = firstChar.toUpperCase() + remainingStr;
				var statusArray = [data.date_modified,data.source,data.supplier,data.purpose,data.iar_status,data.address,data.tin,data.mode,data.pdelivery,data.ddelivery,data.dterm,data.pterm,data.sign,data.modified_by,data.signby];
				var statusStr = [];
				for(var i=0;i<statusArray.length;i++){
					if((statusArray[i] == "") || (statusArray[i] == null) || (statusArray[i] == "0000-00-00")){
						statusStr[i] = "N/A";
					}else{
						statusStr[i] = statusArray[i];
					}
				}
		$("#view-po-status-by").html("<label style='color: #D00D0D'>"+status+" By:</label>");
		$('#view-po-date_modified').html(statusStr[0]);
		$('#view-po-source').html(statusStr[1]);
		$('#view-po-supplier').html(statusStr[2]);
		$('#view-po-purpose').html(statusStr[3]);
		$('#view-po-address').html(statusStr[5]);
		$('#view-po-tin').html(statusStr[6]);
		$('#view-po-mode').html(statusStr[7]);
		$('#view-po-pdelivery').html(statusStr[8]);
		$('#view-po-ddelivery').html(statusStr[9]);
		$('#view-po-dterm').html(statusStr[10]);
		$('#view-po-pterm').html(statusStr[11]);
		$('#view-po-sign').html(statusStr[12]);
		$('#view-po-signby').html(statusStr[14]);
		$('#view-po-iar_status').html(statusStr[4]);
		$('#view-po-created_by').html(data.user_name);
		$('#view-po-statusby').html(statusStr[13]);
		var total = 0;
		var filename = "";
		$.each(data.items, function(index, value){
			if(value.filename != filename){
				filename=value.filename;
				$('#view-po-items').append("<thead><th style='padding-bottom:20px;padding-top:20px;'>From "+value.filename+" file:</th></thead>");
			}
			$('#view-po-items').append("<tr>"+
											"<td>"+value.code+"</td>"+
						            		"<td>"+value.name+"</td>"+
						            		"<td>"+value.description+"</td>"+
						            		"<td>"+value.qty+"</td>"+
											"<td class='text-right'>"+value.unit+"</td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.unit_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.total_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
											"<td>"+value.item_type+"</td>"+
										"</tr>");
			total = total + parseFloat(value.total_cost);
		});
		$('#view-po-modal .modal-footer').append("<h4><b class='pull-left'>Total Amount: &#8369;<u> "+parseFloat(total).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</u></b></h4><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>");
		$('#view-po-modal').modal('show');
	});
	$('#rejected-table').on('click', '.view-po', function(){
		$('#view-po-items').html('');
		$('#view-po-modal .modal-footer').html('');
		var data = rejected_table.row(this.closest('tr')).data();
		$('#view-po-po_no').html(data.po_no);
		$('#view-po-date_created').html(data.date_created);
		$('#view-po-status').html(data.status);
		var firstChar = data.status.charAt(0);
        var remainingStr = data.status.slice(1);
        var status = firstChar.toUpperCase() + remainingStr;
				var statusArray = [data.date_modified,data.source,data.supplier,data.purpose,data.iar_status,data.address,data.tin,data.mode,data.pdelivery,data.ddelivery,data.dterm,data.pterm,data.sign,data.modified_by,data.signby];
				var statusStr = [];
				for(var i=0;i<statusArray.length;i++){
					if((statusArray[i] == "") || (statusArray[i] == null) || (statusArray[i] == "0000-00-00")){
						statusStr[i] = "N/A";
					}else{
						statusStr[i] = statusArray[i];
					}
				}
		$("#view-po-status-by").html("<label style='color: #D00D0D'>"+status+" By:</label>");
		$('#view-po-date_modified').html(statusStr[0]);
		$('#view-po-source').html(statusStr[1]);
		$('#view-po-supplier').html(statusStr[2]);
		$('#view-po-purpose').html(statusStr[3]);
		$('#view-po-address').html(statusStr[5]);
		$('#view-po-tin').html(statusStr[6]);
		$('#view-po-mode').html(statusStr[7]);
		$('#view-po-pdelivery').html(statusStr[8]);
		$('#view-po-ddelivery').html(statusStr[9]);
		$('#view-po-dterm').html(statusStr[10]);
		$('#view-po-pterm').html(statusStr[11]);
		$('#view-po-sign').html(statusStr[12]);
		$('#view-po-signby').html(statusStr[14]);
		$('#view-po-iar_status').html(statusStr[4]);
		$('#view-po-created_by').html(data.user_name);
		$('#view-po-statusby').html(statusStr[13]);
		var total = 0;
		var filename = "";
		$.each(data.items, function(index, value){
			if(value.filename != filename){
				filename=value.filename;
				$('#view-po-items').append("<thead><th style='padding-bottom:20px;padding-top:20px;'>From "+value.filename+" file:</th></thead>");
			}
			$('#view-po-items').append("<tr>"+
											"<td>"+value.code+"</td>"+
						            		"<td>"+value.name+"</td>"+
						            		"<td>"+value.description+"</td>"+
						            		"<td>"+value.qty+"</td>"+
											"<td class='text-right'>"+value.unit+"</td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.unit_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.total_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
											"<td>"+value.item_type+"</td>"+
										"</tr>");
			total = total + parseFloat(value.total_cost);
		});
		$('#view-po-modal .modal-footer').append("<h4><b class='pull-left'>Total Amount: &#8369;<u> "+parseFloat(total).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</u></b></h4><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>");
		$('#view-po-modal').modal('show');
	});
	$('#confirmed-table').on('click', '.view-po', function(){
		$('#view-po-items').html('');
		$('#view-po-modal .modal-footer').html('');
		var data = confirmed_table.row(this.closest('tr')).data();
		$('#view-po-po_no').html(data.po_no);
		$('#view-po-date_created').html(data.date_created);
		$('#view-po-status').html(data.status);
		var firstChar = data.status.charAt(0);
        var remainingStr = data.status.slice(1);
        var status = firstChar.toUpperCase() + remainingStr;
				var statusArray = [data.date_modified,data.source,data.supplier,data.purpose,data.iar_status,data.address,data.tin,data.mode,data.pdelivery,data.ddelivery,data.dterm,data.pterm,data.sign,data.modified_by,data.signby];
				var statusStr = [];
				for(var i=0;i<statusArray.length;i++){
					if((statusArray[i] == "") || (statusArray[i] == null) || (statusArray[i] == "0000-00-00")){
						statusStr[i] = "N/A";
					}else{
						statusStr[i] = statusArray[i];
					}
				}
		$("#view-po-status-by").html("<label style='color: #D00D0D'>"+status+" By:</label>");
		$('#view-po-date_modified').html(statusStr[0]);
		$('#view-po-source').html(statusStr[1]);
		$('#view-po-supplier').html(statusStr[2]);
		$('#view-po-purpose').html(statusStr[3]);
		$('#view-po-address').html(statusStr[5]);
		$('#view-po-tin').html(statusStr[6]);
		$('#view-po-mode').html(statusStr[7]);
		$('#view-po-pdelivery').html(statusStr[8]);
		$('#view-po-ddelivery').html(statusStr[9]);
		$('#view-po-dterm').html(statusStr[10]);
		$('#view-po-pterm').html(statusStr[11]);
		$('#view-po-sign').html(statusStr[12]);
		$('#view-po-signby').html(statusStr[14]);
		$('#view-po-iar_status').html(statusStr[4]);
		$('#view-po-created_by').html(data.user_name);
		$('#view-po-statusby').html(statusStr[13]);
		var total = 0;
		var filename = "";
		$.each(data.items, function(index, value){
			if(value.filename != filename){
				filename=value.filename;
				$('#view-po-items').append("<thead><th style='padding-bottom:20px;padding-top:20px;'>From "+value.filename+" file:</th></thead>");
			}
			$('#view-po-items').append("<tr>"+
											"<td>"+value.code+"</td>"+
						            		"<td>"+value.name+"</td>"+
						            		"<td>"+value.description+"</td>"+
						            		"<td>"+value.qty+"</td>"+
											"<td class='text-right'>"+value.unit+"</td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.unit_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.total_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
											"<td>"+value.item_type+"</td>"+
										"</tr>");
			total = total + parseFloat(value.total_cost);
		});
		$('#view-po-modal .modal-footer').append("<h4><b class='pull-left'>Total Amount: &#8369;<u> "+parseFloat(total).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</u></b></h4><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>");
		$('#view-po-modal').modal('show');
	});
	$('#cancelled-table').on('click', '.delete-po', function(){
		var data = cancelled_table.row(this.closest('tr')).data();
		$.post(base_url+"/gss/head/po/post_delete_po", {id: data.id, status:'cancelled'}).done(function(){
			location.reload();
		});
	});
	$('#all-table').on('click', '.delete-po-ca', function(){
		var data = all_table.row(this.closest('tr')).data();
		$.post(base_url+"/gss/head/po/post_delete_po", {id: data.id, status:'cancelled'}).done(function(){
			location.reload();
		});
	});
	$('#all-table').on('click', '.delete-po-co', function(){
		var data = all_table.row(this.closest('tr')).data();
		$.post(base_url+"/gss/head/po/post_delete_po", {id: data.id, status:'completed'}).done(function(){
			location.reload();
		});
	});
	$('#completed-table').on('click', '.delete-po', function(){
		var data = all_table.row(this.closest('tr')).data();
		$.post(base_url+"/gss/head/po/post_delete_po", {id: data.id, status:'completed'}).done(function(){
			location.reload();
		});
	});
	$('#cancelled-table').on('click', '.view-po', function(){
		$('#view-po-items').html('');
		$('#view-po-modal .modal-footer').html('');
		var data = cancelled_table.row(this.closest('tr')).data();
		$('#view-po-po_no').html(data.po_no);
		$('#view-po-date_created').html(data.date_created);
		$('#view-po-status').html(data.status);
		var firstChar = data.status.charAt(0);
        var remainingStr = data.status.slice(1);
        var status = firstChar.toUpperCase() + remainingStr;
				var statusArray = [data.date_modified,data.source,data.supplier,data.purpose,data.iar_status,data.address,data.tin,data.mode,data.pdelivery,data.ddelivery,data.dterm,data.pterm,data.sign,data.modified_by,data.signby];
				var statusStr = [];
				for(var i=0;i<statusArray.length;i++){
					if((statusArray[i] == "") || (statusArray[i] == null) || (statusArray[i] == "0000-00-00")){
						statusStr[i] = "N/A";
					}else{
						statusStr[i] = statusArray[i];
					}
				}
		$("#view-po-status-by").html("<label style='color: #D00D0D'>"+status+" By:</label>");
		$('#view-po-date_modified').html(statusStr[0]);
		$('#view-po-source').html(statusStr[1]);
		$('#view-po-supplier').html(statusStr[2]);
		$('#view-po-purpose').html(statusStr[3]);
		$('#view-po-address').html(statusStr[5]);
		$('#view-po-tin').html(statusStr[6]);
		$('#view-po-mode').html(statusStr[7]);
		$('#view-po-pdelivery').html(statusStr[8]);
		$('#view-po-ddelivery').html(statusStr[9]);
		$('#view-po-dterm').html(statusStr[10]);
		$('#view-po-pterm').html(statusStr[11]);
		$('#view-po-sign').html(statusStr[12]);
		$('#view-po-signby').html(statusStr[14]);
		$('#view-po-iar_status').html(statusStr[4]);
		$('#view-po-created_by').html(data.user_name);
		$('#view-po-statusby').html(statusStr[13]);
		var total = 0;
		var filename = "";
		$.each(data.items, function(index, value){
			if(value.filename != filename){
				filename=value.filename;
				$('#view-po-items').append("<thead><th style='padding-bottom:20px;padding-top:20px;'>From "+value.filename+" file:</th></thead>");
			}
			$('#view-po-items').append("<tr>"+
											"<td>"+value.code+"</td>"+
						            		"<td>"+value.name+"</td>"+
						            		"<td>"+value.description+"</td>"+
						            		"<td>"+value.qty+"</td>"+
											"<td>"+value.unit+"</td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.unit_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.total_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
											"<td>"+value.item_type+"</td>"+
										"</tr>");
			total = total + parseFloat(value.total_cost);
		});
		$('#view-po-modal .modal-footer').append("<h4><b class='pull-left'>Total Amount: &#8369;<u> "+parseFloat(total).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</u></b></h4><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>");
		$('#view-po-modal').modal('show');
	});
	$('#all-table').on('click', '.view-po', function(){
		$('#view-po-items').html('');
		$('#view-po-modal .modal-footer').html('');
		var data = all_table.row(this.closest('tr')).data();
		$('#view-po-po_no').html(data.po_no);
		$('#view-po-date_created').html(data.date_created);
		$('#view-po-status').html(data.status);
		var firstChar = data.status.charAt(0);
        var remainingStr = data.status.slice(1);
        var status = firstChar.toUpperCase() + remainingStr;
				var statusArray = [data.date_modified,data.source,data.supplier,data.purpose,data.iar_status,data.address,data.tin,data.mode,data.pdelivery,data.ddelivery,data.dterm,data.pterm,data.sign,data.modified_by,data.signby];
				var statusStr = [];
				for(var i=0;i<statusArray.length;i++){
					if((statusArray[i] == "") || (statusArray[i] == null) || (statusArray[i] == "0000-00-00")){
						statusStr[i] = "N/A";
					}else{
						statusStr[i] = statusArray[i];
					}
				}
		$("#view-po-status-by").html("<label style='color: #D00D0D'>"+status+" By:</label>");
		$('#view-po-date_modified').html(statusStr[0]);
		$('#view-po-source').html(statusStr[1]);
		$('#view-po-supplier').html(statusStr[2]);
		$('#view-po-purpose').html(statusStr[3]);
		$('#view-po-address').html(statusStr[5]);
		$('#view-po-tin').html(statusStr[6]);
		$('#view-po-mode').html(statusStr[7]);
		$('#view-po-pdelivery').html(statusStr[8]);
		$('#view-po-ddelivery').html(statusStr[9]);
		$('#view-po-dterm').html(statusStr[10]);
		$('#view-po-pterm').html(statusStr[11]);
		$('#view-po-sign').html(statusStr[12]);
		$('#view-po-signby').html(statusStr[14]);
		$('#view-po-iar_status').html(statusStr[4]);
		$('#view-po-created_by').html(data.user_name);
		$('#view-po-statusby').html(statusStr[13]);
		var total = 0;
		var filename = "";
		$.each(data.items, function(index, value){
			if(value.filename != filename){
				filename=value.filename;
				$('#view-po-items').append("<thead><th style='padding-bottom:20px;padding-top:20px;'>From "+value.filename+" file:</th></thead>");
			}
			$('#view-po-items').append("<tr>"+
											"<td>"+value.code+"</td>"+
						            		"<td>"+value.name+"</td>"+
						            		"<td>"+value.description+"</td>"+
						            		"<td>"+value.qty+"</td>"+
											"<td class='text-right'>"+value.unit+"</td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.unit_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.total_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
											"<td>"+value.item_type+"</td>"+
										"</tr>");
			total = total + parseFloat(value.total_cost);
		});
		$('#view-po-modal .modal-footer').append("<h4><b class='pull-left'>Total Amount: &#8369;<u> "+parseFloat(total).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</u></b></h4><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>");
		$('#view-po-modal').modal('show');
	});
	$('#completed-table').on('click', '.view-po', function(){
		$('#view-po-items').html('');
		$('#view-po-modal .modal-footer').html('');
		var data = completed_table.row(this.closest('tr')).data();
		$('#view-po-po_no').html(data.po_no);
		$('#view-po-date_created').html(data.date_created);
		$('#view-po-status').html(data.status);
		var firstChar = data.status.charAt(0);
        var remainingStr = data.status.slice(1);
        var status = firstChar.toUpperCase() + remainingStr;
				var statusArray = [data.date_modified,data.source,data.supplier,data.purpose,data.iar_status,data.address,data.tin,data.mode,data.pdelivery,data.ddelivery,data.dterm,data.pterm,data.sign,data.modified_by,data.signby];
				var statusStr = [];
				for(var i=0;i<statusArray.length;i++){
					if((statusArray[i] == "") || (statusArray[i] == null) || (statusArray[i] == "0000-00-00")){
						statusStr[i] = "N/A";
					}else{
						statusStr[i] = statusArray[i];
					}
				}
		$("#view-po-status-by").html("<label style='color: #D00D0D'>"+status+" By:</label>");
		$('#view-po-date_modified').html(statusStr[0]);
		$('#view-po-source').html(statusStr[1]);
		$('#view-po-supplier').html(statusStr[2]);
		$('#view-po-purpose').html(statusStr[3]);
		$('#view-po-address').html(statusStr[5]);
		$('#view-po-tin').html(statusStr[6]);
		$('#view-po-mode').html(statusStr[7]);
		$('#view-po-pdelivery').html(statusStr[8]);
		$('#view-po-ddelivery').html(statusStr[9]);
		$('#view-po-dterm').html(statusStr[10]);
		$('#view-po-pterm').html(statusStr[11]);
		$('#view-po-sign').html(statusStr[12]);
		$('#view-po-signby').html(statusStr[14]);
		$('#view-po-iar_status').html(statusStr[4]);
		$('#view-po-created_by').html(data.user_name);
		$('#view-po-statusby').html(statusStr[13]);
		var total = 0;
		var filename = "";
		$.each(data.items, function(index, value){
			if(value.filename != filename){
				filename=value.filename;
				$('#view-po-items').append("<thead><th style='padding-bottom:20px;padding-top:20px;'>From "+value.filename+" file:</th></thead>");
			}
			$('#view-po-items').append("<tr>"+
											"<td>"+value.code+"</td>"+
						            		"<td>"+value.name+"</td>"+
						            		"<td>"+value.description+"</td>"+
						            		"<td>"+value.qty+"</td>"+
											"<td class='text-right'>"+value.unit+"</td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.unit_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
						            		"<td class='text-right'><div class='input-group'><span class='input-group-addon' style='border: none; background: transparent;font-size:18px;'>&#8369;</span>"+
											parseFloat(value.total_cost).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</div></td>"+
											"<td>"+value.item_type+"</td>"+
										"</tr>");
			total = total + parseFloat(value.total_cost);
		});
		$('#view-po-modal .modal-footer').append("<h4><b class='pull-left'>Total Amount: &#8369;<u> "+parseFloat(total).toFixed(2).toString().replace(/.(?=(?:[0-9]{3})+\b)/g, '$&,')+"</u></b></h4><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>");
		$('#view-po-modal').modal('show');
	});
	var next = 1;
    $(document).on('click', '.add-more',function(e){
        e.preventDefault();
		$(this).replaceWith("<button id='remove" + (next) + "' class='btn btn-danger remove-me pull-right'>-</button>");
		var addto = "#field" + next;
        next = next + 1;
		var str = "<tr id='field" + next + "'><input class='form-control' type='hidden' name='inventory_id[]' value='0'>"+
					"<td><input autocomplete='off' class='input form-control' id='item" + next + "' name='inventory_item[]' type='text' data-items='8'/></td>"+
					"<td><input autocomplete='off' class='input form-control' id='desc" + next + "' name='inventory_desc[]' type='text' data-items='8'/></td>"+
					"<td><input autocomplete='off' class='input form-control' id='qty" + next + "' name='inventory_qty[]' value=0 type='text' data-items='8'/></td>"+
					"<td><div class='input-group'><span class='input-group-addon' style='font-size:18px;'>&#8369;</span>"+
					"<input autocomplete='off' data-type='number' class='input form-control text-right' id='ucost" + next + "' value=0 name='inventory_unit_cost[]' type='text' data-items='8'/></div></td>"+
					"<td><div class='input-group'><span class='input-group-addon' style='font-size:18px;border:0;background:transparent;'>&#8369;</span>"+
					"<input autocomplete='off' data-type='number' class='input form-control text-right' id='tcost" + next + "' value=0 name='inventory_total_cost[]' type='text' data-items='8' style='border:0;background:transparent;' readonly  /></div></td>"+
					"<td><select class='form-control' name='inventory_type[]'><option value='supply'>Supply</option><option value='asset'>Asset</option></select></td>"+
					"<td><button id='b1' class='btn add-more pull-right' type='button'>+</button></td></tr>";
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
	$(document).on('keyup', "input[data-type='number']",function(e){
		if(e.which >= 37 && e.which <= 40){
		}else{
			var $this = $(this);
			var val =$this.val();
			$this.val(numberWithCommas(val));
		}
		calcTotal();
	});
	function calcTotal(){
		var val = 0;
		$("input[name='inventory_total_cost[]'],input[name='upload_total_cost[]']").each(function( index ) {
			var value = parseFloat($(this).val().split(",").join(""));
			val = parseFloat(val) + value;
		});
		scope.gen_po_total = val;
	}
	function numberWithCommas(num) {
		var str = ""; 
		if (num.toString().indexOf('.') > -1){
			num = num.split(".");
			num[0] = num[0].split(",").join("");
			var number = num[0].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
			str = number+'.'+num[1];
		}else{
			num= num.split(",").join("");
			str=num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
		}
		return str;
	}
	$(document).on('keyup', "input[name='inventory_qty[]'], input[name='inventory_unit_cost[]']", function(e) {
		if (e.which >= 37 && e.which <= 40) {
		e.preventDefault();
		}
		var qty = $(this).closest('tr').find('input[name="inventory_qty[]"]').val();
		var cost = $(this).closest('tr').find('input[name="inventory_unit_cost[]"]').val();
		var total = $(this).closest('tr').find('input[name="inventory_total_cost[]"]');
		cost = parseFloat(cost.split(",").join(""));
		total.val(qty * cost);
	});	
	$('#save_po').submit(function (e) {
		e.preventDefault();
		var po = $('input[name=po_no]').val();
		if(Date.parse($('input[name="po_date_created2"]').val()) && (Date.parse($('input[name="po_ddelivery"]').val()) || $('input[name="po_ddelivery"]').val() == "")){
			var $form = $(e.target),
			fv = $form.data('formValidation');
			$.post(base_url+'gss/head/po/po_exist',{data: po},function(msg){
				if(msg == "Successful"){
					$.ajax({
						url: $form.attr('action'),
						type: 'POST',
						data: $form.serialize(),
						success: function(result) {
							location.reload();
						}
					});
				}else{
					$('#error-po-modal .modal-body').html("<h3 style='text-align: center;'>"+msg+"</h3>");
					$('#error-po-modal').modal('show');
				}
			});
		}else{
			$('#error-po-modal .modal-body').html("<h3 style='text-align: center;'>Invalid Date Format</h3>");
			$('#error-po-modal').modal('show');
		}
	});
	$('#edit_po').submit(function (e) {
		e.preventDefault();
		var po = $('input[name=po_no]').val();
		if(Date.parse($('input[name="po_date_created2"]').val()) && (Date.parse($('input[name="po_ddelivery"]').val()) || $('input[name="po_ddelivery"]').val() == "")){
			var $form = $(e.target),
			fv = $form.data('formValidation');
			$.post(base_url+'gss/head/po/po_exist',{data: po},function(msg){
				if(msg == "Successful"){
					$.ajax({
						url: $form.attr('action'),
						type: 'POST',
						data: $form.serialize(),
						success: function(result) {
							location.reload();
						}
					});
				}else{
					$('#error-po-modal .modal-body').html("<h3 style='text-align: center;'>"+msg+"</h3>");
					$('#error-po-modal').modal('show');
				}
			});
		}else{
			$('#error-po-modal .modal-body').html("<h3 style='text-align: center;'>Invalid Date Format</h3>");
			$('#error-po-modal').modal('show');
		}
	});
	$('.save-draft').click(function(){
		var po = $('input[name=po_no]').val();
		$.post(base_url+'gss/head/po/po_exist',{data: po},function(msg){
			if(msg == "Successful"){
				$('#save_po_status').val('draft');
				$.post(base_url+"/gss/head/po/save_po", $('form#save_po').serialize(), function(data) {
					location.reload();
				});
			}else{
				$('#error-po-modal .modal-body').html("<h3 style='text-align: center;'>"+msg+"</h3>");
				$('#error-po-modal').modal('show');
				$('#draft-modal').modal('hide');
			}
		});
	});
	$(document).on('change', ".file-name", function(e) {
		var oldName = this.oldvalue;
		var newName = this.value;
		var textf = this;
		scope.$apply(function(){
			
			if(!scope.changeFileName(oldName,newName,textf)){
				$('.error-upload').html("<i class='fa fa-warning'></i> Error changing File name.");
				$('.error-upload').css('display', 'block');
			}
		});
	});
	function removeF(i){
		scope.$apply(function(){
			scope.removeFile(i);
		});
	}
}