<?php

include ('include/function.php');

 $tr_no = $_GET['trno'];
 $quantity = $_GET['quantity'];
 	 
	$sql = "UPDATE po_detail SET quantity = '$quantity' where trno = '$tr_no'";
	   $compiled = mysqli_query($conn, $sql);

	
	if($compiled){
	 
	 echo "<center>Quantity Updated</center>";

	}
	else
	{
	 echo "<center>Error</center>";		
	}


 
?>