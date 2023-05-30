<?php

include('config.php');

$ip = $_SERVER['REMOTE_ADDR'];
if (! empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip = $_SERVER['HTTP_CLIENT_IP'];
}
elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
$userid=1;

date_default_timezone_set("Asia/Karachi");
$time = date("d-m-y h:i:s A");
$date=date("d-m-y");
$today_date=date("d-m-y");
$customized_date=date("Y-m-d");

$date_only=date("d");
$time1 = date("h:i:s A");
$title="POS";

function auth_user($pagename,$userid)
{
    global $conn;

    $srs=mysqli_query($conn,"select * from user_reports s,allot_report_user a WHERE s.report_title='$pagename' AND a.report_id=s.report_id AND a.user_id='$userid'");
    $cunt_bn=mysqli_num_rows($srs);
    if($cunt_bn==0){
        echo "<script>alert('You have no rights of this page')</script>";
        echo "<script>window.open('mainmenu.php','_self')</script>";
        exit();
    }

}
function alert_box($var){
    echo "<script>alert('$var')</script>";
}
function redirect($pgname,$type){
    echo "<script>window.open('$pgname','$type')</script>";
}

function user_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$username=$_POST['username'];
		$pass=md5($_POST['password']);
		$status=$_POST['status'];
		$createdby=$_POST['createdby'];
		$branch=$_POST['branch'];
		//insert query
					
		 $query="INSERT INTO `portal_user`(  `branch_id`, `status`, `USER_NAME`, `user_pass`, `CREATED_BY`) VALUES ('$branch','$status','$username','$pass','$createdby')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function mainmenu_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$mainmenu=$_POST['mainmenu'];
		
		$status=$_POST['status'];
		$link=$_POST['link'];
		$sequence=$_POST['sequence'];
		//insert query
					
		 $query="INSERT INTO `main_menu`(  `menu_title`, `sequence_id`, `status`, `menu_link`) VALUES ('$mainmenu','$sequence','$status','$link')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function submenu_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$mainmenu=$_POST['mainmenu'];
		$submenu=$_POST['submenu'];
		$status=$_POST['status'];
		$link=$_POST['link'];
		$sequence=$_POST['sequence'];
		//insert query
					
		 $query="INSERT INTO `user_reports`( `report_name`, `report_title`, `status`, `parent_id`, `sequence_id`) VALUES ('$link','$submenu','$status','$mainmenu','$sequence')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function allot_main_menu()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		$user = $_POST['user'];
		$reports = $_POST['items'];
		

	   foreach($reports as $check){

		   $k=mysqli_query($conn,"select * from allot_main_menu WHERE menu_id='$check' AND user_id='$user'");
		   $k_count=mysqli_num_rows($k);
		   if($k_count==1){
			   echo "<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>warning!</strong> Record Already exist.
		</div>";
			   echo "<script>setTimeout(\"location.href = 'menu_alloting.php';\",2000);</script>";

		   }
		   else{

				   $query="INSERT INTO `allot_main_menu`(`menu_id`, `user_id` ) VALUES ('$check','$user')";
					if (mysqli_query($conn, $query)) 
					{	
							echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
					} 
					else 
					{
						echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
					}
				}
	   }
		

		
		
		
	}
	
	
}
function allot_sub_menu()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		$user = $_POST['user'];
		$reports = $_POST['items'];
		

	   foreach($reports as $check){

		   $k=mysqli_query($conn,"select * from allot_report_user WHERE report_id='$check' AND user_id='$user'");
		   $k_count=mysqli_num_rows($k);
		   if($k_count==1){
			   echo "<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>warning!</strong> Record Already exist.
		</div>";
			   echo "<script>setTimeout(\"location.href = 'submenu_allot.php';\",2000);</script>";

		   }
		   else{

				   $query="INSERT INTO `allot_report_user`( `report_id`, `user_id`) VALUES ('$check','$user')";
					if (mysqli_query($conn, $query)) 
					{	
							echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
					} 
					else 
					{
						echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
					}
				}
	   }
		

		
		
		
	}
	
	
}
function session_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$todate=$_POST['todate'];
		$fromdate=$_POST['fromdate'];
		$timein=$_POST['timein'];
		$timeout=$_POST['timeout'];
		$surcharge=$_POST['surcharge'];
		$status=$_POST['status'];
		//insert query
					
		 $query="INSERT INTO `sessions_setup`( `FROM_DATE`, `TO_DATE`, `ACTIVE`, `TIME_IN`, `TIME_OUT`, `SURCHARGE`) VALUES ('$fromdate','$todate','$status','$timein','$timeout','$surcharge')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function branch_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$branchname=$_POST['branchname'];
		$branchaddress=$_POST['branchaddress'];
		$branchtype=$_POST['branchtype'];
		
		//insert query
					
		 $query="INSERT INTO `school_branches`( `branch_name`, `branch_address`, `active`, `branch_type`, `pc_ip`, `user_id`) VALUES ('$branchname','$branchaddress','Y','$branchtype','$ip','$userid')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function class_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$classname=$_POST['classname'];
	
		
		//insert query
					
		 $query="INSERT INTO `class_setup`( `CLASS_DESCRIPTION`, `PC_IP`, `USER_ID`, `ACTIVE`) VALUES ('$classname','$ip','$userid','Y')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function gender_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$gender=$_POST['gender'];
	
		
		//insert query
					
		 $query="INSERT INTO `gender_setup`( `GENDER_DESCRIPTION`) VALUES ('$gender')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function religion_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$religion=$_POST['religion'];
	
		
		//insert query
					
		 $query="INSERT INTO `religion_setup`( `REG_NAME`,`PC_IP`, `USER_ID`) VALUES ('$religion','$ip','$userid')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function section_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$section=$_POST['section'];
	
		
		//insert query
					
		 $query="INSERT INTO `class_setup_section`( `SECTION_DESCRIPTION`, `PC_IP`, `USER_ID`, `ACTIVE`) VALUES ('$section','$ip','$userid','Y')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function class_section_capacity_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$branch=$_POST['branch'];
		$class=$_POST['class'];
		$section=$_POST['section'];
		$capacity=$_POST['capacity'];
	
		
		//insert query
					
		 $query="INSERT INTO `class_sections_capacity`(`CLASS_ID`, `SECTION_ID`, `CAPACITY`, `PC_IP`, `USER_ID`,  `BRANCH_ID`) VALUES ('$class','$section','$capacity','$ip','$userid','$branch')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}

function class_branch_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		$branch = $_POST['branch'];
		$reports = $_POST['items'];
		

	   foreach($reports as $check){

		   $k=mysqli_query($conn,"select * from class_branch_setup WHERE CLASS_ID='$check' AND BRANCH_ID='$branch'");
		   $k_count=mysqli_num_rows($k);
		   if($k_count==1){
			   echo "<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>warning!</strong> Record Already exist.
		</div>";
			   echo "<script>setTimeout(\"location.href = 'class_branch_setup.php';\",2000);</script>";

		   }
		   else{

				   $query="INSERT INTO `class_branch_setup`(`CLASS_ID`, `BRANCH_ID` ) VALUES ('$check','$branch')";
					if (mysqli_query($conn, $query)) 
					{	
							echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
					} 
					else 
					{
						echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
					}
				}
	   }
		

		
		
		
	}
	
	
}
function employee_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		$errors= array();
		
		 $file_name = $_FILES['image']['name'];
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		  
		  $expensions= array("jpeg","jpg","png");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  }
		  
		  if($file_size > 1000000){
			 $errors[]='File size must be exactely 1000 KB';
		  }
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp,"emp_images/".$file_name);
			 //echo "Success";
		  }else{
			 print_r($errors);
		  }
		
		
		
		$name = $_POST['name'];
		$fname = $_POST['fname'];
		$address=$_POST['address'];
		$cnic=$_POST['cnic'];
		$department=$_POST['department'];
		$designation=$_POST['designation'];
		$contact = $_POST['contact'];
		$account = $_POST['account'];
		$remark=$_POST['remark'];
		$joining=$_POST['joining'];
		$gender=$_POST['gender'];
		$religion=$_POST['religion'];
		$emptype = $_POST['emptype'];
		$qualification = $_POST['qualification'];
		$experience=$_POST['experience'];
		$payrate=$_POST['payrate'];
		$depositry=$_POST['depositry'];
		$rfid=$_POST['rfid'];
		$grade=$_POST['grade'];
		$reference=$_POST['reference'];
		$status = 'Active';
		
		$k=mysqli_query($conn,"select * from employees WHERE RF_ID='$rfid'");
		   $k_count=mysqli_num_rows($k);
		   if($k_count==0)
		   {
			   //insert query
							
				 $query="INSERT INTO `employees`(`EMP_NAME`, `EMP_FATHER_NAME`, `EMP_CNIC`, `CONTACT_NO`, `DATE_OF_JOINING`, `GENDER`, `RELIGION`, `PAY_RATE`, `REMARKS`, `PC_IP`, `USER_ID`, `EMP_EXPERIENCE`, `EMP_QUALIFICATION`, `EMP_IMG`, `DESIGNATION_ID`, `DEPARTMENT_ID`, `EMP_TYPE`, `ACCOUNT_NO`, `DEPOSIT_BANK_ID`, `RF_ID`, `GRADE_ID`, `EMP_ADDRESS`,`REFRENCE`, `STATUS`,EMP_STATUS) VALUES ('$name','$fname','$cnic','$contact','$joining','$gender','$religion','$payrate','$remark','$ip','$userid','$experience','$qualification','$file_name','$designation','$department','$emptype','$account','$depositry','$rfid','$grade','$address','$reference','Y','$status')";
				if (mysqli_query($conn, $query)) 
				{	
						//echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";
						 echo"<script type='text/javascript'>alert('Data Insertted Succesfuly');</script>";
							echo "<script>location.href='employee'; </script>";
				} 
				else 
				{
						//echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
						 echo"<script type='text/javascript'>alert('Error! Data Not Inserted');</script>";
							echo "<script>location.href='employee'; </script>";
				}
			  
		   }
		   else
		   {
				 //echo "<div class='alert alert-success alert-dismissable'>Sorry! RFID Already Exist</div>";	
				 echo"<script type='text/javascript'>alert('Sorry! RFID Already Exist');</script>";
							echo "<script>location.href='employee'; </script>";
		   }
		
	}
	
	
}
function emp_branch_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		$employee = $_POST['employee'];
		$reports = $_POST['items'];
		

	   foreach($reports as $check){

		   $k=mysqli_query($conn,"select * from employees_current_branch WHERE BRANCH_ID='$check' AND EMPLOYEE_ID='$employee'");
		   $k_count=mysqli_num_rows($k);
		   if($k_count==1){
			   echo "<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>warning!</strong> Record Already exist.
		</div>";
			   echo "<script>setTimeout(\"location.href = 'employee_branch_setup.php';\",2000);</script>";

		   }
		   else{

				   $query="INSERT INTO `employees_current_branch`( `EMPLOYEE_ID`, `BRANCH_ID`,`ACTIVE`) VALUES ('$employee','$check','Y')";
					if (mysqli_query($conn, $query)) 
					{	
							echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
					} 
					else 
					{
						echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
					}
				}
	   }
		

		
		
		
	}
	
	
}
function emp_type_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$emptype=$_POST['emptype'];
	
		
		//insert query
					
		 $query="INSERT INTO `employee_type_setup`( `EMPLOYEE_TYPE`) VALUES ('$emptype')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function designation_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$designation=$_POST['designation'];
	
		
		//insert query
					
		 $query="INSERT INTO `designation`(  `designation_name`, `ACTIVE`) VALUES ('$designation','Y')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function department_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$department=$_POST['department'];
	
		
		//insert query
					
		 $query="INSERT INTO `department`(`DESCRIPTION`, `ACTIVE`, `PC_IP`, `USER_ID`) VALUES ('$department','Y','$ip','$userid')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function allowance_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$allowance=$_POST['allowance'];
	
		
		//insert query
					
		 $query="INSERT INTO `allowances`(`allowance_name`, `status`, `user_id`, `pc_ip`) VALUES ('$allowance','Y','$userid','$ip')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function qualification_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$qualification=$_POST['qualification'];
	
		
		//insert query
					
		 $query="INSERT INTO `qualification`(`qualification_name`) VALUES ('$qualification')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function grade_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$grade=$_POST['grade'];
	
		
		//insert query
					
		 $query="INSERT INTO `employee_grade`(`grade_name`) VALUES ('$grade')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function leave_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$leave=$_POST['leave'];
	
		
		//insert query
					
		 $query="INSERT INTO `leave_type`(`leave_name`) VALUES ('$leave')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function subject_type_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$subtype=$_POST['subtype'];
	
		
		//insert query
					
		 $query="INSERT INTO `subject_type`(`sub_type_name`) VALUES ('$subtype')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function subject_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$subject=$_POST['subject'];
	
		
		//insert query
					
		 $query="INSERT INTO `subjects`(`sub_name`) VALUES ('$subject')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function document_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$document=$_POST['document'];
	
		
		//insert query
					
		 $query="INSERT INTO `documents`(`doc_name`) VALUES ('$document')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function class_subject_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$class=$_POST['class'];
		$subject=$_POST['subject'];
		$subtype=$_POST['subtype'];
		
	
		$k=mysqli_query($conn,"select * from class_subject_assign WHERE class_id='$class' AND subject_id='$subject' AND subject_type_id='$subtype'");
		   $k_count=mysqli_num_rows($k);
		   if($k_count==1){
			   echo "<div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<strong>warning!</strong> Menu Already Alloted.
				</div>";
					   echo "<script>setTimeout(\"location.href = 'class_subject.php';\",2000);</script>";

		   }
		   else{
					 $query="INSERT INTO `class_subject_assign`(`class_id`, `subject_id`, `subject_type_id`, `user_id`, `pc_ip`) VALUES ('$class','$subject','$subtype','$userid','$ip')";
					if (mysqli_query($conn, $query)) 
					{	
							echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
					} 
					else 
						{
							echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
						}
				}
		//insert query
					
		
		
	}
	
	
}
function period_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$peroid=$_POST['peroid'];
		$duration=$_POST['duration'];
	
		
		//insert query
					
		 $query="INSERT INTO `period_setup`(`class_period`, `duration`, `user_id`, `pc_ip`) VALUES ('$peroid','$duration','$userid','$ip')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function right_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		$user = $_POST['user'];
		$reports = $_POST['items'];
		

	   foreach($reports as $check){

		   $k=mysqli_query($conn,"select * from employee_right WHERE right_id='$check' AND user_id='$user'");
		   $k_count=mysqli_num_rows($k);
		   if($k_count==1){
			   echo "<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>warning!</strong> Record Already exist.
		</div>";
			   echo "<script>setTimeout(\"location.href = 'edit_delete_rights.php';\",2000);</script>";

		   }
		   else{

				   $query="INSERT INTO `employee_right`( `user_id`, `right_id`, `given_by`, `pc_ip`) VALUES ('$user','$check','$userid','$ip')";
					if (mysqli_query($conn, $query)) 
					{	
							echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
					} 
					else 
					{
						echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
					}
				}
	   }
		

		
		
		
	}
	
	
}
function assign_leave_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$leave=$_POST['leave'];
		$depart=$_POST['depart'];
		$design=$_POST['design'];
		$leaveno=$_POST['leaveno'];
		$maxleave=$_POST['maxleave'];
		
	
		$k=mysqli_query($conn,"select * from assign_leave WHERE leave_id='$leave' AND depart_id='$depart' AND design_id='$design'");
		   $k_count=mysqli_num_rows($k);
		   if($k_count==1){
			   echo "<div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<strong>warning!</strong> Menu Already Alloted.
				</div>";
					   echo "<script>setTimeout(\"location.href = 'assign_leaves.php';\",2000);</script>";

		   }
		   else{
					 $query="INSERT INTO `assign_leave`(`leave_id`, `depart_id`, `design_id`, `no_of_leave`, `max_leave`, `user_id`, `pc_ip`) VALUES ('$leave','$depart','$design','$leaveno','$maxleave','$userid','$ip')";
					if (mysqli_query($conn, $query)) 
					{	
							echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
					} 
					else 
						{
							echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
						}
				}
		//insert query
					
		
		
	}
	
	
}
function employee_allowance_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$branch=$_POST['branch'];
		$employee=$_POST['employee'];
		$allowance=$_POST['allowance'];
		$amount=$_POST['amount'];
		
		
	
		$k=mysqli_query($conn,"select * from employee_allowances WHERE branch_id='$branch' AND emp_id='$employee' AND allowance_id='$allowance'");
		   $k_count=mysqli_num_rows($k);
		   if($k_count==1){
			   echo "<div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<strong>warning!</strong> Menu Already Alloted.
				</div>";
					   echo "<script>setTimeout(\"location.href = 'employee_allowance.php';\",2000);</script>";

		   }
		   else{
					 $query="INSERT INTO `employee_allowances`(`branch_id`, `emp_id`, `allowance_id`, `amount`, `status`, `user_id`, `pc_ip`) VALUES ('$branch','$employee','$allowance','$amount','Y','$userid','$ip')";
					if (mysqli_query($conn, $query)) 
					{	
							echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
					} 
					else 
						{
							echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
						}
				}
		//insert query
					
		
		
	}
	
	
}
function admission_form_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		$errors= array();
		
		 $file_name = $_FILES['image']['name'];
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		  
		  $expensions= array("jpeg","jpg","png");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  }
		  
		  if($file_size > 1000000){
			 $errors[]='File size must be exactely 1000 KB';
		  }
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp,"student_images/".$file_name);
			 //echo "Success";
		  }else{
			 print_r($errors);
		  }
		
		
		//Student Details
		$name = $_POST['name'];
		$fname = $_POST['fname'];
		$mname=$_POST['mname'];
		$nationality=$_POST['nationality'];
		$branch=$_POST['branch'];
		$remark=$_POST['remark'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$dob=$_POST['dob'];
		$gender=$_POST['gender'];
		$religion=$_POST['religion'];
		$dateadm=$_POST['dateadm'];
		$testdate = $_POST['testdate'];
		$result = $_POST['result'];
		$session=$_POST['session'];
		$class=$_POST['class'];
		
		//Contact Person
		$contname=$_POST['contname'];
		$mobnum=$_POST['mobnum'];
		$contadd=$_POST['contadd'];
		
		//Guardians
		$guardname=$_POST['guardname'];
		$guardcnic=$_POST['guardcnic'];
		$relation=$_POST['relation'];
		$guardnation=$_POST['guardnation'];
		$profession=$_POST['profession'];
		
		//Disease Detail
		$disease=$_POST['disease'];
	
		
		//insert query
					
		 $query="INSERT INTO `admission_test`(`APPLICANT_NAME`, `FATHER_NAME`, `MOTHER_NAME`, `DATE_OF_BIRTH`, `APPLICANT_ADDRESS`, `GUARDIAN_NAME`, `GUARDIAN_CNIC_NO`, `APPLICANT_NATIONALITY`, `GENDER`, `RELIGION`, `GUARDIAN_NATIONALITY`, `GUARDIAN_PROFFESSION`, `SPECIAL_CASE_REMARKS`, `CONTACT_PERSON_NAME`, `CONTACT_PERSON_MOB`, `CONTACT_PERSON_ADDRESS`, `APPLICANT_CONTACT_NO`, `IMG`, `SESSION_ID`, `BRANCH_ID`, `DIESEASE_DETAIL`,`PC_IP`, `USER_ID`, `DATE_OF_SUBMISSION`,`TEST_RESULT`, `DATE_OF_TEST`, `APPLICANT_GUARDIAN_RELATION`,`CLASS_ID`) VALUES ('$name','$fname','$mname','$dob','$address','$guardname','$guardcnic','$nationality','$gender','$religion','$guardnation','$profession','$remark','$contname','$mobnum','$contadd','$contact','$file_name','$session','$branch','$disease','$ip','$userid','$dateadm','$result','$testdate','$relation','$class')";
		if (mysqli_query($conn, $query)) 
		{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
		{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
		}
			  
		

		
		
		
	}
	
	
}
function student_profile_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		$errors= array();
		
		 $file_name = $_FILES['image']['name'];
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		  
		  $expensions= array("jpeg","jpg","png");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  }
		  
		  if($file_size > 1000000){
			 $errors[]='File size must be exactely 1000 KB';
		  }
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp,"reference_image/".$file_name);
			 //echo "Success";
		  }else{
			 print_r($errors);
		  }
		
		
		//Student Details
		$formid = $_POST['formid'];
		$stdimage = $_POST['stdimage'];
		$name = $_POST['name'];
		$fname = $_POST['fname'];
		$mname=$_POST['mname'];
		$nationality=$_POST['nationality'];
		$branch=$_POST['branch'];
		$remark=$_POST['remark'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$dob=$_POST['dob'];
		$gender=$_POST['gender'];
		$religion=$_POST['religion'];
		$dateadm=$_POST['dateadm'];
		$session=$_POST['session'];
		$class=$_POST['class'];
		$blood=$_POST['blood'];
		$section=$_POST['section'];
		$rollno=$_POST['rollno'];
		$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];
		$rfid=$_POST['rfid'];
		
		//Contact Person
		$contname=$_POST['contname'];
		$mobnum=$_POST['mobnum'];
		$email=$_POST['email'];
		$contadd=$_POST['contadd'];
		
		//reference
		$formno=$_POST['formno'];
		$refname=$_POST['refname'];
		$refcnic=$_POST['refcnic'];
		$refaddress=$_POST['refaddress'];
		$refmobno=$_POST['refmobno'];
		
		//siblings
		$siblingcnic=$_POST['siblingcnic'];
		
		//Guardians
		$guardname=$_POST['guardname'];
		$guardcnic=$_POST['guardcnic'];
		$relation=$_POST['relation'];
		$guardnation=$_POST['guardnation'];
		$profession=$_POST['profession'];
		
		//Disease Detail
		$disease=$_POST['disease'];
	
		$query = mysqli_query($conn, "select * from class_sections_capacity where class_id = '$class' and section_id = '$section'  "); 
	
		while (($rows_f = mysqli_fetch_array($query)) != false) {
		
		  $section_capacity = $rows_f['CAPACITY'];
		
		}
		
		$select_total = mysqli_query($conn,"select count(student_id) from student_current_class where section_id = '$section' and class_id = '$class' and active = 'Y'");
		
		while (($rows_f = mysqli_fetch_array($select_total)) != false) {
		
		  $section_total = $rows_f['count(student_id)'];
		
		}
		

		
		
		$s = mysqli_query($conn, "select * from STUDENT_CURRENT_STATUS where RF_ID = '$rfid'");
	
		$numrows = mysqli_num_rows($s);

		if($numrows==0){
			
			

		$select_roll = mysqli_query($conn, "select * from student_current_class where roll_no = '$rollno' ");
		
		$select_num_roll = mysqli_num_rows($select_roll);

		if($select_num_roll == 0){

		



			if($section_capacity == $section_total)
		{
		  echo "<script>alert('Section is Full')</script>";		
		}
		else
		{
				//insert query
						
			 $query="INSERT INTO `student_current_status`(`APPLICANT_NAME`, `FATHER_NAME`, `MOTHER_NAME`, `DATE_OF_BIRTH`, `APPLICANT_ADDRESS`, `GUARDIAN_NAME`, `GUARDIAN_CNIC_NO`, `APPLICANT_NATIONALITY`, `GENDER`, `RELIGION`, `GUARDIAN_NATIONALITY`, `GUARDIAN_PROFFESSION`, `DATE_OF_SUBMISSION`, `SPECIAL_CASE_REMARKS`, `ADMISSION_FORM_ID`, `CONTACT_PERSON_NAME`, `CONTACT_PERSON_MOB`, `CONTACT_PERSON_ADDRESS`, `CLASS_ID`, `REFERENCE_FORM_NO`, `REFERENCE_PERSON_NAME`, `REFERENCE_PERSON_CNIC_NO`, `REFERENCE_PERSON_ADDRESS`, `REFERENCE_PERSON_CONTACT_MOB`, `APPLICANT_CONTACT_RES_NO`, `PC_IP`, `USER_ID`, `IMG`, `STUDENT_STATUS`, `SESSION_ID`, `BLOOD_GROUP`,   `SECTION_ID`,  `SIBLING_CNIC_NO`, `RF_ID`, `BRANCH_ID`,  `CONTACT_PERSON_EMAIL`, `REFERENCE_PICTURES`, `DISEASE_DETAILS`) VALUES ('$name','$fname','$mname','$dob','$address','$guardname','$guardcnic','$nationality','$gender','$religion','$guardnation','$profession','$dateadm','$remark','$formid','$contname','$mobnum','$contadd','$class','$formno','$refname','$refcnic','$refaddress','$refmobno','$contact','$ip','$userid','$stdimage','Student','$session','$blood','$section','$siblingcnic','$rfid','$branch','$email','$file_name','$disease')";
			if (mysqli_query($conn, $query)) 
			{	
					echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";
					$f = mysqli_query($conn, "select * from STUDENT_CURRENT_STATUS order by STUDENT_ID ASC"); 
		
					while (($rows_f = mysqli_fetch_array($f)) != false) {
					 $stdid=$rows_f['STUDENT_ID'];
					}
					$studentid=$stdid+1;
					$query="UPDATE admission_test set IS_PROFILE_MADE = '1' where ADMISSION_FORM_ID = '$formid' ";
					$result = $conn->query($query);	

					$sql = 'INSERT INTO student_current_class(STUDENT_ID,CLASS_ID,ACTIVE,PC_IP,USER_ID,SECTION_ID,SESSION_ID,FROM_DATE,TO_DATE,ROLL_NO,BRANCH_ID)'.
					"VALUES('$stdid','$class','Y','$ip','$userid','$section','$session','$fromdate','$todate','$rollno','$branch')";
					$result1 = $conn->query($sql);
			} 
			else 
			{
					echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
				
		}
	
		}
		else
		{
			echo "<script>alert('Please Enter A New Roll No $roll')</script>";
		}
		
		}else
		{
			echo "<script>alert('Please Enter a New Enter Rf Id $rf_id')</script>";
		}
	
		
		
	}
	
	
}
function student_document_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		$errors= array();
		
		 $file_name = $_FILES['image']['name'];
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		  
		  $expensions= array("jpeg","jpg","png");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  }
		  
		  if($file_size > 1000000){
			 $errors[]='File size must be exactely 1000 KB';
		  }
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp,"student_document/".$file_name);
			 //echo "Success";
		  }else{
			 print_r($errors);
		  }
		
		
		
		$stdid = $_POST['stdid'];
		$document = $_POST['document'];
		$stdname=$_POST['stdname'];
		
	
	
		
		//insert query
					
		 $query="INSERT INTO `student_doc_attached`(`doc_id`, `Img_loc`, `student_id`, `pc_ip`, `user_id`) VALUES ('$document','$file_name','$stdid','$ip','$userid')";
		if (mysqli_query($conn, $query)) 
		{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
		{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
		}
			  
		

		
		
		
	}
	
	
}
function student_bearer_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$stdid=$_POST['stdid'];
		$bearname=$_POST['bearname'];
		$bearcont=$_POST['bearcont'];
		$chngdate=$_POST['chngdate'];
		$bearnic=$_POST['bearnic'];
		$issuedate=$_POST['issuedate'];
		
	
		$query = "update student_current_bearer set active = 'N' where student_id = '$stdid' ";
		$result = $conn->query($query);
		//insert query
					
		 $query="INSERT INTO `student_current_bearer`(`bearer_name`, `student_id`, `bearer_nic`, `bearer_contact`, `date_of_issue`, `change_date`, `active`, `pc_ip`, `user_id`) VALUES ('$bearname','$stdid','$bearnic','$bearcont','$issuedate','$chngdate','Y','$ip','$userid')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function student_parent_contact()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$stdid=$_POST['stdid'];
		$fname=$_POST['fname'];
		$branchid=$_POST['branchid'];
		$fcontact=$_POST['fcontact'];
		$mname=$_POST['mname'];
		$mcontact=$_POST['mcontact'];
		
	
		$query = "update student_parent_contact set active = 'N' where student_id = '$stdid' ";
		$result = $conn->query($query);
		//insert query
					
		 $query="INSERT INTO `student_parent_contact`(`father_name`, `father_contact`, `mother_name`, `mother_contact`, `active`, `student_id`, `branch_id`, `pc_ip`, `user_id`) VALUES ('$fname','$fcontact','$mname','$mcontact','Y','$stdid','$branchid','$ip','$userid')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function student_previous_detail()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$stdid=$_POST['stdid'];
		$fromdate=$_POST['fromdate'];
		$fromclass=$_POST['fromclass'];
		$lastpercent=$_POST['lastpercent'];
		$previous=$_POST['previous'];
		$todate=$_POST['todate'];
		$toclass=$_POST['toclass'];
		$reason=$_POST['reason'];
		
	
		 $k=mysqli_query($conn,"select * from student_previous_detail WHERE student_id='$stdid'");
		   $k_count=mysqli_num_rows($k);
		   if($k_count==1){
			   echo "<div class='alert alert-success'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<strong>warning!</strong> Student Previous Details Already Exist.
				</div>";
					   echo "<script>setTimeout(\"location.href = 'prev_docs.php';\",2000);</script>";

		   }
		   else{
				//insert query
							
				 $query="INSERT INTO `student_previous_detail`(`student_id`, `academy_name`, `from_date`, `to_date`, `from_class`, `to_class`, `last_class_percent`, `reason_for_left`, `pc_ip`, `user_id`) VALUES ('$stdid','$previous','$fromdate','$todate','$fromclass','$toclass','$lastpercent','$reason','$ip','$userid')";
				if (mysqli_query($conn, $query)) 
					{	
								echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
						} 
						else 
							{
								echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
							}
						
			}
	}
	
}
function nature_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$nature=$_POST['nature'];
		$status=$_POST['status'];
		$amount=$_POST['amount'];
	
		
		//insert query
					
		 $query="INSERT INTO `nature_payments`(`DESCRIPTION`,`AMOUNT`, `ACTIVE`, `PC_IP`, `USER_ID`) VALUES ('$nature','$amount','$status','$ip','$userid')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function payment_frequency_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$descrip=$_POST['descrip'];
		$numdate=$_POST['numdate'];
		$status=$_POST['status'];
	
		
		//insert query
					
		 $query="INSERT INTO `payment_frequency_unit`(`DESCRIPTION`, `NO_DAYS`, `ACTIVE`, `PC_IP`, `USER_ID`) VALUES ('$descrip','$numdate','$status','$ip','$userid')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function payment_mode_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$Description=$_POST['Description'];
		
	
		
		//insert query
					
		 $query="INSERT INTO `payment_mode`(`DESCRIPTION`, `USER_ID`,  `PC_IP`) VALUES ('$Description','$userid','$ip')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function charges_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$descrip=$_POST['descrip'];
		$nature=$_POST['nature'];
		$percent=$_POST['percent'];
		$fix=$_POST['fix'];
		$admission=$_POST['admission'];
		$sibling=$_POST['sibling'];
		$status=$_POST['status'];
		
		
		//insert query
					
		 $query="INSERT INTO `charges_types`(`CHARGES_DESCRIPTION`, `NATURE_ID`, `ACTIVE`, `PC_IP`, `USER_ID`, `ROYALITY_PERCENT`, `ROYALITY_FIX`, `CHK`, `ON_ADMI`) VALUES ('$descrip','$nature','$status','$ip','$userid','$percent','$fix','$admission','$sibling')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function account_type_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$typename=$_POST['typename'];
	
		
		//insert query
					
		 $query="INSERT INTO `account_types`(`ACC_DESCRIPTION`) VALUES ('$typename')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function account_detail_type()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$type=$_POST['type'];
		$descrip=$_POST['descrip'];
		$type1=$type+1;
		
		$r1 = mysqli_query($conn, "select * from account_types_detail where account_type='$type'");  
	
	
		$run=mysqli_num_rows($r1);
		
		if($run=0){
		
		//insert query
					
		 $query="INSERT INTO `account_types_detail`(`ACCOUNT_TYPE`, `ACC_DETAIL_TYPE`, `DESCRIPTION`, `USER_ID`, `PC_IP`) VALUES ('$type','$type1','$descrip','$userid','$ip')";
			if (mysqli_query($conn, $query)) 
			{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
			} 
			else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
		}
		else
		{
			while (($rows1 = mysqli_fetch_array($r1)) != false) {
				$at=$rows1['ACC_DETAIL_TYPE'];
			}
		

			$n1=$at+1;
			 $query="INSERT INTO `account_types_detail`(`ACCOUNT_TYPE`, `ACC_DETAIL_TYPE`, `DESCRIPTION`, `USER_ID`, `PC_IP`) VALUES ('$type','$n1','$descrip','$userid','$ip')";
			if (mysqli_query($conn, $query)) 
			{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
			} 
			else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		}
	}
	
	
}
function account_head_code()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$type=$_POST['type'];
		$class=$_POST['class'];
		$descrip=$_POST['descrip'];
		$type1=$type+1;
		
		$r1 = mysqli_query($conn, "select * from chart_head where acc_type='$type'");  
	
	
		$run=mysqli_num_rows($r1);
		
		if($run=0){
			if($atype=10000){
			$headcode=100;
		}
		else if($atype=20000){
			$headcode=300;
		}
		else if($atype=30000){
			$headcode=500;
		}
		else if($atype=40000){
			$headcode=700;
		}else{
			$headcode=900;
		}
		$headcode1=$headcode+1;
		
		//insert query
					
		 $query="INSERT INTO `chart_head`(`ACC_TYPE`, `HEAD_CODE`, `HEAD_DESC`, `USER_ID`, `PC_IP`, `ACC_DETAIL_TYPE`) VALUES ('$type','$headcode1','$descrip','$userid','$ip','$class')";
			if (mysqli_query($conn, $query)) 
			{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
			} 
			else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
		}
		else
		{
			while (($rows1 = mysqli_fetch_array($r1)) != false) {
				$at=$rows1['HEAD_CODE'];
			}
		

			$n1=$at+1;
			 $query="INSERT INTO `chart_head`(`ACC_TYPE`, `HEAD_CODE`, `HEAD_DESC`, `USER_ID`, `PC_IP`, `ACC_DETAIL_TYPE`) VALUES ('$type','$n1','$descrip','$userid','$ip','$class')";
			if (mysqli_query($conn, $query)) 
			{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
			} 
			else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		}
	}
	
	
}
function account_code()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$type=$_POST['type'];
		$class=$_POST['class'];
		$class2=$_POST['class2'];
		$descrip=$_POST['descrip'];
		$classcheck=$_POST['class_check'];
		$type1=$type+1;
		
		$r1 = mysqli_query($conn, "select * from chart_detail where acc_type='$type' and acc_detail_type='$class'");  
	
	
		$run=mysqli_num_rows($r1);
		
		if($run=0){
		$test=0+1;
		
		//insert query
					
		 $query="INSERT INTO `chart_detail`(`CHART_HEAD_CODE`, `CHART_ACC_CODE`, `CHART_ACC_DESC`, `ACTIVE`, `USER_ID`, `PC_IP`, `ACC_TYPE`, `ACC_DETAIL_TYPE`) VALUES ('$class2','$test','$descrip','$classcheck','$userid','$ip','$type','$class')";
			if (mysqli_query($conn, $query)) 
			{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
			} 
			else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
		}
		else
		{
			while (($rows1 = mysqli_fetch_array($r1)) != false) {
				$at=$rows1['CHART_ACC_CODE'];
			}
		

			$n1=$at+1;
			 $query="INSERT INTO `chart_detail`(`CHART_HEAD_CODE`, `CHART_ACC_CODE`, `CHART_ACC_DESC`, `ACTIVE`, `USER_ID`, `PC_IP`, `ACC_TYPE`, `ACC_DETAIL_TYPE`) VALUES ('$class2','$n1','$descrip','$classcheck','$userid','$ip','$type','$class')";
			if (mysqli_query($conn, $query)) 
			{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
			} 
			else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		}
	}
	
	
}
function chart_company()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$type=$_POST['type'];
		$class=$_POST['class'];
		$class2=$_POST['class2'];
		$reports=$_POST['items'];
		$company=$_POST['company'];
		
		 foreach($reports as $check){
				$r1 = mysqli_query($conn, "select * from chart_detail_company where acc_type = '$type' and acc_detail_type = '$class' and chart_head_code = '$class2' and chart_acc_code = '$check' and company_id = '$company'");  
	
		
				$run=mysqli_num_rows($r1);
				
				if($run==0){
				
				
				//insert query
							
				 $query="INSERT INTO `chart_detail_company`(`ACC_TYPE`, `ACC_DETAIL_TYPE`, `CHART_HEAD_CODE`, `CHART_ACC_CODE`, `COMPANY_ID`, `PC_IP`, `USER_ID`) VALUES ('$type','$class','$class2','$check','$company','$ip','$userid')";
					if (mysqli_query($conn, $query)) 
					{	
						echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
					} 
					else 
					{
						echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
					}
				
				}
				else
				{
					echo "<script>alert('Record Already Exist')</script>";
				}
		 }
	}
	
	
}
function chart_project()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$type=$_POST['type'];
		$class=$_POST['class'];
		$class2=$_POST['class2'];
		$reports=$_POST['items'];
		$branch=$_POST['branch'];
		$class_check=$_POST['class_check'];
		
		 foreach($reports as $check){
				$r1 = mysqli_query($conn, "select * from chart_detail_project where acc_type = '$type' and acc_detail_type = '$class' and chart_head_code = '$class2' and chart_acc_code = '$check' and PROJECT_ID = '$branch'");  
	
		
				$run=mysqli_num_rows($r1);
				
				if($run==0){
				
				
				//insert query
							
				 $query="INSERT INTO `chart_detail_project`(`ACC_TYPE`, `ACC_DETAIL_TYPE`, `CHART_HEAD_CODE`, `CHART_ACC_CODE`, `PROJECT_ID`, `ACTIVE`, `PC_IP`, `USER_ID`) VALUES ('$type','$class','$class2','$check','$branch','$class_check','$ip','$userid')";
					if (mysqli_query($conn, $query)) 
					{	
						echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
					} 
					else 
					{
						echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
					}
				
				}
				else
				{
					echo "<script>alert('Record Already Exist')</script>";
				}
		 }
	}
	
	
}
function voucher_type()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$voucherdesc=$_POST['voucherdesc'];
		$nature=$_POST['nature'];
		
		//insert query
					
		 $query="INSERT INTO `voucher_types`( `DESCRIPTION`, `USER_ID`, `PC_IP`, `VOUCHER_NATURE`) VALUES ('$voucherdesc','$userid','$ip','$nature')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function fiscal_year()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$company=$_POST['company'];
		$project=$_POST['project'];
		$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];
	


		$r2 = mysqli_query($conn, "select * from fiscal_year where  COMPANY_ID = '$company' and PROJECT_ID = '$project' " ); 
	
	$count=mysqli_num_rows($r2);
	
	
		if($count == 1){
			 echo "<script>alert('Fiscal Year Already Creared')</script>
				 <script>window.open('fiscal_year','_self')</script>";
			
			
		}
		else
		{
			//insert query
						
			 $query="INSERT INTO `fiscal_year`( `FROM_DATE`, `TO_DATE`, `ACTIVE`, `COMPANY_ID`, `PROJECT_ID`, `USER_ID`, `PC_IP`) VALUES ('$fromdate','$todate','Y','$company','$project','$userid','$ip')";
			if (mysqli_query($conn, $query)) 
			{	
						echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
				} 
				else 
					{
						echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
					}
		}		
	}
		
	
}
function bank_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$bankname=$_POST['bankname'];
		$acctype=$_POST['acctype'];
		$detailtype=$_POST['detailtype'];
		$headcode=$_POST['headcode'];
		$chartcode=$_POST['chartcode'];
		$accoutno=$_POST['accoutno'];
		$active=$_POST['active'];
		$chk=$_POST['chk'];
		$default=$_POST['default'];
		$portal=$_POST['portal'];
		
		//insert query
					
		 $query="INSERT INTO `banks_setup`( `BANK_NAME`, `ACC_TYPE`, `ACC_DETAIL_TYPE`, `ACC_HEAD_CODE`, `ACC_CHARTACC_CODE`, `USER_ID`, `PC_IP`,  `ACTIVE`, `BANK_ACCOUNT_NO`, `CHK`, `DEF`, `PORTAL_CHK`) VALUES ('$bankname','$acctype','$detailtype','$headcode','$chartcode','$userid','$ip','$active','$accoutno','$chk','$default','$portal')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function bank_detail()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$bankid=$_POST['bankid'];
		$project=$_POST['project'];
		$active=$_POST['active'];
		
		$r2 = mysqli_query($conn, "select * from bank_detail_project where project_id='$project' and bank_id = '$bankid' " ); 
	
	$count=mysqli_num_rows($r2);
	
	
		if($count == 1){
			 echo "<script>alert('Detail Already Created')</script>
				 <script>window.open('bank','_self')</script>";
			
			
		}
		else
		{
		
		//insert query
					
		 $query="INSERT INTO `bank_detail_project`( `PROJECT_ID`, `BANK_ID`,  `ACTIVE`) VALUES ('$project','$bankid','$active')";
			if (mysqli_query($conn, $query)) 
			{	
					echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>
					<script>window.open('bank','_self')</script>";	
			} 
			else 
				{
					echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>
					<script>window.open('bank','_self')</script>";
				}
			
		}
	}
	
}

function supplier_type()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$supplier=$_POST['supplier'];
	
		
		//insert query
					
		 $query="INSERT INTO `supplier_type`(`SUPPLIER_TYPE_NAME`) VALUES ('$supplier')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function supplier_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$supplier=$_POST['supplier'];
		$address=$_POST['address'];
		$email=$_POST['email'];
		$number=$_POST['number'];
		$type=$_POST['type'];
		$landline=$_POST['landline'];
		$shipping=$_POST['shipping'];
		$cnic=$_POST['cnic'];
		$ntn=$_POST['ntn'];
	
		
		//insert query
					
		 $query="INSERT INTO `supplier_setup`(`NAME`, `ADDRESS`, `EMAIL`, `PHONE`, `LANDLINE`, `SHIPPING_ADD`, `CNIC`, `TYPE`, `NTN`) VALUES ('$supplier','$address','$email','$number','$landline','$shipping','$cnic','$type','$ntn')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function classification_description()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$classdescrip=$_POST['classdescrip'];
	
		
		//insert query
					
		 $query="INSERT INTO `classification_description`(`CLASSIC_DESC`) VALUES ('$classdescrip')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function description_detail()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$classdescrip=$_POST['classdescrip'];
		$descripdetail=$_POST['descripdetail'];
	
		
		//insert query
					
		 $query="INSERT INTO `class_description_detail`(`CLASSIC_ID`, `CLASSIC_DETAIL_DESC`) VALUES ('$classdescrip','$descripdetail')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function item_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		$errors= array();
		
		 $file_name = $_FILES['image']['name'];
		  $file_size =$_FILES['image']['size'];
		  $file_tmp =$_FILES['image']['tmp_name'];
		  $file_type=$_FILES['image']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		  
		  $expensions= array("jpeg","jpg","png");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  }
		  
		  if($file_size > 1000000){
			 $errors[]='File size must be exactely 1000 KB';
		  }
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp,"item_image/".$file_name);
			 //echo "Success";
		  }else{
			 print_r($errors);
		  }
		
		
		
		$itemname = $_POST['itemname'];
		$itemcode = $_POST['itemcode'];
		$itemdate = $_POST['itemdate'];
		$inspection=$_POST['inspection'];
		$ordervalue = $_POST['ordervalue'];
		$barcode = $_POST['barcode'];
		$uom=$_POST['uom'];
		$class1 = $_POST['class1'];
		$class2 = $_POST['class2'];
		$class3=$_POST['class3'];
		$discontinue = $_POST['discontinue'];
		$itemdetail = $_POST['itemdetail'];
	
	
		$r2 = mysqli_query($conn, "select * from item_setup2 where ITEM_CODE='$itemcode'" ); 
	
	$count=mysqli_num_rows($r2);
	
	
		if($count == 0){
			
			//insert query
							
				 $query="INSERT INTO `item_setup2`(`ITEM_NAME`, `ITEM_CODE`,`ITEM_DATE`, `RE_ORDER_VALUE`, `BARCODE`, `DESCRIPTION`, `UOM_ID`, `CLASS1`, `CLASS2`, `CLASS3`, `INSPECTION`, `DISCONTINUE`, `ITEM_PICTURE`) VALUES ('$itemname','$itemcode','$itemdate','$ordervalue','$barcode','$itemdetail','$uom','$class1','$class2','$class3','$inspection','$discontinue','$file_name')";
				if (mysqli_query($conn, $query)) 
				{	
						echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
				} 
				else 
				{
						echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
				}
			  
			
			
		}
		else
		{
			 echo "<script>alert('Itemcode Already Existed')</script>
				 <script>window.open('item_setup','_self')</script>";
			

		}
		
		
	}
	
	
}
function allot_item()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$branch=$_POST['branch'];
		$item_id=$_POST['item'];
		
		$r2 = mysqli_query($conn, "select * from allot_items where item_id = '$item_id' and branch_id='$branch' " ); 
	
	$count=mysqli_num_rows($r2);
	
	
		if($count == 0){
			
			//insert query
					
		 $query="INSERT INTO `allot_items`(`item_id`,`branch_id`) VALUES ('$item_id','$branch')";
			if (mysqli_query($conn, $query)) 
			{	
					echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>
					<script>window.open('allot_items','_self')</script>";	
			} 
			else 
				{
					echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>
					<script>window.open('allot_items','_self')</script>";
				}
			
			
			
		}
		else
		{
		
				 echo "<script>alert('Record Already Exist')</script>
				 <script>window.open('allot_items','_self')</script>";
			
		}
	}
	
}
function allot_supplier()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$branch=$_POST['branch'];
		$supplier=$_POST['supplier'];
		
		$r2 = mysqli_query($conn, "select * from allot_supplier_setup where supplier_id = '$supplier' and branch_id='$branch' " ); 
	
	$count=mysqli_num_rows($r2);
	
	
		if($count == 0){
			
			//insert query
					
		 $query="INSERT INTO `allot_supplier_setup`(`SUPPLIER_ID`, `BRANCH_ID`) VALUES ('$supplier','$branch')";
			if (mysqli_query($conn, $query)) 
			{	
					echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>
					<script>window.open('allot_supplier','_self')</script>";	
			} 
			else 
				{
					echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>
					<script>window.open('allot_supplier','_self')</script>";
				}
			
			
		}
		else
		{
			 echo "<script>alert('Record Already Exist')</script>
				 <script>window.open('allot_supplier','_self')</script>";
			
		
			
		}
	}
	
}
function uom_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$uomname=$_POST['uomname'];
		
		//insert query
					
		 $query="INSERT INTO `uom_setup`( `DESCRIPTION`, `USER_ID`, `PC_IP`) VALUES ('$uomname','$userid','$ip')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function payment_description()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$termdescrip=$_POST['termdescrip'];
		$ondays=$_POST['ondays'];
		$payment=$_POST['payment'];
		
		//insert query
					
		 $query="INSERT INTO `payment_terms`(`DESCRIPTION`, `NO_DAYS`, `PAYMENT_PER`) VALUES ('$termdescrip','$ondays','$payment')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function priority()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$priority=$_POST['priority'];
		
		
		//insert query
					
		 $query="INSERT INTO `popriority_setup`(`POPRIORITY_NAME`) VALUES ('$priority')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function purchase_order_type()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$typename=$_POST['typename'];
		
	
		
		//insert query
					
		 $query="INSERT INTO `potype_setup`(`POTYPE_NAME`) VALUES ('$typename')";
		if (mysqli_query($conn, $query)) 
	{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
			{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
			}
		
	}
	
	
}
function bank_assign_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		$branch=$_POST['branch'];
		$bank=$_POST['bank'];
	 $k=mysqli_query($conn,"select * from bank_assign_branch WHERE bank_id='$bank' AND branch_id='$branch'");
	   $k_count=mysqli_num_rows($k);
	   if($k_count==1){
		   echo "<div class='alert alert-success'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			<strong>warning!</strong> Bank Already Assigned.
			</div>";
				   echo "<script>setTimeout(\"location.href = 'bank_assign_branch.php';\",2000);</script>";

	   }
	   else{
	
		
		//insert query
					
		 $query="INSERT INTO `bank_assign_branch`(`branch_id`, `bank_id`) VALUES ('$branch','$bank')";
		if (mysqli_query($conn, $query)) 
		{	
				echo "<div class='alert alert-success alert-dismissable'>Data Insertted Succesfuly</div>";	
		} 
		else 
		{
				echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
		}
	   }
	}
	
	
}
function fee_voucher_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		$branch = $_POST['branch'];
		$bankid = $_POST['bankid'];
		$class = $_POST['class'];
		$section = $_POST['section'];
		$student = $_POST['student'];
		$nature = $_POST['nature'];
		$feeperiod = $_POST['feeperiod'];
		$issue = $_POST['issue'];
		$due = $_POST['due'];
		$valid = $_POST['valid'];
		$session = $_POST['session'];
		$remark = $_POST['remark'];
		
		if(empty($nature) && empty($student))
		{
				//echo "<div class='alert alert-success alert-dismissable'>Please Select Student OR Nature</div>";	
				 echo"<script type='text/javascript'>alert('Please Select Student and Nature');</script>";
			 
		}
		else if(empty($nature))
			{
				//echo "<div class='alert alert-success alert-dismissable'>Please Select Nature</div>";	
				 echo"<script type='text/javascript'>alert('Please Select Nature');</script>";
			}	
		else if(empty($student))
			{
				//echo "<div class='alert alert-success alert-dismissable'>Please Select Student</div>";	
				 echo"<script type='text/javascript'>alert('Please Select Student');</script>";
			}	
		else
		{
			  foreach($student as $checkstudent)
			   {
					$challan_no=0;
				   $k=mysqli_query($conn,"select challan_no from fee_voucher_master");
					while ($rows = mysqli_fetch_array($k)) {					
						$challan_no = $rows['challan_no'];
						}
						$challan=$challan_no+1;
						
						
					   $query=mysqli_query($conn,"INSERT INTO `fee_voucher_master`(`challan_no`, `issue_date`, `due_date`, `expiry_date`, `branch_id`, `session_id`, `section_id`, `class_id`, `student_id`, `bank_id`, `generated_by`,  `remarks`, `pc_ip`) VALUES ('$challan','$issue','$due','$valid','$branch','$session','$section','$class','$checkstudent','$bankid','$userid','$remark','$ip')");
						foreach($nature as $checknature)
						{
							 $nat=mysqli_query($conn,"select voucher_id from fee_voucher_master");
							while ($rows = mysqli_fetch_array($nat)) {					
								$voucher_id = $rows['voucher_id'];
							}
							$sql = mysqli_query($conn,"INSERT INTO `fee_voucher_detail`( `voucher_id`, `challan_no`, `nature_id`) VALUES ('$voucher_id','$challan','$checknature')");	
						}
						$sqlquery = mysqli_query($conn,"INSERT INTO `fee_voucher_month`(`voucher_id`,`challan_no`, `fee_month`) VALUES ('$voucher_id','$challan','$feeperiod')");
						
					}
			
		}
	}
}
function student_attendance_setup()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		$branch = $_POST['branch'];
		$class = $_POST['class'];
		$section = $_POST['section'];
		$student = $_POST['student'];
		$date = $_POST['date'];
		$session = $_POST['session'];
		
		
		
	   foreach($student as $checkstudent)
	   {
			

			   $query="INSERT INTO `daily_attendance`(`ATT_DATE`,  `PC_IP`, `USER_ID`, `ATTENDENT_ID`, `ATTENDENT_TYPE`, `SESSION_ID`, `PRESENT`, `CLASS_ID`, `SECTION_ID` , `BRANCH_ID`) VALUES ('$date','$ip','$userid','$checkstudent','S','$session','N','$class','$section','$branch')";
				
				if (mysqli_query($conn, $query)) 
				{	
					echo "<div class='alert alert-success alert-dismissable'>Attendance Insertted Succesfuly</div>";	
				} 
				else 
				{
					echo "<div class='R123c456s7890'>Error! Data Not Inserted</div>";
				}
				
	   }		
	}
}
function student_fee_schedule()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		$branch = $_POST['branch'];
		//$othercharges = $_POST['othercharges'];
		$class = $_POST['class'];
		$section = $_POST['section'];
		$student = $_POST['student'];
		$nature = $_POST['nature'];
		//$discount = $_POST['discount'];
		$amount = $_POST['feeamount'];
		$session = $_POST['session'];
		$remark = $_POST['remark'];
		
		
	   foreach($student as $checkstudent)
	   {
			
		   $k=mysqli_query($conn,"SELECT `DATE_OF_SUBMISSION` FROM `student_current_status` WHERE STUDENT_ID='$checkstudent'");
		    while ($rows = mysqli_fetch_array($k)) 
			{					
				$admission_Date = $rows['DATE_OF_SUBMISSION'];
			}
				$student_admission_month=date('m', strtotime($admission_Date));
				$admission_year=date('y', strtotime($admission_Date));

			$bn=mysqli_query($conn,"select * from sessions_setup where SESSION_ID='$session' AND active='Y'");
			while($emp=mysqli_fetch_array($bn))
            {
					$from_date = $emp['FROM_DATE'];
					$start_month=date('m', strtotime($from_date));
					$start_year=date('y', strtotime($from_date));
					
					
					$TO_DATE = $emp['TO_DATE'];
					$end_month=date('m', strtotime($TO_DATE));
					$end_year=date('y', strtotime($TO_DATE));
					
			}
		//if($start_year > $admission_year )
		//{
			for($p=0; $p <  12; $p++)
					{
						$fee_month= date('M-Y', strtotime("+ $p months", strtotime($from_date)));
						
							$query=mysqli_query($conn,"INSERT INTO `student_schedule`(`session_id`, `branch_id`, `class_id`, `section_id`, `student_id`, `amount`, `fee_month`, `remarks`, `nature_id`) VALUES ('$session','$branch','$class','$section','$checkstudent','$amount','$fee_month','$remark','$nature')");
					}
	/*	}
		else
		{
			$total_month_duration =  $start_month-$student_admission_month;
			$total=$total_month_duration + 12;
			
			for($p=0; $p < $total; $p++)
					{
						$fee_month= date('M-Y', strtotime("+ $p months", strtotime($admission_Date)));
						
							$query=mysqli_query($conn,"INSERT INTO `student_schedule`(`session_id`, `branch_id`, `class_id`, `section_id`, `student_id`, `amount`,  `fee_month`, `remarks`) VALUES ('$session','$branch','$class','$section','$checkstudent','$amount','$fee_month','$remark')");
					}
		}*/
			
			   
				
				
	   }		
	}
}
function student_promotion()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsub']))
	{
		
		
		
		$branch=$_POST['branch'];
		$class=$_POST['class'];
		$section=$_POST['section'];
		$branch2=$_POST['branch2'];
		$class2=$_POST['class2'];
		$section2=$_POST['section2'];
		$session=$_POST['session'];
		$remark=$_POST['remark'];
		$student = $_POST['student'];
		
		
		foreach($student as $checkstudent)
	   {
		   $l=mysqli_query($conn,"SELECT * FROM `student_current_class` WHERE STUDENT_ID='$checkstudent' and CLASS_ID ='
		   $class2' and SECTION_ID ='$section2' and BRANCH_ID ='$branch2'");
		    $k_count=mysqli_num_rows($l);
	   if($k_count==0)
	   {
		   
		   $k=mysqli_query($conn,"UPDATE `student_current_class` SET `ACTIVE`='N' WHERE STUDENT_ID='$checkstudent' and CLASS_ID ='
		   $class' and SECTION_ID ='$section' and BRANCH_ID ='$branch'");
		   
		   $r=mysqli_query($conn,"SELECT * FROM `student_current_class` WHERE STUDENT_ID='$checkstudent' and CLASS_ID ='
		   $class' and SECTION_ID ='$section' and BRANCH_ID ='$branch'");
		    while ($rows = mysqli_fetch_array($r)) 
			{					
				$rollno = $rows['ROLL_NO'];
			}
		   
		//insert query
					
			$query="INSERT INTO `student_current_class`( `STUDENT_ID`, `CLASS_ID`, `ACTIVE`, `PC_IP`, `USER_ID`, `SECTION_ID`, `SESSION_ID`, `ROLL_NO`, `BRANCH_ID` , `REMARKS`) VALUES 
			('$checkstudent','$class2','Y','$ip','$userid','$section2','$session','$rollno','$branch2','$remark')";
			if (mysqli_query($conn, $query)) 
			{	
				 echo"<script type='text/javascript'>alert('Record Successfully Inserted');</script>";
								echo "<script>location.href='student_current_class'; </script>";	
			} 
			else 
			{
				echo"<script type='text/javascript'>alert('Error! Data Not Inserted');</script>";
								echo "<script>location.href='student_current_class'; </script>";
			}
		
		}
		else
		{
			echo"<script type='text/javascript'>alert('Error! Student Already Exist in this Class');</script>";
								echo "<script>location.href='student_current_class'; </script>";
		}
	   }
	}
	
}
function subject_marks()
{
	global $ip,$date,$conn;
	
	$userid=1; //this will be changed to dynamically in near future
	
	if(isset($_POST['btnsave']))
	{
		
		
		
		
		$class=$_POST['class'];
		$subject=$_POST['subject'];
		//$total=$_POST['total'];
		//$pass=$_POST['pass'];
		
		
		
		
		foreach($subject as $key => $checksubject)
	   {
		   $l=mysqli_query($conn,"SELECT * FROM `class_subject_marks` WHERE class_id='$class' and subject_id ='$checksubject'");
		    $k_count=mysqli_num_rows($l);
	   if($k_count==0)
	   {
		   //foreach(array_combine($artotal,$arpass) as $totalmarks=>$passmarks)
			//{
				//$subj=$checksubject;
				$total1=$_POST['total'][$key];
				$pass1=$_POST['pass'][$key];
		//insert query
					
				$query="INSERT INTO `class_subject_marks`(`class_id`, `subject_id`, `total_marks`, `passing_marks`, `userid`)  VALUES 
				('$class','$checksubject','$total1','$pass1','$userid')";
				if (mysqli_query($conn, $query)) 
				{	
					 echo"<script type='text/javascript'>alert('Record Successfully Inserted');</script>";
									echo "<script>location.href='subject_marks'; </script>";	
				} 
				else 
				{
					echo"<script type='text/javascript'>alert('Error! Data Not Inserted');</script>";
									echo "<script>location.href='subject_marks'; </script>";
				}
			//}
		
		}
		else
		{
			echo"<script type='text/javascript'>alert('Error! Data Already Exist');</script>";
								echo "<script>location.href='subject_marks'; </script>";
		}
	   }
	}
	
}
?>