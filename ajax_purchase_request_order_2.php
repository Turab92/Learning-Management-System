<?php

include ('include/function.php');

$branch_id = $_GET['q'];

?>
			<div class="col-md-6">
<div class="form-group">
			
	<label for="inputPassword3" class="col-sm-3 control-label">Select Purchase Request</label>		
	<div class="col-md-6">
	
<select  name="names"  class="form-control" onchange="show_detail(this.value,<?php echo $branch_id; ?>)">

<option value="">Select Request No</option>
 	<?php
	$select_request = mysqli_query($conn,"select rm.REQ_ID from purchase_request_master rm where rm.REQ_ID NOT IN(SELECT h.REQ_ID from po_master h WHERE rm.REQ_ID=h.REQ_ID) AND rm.Status = 'Y' and rm.branch_id = '$branch_id' ");
	
	while($r = mysqli_fetch_array($select_request))
	{
		$request_id = $r['REQ_ID'];
		$remarks = $r['REMARKS'];
		?>
	<option value="<?php echo $request_id; ?>"><?php echo $request_id; ?></option>
		<?php
	}
	
	?>


</select>
	</div>
		
		
			</div>
						</div>
