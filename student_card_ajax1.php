<?php
include ('include/function.php');
 $section = $_GET['q'];
 $class = $_GET['a'];
 $branch_id = $_GET['c'];
?>
<div class="form-group">
 
								 <label for="inputEmail3" class="col-sm-3 control-label">Select Student<br> <input type="checkbox" name="student_check" value="1" /></label>
								 
								<div class="col-md-6">
                                  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Select Student<span class="caret"></span></button>

<ul class="dropdown-menu">
<div style="height: 250px; overflow: auto;">
<li><input type="checkbox" onClick="selectall(this)" /> Select All<br/></li>
								 <?php
								 $r1 = mysqli_query($conn, " select  a.section_id,a.class_id,a.STUDENT_ID,a.active,a.is_print,b.STUDENT_ID,b.APPLICANT_NAME,b.left_date,b.branch_id
              from student_current_class a,student_current_status b
								 where a.section_id = '$section' and a.class_id = '$class' and a.STUDENT_ID = b.STUDENT_ID and b.left_date IS NULL and a.active = 'Y' and b.branch_id = '$branch_id' and a.is_print is null"); 
	
	while (($rows1 = mysqli_fetch_array($r1)) != false) {
	 $student_id = $rows1['STUDENT_ID'];
	  $student_description=$rows1['APPLICANT_NAME'];
	 ?>
	 <li><input type="checkbox" name="students[]" value="<?php echo $student_id; ?>"/>&nbsp;<?php echo $student_description; ?></li>
	 <?php
	}
								 
								 ?>
										 </div>
								</ul>
  </div>
								</div>
							</div>