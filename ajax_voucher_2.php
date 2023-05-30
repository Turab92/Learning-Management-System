 <?php
  include ('include/function.php');
 $company_id = $_GET['com'];
 $project_id = $_GET['prj'];
 
 ?>
<div class="form-group">

								<label for="inputEmail3" class="col-sm-3 control-label">Fiscal Year</label>	
				<div class="col-md-8">

				
				<select name="fiscal_year" id="fiscal_year"  class="form-control" required  >
				<option value="">Select Fiscal Year</option>
				<?php
				$select_fiscal = mysqli_query($conn,"select * from fiscal_year where company_id = '$company_id' and project_id = '$project_id' and active = 'Y'");
				
				while($s = mysqli_fetch_array($select_fiscal))
				{
					$sno = $s['SNO'];
					$from_date = $s['FROM_DATE'];
					$to_date = $s['TO_DATE'];
					?>
					<option value="<?php echo $sno; ?>"><?php echo $from_date." - ".$to_date; ?></option>
					<?php
				}
				?>
				</select>
				</div>
				
			    </div>
				<br>
				<input type="hidden" readonly value="<?php echo $project_id; ?>" name="prj_id"/>
		