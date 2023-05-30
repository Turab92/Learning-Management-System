<?php
include ('include/config.php');
 $section = $_GET['q'];
 $class = $_GET['a'];
 $branch = $_GET['c'];
?>

								<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Select Student</label>
			 <div class="col-sm-6">
			  <button type="button" class="btn btn-default btn-sm " data-toggle="dropdown"> Select <span class="caret"></span></button>
			  <ul class="dropdown-menu">
				  <div style="height:200px; overflow:auto;"
				  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" onClick="selectall(this)" />&nbsp;&nbsp;&nbsp;Select All</li>
				  <?php

				 $r=mysqli_query($conn,"select a.section_id,
										   a.class_id,
										   a.student_id,
										   a.active,
										   b.student_id,
										   b.applicant_name,
										   b.left_date,
										   b.branch_id
									  from student_current_class a, student_current_status b
									 where a.section_id = '$section'
									   and a.class_id = '$class'
									   and a.student_id = b.student_id
									   and b.left_date IS NULL
									   and a.active = 'Y'
									   and b.branch_id = '$branch'");
				  foreach($r as $cat)
				  {
					  ?>

					  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="student[]" value="<?php echo $cat['student_id'];  ?>"/>&nbsp;&nbsp;&nbsp;<?php echo $cat['applicant_name'];  ?></li>
					  <?php
				  }
				  ?>
		  </div>
		 </ul>
	   </div>
		</div>