<?php
include ('include/function.php');
 $class = $_GET['q'];
 $branch = $_GET['a'];
?>
<div class="form-group">
                                    
                                    <label  for="inputPassword3" class="col-sm-3 control-label">Select Section</label>
									
                              
                                   <div class="col-md-6"> 
                                    <select class="form-control" name="section" onchange="showStudent(this.value,<?php echo $class; ?>,<?php echo $branch; ?>)">
                                          <option value="">Select Section</option>
                                       <?php
									   
                                          $sql="select a.class_id,a.SECTION_ID,a.branch_id,b.SECTION_ID,b.SECTION_DESCRIPTION from class_sections_capacity a,
								 class_setup_section b where a.SECTION_ID = b.SECTION_ID and a.class_id = '$class' and a.branch_id = '$branch' ";
        		$run=mysqli_query($conn,$sql);
        		
									 while(($row = mysqli_fetch_array($run)) != false) 
									 {										
									         
        			$section=$row['SECTION_ID'];
                    $section_name=$row['SECTION_DESCRIPTION'];
                    echo"<option value='$section'>$section_name</option>";
									
                }
                                          ?>
                                          
                                       </select></div>
                                </div>