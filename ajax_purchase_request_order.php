<?php

include ('include/function.php');

 $request_id = $_GET['q'];
 $branch_id = $_GET['branch'];

$select = mysqli_query($conn,"select * from purchase_request_master a,supplier_setup b ,school_branches c where a.req_from = b.SUPPLIER_ID and a.branch_id = c.branch_id
and a.req_id = '$request_id' ");

while($r = mysqli_fetch_array($select))
{
	$req_id = $r['REQ_ID'];
	$req_date = $r['REQ_DATE'];
	$name = $r['NAME'];
	$supplier_id = $r['SUPPLIER_ID'];
    $branch_name = $r['branch_name'];
	
}

?>

				
				<style>
				label
				{
					font-size:13px;
				}
				</style>	
				<div class="col-md-6">	
			<div class="form-group">
			
	<label for="inputPassword3" class="col-sm-3 control-label" >Request ID</label>		
	<div class="col-md-6">
			<input type="text" name="req_id" id="req_id" class="form-control" readonly value="<?php echo $req_id;?>" required  >
	</div>
		
	
			</div>
									
													

							
							<div class="form-group">

								<label for="inputPassword3" class="col-sm-3 control-label"  >Payment Terms</label>								
								<div class="col-md-6">
<select id="payment_terms" class="form-control">
<option value="">Select Payment Terms</option>
<?php
$payment_terms = mysqli_query($conn,"select * from payment_terms");

while($r = mysqli_fetch_array($payment_terms))
{
	$term_id = $r['TERM_ID'];
	$type_desc = $r['DESCRIPTION'];
	?>
	<option value="<?php echo $term_id; ?>"><?php echo $type_desc;?></option>
	<?php
}
?>
</select>
								</div>
							
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label" >Priority</label>								
								<div class="col-md-6">
		<select name="priority" id="priority" class="form-control" required  >
				<option value="">Select Priority</option>	
	      <?php
$select_priority = mysqli_query($conn,"select * from popriority_setup");

while($r = mysqli_fetch_array($select_priority))
{
	$priority_id = $r['POPRIORITY_ID'];
	$type_desc = $r['POPRIORITY_NAME'];
	?>
	<option value="<?php echo $priority_id; ?>"><?php echo $type_desc; ?></option>
	<?php
}
?>		  
				</select>

		
								</div>
							</div>
							</div>


							<div class="col-md-6">
												<div class="form-group">
													
											<label for="inputPassword3" class="col-sm-3 control-label" >Branch Name</label>
								<div class="col-md-6">

	<input type="text" name="branch" id="branch" class="form-control" required value="<?php echo $branch_name; ?>" readonly  >
								</div>
							
							</div>
							<div class="form-group">
													
											<label for="inputPassword3" class="col-sm-3 control-label" >Supplier</label>
								<div class="col-md-6">

			<input type="text" class="form-control" name="supplier" id="supplier" value="<?php echo $name; ?>" readonly  >
								</div>
								
							</div>
							
							<div class="form-group">
							<div class="required">
										<label for="inputPassword3" class="col-sm-3 control-label"  >Po Type</label>
			<div class="col-md-6">

				<select name="po_type" id="po_type" required class="form-control" >
				<option value="">Select Po Type</option>	
	      <?php
$select_potype = mysqli_query($conn,"select * from potype_setup ");

while($r = mysqli_fetch_array($select_potype))
{
	$type_id = $r['POTYPE_ID'];
	$type_desc = $r['POTYPE_NAME'];
	?>
	<option value="<?php echo $type_id; ?>"><?php echo $type_desc; ?></option>
	<?php
}
?>		  
				</select>
								</div>
								</div>
							</div>

						
														
												
							
																					<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label"  >Remarks</label>
																					<div class="col-md-6">

			<textarea  name="remarks" id="remarks" class="form-control" rows="3" cols="25" ></textarea>
								</div>
							</div>

							
	   </form>
							
							</div>
						
						
	
<div class="col-md-12">
<div align="center">
<br>
<li class="margin-bottom-10"><button onclick="create_order(<?php echo $branch_id; ?>,<?php echo $request_id; ?>,<?php echo $supplier_id; ?>);" style="width:155px; font-size:13px; height:50px; " id="btn" class="btn btn-primary btn-bordered waves-effect waves-light">Create Order</button></li>
</center>
<br>
</div>
							</div>					

						