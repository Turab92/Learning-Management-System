<?php
 $branch_id = $_GET['q'];
include ('include/function.php');

?>
								<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Select Employees</label>
								<div class="col-md-6">
                                 <select name="employees" class="form-control" required >
								 <option value="">Select Employees</option>
								 <?php
								 $r1 = mysqli_query($conn, "select a.emp_id,a.emp_name,a.emp_status,b.employee_id,b.branch_id from employees a , employees_current_branch b where a.emp_id = b.employee_id and a.emp_status = 'Active' and b.branch_id = '$branch_id' "); 
								
								while (($rows1 = mysqli_fetch_array($r1)) != false) {
								 $employee_id = $rows1['emp_id'];
								 $employee_name=$rows1['emp_name'];
								 ?>
								 <option value="<?php echo $employee_id;?>"><?php echo $employee_name;?></option>
								 <?php
								}
								 
								 ?>
								 
								 </select>
								</div>
							</div>