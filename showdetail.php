<?php
include ('include/function.php');
if(isset($_GET['m']) && isset($_GET['cha'])&& isset($_GET['se'])&& isset($_GET['st'])){
    
    $q=$_GET['m'];
	$b=$_GET['cha'];
	$se=$_GET['se'];
	$st=$_GET['st'];

							if($q=='14')
							{
								 $k2=mysqli_query($conn,"SELECT  `amount` FROM `student_schedule` WHERE session_id = '$se' and student_id ='$st' and nature_id = '$q'");
								while ($rows = mysqli_fetch_array($k2))
								{					
									$AMOUNT = $rows['amount'];
								}
							}
							else
							{
								$r=mysqli_query($conn,"SELECT  `AMOUNT` FROM `nature_payments` WHERE NATURE_ID='$q'");
								while ($k=mysqli_fetch_array($r))
								{
									$AMOUNT=$k['AMOUNT'];
								}
							}
							$r2=mysqli_query($conn,"SELECT `discount` FROM `fee_voucher_detail` WHERE challan_no = '$b' and nature_id = '$q'");
							while ($k2=mysqli_fetch_array($r2)){
								$discount=$k2['discount'];
								
								
							}
							
					?>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Amount</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="feeamount" name="feeamount" value="<?php echo $AMOUNT ?>" readonly>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Discount</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="discount" name="discount" value="<?php echo $discount ?>" >
                  </div>
                </div>
				
		
				
		
				

<?php
}
?>