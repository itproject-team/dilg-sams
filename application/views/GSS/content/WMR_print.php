<html>
	<head>

	<script src="<?php echo base_url(); ?>/libs/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>/libs/jsPDF/jspdf.js"></script>
	<script src="<?php echo base_url(); ?>/libs/jsPDF/libs/FileSaver.js/filesaver.js"></script>
		<title></title>
	</head>
	<style>

	@media print {
    #print-btn, #download-btn {
        display :  none;
    	}
	}
		body {
			width:750px;

		}
		h2{
			text-align: center;
			padding: 0px;
			margin: 0px;
		}
		p{
			padding: 0px;

		}
		table,th, td{
		border: 1px solid black;
		padding:0px;
		margin: 0px;
		border-spacing:0px;
		border-collapse:collapse;

		}
		div{
			border: 1px solid black;
		}
		

		.hr1 {
			margin: -18px 20px -10px 120px;
			padding: 0px;
			text-align: center;
		}
		
		.hr2 {
			margin: -18px 20px -10px 50px;
			padding: 0px;
			text-align: center;
		}
		
		.hr3{
			margin: 10px 20px -10px 50px;
			padding: 0px;
			text-align: center;
		}
		.hr4{
			margin: 22px 20px -10px 50px;
			padding: 0px;
			text-align: center;
		}
		
		.Signatory1 {
			border-right: 0;
			width: 50%;
			float: left;
		}
		.Signatory2 {
			border-left: 0;
			width: 49.45%;
			float: right;
		}
		.Signatory3 {
			border-right: 0;
			width: 50%;
			float: left;
		}
		.Signatory4 {
			border-left: 0;
			width: 49.45%;
			float: right;
		}
		
		.position {
			text-align:center;
		}

		
	
		
		.property {
			padding-left: 100px;
		}
	
		.item {
			padding-left: 150px;
			margin: 5px;
		}	

		#storage{
			width: 60%;
			float:left;

		}
		#date{
			width: 39.45%;
			float:right;


		}
		#p1{
			border: 0px;
			width: 60%;
			float: left;
		}
		#p2{
			border: 0px;
			width: 39.45%;
			float: right;
			text-align: left;
		}
		.head{
			border: 0px;
		}
		#appendix{
			text-align: right;
			font-style: italic;

		}



</style>

	<div>
		<a href="javascript:demoFromHTML()" id="download-btn"> Download</a>
		<a href="javascript:window.print()" id="print-btn">Print</a>
	</div>
	
	<body>
		<!-- appendix is editable -->
		<p id = "appendix">Appendix #</p>

		<div class = "head">
		<h2>WASTE MATERIALS REPORT</h2>
		<br>
			<div id="p1" >Entity Name:</div>
			<div id="p2" >Fund Cluster:</div>
		</div>

		<div id = "storage">
			<p>Place of Storage:<hr class = "hr1"></p>
		</div>
		<br>
		<div id = "date">
			<p>Date:<hr class = "hr2"></p>
		</div>

		<div >
			<p>ITEMS FOR DISPOSAL</p>
		</div>

		<table >			
			<tr>
				<th width = "60px" rowspan ="3">Item</th>
				<th width = "80px" rowspan ="3">Quantity</th>
				<th width = "80px" rowspan ="3">Unit</th>
				<th width = "230px" rowspan ="3">Description</th>
				<th width = "300px" colspan = "3">Record of Sales</th>
			</tr>
			<tr>
				<th colspan = "3">Official Receipt</th>
			</tr>
			<tr>
				<th width = "100px">No.</th>
				<th width = "100px">Date</th>
				<th width = "100px">Amount</th>
			</tr>

			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>
			<tr>
				<td contenteditable="true">&nbsp</td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>
				<td contenteditable="true"> </td>		
				<td contenteditable="true"> </td>	
			</tr>


</table>

<div class="Signatory1">
	<p>Certified Correct:</p>
	<br>
	<hr class = "hr3">
		<p class="position">Signature over Printed Name of</p>
		<p class="position">Supply and/or Property Custodian</p>
<br>
</div>
	
<div class = "Signatory2">
		<p>Disposal Approved:</p>
		<br>
		<hr class = "hr3">
		<p class="position">Signature over Printed Name of</p>
		<p class="position">Head of Agency/Entity or his/her Authorized Representative</p>
</div>

<div>
	<h2>CERTIFICATE OF INSPECTION</h2>
</div>

<div>
	<p class="property">I hereby certify that the property enumerated above was disposed of as follows:</p>
	<br>
	<p class="item" contenteditable="true" >Item ___________ Destroyed</p>
	<p class="item" contenteditable="true">Item ___________ Sold at private sale</p>
	<p class="item" contenteditable="true">Item ___________ Sold at public auction</p>
	<p class="item" contenteditable="true">Item ___________ Transferred without cost to <u>(Name of the Agency/Entity)</u></p>
	<br>
</div>

<div class="Signatory3">
	<p>Certified Correct:</p>

	<hr class = "hr4">
		<p class="position">Signature over Printed Name of Inspection Officer</p>

</div>
	
<div class = "Signatory4">
		<p>Disposal Approved:</p>

		<hr class = "hr4">
		<p class="position">Signature over Printed Name of Witness</p>

</div>
	</body>
	</html>