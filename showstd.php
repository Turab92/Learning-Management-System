<?php
include ('include/config.php');
 $section = $_GET['q'];
 $class = $_GET['a'];
 $branch = $_GET['c'];
?>

								<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">Select Student</label>
					<div class="col-sm-6">
					 <select class="form-control"  name="student" id="student">
                    <option value=''>Select Student</option>
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
							while ($k=mysqli_fetch_array($r)){
								$student_id=$k['student_id'];
								 $applicant_name=$k['applicant_name'];
								echo "<option value='$student_id' >$applicant_name</option>";
							}
					?>
                
					</select>
					</div>
		</div>