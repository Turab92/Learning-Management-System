<?php
include ('include/function.php');
 $class = $_GET['q'];
 $branch_id = $_GET['a'];

?>
<div class="form-group">
                                    
                                    <label for="inputEmail3" class="col-sm-3 control-label">Select Section</label>
									
                                  
                                   <div class="col-md-8"> 
                                    <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Select Section<span class="caret"></span></button>
<ul class="dropdown-menu">
	<li><input type="checkbox" onClick="selectall(this)" /> Select All<br/></li>
                                       <?php
									   
                                          $sql="select a.class_id,a.SECTION_ID,a.branch_id,b.SECTION_ID,b.SECTION_DESCRIPTION from class_sections_capacity a,
								 class_setup_section b where a.SECTION_ID = b.SECTION_ID and a.class_id = '$class' and a.branch_id = '$branch_id'";
        		$run=mysqli_query($conn,$sql);
        		
									 while(($row = mysqli_fetch_array($run)) != false) 
									 {										
									         
        			$section=$row['SECTION_ID'];
                    $section_name=$row['SECTION_DESCRIPTION'];
                 ?>
					<li><input type="checkbox" name="section[]" value="<?php echo $section; ?>"/>&nbsp;<?php echo $section_name; ?></li>	
<?php					
                }
                                          ?>
                                          
                                       </ul>
  </div>
  </div>
                                </div>