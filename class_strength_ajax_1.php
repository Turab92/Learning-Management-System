<?php
$branch_id = $_GET['q'];
include ('include/function.php');
?>

<div class="form-group">
                                   
                                    <label for="inputEmail3" class="col-sm-3 control-label">Select Class</label>
									
                                   
                                   <div class="col-md-6"> 
                                    <select class="form-control" name="class"  onChange="showSection(this.value,<?php echo $branch_id; ?>)">
                                          <option>Select Class</option>
										  
                                       <?php
									   
                                          $sql="select a.CLASS_ID,a.CLASS_DESCRIPTION,a.active,b.CLASS_ID,b.branch_id from class_setup a, class_branch_setup b where b.branch_id = '$branch_id' and a.active = 'Y'  and a.CLASS_ID = b.CLASS_ID order by a.CLASS_ID asc ";
        		$run=mysqli_query($conn,$sql);
        	
									 while(($row = mysqli_fetch_array($run)) != false) 
									 {										
									         
        			$class_id=$row['CLASS_ID'];
                    $class_name=$row['CLASS_DESCRIPTION'];
                    echo"<option value='$class_id'>$class_name</option>";
									
                }
                                          ?>
                                          
                                       </select></div>
                                </div>