<?php 

include ('include/function.php');
 $rf_id = $_GET['q'];
   $in = $_GET['in'];
    $branch_id = $_GET['branch'];
   $out = $_GET['out'];
  error_reporting(0);
date_default_timezone_set("Asia/Karachi");
 $trans_date = date('n/d/Y', strtotime(date('n/d/Y')));
  $timestamp = date('Y-m-d h:i:s a');
  $customized_date=date("Y-m-d");
 
					 $time = date("d-M-Y h:i A");

 $query=mysqli_query($conn,"select * from employees a , employees_current_branch b where a.EMP_ID = b.EMPLOYEE_ID and  a.rf_id = '$rf_id' ");

					while (($row1 = mysqli_fetch_array($query)) != false){
						
						    $employee_id = $row1['EMP_ID'];
							 $employee_name = $row1['EMP_NAME'];
						 
						  $image = $row1['EMP_IMG'];
						 "<br>";
						   $department_id = $row1['DEPARTMENT_ID'];
						  "<br>";
						   $designation_id = $row1['DESIGNATION_ID'];
						  "<br>";
						  
						  $session_id = 1;
						
						   $type = 'E';
						   $present = 'Y';
					}
	
$select_emp_branch = mysqli_query($conn,"select * from employees_current_branch where EMPLOYEE_ID = '$employee_id' and 	BRANCH_ID = '$branch_id' and ACTIVE = 'Y'");

$select_num_emp_branch = mysqli_num_rows($select_emp_branch); 	
				///
				
				if($select_num_emp_branch > 0)
				{
				///
				
			if($in == 'true')
				{
			 
			 
                 $sql = "INSERT INTO daily_attendance(ATT_DATE,TIME_IN,ATTENDENT_ID,ATTENDENT_TYPE,PRESENT,DEPARTMENT_ID,DESIGNATION_ID,BRANCH_ID,SESSION_ID)VALUES('$customized_date','$timestamp','$employee_id','$type','$present','$department_id','$designation_id','$branch_id','$session_id')";
	   

	
	if(mysqli_query($conn, $sql)){
		
		echo "<div class='warning center text-center'>$employee_name</div>";
		echo "<div class='warning center text-center'>$time</div>";
		echo "<div class='warning center text-center'>Attendance In Completed</div>";
			
	}
	else {
		
		echo "<div class='warning center text-center'>Error</div>";
		
	}
				}
else
{
	
	
	 $query = "select * from daily_attendance where attendent_id = '$employee_id' and time_out is null and att_date = '$customized_date' and attendent_type = 'E' ";
         $query_run = mysqli_query($conn,$query);
		 
		 $numrows = mysqli_num_rows($query_run);
		 
		 if($numrows == 0)
		 {	
	   echo "<div class='warning center text-center'>Checked In Attendance Not Found Of this Employee</div>";
	   
	     $sql = "INSERT INTO daily_attendance(ATT_DATE,TIME_OUT,ATTENDENT_ID,ATTENDENT_TYPE,PRESENT,DEPARTMENT_ID,DESIGNATION_ID,BRANCH_ID,SESSION_ID)VALUES('$customized_date','$timestamp','$employee_id','$type','$present','$department_id','$designation_id','$branch_id','$session_id')";
	  

	
	if(mysqli_query($conn, $sql)){
		
		echo "<div class='warning center text-center'>$employee_name</div>";
		echo "<div class='warning center text-center'>$time</div>";
		echo "<div class='warning center text-center'>Attendance Out Completed</div>";
			
	}
	else {
		
		echo "<div class='warning center text-center'>Error</div>";
		
	}
	   
		 }
	   else
	   {
		  
		  $sql = "UPDATE daily_attendance SET TIME_OUT = '$timestamp' where attendent_id = '$employee_id' and time_out is null and att_date = '$customized_date' and attendent_type = 'E' ";
	   
	

	
	if( mysqli_query($conn, $sql)){
		echo "<div class='warning center text-center'>$employee_name</div>";
		
		  echo "<div class='warning center text-center'>$time</div>";
			echo "<div class='warning center text-center'>Attendance Out Completed</div>";
		
	}
		 
	   }
}	
}
else
{
			echo "<div class='warning center text-center'>Invalid Branch</div>";	
}
	
	    // $sql = "INSERT INTO daily_attendance(ATT_DATE,TIME_OUT,ATTENDENT_ID,ATTENDENT_TYPE,PRESENT,DEPARTMENT_ID,DESIGNATION_ID,BRANCH_ID,SESSION_ID)".
       // "VALUES(To_date('".$trans_date."','MM/DD/YY'),TO_DATE('$time', 'dd-mon-yyyy hh:mi PM'),'$employee_id','$type','$present','$department_id','$designation_id','$branch_id','$session_id')";
	   // $compiled = oci_parse($conn, $sql);

	// $ny=oci_execute($compiled);
	// if($ny){
		// echo "<div class='warning center text-center'>$time</div>";
		// echo "<div class='warning center text-center'>Attendance Completed</div>";
			
	// }
	// else {
		
		// echo "<div class='warning center text-center'>Error</div>";
		
	// }
	

?>
  
							<br>
							<center>
								<img src="emp_images/<?php echo $image; ?>" width="200" height="200" />
								</center>
								
						
				
				</div>
			
			</div>