<?php
include ('include/function.php');
if(isset($_GET['n'])){
 $charges_id = $_GET['n'];
 
 $query =mysqli_query($conn, "select NATURE_ID from charges_types where CHARGE_TYPE_ID = '$charges_id' "); 
	while ($k=mysqli_fetch_array($query)) {
		 $nature_id = $k['NATURE_ID'];
		
	}
 

?>

						<div class="form-group">
								<label  for="inputPassword3" class="col-sm-3 control-label">Select Nature</label>
								<div class="col-md-6">
									<select name="nature" id="nature"  class="form-control" required />
									<option value="">Select nature</option>
									<?php
									$r1 = mysqli_query($conn, "select * from nature_payments where NATURE_ID = '$nature_id'"); 
									while ($row=mysqli_fetch_array($r1)) {
										 $branch_id = $row['NATURE_ID'];
										 $branch_name = $row['DESCRIPTION'];
										?>
										<option value="<?php echo $branch_id; ?>"><?php echo $branch_name; ?></option>
										
										<?php
										
									}
									?>
									</select>
								</div>
							</div>
<?php
}
?>