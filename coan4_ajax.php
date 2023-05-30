<?php
$branch_id = $_GET['p'];
include ('include/function.php');
?>


								<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Code </label>
                   <div class="col-sm-6">
				    <button type="button" class="btn btn-default btn-sm " data-toggle="dropdown"> Select<span class="caret"></span></button>
				  <ul class="dropdown-menu">
					  <div style="height:200px; overflow:auto;"
					  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" onClick="selectall(this)" />&nbsp;&nbsp;&nbsp;Select All</li>
					  <?php

					 $r=mysqli_query($conn,"select distinct c.CHART_ACC_DESC, c.CHART_ACC_CODE
  from account_types_detail a, chart_head b, chart_detail c
 where b.head_code='$branch_id'
   and b.head_code = c.chart_head_code");
					  foreach($r as $cat)
					  {
						  ?>

						  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="items[]" value="<?php echo $cat['CHART_ACC_CODE'];  ?>"/>&nbsp;&nbsp;&nbsp;<?php echo $cat['CHART_ACC_DESC'];  ?></li>
						  <?php
					  }
					  ?>
                   </div>
                   </ul>
				  </div>
                </div>