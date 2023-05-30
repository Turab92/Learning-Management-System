<?php
include ('include/function.php');

 $class = $_GET['q'];
 $branch_id = $_GET['a'];
?>
						
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Select Student</label>
								<div class="col-md-6">
									<button type="button" class="btn btn-default btn-sm " data-toggle="dropdown">Select Students<span class="caret"></span></button>
<ul class="dropdown-menu">
<div style="height:200px; overflow:auto;"
	 <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" onClick="selectall(this)" />&nbsp;&nbsp;&nbsp;Select All</li>
										<?php
									
									 $r1 = mysqli_query($conn, "select  a.section_id,a.class_id,a.STUDENT_ID,a.active,b.STUDENT_ID,b.APPLICANT_NAME,b.left_date,b.branch_id
              from student_current_class a,student_current_status b
								 where  a.class_id = '$class' and a.STUDENT_ID = b.STUDENT_ID and b.left_date IS NULL and
								 a.active = 'Y' and b.branch_id = '$branch_id'"); 
	while (($rows1 = mysqli_fetch_array($r1)) != false) {
	 $student_id = $rows1['STUDENT_ID'];
	  $student_description=$rows1['APPLICANT_NAME'];
											?>
	
  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="students[]" value="<?php echo $student_id; ?>"/>&nbsp;&nbsp;&nbsp;<?php echo $student_description; ?></li>
  <?php
											}
									?>
									</div>
									</ul>
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Select New Class </label>
								<div class="col-md-6">
									<select type="text" class="form-control" name="newclass" id="class" required  >
									 <option value="">Select Class</option>
                                        <?php
									   
                                          $sql4="select a.CLASS_ID,a.CLASS_DESCRIPTION,a.active,b.CLASS_ID,b.branch_id from class_setup a, class_branch_setup b where b.branch_id = '$branch_id' and a.active = 'Y'  and a.CLASS_ID = b.CLASS_ID order by a.CLASS_ID asc";
        		$run4=mysqli_query($conn,$sql4);
									 while(($row4 = mysqli_fetch_array($run4)) != false) 
									 {										
									         
        			$id4=$row4['CLASS_ID'];
                    $name4=$row4['CLASS_DESCRIPTION'];
                    ?>
					<option value="<?php echo $id4; ?>"><?php echo $name4; ?></option>
					<?php
									
                }
                                          ?>
                                      
                                          
                                       </select>
								</div>
							</div>