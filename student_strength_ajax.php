<?php
include ('include/function.php');
$branch_id = $_GET['q'];
?>

<div class="form-group">
                                  
                                    <label for="inputEmail3" class="col-sm-3 control-label">Select Class</label>
								
									
																
			
                                   <div class="col-md-6"> 
                                       <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Select Class<span class="caret"></span></button>
<ul class="dropdown-menu">
	<li>&nbsp;&nbsp;<input type="checkbox" onClick="selectall(this)" />&nbsp;&nbsp;&nbsp;Select All<br/></li>
										  
                                       <?php
									   
                                          $sql="select a.CLASS_ID,a.CLASS_DESCRIPTION,a.active,b.CLASS_ID,b.branch_id from class_setup a, class_branch_setup b where b.branch_id = '$branch_id' and a.active = 'Y'  and a.CLASS_ID = b.CLASS_ID order by a.CLASS_ID asc ";
        		$run=mysqli_query($conn,$sql);
        		
									 while(($row = mysqli_fetch_array($run)) != false) 
									 {										
									         
        			$class_id=$row['CLASS_ID'];
                    $class_name=$row['CLASS_DESCRIPTION'];
                   ?>
				<li>&nbsp;&nbsp;<input type="checkbox" name="class[]" value="<?php echo $class_id; ?>"/>&nbsp;&nbsp;&nbsp;<?php echo $class_name; ?></li>	
<?php				
                }
                                          ?>
                                          
                                                                            
                                       </ul>
  </div></div>
                                </div>