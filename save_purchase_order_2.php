<?php
 
include ('include/function.php');
				
   $item_code = $_GET['item_code'];
   $po_no = $_GET['po_no']; 
  $quantity = $_GET['quantity'];
 $uom = $_GET['uom'];
   $remarks = $_GET['remarks'];
$rate = $_GET['rate'];
  $discount = $_GET['discount']; 
  


$select_po = mysqli_query($conn,"select * from po_detail where po_no = '$po_no' and item_code = '$item_code' ");
$selected_rows_po = mysqli_num_rows($select_po);

if($selected_rows_po == 0)
{
	
$sql = "INSERT INTO PO_DETAIL (PO_NO,ITEM_CODE,UOM,RATE,QUANTITY,USER_ID,PC_IP,DISCOUNT,REMARKS) VALUES ('$po_no','$item_code','$uom','$rate','$quantity','$userid','$ip','$discount','$remarks')";
	   $compiled = mysqli_query($conn, $sql);


	if($compiled){
 
  // echo "Purchase Order Detail Created"; 
?>
   <style>
   th,td{
	   font-size:12px;
	   
   }
   </style>
   <div class="table-responsive">
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>S.No</th>
                                <th>Item</th>
								<th>Rate</th>
								<th>Uom</th>
								<th>Quantity</th>
								<th>Discount</th>
								<th>Amount</th>
								<th>Remarks</th>
								<th>Edit/Save</th>
								<th>Delete</th>
							</tr>
						</thead>

						<tbody>
						</tr>
						 <?php 
		  $i=1;

 
	$r = mysqli_query($conn, "select a.DISCOUNT,a.PO_NO,a.QUANTITY,a.TRNO,a.RATE,b.ITEM_NAME,c.DESCRIPTION,a.REMARKS,a.ITEM_CODE from po_detail a , item_setup2 b ,uom_setup c where a.PO_NO = '$po_no' and a.ITEM_CODE = b.ITEM_ID 
	and a.UOM = c.DESCRIPTION"); 
	while (($rows = mysqli_fetch_array($r)) != false) {
	
$po_no = $rows['PO_NO'];
$item_code = $rows['ITEM_CODE'];	 
$item_name = $rows['ITEM_NAME'];
$uom = $rows['DESCRIPTION'];	 
$quantity = $rows['QUANTITY'];	 
$remarks = $rows['REMARKS'];	 
$trno = $rows['TRNO'];	 
$rate = $rows['RATE'];
$discount = $rows['DISCOUNT'];	 
$total_amount = $rate * $quantity - $discount;	 
	 
	ini_set('max_execution_time', 500);
	?>
	<tr id="row<?php echo $i; ?>" class='showme'>
	
        <td class="center"  ><?php echo $i; ?></td>
        <td class="center" ><?php echo $item_name; ?></td>
		<td class="center" ><?php echo number_format($rate); ?></td>
		<td class="center" ><?php echo $uom; ?></td>
		<td class="center" id="quantity<?php echo $i; ?>" ><?php echo $quantity; ?></td>
		<td class="center" ><?php echo number_format($discount); ?></td>
		<td class="center" ><?php echo number_format($total_amount); ?></td>
		<td class="center" ><?php echo $remarks; ?></td>
        	<td class="center"><input type='button' id='edit_button<?php echo $i;?>' class="btn btn-primary" style="width:80px; font-size:12px;" value='Edit' onclick='edit_row(<?php echo $i; ?>,<?php echo $trno; ?>)' >
	<input type='button' id='save_button<?php echo $i;?>' value='Save' class="btn btn-primary" onclick='save_row(<?php echo $i; ?>,<?php echo $trno; ?>,<?php echo $po_no; ?>)' style="display:none; width:80px; font-size:12px;" >
	</td>
<td class="center"><input type='button' id='del_button' value='Delete' class="btn btn-primary" style="width:80px; font-size:12px;" onclick='delrow(<?php echo $i; ?>,<?php echo $trno; ?>,<?php echo $po_no; ?>)' ></td>
       		
				
                </tr>
				
          <?php $i++;}  ?>
						
				<tr>
		
				</tbody>
					</table>
					</div>
   
   <div align="center">
   <div id="detail_delete"></div>
   </div>
   
      <div align="center">
   <button id="btn" onClick="save()"
   
 class="btn btn-primary btn-bordered waves-effect waves-light">Save</button>
   </div>
   
   <div id="voucher_saved"></div>
  <?php 
	}
	else {
		
	echo "Error";
	
	}

}
else
{
	echo "<center>Detail Already Exist</center>";
	echo "<br>";
	?>
	
	<style>
   th,td{
	   font-size:12px;
	   
   }
   </style>
   <div class="table-responsive">
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>S.No</th>
                                <th>Item</th>
								<th>Rate</th>
								<th>Uom</th>
								<th>Quantity</th>
								<th>Discount</th>
								<th>Amount</th>
								<th>Remarks</th>
								<th>Edit/Save</th>
								<th>Delete</th>
							</tr>
						</thead>

						<tbody>
						</tr>
						 <?php 
		  $i=1;

 
	$r = mysqli_query($conn, "select a.DISCOUNT,a.PO_NO,a.QUANTITY,a.TRNO,a.RATE,b.ITEM_NAME,c.DESCRIPTION,a.REMARKS,a.ITEM_CODE from po_detail a , item_setup2 b ,uom_setup c where a.PO_NO = '$po_no' and a.ITEM_CODE = b.ITEM_ID 
	and a.UOM = c.DESCRIPTION"); 
	
	while (($rows = mysqli_fetch_array($r)) != false) {
	
$po_no = $rows['PO_NO'];
$item_code = $rows['ITEM_CODE'];	 
$item_name = $rows['ITEM_NAME'];
$uom = $rows['DESCRIPTION'];	 
$quantity = $rows['QUANTITY'];	 
$remarks = $rows['REMARKS'];	 
$trno = $rows['TRNO'];	 
$rate = $rows['RATE'];
$discount = $rows['DISCOUNT'];	 
$total_amount = $rate * $quantity - $discount;	 	 
	 
	ini_set('max_execution_time', 500);
	?>
	<tr id="row<?php echo $i; ?>" class='showme'>
	
        <td class="center"  ><?php echo $i; ?></td>
        <td class="center" ><?php echo $item_name; ?></td>
		        <td class="center" ><?php echo number_format($rate); ?></td>
		<td class="center" ><?php echo $uom; ?></td>
		<td class="center" id="quantity<?php echo $i; ?>" ><?php echo number_format($quantity); ?></td>
		<td class="center" ><?php echo number_format($discount); ?></td>
		<td class="center" ><?php echo number_format($total_amount); ?></td>
		<td class="center" ><?php echo $remarks; ?></td>
        	<td class="center"><input type='button' id='edit_button<?php echo $i;?>' class='btn btn-primary' style="font-size:12px; width:80px;" value='Edit' onclick='edit_row(<?php echo $i; ?>,<?php echo $tr_no; ?>)' >
	<input type='button' id='save_button<?php echo $i;?>' value='Save' class='btn btn-primary'  onclick='save_row(<?php echo $i; ?>,<?php echo $trno; ?>,<?php echo $po_no; ?>)' style="display:none; font-size:12px; width:80px;" >
	</td>
<td class="center"><input type='button' id='del_button' value='Delete' style="font-size:12px; width:80px;" class='btn btn-primary' onclick='delrow(<?php echo $i; ?>,<?php echo $trno; ?>,<?php echo $po_no; ?>)' ></td>
       		
				
                </tr>
				
          <?php $i++;}  ?>
						
				<tr>
		
				</tbody>
					</table>
					</div>
   
   <div align="center">
   <div id="detail_delete"></div>
   </div>
   
   <div align="center">
   <button id="btn" onClick="save()"
   
 class="btn btn-primary btn-bordered waves-effect waves-light">Save</button>
   
   </div>
   <div id="voucher_saved"></div>
	
	<?php
}

 
?>