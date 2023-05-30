 <?php
 include ('include/function.php');
 
 $item_code = $_GET['code'];
$po_no = $_GET['pono'];

$sel4 = "select b.UOM_ID,b.DESCRIPTION from uom_setup b,item_setup2 c where  b.UOM_ID=c.UOM_ID and  c.item_id ='$item_code'";
$run14=mysqli_query($conn,$sel4);
            while(($row14=mysqli_fetch_array($run14)) != false){
			
               $uom_id = $row14['UOM_ID'];			
			$uom_name = $row14['DESCRIPTION'];
			}


 ?>
 <form class="form-horizontal" method="post" >
  <div class="col-md-6">
 

						
					
						
			<div class="form-group">
	<label for="inputPassword3" class="col-sm-3 control-label">Quantity</label>		
	<div class="col-md-6">

  <input type="number" class="form-control"  id="quantity" min="1" />	
	</div>
			</div>
			
							
				
							<div class="form-group">
										<label for="inputPassword3" class="col-sm-3 control-label" >UOM</label>
			<div class="col-md-6">

			<select id="uom" class="form-control" >
			<option value="<?php echo $uom_name; ?>"><?php echo $uom_name; ?></option>
			</select>
			
								</div>
							</div>
								
							
							
							
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label" >Rate</label>
														<div class="col-md-6">
														
  <input type="number" class="form-control"   id="rate" min="1" />	
								</div>
							</div>

						
												
							
							</div>
							
							<div class="col-md-6">
							
							
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label" >Discount</label>
														<div class="col-md-6">
														
  <input type="number" class="form-control"  id="discount" min="1" />	
														
								</div>
							</div>
							
							
							
										
<div class="form-group">
<label for="inputPassword3" class="col-sm-3 control-label" >Remarks</label>
														<div class="col-md-6">
														
	<textarea  id="remarks_2" class="form-control"  cols="27" rows="4" ></textarea>
								</div>
							</div>
							<br><br>	
							
						

							</div>
<br><br>
</form>
							<div class="col-md-12">
<div align="center">
							
 <li class="margin-bottom-10"><button style="width:155px; font-size:13px; height:50px; " id="btn" onClick="add_detail(<?php echo $item_code; ?>,<?php echo $po_no; ?>)" 
 class="btn btn-primary btn-bordered waves-effect waves-light">Add Detail</button></li>
							
							</div>
							</div>


							
							
										
																
							
							
						