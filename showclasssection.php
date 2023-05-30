<?php
include ('include/function.php');
if(isset($_GET['m'])){
    
    $q=$_GET['m'];

        ?>
		
		 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Class</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="class" id="class" >
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"SELECT cb.ALLOT_ID, cb.CLASS_ID, cb.BRANCH_ID,cs.CLASS_DESCRIPTION FROM `class_branch_setup` as cb join class_setup as cs on cb.CLASS_ID=cs.CLASS_ID WHERE  cb.BRANCH_ID='$q'");
							while ($k=mysqli_fetch_array($r)){
								$CLASS_ID=$k['CLASS_ID'];
								 $CLASS_DESCRIPTION=$k['CLASS_DESCRIPTION'];
								echo "<option value='$CLASS_ID' >$CLASS_DESCRIPTION</option>";
							}
					?>
                  </select>
                  </select>
				  </div>
             </div>
		
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Section</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="section" id="section" >
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select SECTION_ID,SECTION_DESCRIPTION from class_setup_section where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$SECTION_ID=$k['SECTION_ID'];
								 $SECTION_DESCRIPTION=$k['SECTION_DESCRIPTION'];
								echo "<option value='$SECTION_ID' >$SECTION_DESCRIPTION</option>";
							}
					?>
                  </select>
                  </select>
				  </div>
                </div>
		
				

<?php
}
?>