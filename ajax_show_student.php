<?php
include ('include/function.php');
 $section = $_GET['q'];
 $class = $_GET['a'];
 $branch = $_GET['c'];
?>
<div class="form-group">
                                    <label  for="inputPassword3" class="col-sm-3 control-label">Student Name</label>
									
									
									
                                   <div class="col-md-6"> 
                                      <select class="form-control" name="pass" type="text" value="" placeholder="" required >
                                        <option value="">Select Student</option>
                                       <?php
																		   
										   $sql="select a.section_id,
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
									   and b.branch_id = '$branch'";
        		$run=mysqli_query($conn,$sql);
        		
									 while($row = mysqli_fetch_array($run)) 
									 {										
									         
        			$id=$row['student_id'];
                    $name=$row['applicant_name'];
                    echo"<option value='$id'>$name</option>";
									
                }
                                          ?>
                                          
                                       </select></div>
                                </div>