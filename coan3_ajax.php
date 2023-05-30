<?php
$branch_id = $_GET['p'];
include ('include/function.php');
?>

<div class="form-group">
                                    
                                    <label for="inputEmail3" class="col-sm-3 control-label"><b>Select Head Code</b> </label>
									
                                    
                                   <div class="col-md-6"> 
                                    <select class="form-control" name="class2" id="classs2" onChange="showStudent2(this.value,<?php echo $branch_id; ?>)"  >
                                          <option>Select Head Code</option>
                                       <?php
									   
$sql="select b.HEAD_DESC,b.HEAD_CODE from account_types_detail a, chart_head b where b.acc_detail_type = '$branch_id' and a.acc_detail_type=b.acc_detail_type ";
        		$run=mysqli_query($conn,$sql);
        		
									 while(($row = mysqli_fetch_array($run)) != false) 
									 {										
									         
        			$class_id=$row['HEAD_CODE'];
                    $class_name=$row['HEAD_DESC'];
                    echo"<option value='$class_id'>$class_name</option>";
									
                }
                                          ?>
                                          
                                       </select></div>
                                </div>