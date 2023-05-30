<?php 
include ('include/function.php');

$branch_id = $_GET['id'];


?>


			<div class="col-md-12">
			
			<div class="box box-info">
					 <div class="box-header with-border">
              <h3 class="box-title">Purchase Request Detail</h3>
            </div>
								
					<div class="box-body">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Request from </label>
								<div class="col-md-6">	
								<select name="request" id="request" class="form-control" >
                                                   
							 <?php
							  $sql5=mysqli_query($conn,"select * from supplier_setup a,allot_supplier_setup b where a.type = '1' and a.SUPPLIER_ID = b.supplier_id and b.branch_id = '$branch_id' ");
												
												while(($row5=mysqli_fetch_array($sql5)) != false){           
									$id5=$row5['SUPPLIER_ID'];
									$name5=$row5['NAME'];
									echo"<option  value='$id5'>$name5</option>";
								}
                                          ?>
								</select>
								 </div>
										
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Item </label>
								<div class="col-md-6">
								<select name="item" id="item" class="form-control" onChange="showLocation(this.value)" >
							<option value="" >Select Item</option>
							 <?php
							  $sql4=mysqli_query($conn,"select * from item_setup2 a,allot_items b where a.ITEM_ID = b.ITEM_ID and b.branch_id = '$branch_id' ");
							 
								while(($row4=mysqli_fetch_array($sql4)) != false){           
									$id4=$row4['ITEM_ID'];
									$name4=$row4['ITEM_NAME'];
									echo"<option  value='$id4'>$name4</option>";
								}
                                          ?>

                                                      

							</select>
							</div>
							</div>
							<div id="txtHint"></div>
						  <div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Quantity </label>
								<div class="col-md-6">
							
								<input type="number" class="form-control" id="quantity" name="quantity"  />
									</div>
							</div>
						  <div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Rate </label>
								<div class="col-md-6">
							
                                        <input type="number" class="form-control" id="rate" name="rate"  />
                                            </div>
                                        </div>
										  
							</div>
										<div class="col-sm-6">
										
										<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Discount</label>
								<div class="col-md-6">
							
                                        <input type="number" class="form-control" id="discount" name="discount"  />
                                            </div>
                                        </div>
										
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Remarks </label>
									<div class="col-md-6">
									  <textarea class="form-control" name="remarks1" cols="5" rows="5" id="remarks1"></textarea>	
									  </div>
									  </div>

							  <div class="form-group">
								<div class="col-sm-6 col-sm-offset-2">
								<li class="margin-bottom-10">
								 <button type="submit" onclick="slab();" name="submit"  class="btn btn-primary">Submit
													</button></li>
									</div>
									<div id="d1"></div>
								</div>
						</div>
							</div>
							
						</div>
</div>

		

			
			   <div class="form-group form-actions">
					<div>
					<center>
						<button type="submit" onclick="save();" class="btn btn-effect-ripple btn-primary" name="submit">Save
						</button></center>
					</div>
				</div>
				<div id="d2"></div>

 <div id="tableHolder"></div>
				<!-- /.row -->
		
		<!-- /.row small-spacing -->	