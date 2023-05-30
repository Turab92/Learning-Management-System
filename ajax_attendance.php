<?php 

include ('include/function.php');
error_reporting(0);

  $rf_id = $_GET['q'];
  "<br>";
  $in = $_GET['in'];
   "<br>";
  $out = $_GET['out'];
 // error_reporting(0);
date_default_timezone_set("Asia/Karachi");
 $trans_date = date('n/d/Y', strtotime(date('n/d/Y')));
 $timestamp = date('Y-m-d h:i:s a');
$customized_date=date("Y-m-d");
					  
				 $time = date("d-M-Y h:i A");

 $query=mysqli_query($conn,"select * from student_current_status a , student_current_class b where a.RF_ID = '$rf_id' and a.STUDENT_ID = b.STUDENT_ID
and b.ACTIVE = 'Y' ");

					while (($row1 = mysqli_fetch_array($query)) != false){
						
						   $student_id = $row1['STUDENT_ID'];
						   "<br>";
						  $image = $row1['IMG'];
						  $student_name = $row1['APPLICANT_NAME'];
						 "<br>";
						  $class_id = $row1['CLASS_ID'];
						  "<br>";
						  $section_id = $row1['SECTION_ID'];
						  "<br>";
						  $branch_id = $row1['BRANCH_ID'];
						  "<br>";
						   $session_id = $row1['SESSION_ID'];
						   $type = 'S';
						   $present = 'Y';
					}
					
				if($in == 'true')
				{
                 $sql = "INSERT INTO daily_attendance(ATT_DATE,TIME_IN,ATTENDENT_ID,ATTENDENT_TYPE,SESSION_ID,PRESENT,CLASS_ID,SECTION_ID,BRANCH_ID)
       VALUES('$customized_date','$timestamp','$student_id','$type','$session_id','$present','$class_id','$section_id','$branch_id')";
	   

	
	if( mysqli_query($conn, $sql)){
		 echo "<div class='warning center text-center'>$student_name</div>";
		   echo "<div class='warning center text-center'>$time</div>";
			echo "<div class='warning center text-center'>Attendance In Completed</div>";
			
	}
	else {
		
		echo "<div class='warning center text-center'>Error</div>";
		
	}
				 
}
else
{
	
	  $query = "select * from daily_attendance where ATTENDENT_ID = '$student_id' and TIME_OUT is null and ATT_DATE = '$customized_date' and ATTENDENT_TYPE = 'S' ";
         $query_run = mysqli_query($conn,$query);
		 
		 $numrows = mysqli_num_rows($query_run);
		 
		 if($numrows == 0)
		 {	
	   echo "<div class='warning center text-center'>Checked In Attendance Not Found Of this Student</div>";
	   
	    $sql = "INSERT INTO daily_attendance(ATT_DATE,TIME_OUT,ATTENDENT_ID,ATTENDENT_TYPE,SESSION_ID,PRESENT,CLASS_ID,SECTION_ID,BRANCH_ID)
      VALUES('$customized_date','$timestamp','$student_id','$type','$session_id','$present','$class_id','$section_id','$branch_id')";
	  

	
	if(mysqli_query($conn, $sql)){
				 echo "<div class='warning center text-center'>$student_name</div>";
		   echo "<div class='warning center text-center'>$time</div>";
			echo "<div class='warning center text-center'>Attendance Out Completed</div>";
			
	}
	else {
		
		echo "<div class='warning center text-center'>Error</div>";
		
	}
	   
	   
		 }
	   else
	   {
		  
		  $sql = "UPDATE daily_attendance SET TIME_OUT = '$timestamp' where attendent_id = '$student_id' and time_out is null and att_date = '$customized_date' and attendent_type = 'S' ";
	   
	

	
	if(mysqli_query($conn, $sql)){
				 echo "<div class='warning center text-center'>$student_name</div>";
		  echo "<div class='warning center text-center'>$time</div>";
			echo "<div class='warning center text-center'>Attendance Out Completed</div>";
		
	}
		  
	   }
	
	 // $sql = "INSERT INTO daily_attendance(ATT_DATE,TIME_OUT,ATTENDENT_ID,ATTENDENT_TYPE,SESSION_ID,PRESENT,CLASS_ID,SECTION_ID,BRANCH_ID)".
       // "VALUES(To_date('".$trans_date."','MM/DD/YY'),TO_DATE('$time', 'dd-mon-yyyy hh:mi PM'),'$student_id','$type','$session_id','$present','$class_id','$section_id',$branch_id)";
	   // $compiled = oci_parse($conn, $sql);

	// $ny=oci_execute($compiled);
	// if($ny){
		
			// echo "<div class='warning center text-center'>Attendance Completed</div>";
			
	// }
	// else {
		
		// echo "<div class='warning center text-center'>Error</div>";
		
	// }
}

?>
  
							<br>
							<center>
								<img src="student_images/<?php echo $image; ?>" width="200" height="200" />
								</center>
								
						
				
				</div>
			
			</div>