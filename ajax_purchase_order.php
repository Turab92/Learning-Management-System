<?php 
include ('include/function.php');

 $branch_id = $_GET['id'];


?>
			<div class="col-md-6">
	
				<div class="form-group">
							
					<label for="inputPassword3" class="col-sm-3 control-label" >Priority</label>
								<div class="col-md-6">

					<select name="priority" id="priority" required  class="form-control" >
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
							
						
							
							<div class="form-group">
							
								<label for="inputPassword3" class="col-sm-3 control-label" >Supplier</label>								
								<div class="col-md-6">

								<select name="supplier" id="supplier"  class="form-control"  required >
									<option value="">Select Supplier</option>
									
									<?php
									$contractor = mysqli_query($conn,"select * from supplier_setup a,allot_supplier_setup b where a.type = '1' and a.SUPPLIER_ID = b.SUPPLIER_ID and b.branch_id = '$branch_id' ");
									while($r = mysqli_fetch_array($contractor))
									{
										$id = $r['SUPPLIER_ID'];
										$name = $r['NAME'];
										?>
									<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
										<?php
									}
									
									?>
									</select>
																
								</div>
							
							</div>
							
							<br>
							<div class="form-group">
							
						<label for="inputPassword3" class="col-sm-3 control-label" >Payment Terms</label>
						<div class="col-md-6">
						<select id="payment_terms"  class="form-control" >
						<option value="" >Select Payment Terms</option>
						<?php
						$payment_terms = mysqli_query($conn,"select * from payment_terms");
							while($r = mysqli_fetch_array($payment_terms))
							{
						$term_id = $r['TERM_ID'];
						$description = $r['DESCRIPTION'];
							?>
							<option value="<?php echo $term_id; ?>"><?php echo $description; ?></option>
							<?php
						}

						?>
						</select>			
														</div>
								
							</div>

							
							</div>
						
						<div class="col-md-6">
						<div class="form-group">
						
					<label for="inputPassword3" class="col-sm-3 control-label" >Po Type</label>
						<div class="col-md-6">

				<select name="po_type" id="po_type" required  class="form-control" >
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
					<br>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label" >Remarks</label>								
								<div class="col-md-6">

			<textarea name="remarks" id="remarks"  class="form-control" cols="23" rows="3"></textarea>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-2">
<br>								
	
								</div>
							</div>
							
						</div>
						
<div class="col-md-12">
<div align="center">
						<li class="margin-bottom-10"><button onclick="create_order(<?php echo $branch_id; ?>);" style="width:155px; font-size:13px; height:50px; " id="btn" class="btn btn-primary btn-bordered waves-effect waves-light">Create Order</button></li>
</center>
<br>
</div>
						
	</div>					
						
						
						
						
						
						
						