 <?php
 include ('include/function.php');

 $id = $_GET['q'];
 ?>
<div class="form-group">

				<label for="inputEmail3" class="col-sm-3 control-label"> Project</label>	
				<div class="col-md-8">
			
				<select name="project" id="project" class="form-control" required onchange="show_fiscal(this.value,<?php echo $id; ?>)">
				<option value="">Select Project</option>
				<?php
				
				
				$select_project = mysqli_query($conn,"select * from school_branches where active='Y'");	
				
				
			
				while($s = mysqli_fetch_array($select_project))
				{
					$project_id = $s['branch_id'];
					$project_name = $s['branch_name'];
					?>
					<option value="<?php echo $project_id ;?>"><?php echo $project_name; ?></option>
					<?php
				}
				?>
				</select>
				</div>
				
			    </div>
				<br>