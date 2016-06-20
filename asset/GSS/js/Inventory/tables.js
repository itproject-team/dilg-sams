var base_url = $('#base_url').val(); 
var purchase="";
var balance="";
var rsmi="";
var initTables = function(scope, compile){

	//ASSET INVENTORY
	var asset_table = $('#asset-table').DataTable({
		ajax: base_url+"/gss/head/inventory/asset_inventory",
		columns: [
					{'data': 'asset_no'},
					{'data': 'distinction_no'},
					{'data': 'asset_name'},
					{'data': 'asset_description'},
					{
						mData: null,
						bSortable: false,
						mRender: function(rowData, settings, sourceData){
							return "<button type='button' class='btn btn-primary add-parts'>Add Parts</button><button type='button' class='btn btn-default view-parts'>View</button>";
						}
					}
				],
		columnDefs: [{targets: 4, width: '200px'}],
	});

	$('#asset-table').on('click', '.add-parts', function(){

		var data = asset_table.row(this.closest('tr')).data();
		$('#asset_id').val(data.id);
		$('#asset_no').val(data.asset_no);
		$('#asset_name').val(data.asset_name);
		$('#asset_desc').val(data.asset_description);
		$('#distinction_no').val(data.distinction_no);
		if(data.part_dist_no != null){
			$('#parts').append("<tr>" +
		           					"<td>"+data.part_dist_no+"</td>"+
		           					"<td>"+data.asset_part_name+"</td>"+
		           					"<td>"+data.asset_part_description+"</td>"+
		           				"</tr>");
			// $.each(data, function(index, value){
			// 	$('#parts').append("<tr>" +
			//            					"<td>"+data.part_dist_no+"</td>"+
			//            					"<td>"+data.asset_part_name+"</td>"+
			//            					"<td>"+data.asset_part_description+"</td>"+
			//            				"</tr>");
			// });
		}

		console.log(data);
		$('#add-modal').modal('show');
	});

	$('#asset-table').on('click', '.view-parts', function(){

		var data = asset_table.row(this.closest('tr')).data();
		$('#asset_id').val(data.id);
		$('#view-asset_no').val(data.asset_no);
		$('#view-asset_name').val(data.asset_name);
		$('#view-asset_desc').val(data.asset_description);
		$('#view-distinction_no').val(data.distinction_no);
		$('#view-part-dist-no').html(data.part_dist_no);
		$('#view-part-name').html(data.asset_part_name);
		$('#view-part-desc').html(data.asset_part_description);
		console.log(data);
		$('#view-modal').modal('show');
	});

	var dist_no = 0;
	var part_no = 0;
	var name = 0;
	var desc = 0;
	$('#add-part-btn').click(function(){
		name++;
		desc++;
		dist_no++;
		part_no++;
		$('#parts').append('<tr>'+
								'<td><input type="hidden" id="'+part_no+'" name="part_no[]"/>'+
								'<input "type="text" id="'+dist_no+'" name="dist_no[]"/></td>'+
								'<td><input type="text" id="'+name+'" name="parts[]"/></td>'+
								'<td><input "type="text" id="'+desc+'" name="desc[]"/></td>'+
								'<td><button id="remove" type="button" class="close">&times;</button></td>'+
							'</tr>');	
	});
	$(parts).on("click",".close", function(e){
        e.preventDefault(); 
        $('#'+name+'').parent('td').remove(); name--;
        $('#'+desc+'').parent('td').remove(); desc--;
        $('#'+dist_no+'').parent('td').remove(); dist_no--;
        $('#'+part_no+'').parent('td').remove(); part_no--;
        $('remove').parent('td').remove(); 
       
    });



 //INVENTORY

 	var inventory_table = $('#inventory-table').DataTable({
 		ajax: base_url + '/gss/head/inventory/inventory_record',
 		columns: [
					{'data': 'code'},
 					{'data': 'name'},
 					{'data': 'description'},
 					{'data': 'max'},
 					{
 						mRender: function(rowData, settings, sourceData){
 							return "<button class='btn btn-primary update-btn'>Update</button>";
 						}
 					},
 				],
 	});

 	var gss_table = $('#gss-table').DataTable({
 						ajax: base_url + '/gss/head/inventory/gss_ppmp',
 						columns: [
									{'data': 'code'},
 									{'data': 'name'},
 									{'data': 'description'},
 									{'data': 'max'},
 								],
 					});

 	var accounting_table = $('#accounting-table').DataTable({
						ajax: base_url + '/gss/head/inventory/accounting_ppmp',
 						columns: [
									{'data': 'code'},
 									{'data': 'name'},
 									{'data': 'description'},
 									{'data': 'max'},
 								],
 					});

 	var it_table = $('#it-table').DataTable({
						ajax: base_url + '/gss/head/inventory/it_ppmp',
 						columns: [
									{'data': 'code'},
 									{'data': 'name'},
 									{'data': 'description'},
 									{'data': 'max'},
 								],
 					});

	$('#inventory-table').on('click', '.update-btn', function(){
		$('#update-modal').modal('show');
	});
	
	
	$('#inventory-table').on('click', '.update-btn', function(){
        $('#update-modal').modal('show');
    });

    $('#generate-purchase-btn').click(function(){
		purchase = "";
		$.post(base_url + '/gss/head/inventory/purchase',function(items){
			items = JSON.parse(items);
			var total_qty = 0;
			var total_amount = 0;
			$('#purchase-table').html("");
			purchase = '<h1>SUMMARY OF PURCHASE REPORT</h1><P id="p1"contentEditable="true">As of '+Date.today().toString('d-MMM-yyyy')+'</P>'+
						'<p id="p2"></p><p id="p3">    </p><table><tr><th>Stock no.</th><th>Name</th><th>Description</th><th>Qty</th>'+
						'<th>Unit of Measures</th><th>Unit Cost</th><th>Total Cost</th></tr>';
			var str2 = "";
			$.each(items.data,function(index,value){
				var str = "<tr><td><input type='text' class='form-control' value='"+items.data[index]["code"]+"' name='purchase_code[]' readonly /></td>"+
								"<td><input type='text' class='form-control' value='"+items.data[index]["name"]+"' name='purchase_name[]' readonly /></td>"+
								"<td><input type='text' class='form-control' value='"+items.data[index]["description"]+"' name='purchase_description[]' readonly /></td>"+
								"<td><input type='text' class='form-control' value='"+items.data[index]["qty"]+"' name='purchase_qty[]' readonly /></td>"+
								"<td>"+items.data[index]["unit"]+"</td>"+
								"<td><input type='text' class='form-control' value='"+items.data[index]["unit_cost"]+"' name='purchase_unit_cost[]' readonly /></td>"+
								"<td><input type='text' class='form-control' value='"+items.data[index]["total_cost"]+"' name='purchase_total_cost[]' readonly /></td></tr>";
				$('#purchase-table').append(str);
				var str3 = "<tr><td>"+items.data[index]["code"]+"</td>"+
								"<td>"+items.data[index]["name"]+"</td>"+
								"<td>"+items.data[index]["description"]+"</td>"+
								"<td>"+items.data[index]["qty"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["unit"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["unit_cost"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["total_cost"]+"</td></tr>";
				str2 = str2 + str3;
				total_qty = parseInt(total_qty) + parseInt(items.data[index]["qty"]);
				total_amount = parseFloat(total_amount) + parseFloat(items.data[index]["total_cost"]);
			});
			purchase = purchase + str2;
			$('#purchase-amount').val(total_amount);
			$('#purchase-qty').val(total_qty);
			$('#purchase-date').val(Date.today().toString('d-MMM-yyyy'));
		});
        $('#generate-purchase-modal').modal('show');
    });

    $('#generate-balance-btn').click(function(){
		balance="";
		$.post(base_url + '/gss/head/inventory/balance',function(items){
			/* scope.$apply(function(){
				//scope.showBalance(items);
			}); */
			items = JSON.parse(items);
			var total_qty = 0;
			var total_amount = 0;
			$('#balance-table').html("");
			balance = '<h1>OFFICE SUPPLIES BALANCE REPORT</h1><P id="p1"contentEditable="true">As of '+Date.today().toString('d-MMM-yyyy')+'</P>'+
						'<p id="p2"></p><p id="p3">    </p><table><tr><th>Stock no.</th><th>Name</th><th>Description</th><th>Qty</th>'+
						'<th>Unit of Measures</th><th>Unit Cost</th><th>Total Cost</th></tr>';
			var str2 = "";
			$.each(items.data,function(index,value){
				var str = "<tr><td>"+items.data[index]["code"]+"</td>"+
								"<td>"+items.data[index]["name"]+"</td>"+
								"<td>"+items.data[index]["description"]+"</td>"+
								"<td>"+items.data[index]["max"]+"</td>"+
								"<td>"+items.data[index]["unit"]+"</td>"+
								"<td>"+items.data[index]["unit_cost"]+"</td>"+
								"<td>"+items.data[index]["total_cost"]+"</td></tr>";
				$('#balance-table').append(str);
				var str3 = "<tr><td>"+items.data[index]["code"]+"</td>"+
								"<td>"+items.data[index]["name"]+"</td>"+
								"<td>"+items.data[index]["description"]+"</td>"+
								"<td>"+items.data[index]["max"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["unit"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["unit_cost"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["total_cost"]+"</td></tr>";
				str2 = str2 + str3;
				total_qty = parseInt(total_qty) + parseInt(items.data[index]["max"]);
				total_amount = parseFloat(total_amount) + parseFloat(items.data[index]["total_cost"]);
			});
			balance = balance + str2;
			$('#balance-amount').val(total_amount);
			$('#balance-qty').val(total_qty);
			$('#balance-date').html(Date.today().toString('d-MMM-yyyy'));
		});
        $('#generate-balance-modal').modal('show');
    });

    $('#gss').on('click','#generate-rsmi-btn',function(){
		rsmi=""
		$.post(base_url + '/gss/head/inventory/rsmi',{division:'GSS'},function(items){
			items = JSON.parse(items);
			var total_qty = 0;
			var total_amount = 0;
			$('#rsmi-table').html("");
			$('#rsmi-division').html("GSS");
			rsmi = '<h1>REPORT OF SUPPLIES AND MATERIALS ISSUED</h1><P id="p1"contentEditable="true">As of '+Date.today().toString('d-MMM-yyyy')+'</P>'+
						'<p id="p2"></p><p id="p3">    </p><table><tr><th>Stock no.</th><th>Name</th><th>Description</th><th>Qty</th>'+
						'<th>Unit of Measures</th><th>Unit Cost</th><th>Total Cost</th></tr>';
			var str2 = "";
			$.each(items.data,function(index,value){
				var str = "<tr><td>"+items.data[index]["code"]+"</td>"+
								"<td>"+items.data[index]["name"]+"</td>"+
								"<td>"+items.data[index]["description"]+"</td>"+
								"<td>"+items.data[index]["unit"]+"</td>"+
								"<td>"+items.data[index]["dispense_qty"]+"</td>"+
								"<td>"+items.data[index]["unit_cost"]+"</td>"+
								"<td>"+items.data[index]["total_cost"]+"</td></tr>";
				$('#rsmi-table').append(str);
				var str3 = "<tr><td>"+items.data[index]["code"]+"</td>"+
								"<td>"+items.data[index]["name"]+"</td>"+
								"<td>"+items.data[index]["description"]+"</td>"+
								"<td>"+items.data[index]["dispense_qty"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["unit"]+"</td>"+
								
								"<td style='text-align:center;'>"+items.data[index]["unit_cost"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["total_cost"]+"</td></tr>";
				str2 = str2 + str3;
				total_qty = parseInt(total_qty) + parseInt(items.data[index]["dispense_qty"]);
				total_amount = parseFloat(total_amount) + parseFloat(items.data[index]["total_cost"]);
			});
			rsmi = rsmi + str2;
			$('#rsmi-amount').val(total_amount);
			$('#rsmi-qty').val(total_qty);
			$('#rsmi-date').html(Date.today().toString('d-MMM-yyyy'));
		});
        $('#generate-rsmi-modal').modal('show');
    });
	
	$('#acc').on('click','#generate-rsmi-btn',function(){
		rsmi=""
		$.post(base_url + '/gss/head/inventory/rsmi',{division:'Accounting'},function(items){
			items = JSON.parse(items);
			var total_qty = 0;
			var total_amount = 0;
			$('#rsmi-table').html("");
			$('#rsmi-division').html("Accounting");
			rsmi = '<h1>REPORT OF SUPPLIES AND MATERIALS ISSUED</h1><P id="p1"contentEditable="true">As of '+Date.today().toString('d-MMM-yyyy')+'</P>'+
						'<p id="p2"></p><p id="p3">    </p><table><tr><th>Stock no.</th><th>Name</th><th>Description</th><th>Qty</th>'+
						'<th>Unit of Measures</th><th>Unit Cost</th><th>Total Cost</th></tr>';
			var str2 = "";
			$.each(items.data,function(index,value){
				var str = "<tr><td>"+items.data[index]["code"]+"</td>"+
								"<td>"+items.data[index]["name"]+"</td>"+
								"<td>"+items.data[index]["description"]+"</td>"+
								"<td>"+items.data[index]["unit"]+"</td>"+
								"<td>"+items.data[index]["dispense_qty"]+"</td>"+
								"<td>"+items.data[index]["unit_cost"]+"</td>"+
								"<td>"+items.data[index]["total_cost"]+"</td></tr>";
				$('#rsmi-table').append(str);
				var str3 = "<tr><td>"+items.data[index]["code"]+"</td>"+
								"<td>"+items.data[index]["name"]+"</td>"+
								"<td>"+items.data[index]["description"]+"</td>"+
								"<td>"+items.data[index]["dispense_qty"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["unit"]+"</td>"+
								
								"<td style='text-align:center;'>"+items.data[index]["unit_cost"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["total_cost"]+"</td></tr>";
				str2 = str2 + str3;
				total_qty = parseInt(total_qty) + parseInt(items.data[index]["dispense_qty"]);
				total_amount = parseFloat(total_amount) + parseFloat(items.data[index]["total_cost"]);
			});
			rsmi = rsmi + str2;
			$('#rsmi-amount').val(total_amount);
			$('#rsmi-qty').val(total_qty);
			$('#rsmi-date').html(Date.today().toString('d-MMM-yyyy'));
		});
        $('#generate-rsmi-modal').modal('show');
    });
	
	$('#it').on('click','#generate-rsmi-btn',function(){
		$.post(base_url + '/gss/head/inventory/rsmi',{division:'IT'},function(items){
			items = JSON.parse(items);
			var total_qty = 0;
			var total_amount = 0;
			$('#rsmi-table').html("");
			$('#rsmi-division').html("IT");
			$.each(items.data,function(index,value){
				var str = "<tr><td>"+items.data[index]["code"]+"</td>"+
								"<td>"+items.data[index]["name"]+"</td>"+
								"<td>"+items.data[index]["description"]+"</td>"+
								"<td>"+items.data[index]["unit"]+"</td>"+
								"<td>"+items.data[index]["dispense_qty"]+"</td>"+
								"<td>"+items.data[index]["unit_cost"]+"</td>"+
								"<td>"+items.data[index]["total_cost"]+"</td></tr>";
				$('#rsmi-table').append(str);
				var str3 = "<tr><td>"+items.data[index]["code"]+"</td>"+
								"<td>"+items.data[index]["name"]+"</td>"+
								"<td>"+items.data[index]["description"]+"</td>"+
								"<td>"+items.data[index]["dispense_qty"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["unit"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["unit_cost"]+"</td>"+
								"<td style='text-align:center;'>"+items.data[index]["total_cost"]+"</td></tr>";
				str2 = str2 + str3;
				total_qty = parseInt(total_qty) + parseInt(items.data[index]["dispense_qty"]);
				total_amount = parseFloat(total_amount) + parseFloat(items.data[index]["total_cost"]);
			});
			$('#rsmi-amount').html(total_amount);
			$('#rsmi-qty').html(total_qty);
			$('#rsmi-date').html(Date.today().toString('d-MMM-yyyy'));
		});
        $('#generate-rsmi-modal').modal('show');
    });
	
	$(document).on('submit','#gen-purchase',function(e){
		e.preventDefault();
		var mywindow = window.open('', 'Summary of Purchase Report');
			mywindow.document.write('<html><head><title>Summary of Purchase Report</title><link rel="stylesheet" type="text/css" href="'+base_url+'/br.css"></head>');
			mywindow.document.write('<body>');
			purchase = purchase +'<tr id="total"><td></td><td></td><td></td><td></td><td id="qty"><b>Total Quantity: '+$('#purchase-qty').val()+'</b></td><td id="amt"><b>Total Amount: '+$('#purchase-amount').val()+'</b></td></tr>'+
								'<tr><tfoot></tfoot></tr></table><p id="qw1">Prepared by: '+$('input[name="purchase-prepared"]').val()+'</p>'+
								'<p id="qw2">Checked by: '+$('input[name="purchase-checked"]').val()+'</p><br><br>'+
						''+
						'<p><input type="text" id="r1" name="names" style="margin-left:200px;" value="'+$('input[name="purchase-prepared-position"]').val()+'">'+
						'</p><p><input type="text" id="r2"name="namez" style="margin-left:200px;" value="'+$('input[name="purchase-checked-position"]').val()+'">'+
						'</p></body></html>';
			mywindow.document.write(purchase);
			
			mywindow.document.write('</body></html>');
			window.open();
			$('#generate-purchase-modal').modal('toggle');
			purchase="";
	});
	$(document).on('submit','#gen-balance',function(e){
		e.preventDefault();
		var mywindow = window.open('', 'Office Supplies Balance Report');
			mywindow.document.write('<html><head><title>Office Supplies Balance Report</title><link rel="stylesheet" type="text/css" href="'+base_url+'/br.css"></head>');
			mywindow.document.write('<body>');
			balance = balance +'<tr id="total"><td></td><td></td><td></td><td></td><td id="qty"><b>Total Quantity: '+$('#balance-qty').val()+'</b></td><td id="amt"><b>Total Amount: '+$('#balance-amount').val()+'</b></td></tr>'+
								'<tr><tfoot></tfoot></tr></table><p id="qw1">Prepared by: '+$('input[name="balance-prepared"]').val()+'</p>'+
								'<p id="qw2">Checked by: '+$('input[name="balance-checked"]').val()+'</p><br><br>'+
						''+
						'<p><input type="text" id="s1" name="names" style="margin-left:200px;" value="'+$('input[name="balance-prepared-position"]').val()+'">'+
						'</p><p><input type="text" id="s2" style="margin-left:200px;" name="namez" value="'+$('input[name="balance-checked-position"]').val()+'">'+
						'</p></body></html>';
			mywindow.document.write(balance);
			mywindow.document.write('</body></html>');
			window.open();
			$('#generate-balance-modal').modal('toggle');
			balance="";
	});
	$(document).on('submit','#gen-rsmi',function(e){
		e.preventDefault();
		var mywindow = window.open('', 'REPORT OF SUPPLIES AND MATERIALS ISSUED');
			mywindow.document.write('<html><head><title>REPORT OF SUPPLIES AND MATERIALS ISSUED</title><link rel="stylesheet" type="text/css" href="'+base_url+'/br.css"></head>');
			mywindow.document.write('<body>');
			rsmi = rsmi +'<tr id="total"><td></td><td></td><td></td><td></td><td id="qty"><b>Total Quantity: '+$('#rsmi-qty').val()+'</b></td><td id="amt"><b>Total Amount: '+$('#rsmi-amount').val()+'</b></td></tr>'+
								'<tr><tfoot></tfoot></tr></table><p id="qw1">Prepared by: '+$('input[name="rsmi-prepared"]').val()+'</p>'+
								'<p id="qw2">Checked by: '+$('input[name="rsmi-checked"]').val()+'</p><br><br>'+
						//'<p id="j1" contentEditable="true" ></p><p id="j2" contentEditable="true"></p>'+
						'<p><input type="text" id="t1" name="names" value="'+$('input[name="rsmi-prepared-position"]').val()+'">'+
						'</p><p><input type="text" id="t2" name="namez" value="'+$('input[name="rsmi-checked-position"]').val()+'">'+
						'</p></body></html>';
			mywindow.document.write(rsmi);
			mywindow.document.write('</body></html>');
			window.open();
			$('#generate-rsmi-modal').modal('toggle');
			rsmi="";
	});
}
