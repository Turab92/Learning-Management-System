<?php
include ('include/function.php');
if(isset($_GET['m'])){
    
    $q=$_GET['m'];

        ?>
		
		 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Employee</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="employee" id="employee" >
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"SELECT ebs.emp_allot_id, ebs.emp_id, ebs.branch_id, e.EMP_NAME FROM `employee_branch_setup` as  ebs join employees as e on ebs.emp_id=e.EMP_ID WHERE  ebs.branch_id='$q'");
							while ($k=mysqli_fetch_array($r)){
								$emp_id=$k['emp_id'];
								 $EMP_NAME=$k['EMP_NAME'];
								echo "<option value='$emp_id' >$EMP_NAME</option>";
							}
					?>
                  </select>
                  </select>
				  </div>
             </div>
		
				
		
				

<?php
}
?>