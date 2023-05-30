<?php
session_start();
include ('include/function.php');

if($_SESSION['name'] ==""){

    echo "<script>alert('You must Login to continue')</script>";
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
$loginuser= $_SESSION['name'];
$usr=mysqli_query($conn,"select * from portal_user WHERE USER_NAME='$loginuser'");
while ($y=mysqli_fetch_array($usr)){
    $userid=$y['user_id'];
    $username=$y['USER_NAME'];
}
//auth
$pagename="View Purchase Request";
auth_user($pagename,$userid);
?>
<!DOCTYPE html>
<html>
 <!--layout start-->
  <?php
  include('include/layout.php');
  ?>
  <!--layout End-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!--header start-->
  <?php
  include('include/header.php');
  ?>
  <!--header End-->
  
  <!--sidebar start-->
  <?php
  include('include/sidebar.php');
  ?>
  <!--sidebar End-->
  <div class="modal fade" id="boostrapModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-1">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel-1">Approval Details</h4>
			</div>
			<div class="modal-body">
				<div id="approval_details"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				
			</div>
		</div>
	</div>
</div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Campus Management System
       
      </h1>
     
    </section>

	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Purchase Request</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 	<th>S.No</th>
					<th>Request ID</th>
					<th>Request Date</th>
					<th>Request From</th>
					<th>Username</th>
					<th>Remarks</th>
					<th>Branch</th>
					<th>Is Approved</th>
                </tr>
                </thead>
               
			<tbody>
						 <?php 
		  $i=1;

 
$r = mysqli_query($conn, "select * from purchase_request_master a , supplier_setup b , portal_user c ,school_branches d 
where b.SUPPLIER_ID = a.req_from and a.user_id = c.user_id and d.branch_id = a.branch_id "); 

	while (($rows = mysqli_fetch_array($r)) != false) {
	
	$req_id = $rows['REQ_ID'];
	$req_date = $rows['REQ_DATE'];
	$remarks = $rows['REMARKS'];
	$name = $rows['NAME'];
	$user_name = $rows['USER_NAME'];
	$branch_name = $rows['branch_name'];
	$is_approved = $rows['APPROVED']; 

$select_request_exist = mysqli_query($conn,"select * from purchase_request_approval where req_id = '$req_id' ");
$selected = mysqli_num_rows($select_request_exist);	 

	
	 $enc = base64_encode($req_id);
	 
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
	 <td class="center"><?php echo $req_id; ?></td>	 
		 <td class="center"><?php echo $req_date; ?></td>
        <td class="center"> <a href='purchase_request_detail.php?id=<?php echo $enc; ?>'  title='Click Here For Purchase Order Detail' target='_blank' ><?php echo $name; ?></td></a>
        <td class="center"><?php echo $user_name; ?></td>
		<td class="center"><?php echo $remarks; ?></td>
			<td class="center"><?php echo $branch_name; ?></td>
			<?php
			if($is_approved != null)
			{
?>		
<td class="center"><a href="#" title="Click Here For Approval Details" data-toggle="modal" data-target="#boostrapModal-2" onclick="approval_details(<?php echo $req_id; ?>)" ><?php echo $is_approved; ?></a></td>	
<?php	
			}
			else if($selected > 0)
	 {
?>
<td class="center"><a href="#" title="Click Here For Submitted Request Details" data-toggle="modal" data-target="#boostrapModal-2" onclick="approval_details(<?php echo $req_id; ?>)" ><?php echo 'Request Submitted..' ?></a></td>
<?php
	 }		
			else
			{
	?>			
		<td class="center"><?php echo 'Request Not Made'; ?></td>	
<?php		
			}
		
			?>
		
        
                </tr>
          <?php $i++;}  ?>
							
							
		
    
												</tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	
	
	
  </div>
 <!--Footer start-->
  <?php
  include('include/footer.php');
  ?>
  <!--Footer End-->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!--javascript start-->
<script>

function approval_details(request_id)
{
        $("#approval_details").load("request_approval_details.php?id="+request_id);
}
	
</script>	
  <?php
  include('include/javascript.php');
  ?>
  <!--javascript End-->
</body>
</html>
