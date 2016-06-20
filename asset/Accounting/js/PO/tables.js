var initTables = function(scope, compile){
	var base_url = $('#base_url').val(); 
	var all_table = $('#all-table').DataTable({
		ajax: base_url+"/accounting/head/po/all_po",
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
								return  "<button type='button' class='btn btn-danger delete-po-co'>Delete</button> "+
									"<button type='button' class='btn btn-default view-po'>View</button>";
							}else if(rowData.status == "pending"){
								return "<select class='form-control action-po'>"+
										"<option value='pending'>Pending</option>"+
										"<option value='confirm'>Confirm</option>"+
										"<option value='reject'>Reject</option>"+
									"</select>"+
									"<button type='button' class='btn btn-default view-po'>View</button>";
							}else if(rowData.status == "confirmed"){
								return "<button type='button' class='btn btn-default view-po'>View</button>";
							}else if(rowData.status == "rejected"){
								return "<button type='button' class='btn btn-default view-po'>View</button>";
							}
						}
					}
				],
		columnDefs: [{targets: 4, 'width': '200px'}],

	});
	var pending_table = $('#pending-table').DataTable({
		ajax: base_url+"/accounting/head/po/pending_po",
		columns: [
					{'data': 'po_no'},
					{'data': 'user_name'},
					{'data': 'date_created'},
					{'data': 'date_modified'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<select class='form-control action-po'>"+
										"<option value='pending'>Pending</option>"+
										"<option value='confirm'>Confirm</option>"+
										"<option value='reject'>Reject</option>"+
									"</select>"+
									"<button type='button' class='btn btn-default view-po'>View</button>";
						}
					}
				],
		columnDefs: [{targets: 3, 'width': '200px'}],

	});
	var completed_table = $('#completed-table').DataTable({
		ajax: base_url+"/accounting/head/po/completed_po",
		columns: [
					{'data': 'po_no'},
					{'data': 'user_name'},
					{'data': 'date_created'},
					{'data': 'date_modified'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return  "<button type='button' class='btn btn-danger delete-po'>Delete</button> "+
									"<button type='button' class='btn btn-default view-po'>View</button>";
						}
					}
				],
		columnDefs: [{targets: 3, 'width': '200px'}],

	});
	var confirmed_table = $('#confirmed-table').DataTable({
		ajax: base_url+"/accounting/head/po/confirmed_po",
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
	var rejected_table = $('#rejected-table').DataTable({
		ajax: base_url+"/accounting/head/po/rejected_po",
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
	$('tbody').on('click', '.remove_curent_item', function(){
		$(this).closest('tr').remove();
	});
	 var next = 1;
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
	$('#all-table').on('change', '.action-po', function(){
		var data = all_table.row(this.closest('tr')).data();
		if($(this).val() === 'confirm'){
			$(this).attr('disabled', true);
			$.post(base_url+"/accounting/head/po/post_confirm_po", {id: data.id}).done(function(){
				location.reload();
			});
		}
		if($(this).val() === 'reject'){
			$(this).attr('disabled', true);
			$.post(base_url+"/accounting/head/po/post_reject_po", {id: data.id}).done(function(){
				location.reload();
			});
		}
	});
	$('#pending-table').on('change', '.action-po', function(){
		var data = pending_table.row(this.closest('tr')).data();
		if($(this).val() === 'confirm'){
			$(this).attr('disabled', true);
			$.post(base_url+"/accounting/head/po/post_confirm_po", {id: data.id}).done(function(){
				location.reload();
			});
		}
		if($(this).val() === 'reject'){
			$(this).attr('disabled', true);
			$.post(base_url+"/accounting/head/po/post_reject_po", {id: data.id}).done(function(){
				location.reload();
			});
		}
	});
}