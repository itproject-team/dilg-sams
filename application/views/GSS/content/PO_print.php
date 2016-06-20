<!DOCType HTML>
<html>
<head>
	<title>PO Form</title>
<style>

@media print{
	#print{
    display: none !important;
  }
}
body{
		border: 3px solid black;
		position: absolute;
		width:816px;
	}

	h4,h5,h3{
		text-align: center;
		margin: 0px;
		padding: 0px;
	}
	div{
		
		padding:0px;
	}
	p{
		padding: 0px;

	}
	table, tr, td{
		
		padding:0px;
		margin: 0px;
		border-spacing:0px;
		
	}
	table{
		width: 100%
	}
	hr{
				position:absotute;
		
	}
	
	.PO{
		border-left: 0px;
		float: right;
		width: 29.7%;
	}
	.hr1{
		margin: -18px 20px 0px 100px;
		padding-left: 0px;
	}
	
	.hr2{
		margin: 0px -10px -10px 0px;
		padding: 0px;
		width: 200px;
	}
	.hr3{
		margin: -18px 40px 0px 120px;
		padding-left: 0px;
	}
	.hr4{
		margin: 40px 20px 0px 190px;
		padding: 0px;
		width: 250px;

	}
	.hr5{
		margin: -18px 0px 0px 115px;
		padding: 0px;
		width: 250px;

	}
	.hr6{
		margin: -18px 0px 0px 80px;
		padding: 0px;
		width: 250px;
	}
	.hr7{
		margin: -18px 20px 0px 550px;
		padding-left: 0px;
	}
	.hr8{
		margin: -18px 20px 0px 650px;
		padding-left: 0px;

	}
	.hr9{
		margin: -18px 20px 0px 600px;
		padding-left: 0px;
	}
	.hr10{
		margin: -18px 20px 0px 120px;
		padding-left: 0px;
	}
	.hr11{
		margin: -18px 20px 0px 155px;
		padding-left: 0px;
	}
	.p1{
		text-align: center;
	}
	.p2{
		text-align:right;
		padding-right:100px;
	}
	.place{
		border-right: 0px;
		float: left;
		width: 69.75%;

	}
	.delivery{
		width: 30%;
		border-left: 0px;
		float: right;
	}
   .td2{

        border-left: 0px;
        border-right: 0px;
    }
    .td1{

        border-top: 0px;
        border-bottom: 0px;
        }
     #abstract{
     	text-align: right;
     	padding: 0px;
     	margin:0px;
     }
     #obr{
     	padding: 0px;
		float:right;
		width:40%;
		height:150px;
     }
	 #supply{
	 width: 60%;
	 float:left;
	 }
	 #POD{
	 width:60%;
	 float:left;
	 }
	 #fail{
	 border:0px;
	 }
	 #conforme{
		border: 0px;
		width: 59.5%;
		float: left;
		height:170px;
	 }
	 #sign{
		border:0px;
		width: 40%;
		float: right;
		height:170px;
	 }
	 #fund{
	 float:left;
	 width:59.5%;
	 padding:0px;
	 height:150px;
    	}
		
		
		
		
	#s1{
	width:60px;
	}	
	#s2{
	width: 400px;
	}
	#s3{
	width:60px}
	#s4{
	width: 195px;  }
	#s5{
	width:60px;
	}	
	#s6{
	width: 400px;
	}
	#s7{
	width:60px}
	#s8{
	width: 195px;  }
	#s11{
	width:160px   
	}
	#t1{
	width:140px;
	}
	#t2{
	width:380px;
	}
		#t3{
	width:110px;
	}
	#t4{
	width:320px;
	}
	
	#t5{
	width:140px;
	}
	#t6{
	width:380px;
	}
		#t7{
	width:110px;
	}
	#t8{
	width:320px;
	}
	
	
	#h1{
	width:140px;}
	#h2{
	width:110px;}
	#h3{
	width:230px;
	}
	#h4{
	width:140px;
	}
	#h5{
	width:140px;
	}
	#h6{
	width:140px;
	}
	#nam{
	width:140px}
	#name{
	width:550px;}
	#names{
	width:50px;}
	#namez{
	width:
	}
</style>
</head>
<button onclick="myFunction()" id="print">Print</button>
	<script>
		function myFunction() {
			window.print();
		}
	</script>
<body>
	
	<p id ="abstract">Appendix 61</p>	
	<h3>PURCHASE ORDER</h3>
	<h4>DEPARTMENT OF INTERIOR AND LOCAL GOVERNMENT</h4>
	<h5>CORDILLERA ADMINISTRATIVE REGION</h5>
	<br>

	<table
	<div>
	<tr>
	<td id="s1">Supplier:</td>
	<td contentEditable="true"id="s2"><?php echo $po[0]->supplier; ?></td>
	<td id="s3">PO:</td>
	<td contentEditable="true" id="s4"><?php echo $po[0]->po_no; ?></td>
	</tr
	</div>
	<tr>
	<td id="s5">Address:</td>
	<td contentEditable="true" id="s6"><?php echo $po[0]->address; ?></td>
	<td id="s7">Date:</td>
	<td contentEditable="true"  id="s8"><?php echo $po[0]->date_created; ?></td>
	</tr>
	<tr>
	<td id="s9">TIN:</td>
	<td contentEditable="true" id="s10"><?php echo $po[0]->tin; ?></td>
	<td id="s11">Mode of procurement:</td>
	<td contentEditable="true" id="s12"><?php echo $po[0]->mode; ?></td>
	</tr>
	</table>
	


	
	<p>Gentlemen:</p>
	<p contentEditable="true">&nbsp Please furnish this office the following articles subject to the terms and conditions contained herein:</p>



	<table class="tablets">
	<div>
	<tr>
	<td id="t1" contentEditable="true">Place of Delivery:</td><td contentEditable="true" id="t2"><?php echo $po[0]->pdelivery; ?></td>
	<td id="t3" contentEditable="true"> Delivery Term:</td><td contentEditable="true"  id="t4"><?php echo $po[0]->dterm; ?></td>
	</tr></div>
	<div>
	<tr>
	<td id="t5"contentEditable="true">Date of Delivery:</td><td contentEditable="true" id="t6"><?php echo $po[0]->ddelivery; ?></td>
	<td id="t7" contentEditable="true">Payment Term:</td><td contentEditable="true" id="t8"><?php echo $po[0]->pterm; ?></td>
	</tr>
	</div>
	
	</table>

<table>
	<tr>
		<td contentEditable="true" id="h1" >Stock/Property No.</td>
		<td contentEditable="true" id="h2" >Unit</td>
		<td contentEditable="true" id="h3" >Description</td>
		<td contentEditable="true" id="h4" >Quantity</td>
		<td contentEditable="true" id="h5" >Unit cost</td>
		<td contentEditable="true" id="h6" >Amount</td>
	</tr>
	
	<?php for($i=0;$i<sizeOf($po[0]->items);$i++){
		echo '<tr><td class="td1" style="border-bottom:1px solid #000;">'.$po[0]->items[$i]->code.'</td>';
		echo '<td class="td1" style="border-bottom:1px solid #000;">'.$po[0]->items[$i]->unit.'</td>';
		echo '<td class="td1" style="border-bottom:1px solid #000;">'.$po[0]->items[$i]->description.'</td>';
		echo '<td class="td1" style="border-bottom:1px solid #000;">'.$po[0]->items[$i]->qty.'</td>';
		echo '<td class="td1" style="border-bottom:1px solid #000;">'.$po[0]->items[$i]->unit_cost.'</td>';
		echo '<td class="td1" style="border-bottom:1px solid #000;">'.$po[0]->items[$i]->total_cost.'</td></tr>';
		}?>
	
</table>
<table>
<tr>
		<td class="td1" id="nam" >Amount in words</td>
		<td class="td1" id="name" contentEditable="true"></td>
		<td class="td1" id="names" >Total:</td>
		<td class="td1" id="namez" contentEditable="true"></td>
</table>
	
		<p>In case of failure to make the full delivery within the time specified above, penalty of  one-tenth(1/10) of one percent for every day of delay shall be imposed.</p>
	
		<p id="za1"> Conforme:</p>
		<p id="za2">Very truly yours,</p>
		
		
		<form>
 <br>
 <br>
  <input type="text" id="sig" name="SIN" value="" style="border-bottom:1px solid #000;">

  <input type="text" id="asa"name="ASA" style="text-align:center;" value="<?php echo $po[0]->signby; ?>">
</form>


			
		<p id="za3" >Signature over printed name</p>
		<p id="za4" style="border-top:1px solid #000;"><?php echo $po[0]->sign; ?></p>
		<br>
				<form>
 
  <input type="text" id="dat" name="datez" >
</form>
		
		<p style="border-top:1px solid #000; margin-left:60px;width:200px;text-align:center;">Date</p>
	
		
		
	
	
	
	<table>
		
		<tr><td id="z1" contentEditable="true">Fund Cluster:</td><td id="z2"contentEditable="true">	</td> <td id="z3" contentEditable="true">OBR/BURS No.:</td><td id="z4" contentEditable="true"></td></tr><tr>
		<td>Funds Available:</td><td contentEditable="true"></td> <td contentEditable="true">Date of the OBR/BURS</td><td contentEditable="true" ></td></tr>
		<tr><td></td><td></td><td id="zq">Amount</td><td contentEditable="true" id="zw" ></td></tr>
		
		
	
	</table>	
	<br>
				<form>
 
  <input type="text" id="rac" name="RAC" >
</form>

	<p id="rea" > Regional Accountant</p>
		
		

<style>
#z1{ width:120px     }
#z2{ width:300px     }
#z3{ width:160px     }
#z4{ width:160px     }
#zq{ width:160px }
#zw{ width:px }
#zx{ padding-left:250px}
#sig{margin-left:150px;}

#sig{
display:inline;
margin-left:60px;
width:200px;
border:0px;
}
#asa{
display:inline;
border:0px;
margin-left:210px;
width:200px;

}
#za1{
display:inline;
}
#za2{
display:inline;
margin-left:380px;
}
#za3{
display:inline;
margin-left:80px;
}
#za4{
display:inline;
margin-left:220px;
}

#za5{
display:inline;
margin-left:220px;
}
#dat{
margin-left:80px;
border:0px;
}
.da1{
margin-left:155px;
}
#rac{
margin-left:240px;
border:0px;
}
#rea{
margin-left:260px;}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
</body>
<html>