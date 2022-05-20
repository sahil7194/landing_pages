<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<style>
body{
	font-family: 'Roboto', sans-serif;
	font-size:14px;
}
th,td{
	padding:10px;
}
.label{
	font-weight:600;
	text-transform: uppercase;
}
a{
	color: #000;
	text-decoration: none;
	text-transform: uppercase;
}
.center{
	text-align: center;
}
.right{
	text-align: right;
}
</style>
</head>
<body>
<div style="width:100%;margin:0 auto;">
 <table border="1" style="border-collapse:collapse;width:100%">
	<thead>
	<tr>
	  <th colspan="4">CASH / CREDIT MEMO</th>
	  </tr>
	</thead>
	<tbody>
		<tr>
		  <td rowspan="2" class="label" width="60%">Goraksh Dairy and Agro Products</td>
		  <td ><span class="label">No:</span> #<?php echo $result[0]->order_ref_id; ?></td>
		</tr>
		<tr>
		  <td><span class="label">Date:</span> <?php echo date('d M Y', strtotime($result[0]->date_created)); ?></td>
		</tr>
		 <tr>
		   <td><span class="label">Name:</span> <?php echo anchor('customer/view/'.$result[0]->customer_id, $result[0]->firstname.' '.$result[0]->lastname, array('target'=>'_blank')); ?></td>
		   <td><span class="label">Payment Mode:</span> <?php echo strtoupper($result[0]->payment_mode); ?></td>
		</tr>
		<tr>
			<td colspan="2"> <span class="label">ADDRESS: </span> <?php echo $result[0]->delivery_address; ?>, <?php echo $result[0]->delivery_city; ?>, <?php echo $result[0]->delivery_pincode; ?> <br> <span class="label">Phone: </span> <?php echo $result[0]->delivery_mobile.' / '.$result[0]->delivery_alternate_phone; ?> </td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" style="border-collapse:collapse;">
					<tr>					   
					   <td width="70%" class="label">PARTICULAR</td>
					   <td width="10%" class="label">QTY</td>
						<td width="10%" class="label center">RATE </td>
						<td width="10%" class="label right"> AMOUNT </td>
					</tr>
					<?php foreach($products as $product){ ?>
					<tr>						
						<td>
							<?php echo $product->product_name; ?><br/>
							<?php 
							  $options = explode('--', $product->product_options);
							  foreach ($options as $option) {
								echo $option.', ';
							  }
							?>
						</td>
						<td><?php echo $product->quantity; ?></td>
						<td class="center"><?php echo $product->price; ?></td>
						<td class="right"><?php echo $product->total; ?></td>
					</tr>
					<?php } ?>

					<?php if($result[0]->packaging_charges!=0){ ?>
					<tr>						
						<td colspan="3">Packaing Charges</td>
						<td class="right"><?php echo $result[0]->packaging_charges; ?></td>
					</tr>
					<?php } ?>

					<?php if($result[0]->shipping_charges!=0){ ?>
					<tr>						
						<td colspan="3">Delivery Charges</td>
						<td class="right"><?php echo $result[0]->shipping_charges; ?></td>
					</tr>
					<?php } ?>

					<tr>
						<td colspan="2" class="label">Thank You </td>
						 <td class="label center"> Total </td>
						<td class="label right">Rs. <?php echo $result[0]->total; ?> </td>
					</tr>
				</table>
			</td>
		</tr>		
	</tbody>
 </table>
</div>  

<br><br>


<script type="text/javascript">
	window.print()
</script>

</body>

</html>
