<?php

 include ('include/function.php');


 $tr_no = $_GET['trno'];
 $po_no = $_GET['po_no'];
 $quantity = $_GET['quantity'];
 
	$select_po_detail = mysqli_query($conn,"select * from po_detail where trno = '$tr_no' ");
	
    while($r = mysqli_fetch_array($select_po_detail))
	{
$item_code = $r['ITEM_CODE'];
	}
	
 $select_request_id = mysqli_query($conn,"select REQ_ID from po_master where po_no = '$po_no' ");
 
 while($row = mysqli_fetch_array($select_request_id))
 {
	  $request_id = $row['REQ_ID'];
 }

$select_quantity = mysqli_query($conn,"select * from purchase_request_Detail where REQ_ID = '$request_id' and ITEM_CODE = '$item_code' "); 
while($tu = mysqli_fetch_array($select_quantity))
{
	 $request_quantity = $tu['QUANTITY'];
}	
 
 if($request_quantity < $quantity)
 {
	 echo "<center>Quantity Should Not Be Greater Than $request_quantity..</center>";
 }
 else
 {
	 
	$sql = "UPDATE po_detail SET quantity = '$quantity' where trno = '$tr_no'";
	   $compiled = mysqli_query($conn, $sql);
	

	
	if($compiled){
	 
	 echo "<center>Quantity Updated</center>";

	}
	else
	{
	 echo "<center>Error</center>";		
	}

	 }
 
 
?>