<?php
include ('include/function.php');

$po_no = $_GET['id'];

$select = mysqli_query($conn,"select * from purchase_order_approval a ,portal_user b where a.approved_by = b.user_id and a.po_no = '$po_no'");
while($r = mysqli_fetch_array($select))
{
	$req_on = $r['REQUESTED_ON'];
	$is_approved = $r['IS_APPROVED'];
	$approved_on = $r['APPROVED_ON']; 
	$approver_comments = $r['APPROVER_COMMENTS'];
	$approved_by = $r['USER_NAME'];
}
?>

					
<div class="col-md-3">
   <label class="form-control-label">Request On</label>
   
		<input type="text" disabled  value="<?php echo $req_on; ?>" style="font-size:13px;" />
					
	</div>
	
<div class="col-md-3">  
   <label class="form-control-label">Is Approved</label>
   
		<input type="text" disabled  value="<?php echo $is_approved; ?>" style="font-size:13px;" />
</div>

<div class="col-md-3">  
   <label class="form-control-label">Approved On</label>
   	<input type="text" disabled  value="<?php echo $approved_on; ?>" style="font-size:13px;" />  
  </div>

  
   <label class="form-control-label">Approver Comments</label>
   <textarea disabled cols="26" rows="3" style="font-size:13px;"><?php echo $approver_comments; ?></textarea> 

     
<div class="col-md-3">  
   <label class="form-control-label">Approved By</label>
   	<input type="text" disabled  value="<?php echo ucfirst($approved_by); ?>" style="font-size:13px;" />  
  </div>
			
			
			