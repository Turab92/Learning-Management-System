<?php

 $request_id = $_GET['request_id'];
include ('include/function.php');


?>
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
 <div class="box">
   <div class="box-body">
					<table id="example1" class="table table-bordered table-striped" style="width:100%">
						<thead>
							<tr>
						    	<th>Requested On</th>
								<th>Is Approved</th>
								<th>Approved On</th>
								<th>Approver Comments</th>
								<th>Approved By</th>
							</tr>
						</thead>

						<tbody>
						</tr>
						 <?php 
		  $i=1;

 
	$r = mysqli_query($conn, "select * from purchase_request_approval a,portal_user b where a.req_id = '$request_id' and a.approved_by = b.user_id "); 
	while (($rows = mysqli_fetch_array($r)) != false) {
	
	$requested_on = $rows['REQUESTED_ON'];
   $is_approved = $rows['IS_APPROVED'];
	$approved_on = $rows['APPROVED_ON'];
	 $approver_comments = $rows['APPROVER_COMMENTS'];
	 $approved_by = $rows['APPROVED_BY'];
	 $user_name = $rows['USER_NAME'];
	 
	ini_set('max_execution_time', 500);
	?>
	<tr >
	
	<td class="center"><?php echo $requested_on; ?></td>
	 		<td class="center" ><?php echo $is_approved; ?></td>
      <td class="center" ><?php echo $approved_on; ?></td>
		<td class="center" ><?php echo $approver_comments; ?></td>
			<td class="center" ><?php echo ucfirst($user_name); ?></td>
		
         
				
                </tr>
				
          <?php $i++;}  ?>
						
				</tbody>
					</table>
					</div>
			</div>
					</div>
			</div>
			   </section>