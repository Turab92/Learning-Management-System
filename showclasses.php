<?php
include ('include/config.php');
if(isset($_GET['m'])){
    
    $q=$_GET['m'];

        ?>
		 <div class="form-group">
					<?php
							$r=mysqli_query($conn,"SELECT bs.BANK_ACCOUNT_NO,bsb.bank_id FROM `bank_assign_branch` as bsb JOIN banks_setup as bs on bsb.bank_id=bs.BANK_ID WHERE branch_id='$q'");
							while ($k=mysqli_fetch_array($r)){
								$BANK_ACCOUNT_NO=$k['BANK_ACCOUNT_NO'];
								$bank_id=$k['bank_id'];
								
							}
					?>
                  <label for="inputEmail3" class="col-sm-3 control-label">Bank Account No:</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bankno" name="bankno" value="<?php echo $BANK_ACCOUNT_NO; ?>" readonly>
					<input type="hidden" class="form-control" id="bankid" name="bankid" value="<?php echo $bank_id; ?>" readonly>
                  </div>
                </div>
		 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Class</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="class" id="class" onchange="showSection(this.value,<?php echo $q; ?>)" required>
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"SELECT cb.ALLOT_ID, cb.CLASS_ID, cb.BRANCH_ID,cs.CLASS_DESCRIPTION FROM `class_branch_setup` as cb join class_setup as cs on cb.CLASS_ID=cs.CLASS_ID WHERE  cb.BRANCH_ID='$q'");
							while ($k=mysqli_fetch_array($r)){
								$CLASS_ID=$k['CLASS_ID'];
								 $CLASS_DESCRIPTION=$k['CLASS_DESCRIPTION'];
								echo "<option value='$CLASS_ID' >$CLASS_DESCRIPTION</option>";
							}
					?>
                  </select>
                  </select>
				  </div>
             </div>
		
				
		
				

<?php
}
?>