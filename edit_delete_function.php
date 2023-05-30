<?php
include ('include/function.php');

$id1=$_SESSION['name'];

$sql = mysqli_query($conn, "select c.user_id from portal_user c where user_name='$id1'");
		
		 while(($rows_sql = mysqli_fetch_array($sql)) != false) 
		{
		$user_id=$rows_sql['user_id'];
		}

	$edit_report = 'Edit';
	$delete_report = 'Delete';
	
	$select_edit = mysqli_query($conn,"select * from employee_right as er join rights as r on er.right_id=r.right_id where r.rights_name = '$edit_report' and er.user_id = '$user_id' ");
	
	$select_edit_rows = mysqli_num_rows($select_edit);
	if($select_edit_rows > 0)
	{
$edit_count = 1;
	}
	else
	{
$edit_count = 0;
	}
	
	$select_delete = mysqli_query($conn,"select * from employee_right as er join rights as r on er.right_id=r.right_id where r.rights_name = '$delete_report' and er.user_id = '$user_id'"); 
    
    $select_delete_rows = mysqli_num_rows($select_delete); 
	if($select_delete_rows)
	{
$delete_count = 1;
	}
	else
	{
$delete_count = 0;
	}
	
?>




