<?php
include ('include/function.php');

$admission_Date = "2018-01-01";
$david_admission_month=date('m', strtotime($admission_Date));
$admission_year=date('y', strtotime($admission_Date));

$bn=mysqli_query($conn,"select * from sessions_setup where active='Y'");
while($emp=mysqli_fetch_array($bn))
            {
					$from_date = $emp['FROM_DATE'];
					$start_month=date('m', strtotime($from_date));
					$start_year=date('y', strtotime($from_date));
					
					
					$TO_DATE = $emp['TO_DATE'];
					$end_month=date('m', strtotime($TO_DATE));
					$end_year=date('y', strtotime($TO_DATE));
					
			}
if($start_year > $admission_year )
{
	
	
	
	for($p=0; $p <  12; $p++)
			{
				echo "<br>";
				//echo date('Y-m-d', strtotime("+ $i months", strtotime($from_date)));
				echo date('M-Y', strtotime("+ $p months", strtotime($from_date)));
				echo "<br>";
				echo date('m', strtotime("+ $p months", strtotime($from_date)));
				echo "<br>";
				//insert into student schedule 
				//student_id,class_id,session_id,schedule_date,amount,disc
				//2,4,3,Jun-2019,4000,400
			}
}
else
{
	$total_month_duration =  $start_month-$david_admission_month;
	//$total_month =$total_month_duration * 
	$total=$total_month_duration + 12;
	
	for($p=0; $p < $total; $p++)
			{
				echo "<br>";
				//echo date('Y-m-d', strtotime("+ $i months", strtotime($from_date)));
				echo date('M-Y', strtotime("+ $p months", strtotime($admission_Date)));
				echo "<br>";
				echo date('m', strtotime("+ $p months", strtotime($admission_Date)));
				echo "<br>";
				//insert into student schedule 
				//student_id,class_id,session_id,schedule_date,amount,disc
				//2,4,3,Jun-2019,4000,400
			}
}


//student schedule generation
	

?>