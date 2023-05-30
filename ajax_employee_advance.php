<?php
include ('include/function.php');
$project_id = $_GET['q'];

?>

						<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Select Employees </label>
								<div class="col-md-6">
                                 <select name="employees" class="form-control" required id="employees" >
								 <option value="">Select Employees</option>
								 <?php
									 $r1 = mysqli_query($conn, "select a.EMP_ID,a.EMP_NAME,a.emp_status,b.employee_id,b.branch_id from employees a , employees_current_branch b where a.EMP_ID = b.employee_id and a.emp_status = 'Active' and b.branch_id = '$project_id' "); 
								while (($rows1 = mysqli_fetch_array($r1)) != false) {
								 $employee_id = $rows1['EMP_ID'];
								 $employee_name=$rows1['EMP_NAME'];
								 ?>
								 <option value="<?php echo $employee_id;?>"><?php echo $employee_name;?></option>
								 <?php
								}
								 
								 ?>
								 
								 </select>
								</div>
							</div>
						