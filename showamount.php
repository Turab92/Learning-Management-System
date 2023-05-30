<?php
include ('include/function.php');
if(isset($_GET['m'])){
    
    $q=$_GET['m'];

      
							$r=mysqli_query($conn,"SELECT  `AMOUNT` FROM `nature_payments` WHERE NATURE_ID='$q'");
							while ($k=mysqli_fetch_array($r)){
								$AMOUNT=$k['AMOUNT'];
								
								
							}
					?>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Monthly Fee</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="feeamount" name="feeamount" value="<?php echo $AMOUNT ?>" required>
                  </div>
                </div>
				
		
				
		
				

<?php
}
?>