<?php
include ('include/function.php');
//error_reporting(0);

$branch_id = $_GET['id'];

?>

					<div class="table-responsive" style="height:400px;">
					<table class="example table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>S.No</th>
										<th>Name</th> 
									<th>Father Name</th> 
									<th>Contact No</th>
							</tr>
						</thead>
							<tfoot>
							<tr>
								<th>S.No</th>
										<th>Name</th> 
									<th>Father Name</th> 
									<th>Contact No</th>
</tr>
</tfoot>									
		
						<tbody>
						 <?php 
		  $i=1;
		  if($branch_id == 0)
		  {
	  $sql2=mysqli_query($conn,"SELECT * FROM employees a order by a.emp_id DESC");
		  }
else
{
  $sql2=mysqli_query($conn,"SELECT * FROM employees a,employees_current_branch b where a.emp_id = b.employee_id and b.branch_id = '$branch_id' ");	
}	
        		
        		while (($row2 = mysqli_fetch_array($sql2)) != false) {

					$emp_id = $row2['EMP_ID'];
					$emp_name = $row2['EMP_NAME'];
					$father_name = $row2['EMP_FATHER_NAME'];
					$contact_no = $row2['CONTACT_NO'];
			   
				
				
	ini_set('max_execution_time', 500);
	?>
	<tr>
	 <td class="center"><?php echo $i; ?></td>
				 <td class="center"> <a href='employee_detail.php?edit=<?php echo $emp_id; ?>'><?php echo $emp_name; ?></td></a>
				 <td class="center"><?php echo $father_name; ?></td>
				 <td class="center"><?php echo $contact_no; ?></td>
        
                </tr>
          <?php $i++;}  ?>
		  
		  
												</tbody>
				</table>
					</div>
