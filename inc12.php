<?php 
//error_reporting(0);
include ('include/function.php');

 //$class=$_POST['class'];
	 $branch=$_GET["branch"];
//	 $department=$_GET["department"];
    $remark = $_GET['remark'];
	 $request = $_GET['request'];
	 $pid=$_GET["payment"];
	  
	
		// $sql2 = "UPDATE PURCHASE_REQUEST_MASTER SET barcode='$barcode', project_id='$project',department_id='$department',remarks='$remark',req_from='$request', status='Y' WHERE req_id='$pid'";
       // $compiled2 = oci_parse($conn, $sql2);
	   // $updated = oci_execute($compiled2);

 $select_barcode = mysqli_query($conn,"select BARCODE from purchase_request_barcode where pr_no is null");

 while($r = mysqli_fetch_array($select_barcode))
 {
	 $barcode = $r['BARCODE'];
 }
	   
	   	 $final_barcode = $barcode.$branch.$pid;
	 
	 	$update = "update purchase_request_barcode set pr_no='$pid' where BARCODE='$barcode'";
		$updated = mysqli_query($conn, $update);
        
 $sql1="UPDATE PURCHASE_REQUEST_MASTER SET remarks='$remark',req_from='$request',status = 'Y',branch_id = '$branch',barcode='$final_barcode'
 WHERE req_id='$pid'";
        	$compiled = mysqli_query($conn, $sql1);
	  $dec = base64_encode($pid);


if($compiled){
		echo "Record Updated";
	}
	else {
		
		echo "Error";
		
	}

	  


	  
if($compiled){
	?>
		 <script type="text/javascript">
                   //Basic
        $('#basic').ready( function () {
            swal({
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-primary',
                text:'Record saved'
            }).catch(swal.noop)
        });
                </script>   
		<?php
		
	}
	else {
		
		echo "Error";
		
	}






?>