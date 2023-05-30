<?php
include ('include/function.php');
if(isset($_GET['user_id']) && $_GET['status'])
    {
        echo  $e_id = $_GET['user_id'];
		echo  $status = $_GET['status'];
        $up_mc = "UPDATE portal_user SET status='$status' WHERE user_id='$e_id'";
            $run_mc=mysqli_query($conn,$up_mc);
        
        echo "<script>setTimeout(\"location.href = 'createuser.php';\");</script>";
    }
if(isset($_GET['m_id']) && $_GET['status'])
    {
        echo  $m_id = $_GET['m_id'];
		echo  $status = $_GET['status'];
        $up_mc = "UPDATE main_menu SET status='$status' WHERE m_id='$m_id'";
            $run_mc=mysqli_query($conn,$up_mc);
        
        echo "<script>setTimeout(\"location.href = 'createmain.php';\");</script>";
    }
if(isset($_GET['report_id']) && $_GET['status'])
    {
        echo  $report_id = $_GET['report_id'];
		echo  $status = $_GET['status'];
        $up_mc = "UPDATE user_reports SET status='$status' WHERE report_id='$report_id'";
            $run_mc=mysqli_query($conn,$up_mc);
        
        echo "<script>setTimeout(\"location.href = 'create_reports.php';\");</script>";
    }
if(isset($_GET['allowance_id']) && $_GET['status'])
    {
        echo  $allowance_id = $_GET['allowance_id'];
		echo  $status = $_GET['status'];
        $up_mc = "UPDATE allowances SET status='$status' WHERE allowance_id='$allowance_id'";
            $run_mc=mysqli_query($conn,$up_mc);
        
        echo "<script>setTimeout(\"location.href = 'allowance.php';\");</script>";
    }
if(isset($_GET['emp_allow_id']) && $_GET['status'])
    {
        echo  $emp_allow_id = $_GET['emp_allow_id'];
		echo  $status = $_GET['status'];
        $up_mc = "UPDATE employee_allowances SET status='$status' WHERE emp_allow_id='$emp_allow_id'";
            $run_mc=mysqli_query($conn,$up_mc);
        
        echo "<script>setTimeout(\"location.href = 'allowance_detail.php';\");</script>";
    }
	

?>