<?php
 
 include ('include/function.php');

session_start();
//error_reporting(0);

$id1=$_SESSION['name'];

$sql = mysqli_query($conn, "select c.user_id from portal_user c where user_name='$id1'");
		 while(($rows_sql = mysqli_fetch_array($sql)) != false) 
		{
		$u_id=$rows_sql['user_id'];
		}
 
 $advance_id = $_GET['advance_id'];
 $adv_amount = $_GET['adv_amount'];
 $no_of_installments = $_GET['no_of_installments'];

 $schedule_amount = $adv_amount/$no_of_installments;
 
 $select_advance_date = mysqli_query($conn,"select advance_date from employee_advance where advance_id = '$advance_id' ");
 while($r = mysqli_fetch_array($select_advance_date))
 {
	  $advance_date = $r['advance_date'];
 }
$date = date("Y-m-d",strtotime($advance_date)); 

 for($i=1;$i<=$no_of_installments;$i++)
 {

$currentMonth = date("m",strtotime($date));
$nextMonth = date("m",strtotime($date."+1 month"));
if($currentMonth==$nextMonth-1)
{
	 $date = date('Y-m-d',strtotime($date."+1 month"));
}
else
{
	 $date = date('Y-m-d',strtotime("last day of next month",strtotime($date)));
}

 
$schedule_date = date('Y-m-d', strtotime($date));

$sql = "INSERT INTO employee_advance_refund_plan (ADVANCE_ID,SCHEDULED_AMOUNT,SCHEDULE_DATE) VALUES ('$advance_id','$schedule_amount','$schedule_date')";
	   $compiled = mysqli_query($conn, $sql);
    
	if($compiled)
	{

	}
	else
	{
	
	}
	
	
 }

?>

