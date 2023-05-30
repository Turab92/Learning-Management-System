<?php
include ('include/function.php');
if(isset($_GET['m'])){
    
    $q=$_GET['m'];

        ?>
		
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-4 control-label">Select Sub Menu</label>
			 <div class="col-sm-6">
			  <button type="button" class="btn btn-default btn-sm " data-toggle="dropdown"> Select<span class="caret"></span></button>
			  <ul class="dropdown-menu">
				  <div style="height:200px; overflow:auto;"
				  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" onClick="selectall(this)" />&nbsp;&nbsp;&nbsp;Select All</li>
				  <?php

				 $r=mysqli_query($conn,"select report_id,report_title from user_reports WHERE parent_id='$q' AND status = 'Y'");
				  foreach($r as $cat)
				  {
					  ?>

					  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="items[]" value="<?php echo $cat['report_id'];  ?>"/>&nbsp;&nbsp;&nbsp;<?php echo $cat['report_title'];  ?></li>
					  <?php
				  }
				  ?>
		  </div>
		 </ul>
	   </div>
		</div>

<?php
}
?>