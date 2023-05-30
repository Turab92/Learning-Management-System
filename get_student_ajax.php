<?php
include ('include/function.php');
  $section = $_GET['q'];
  $class = $_GET['a'];
 $branch = $_GET['c'];
?>
<div class="form-group">
 
								 <label for="inputEmail3" class="col-sm-3 control-label">Select Student<br> <input type="checkbox" name="student_check" value="1" /></label>
								
								<div class="col-md-6">
							
                                 <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Select Student<span class="caret"></span></button>

<ul class="dropdown-menu">
<div style="height: 250px; overflow: auto;">
<li>&nbsp;<input type="checkbox" onClick="selectall(this)" />&nbsp;&nbsp;Select All<br/></li>
								 <?php
								 $r1 = mysqli_query($conn,"select  a.section_id,a.class_id,a.STUDENT_ID,a.active,b.STUDENT_ID,b.APPLICANT_NAME,b.left_date,b.branch_id,e.student_id,e.active,e.is_print
              from student_current_class a,student_current_status b , student_current_bearer e
								 where a.section_id = '$section' and a.class_id = '$class' and a.STUDENT_ID = b.STUDENT_ID and b.left_date IS NULL and
								 a.active = 'Y' and b.branch_id = '$branch' and a.STUDENT_ID = e.student_id and e.active = 'Y' and e.is_print is null "); 
	
	while (($rows1 = mysqli_fetch_array($r1)) != false) {
	 $student_id = $rows1['STUDENT_ID'];
	  $student_description=$rows1['APPLICANT_NAME'];
	 ?>
	 <li>&nbsp;<input type="checkbox" name="student[]" value="<?php echo $student_id; ?>"/>&nbsp;&nbsp;<?php echo $student_description; ?></li>
	 <?php
	}
								 
								 ?>
								 </div>
								</ul>
  </div>
 
								</div>
							</div>