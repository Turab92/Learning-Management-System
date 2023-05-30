<?php
$branch_id = $_GET['q'];

include ('include/function.php');
?>

<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Select Class</label>
								<div class="col-md-6">
                                 <select name="class" class="form-control" required onchange="showSection(this.value,<?php echo $branch_id; ?>)">
								 <option value="">Select Class</option>
								 <?php
								 $r1 = mysqli_query($conn, "select a.CLASS_ID,a.CLASS_DESCRIPTION,a.active,b.CLASS_ID,b.branch_id from class_setup a, class_branch_setup b where b.branch_id = '$branch_id' and a.active = 'Y'  and a.CLASS_ID = b.CLASS_ID order by a.CLASS_ID asc"); 
	
								while (($rows1 = mysqli_fetch_array($r1)) != false) {
								 $class_id = $rows1['CLASS_ID'];
								 $class_description=$rows1['CLASS_DESCRIPTION'];
								 ?>
								 <option value="<?php echo $class_id;?>"><?php echo $class_description;?></option>
								 <?php
								}
								 
								 ?>
								 
								 </select>
								</div>
							</div>