<?php
include ('include/config.php');
 $class = $_GET['q'];
 $branch = $_GET['a'];
?>
							<div class="form-group">
                                  
									 <label  for="inputPassword3" class="col-sm-3 control-label">Select Section</label>
									
                                  
                                   <div class="col-sm-6"> 
                                    <select class="form-control" name="section2"  required>
                                          <option value="">Select Section</option>
                                       <?php
									   
                                          $sql="select a.class_id,a.section_id,a.branch_id,b.section_id,b.section_description from class_sections_capacity a,
								 class_setup_section b where a.section_id = b.section_id and a.class_id = '$class' and a.branch_id = '$branch' ";
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