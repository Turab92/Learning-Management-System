<?php
$branch_id = $_GET['q'];
include ('include/function.php');
?>

<div class="form-group">
                                   
                                    <label for="inputEmail3" class="col-sm-3 control-label">Select Nature </label>
									
                                  
                                   <div class="col-md-6"> 
                                    <select class="form-control" name="class" id="classs" ng-model="classs" ng-required="true" class="form-control" onChange="showStudent(this.value,<?php echo $branch_id; ?>)"  >
                                          <option>Select Nature</option>
                                       <?php
									   
                                          $sql="select a.DESCRIPTION,a.ACC_DETAIL_TYPE from account_types_detail a, account_types b where b.account_type = '$branch_id' and a.account_type=b.account_type  ";
        		$run=mysqli_query($conn,$sql);
        	
									 while(($row = mysqli_fetch_array($run)) != false) 
									 {										
									         
        			$class_id=$row['ACC_DETAIL_TYPE'];
                    $class_name=$row['DESCRIPTION'];
                    echo"<option value='$class_id'>$class_name</option>";
									
                }
                                          ?>
                                          
                                       </select></div>
                                </div>