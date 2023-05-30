<?php 

include ('include/function.php');

 $payment=$_GET["payment"];
  $item=$_GET["item"];
  $uom=$_GET["uom"];
 
   $quantity = $_GET["quantity"];
  
 $remarks = $_GET["remarks1"];
 
 $rate = $_GET["rate"];
 
 $discount = $_GET["discount"];
 

 $query="INSERT INTO PURCHASE_REQUEST_DETAIL(REQ_ID,ITEM_CODE,UOM,QUANTITY,REMARKS,RATE,DISCOUNT,USER_ID)VALUES ('$payment','$item','$uom','$quantity','$remarks','$rate','$discount','$userid')"; 
	                      $compiled = mysqli_query($conn,$query);
	                    
                         
	 

?>






