<?php
$branch_id = $_GET['q'];
include ('include/function.php');
?>

<div class="form-group">
                                  
                                    <label for="inputEmail3" class="col-sm-3 control-label">Select Class <br><input type="checkbox" name="class_check" value="1" required /></label>
								
                                   <div class="col-md-6"> 
                                    <select class="form-control" name="class"  onChange="showSection(this.value,<?php echo $branch_id; ?>)">
                                          <option>Select Class</option>
                                       <?php
									   
                                          $sql="select a.class_id,a.class_description,a.active,b.class_id,b.branch_id from class_setup a, class_branch_setup b where b.branch_id = '$branch_id' and a.active = 'Y'  and a.class_id = b.class_id order by a.class_id asc ";
        		$run=mysqli_query($conn,$sql);
        		
									 while(($row = mysqli_fetch_array($run)) != false) 
									 {										
									         
        			$class_id=$row['class_id'];
                    $class_name=$row['class_description'];
                    echo"<option value='$class_id'>$class_name</option>";
									
                }
                                          ?>
                                          
                                       </select></div>
                                </div>