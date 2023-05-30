<?php
 
 include ('include/function.php');

  $project = $_GET['project'];
  
  $select_branch = mysqli_query($conn,"select branch_name from school_branches where branch_id = '$project'");
  while($r = mysqli_fetch_array($select_branch))
  {
	  $branch_name = $r['branch_name'];
  }
  
 $employee = $_GET['employee'];
 $payment_mode = $_GET['payment_mode'];
 $bank = $_GET['bank'];
 $cheque_no = $_GET['cheque_no'];
 $cheque_date = $_GET['cheque_date'];
  $adv_amount = $_GET['adv_amount'];
  $no_of_installments = $_GET['no_of_installments'];
 $remarks = $_GET['remarks'];


	
	if($cheque_date == null)
	{
		$c_date = null;
	}
 
 if($project == null || $employee == null || $payment_mode == null || $bank == null || $adv_amount == null || $no_of_installments == null )
{
	echo "Please Fill All The Mandatory Fields";
}
else
	{

$select_advance_id = mysqli_query($conn,"select * from employee_advance order by advance_id asc");
while($r = mysqli_fetch_array($select_advance_id))	
{
	$adv_id = $r['ADVANCE_ID'];
	
	
}	
$adv_id += 1;
?>
<input type="hidden" id="advance_id" value="<?php echo $adv_id; ?>" />
<?php
$sql = "INSERT INTO EMPLOYEE_ADVANCE (EMPLOYEE_ID,ADVANCE_DATE,ADVANCE_AMOUNT,PAYMENT_MODE,BANK_ID,CHEQUE_NO,CHEQUE_DATE,REMARKS,NO_OF_INSTALLMENT,BRANCH_NAME) VALUES ('$employee','$customized_date','$adv_amount','$payment_mode','$bank','$cheque_no','$cheque_date','$remarks','$no_of_installments','$branch_name')";
	   $compiled = mysqli_query($conn, $sql);
	
	if($compiled){
		
		?>
		

<?php		
		echo "<center>Employee Advance Saved</center>";
		echo "<br>";
	

	}
	else {
		
		echo "Error";
		
	}

	}
?>