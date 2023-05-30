<?php
include ('include/function.php');
$class = $_GET['q'];
$branch_id = $_GET['a'];
?>
<div class="form-group">
                                  
                                    <label for="inputEmail3" class="col-sm-3 control-label">Select Section<br> <input type="checkbox" name="section_check" value="1" /></label>
									
                                  
                                   <div class="col-md-6"> 
                                    <select class="form-control" name="section" onchange="showStudent(this.value,<?php echo $class; ?>,<?php echo $branch_id; ?>)">
                                          <option>Select Section</option>
                                       <?php
									   
                                          $sql="select a.class_id,a.section_id,a.branch_id,b.section_id,b.section_description from class_sections_capacity a,
								 class_setup_section b where a.section_id = b.section_id and a.class_id = '$class' and a.branch_id = '$branch_id'";
        		$run=mysqli_query($conn,$sql);
        		
									 while(($row = mysqli_fetch_array($run)) != false) 
									 {										
									         
        			$section=$row['section_id'];
                    $section_name=$row['section_description'];
                    echo"<option value='$section'>$section_name</option>";
									
                }
                                          ?>
                                          
                                       </select></div>
                                </div>