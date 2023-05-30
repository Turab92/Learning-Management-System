<?php

include ('include/function.php');

  $admission_form_id =$_GET['waiting'];
  
 $sql = "UPDATE admission_test SET WAITING_LIST = '1' where ADMISSION_FORM_ID = '$admission_form_id' ";
	  
	 $result = $conn->query($sql);
   
  echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
   echo "<script>location.href='create_student_profile.php'; </script>";


 
?>