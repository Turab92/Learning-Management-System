<?php

include ('include/function.php');

 $branch_id = $_GET['id'];


?>
					
				<div class="table-responsive">
						
										<table class=" example table table-striped table-bordered display" >
						<thead>
							<tr>
								<th>S.No</th>
								<th>Employees</th>
								<th>Joining Date</th>
								<th>Department</th>
								<th>Designation</th>
								<th>Type</th>
						        </tr>
						</thead>
						<tfoot>
							<tr>
								<th>S.No</th>
								<th>Employees</th>
								<th>Joining Date</th>
								<th>Department</th>
								<th>Designation</th>
								<th>Type</th>
						        
						</tfoot>
						<tbody>
						 <?php 
		 include ('include/config.php');

$a = 0;

if($branch_id == 0)
{
$select_employees = mysqli_query($conn,"select '$trans_date' - a.date_of_joining as remaining_days,a.emp_name,a.date_of_joining,
 a.designation_id,a.department_id,a.emp_type,b.department_id,b.description as department,c.designation_id,c.designation_name as designation,d.type_id,
 d.employee_type from employees a ,department b,designation c,employee_type_setup d
where '$trans_date' - a.date_of_joining <= 180 and '$trans_date' - a.date_of_joining > 0
and a.designation_id = c.designation_id and a.department_id = b.department_id and a.emp_type = d.type_id ");
}
else if($branch_id != null)
{
	$select_employees = mysqli_query($conn,"select '$trans_date' - a.date_of_joining as remaining_days,a.emp_id,a.emp_name,a.date_of_joining,e.employee_id,e.branch_id,f.branch_id,f.branch_name,
 a.designation_id,a.department_id,a.emp_type,b.department_id,b.description as department,c.designation_id,c.designation_name as designation,d.type_id,
 d.employee_type from employees a ,department b,designation c,employee_type_setup d ,employees_current_branch e ,school_branches f
where '$trans_date' - a.date_of_joining <= 180 and '$trans_date' - a.date_of_joining > 0
and a.designation_id = c.designation_id and a.department_id = b.department_id and a.emp_type = d.type_id and a.emp_id = e.employee_id and e.branch_id = f.branch_id and e.branch_id = '$branch_id' ");
}


while($rows = mysqli_fetch_array($select_employees))
{
	$a+= 1;
 $emp_name = $rows["emp_name"];
 $joining_date = $rows["date_of_joining"];
 $department = $rows["department"];
 $designation = $rows["designation"];
 $remaining_days = $rows['remaining_days'];
 $emp_type = $rows["employee_type"];
						 

	 
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $a; ?></td>
		 <td class="center"><?php echo $emp_name; ?></td>
       <td class="center"><?php echo $joining_date; ?></td>
	 <td class="center"><?php echo $department; ?></td>
		 <td class="center"><?php echo $designation; ?></td>
       <td class="center"><?php echo $emp_type; ?></td>
	   		   	
			
                </tr>
          <?php }  ?>
												</tbody>
				</table>
</div>
