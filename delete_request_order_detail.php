<?php

 include ('include/function.php');

 $tr_no = $_GET['trno'];
 $po_no = $_GET['po_no'];
 
 $select_detail = mysqli_query($conn,"select * from po_detail where po_no = '$po_no' ");
 $selected_detail_rows = mysqli_fetch_all($select_detail);
 
 if($selected_detail_rows == 1)
 {
 echo "Sorry Only One Record Is Left";
 }
else{	
	
$del ="DELETE FROM po_detail WHERE trno = '$tr_no'  ";
$compiled = mysqli_query($conn, $del);
		
		
			if($compiled){
				echo "Detail Deleted";
				
				}
				else{
					
					
					echo "Error";
				}
}
?>