 <?php
 include ('include/function.php');
 

 $company_id = $_GET['q'];
 
 
 ?>
<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Select Project</label>
								<div class="col-md-6">
									<select name="project" id="project" class="form-control" required  >
									<option value="">Select Project</option>
									<?php
									
$select_project = mysqli_query($conn,"select * from school_branches where active = 'Y' order by branch_id desc ");										
									
							

									
									while($row = mysqli_fetch_array($select_project))
									{
										$project_id = $row['branch_id'];
										$project = $row['branch_name'];
										?>
										<option value="<?php echo $project_id;  ?>"><?php echo $project; ?></option>
										<?php
									}
									?>
									</select>
								</div>
							</div>