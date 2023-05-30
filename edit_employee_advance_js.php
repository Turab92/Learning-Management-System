<?php
	
include ('include/function.php');

 $advance_id = $_GET['advance_id'];
$adv_amount = $_GET['adv_amount'];
$no_of_installments = $_GET['no_of_installments'];
$adv_date = $_GET['adv_date'];
$payment_mode = $_GET['payment_mode'];
$bank = $_GET['bank'];
$cheque_no = $_GET['cheque_no'];
$cheque_date = $_GET['cheque_date'];

	
	$sql = "UPDATE employee_advance SET ADVANCE_DATE = '".$adv_date."',ADVANCE_AMOUNT = '".$adv_amount."' ,CHEQUE_NO = '".$cheque_no."',CHEQUE_DATE = '".$cheque_date."',
	NO_OF_INSTALLMENT = '".$no_of_installments."',PAYMENT_MODE = '".$payment_mode."',BANK_ID = '".$bank."' where ADVANCE_ID = '$advance_id'";
	   $compiled = mysqli_query($conn, $sql);

	
	if($compiled){
		
		echo "Record Updated";

	}
	else {
		
		echo "Error";
	}
	
	
?>