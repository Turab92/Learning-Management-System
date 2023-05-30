<?php 
include ('include/function.php');
$id = $_GET['z'];


$sel4="select b.DESCRIPTION from uom_setup b,item_setup2 c where b.uom_id = c.uom_id and c.item_id ='$id'";
$run14=mysqli_query($conn,$sel4);
 
            while(($row14=mysqli_fetch_array($run14)) != false){
				
				$item4=$row14['DESCRIPTION'];
		
			}

?>
										
                                          <div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Uom </label>
								<div class="col-md-6">	

                                                <select name="uom" id="uom" class="form-control" >
                                                   <option value="<?php echo $item4;  ?>"><?php echo $item4; ?></option>
													<?php
$sel1="select * from item_setup2 a,uom_setup b where  b.uom_id=a.uom_id and a.item_id ='$id'";
$run11=mysqli_query($conn,$sel1);

            while(($row13=mysqli_fetch_array($run11)) != false){
				
				$item=$row13['DESCRIPTION'];
				  echo"<option  value='$item'>$item</option>";
		
			}

                                          ?>

                                                </select>
                                            </div>
                                        </div>
										
                                           
						
				
				
				
				
				
				  
				            
						