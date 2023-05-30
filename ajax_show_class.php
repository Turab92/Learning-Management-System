<?php
include ('include/function.php');
if(isset($_GET['q'])){
	$branch_id = $_GET['q'];
?>

<div class="form-group"><div class="required">
								<label for="inputPassword3" class="col-sm-3 control-label"><b>Select Class</b></label></div>
								<div class="col-md-6">
                                 <select name="class" class="form-control" required onchange="showSection(this.value,<?php echo $branch_id; ?>)">
								 <option value="">Select Class</option>
								 <?php
								 $r1 = mysqli_query($conn, "select a.class_id,a.class_description,a.active,b.class_id,b.branch_id from class_setup a, class_branch_setup b where b.branch_id = '$branch_id' and a.active = 'Y'  and a.class_id = b.class_id order by a.class_id asc"); 
	
									while ($rows1 = mysqli_fetch_array($r1)) {
									 $class_id = $rows1['class_id'];
									 $class_description=$rows1['class_description'];
									 ?>
									 <option value="<?php echo $class_id;?>"><?php echo $class_description;?></option>
									 <?php
									}
																 
																 ?>
																 
									 </select>
									</div>
								</div>
<?php
}
?>