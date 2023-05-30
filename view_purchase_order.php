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
$pagename="View Purchase Order";
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
              <h3 class="box-title">View Purchase Order</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 	<th>S.No</th>
					<th>Order No</th>
					<th>Order Date</th>
					<th>Supplier</th>
					<th>Branch</th>
					<th>Payment Terms</th>
					<th>Remarks</th>
					<th>Without Request</th>
					<th>Is Approved</th>
                </tr>
                </thead>
               
			<tbody>
						 <?php 
		  $i=1;

 
$r = mysqli_query($conn, "select a.PO_NO,a.PO_DATE,a.supplier_id,a.REMARKS,a.user_id,a.pc_ip,a.sys_date,a.PAYMENT_TERMS,a.req_id,a.APPROVED,a.po_type_id,a.branch_id,a.WITHOUT_REQUEST,b.supplier_id,b.name as SUPPLIER,c.term_id,c.description as PAYMENT_TERMS,d.potype_id,d.POTYPE_NAME,e.branch_id,e.branch_name from po_master a,supplier_setup b,PAYMENT_TERMS c,potype_setup d,school_branches e where a.supplier_id = b.supplier_id and a.PAYMENT_TERMS = c.term_id and a.po_type_id = d.potype_id and a.branch_id = e.branch_id order by PO_NO desc"); 

	while (($rows = mysqli_fetch_array($r)) != false) {
	
$po_no = $rows['PO_NO'];
$po_date = $rows['PO_DATE'];
$remarks = $rows['REMARKS'];
$is_approved = $rows['APPROVED'];
$supplier = $rows['SUPPLIER'];
$payment_terms = $rows['PAYMENT_TERMS'];
$potype_name = $rows['POTYPE_NAME'];
$branch_name = $rows['branch_name'];
$without_request = $rows['WITHOUT_REQUEST'];
$payment_terms = $rows['PAYMENT_TERMS'];
$enc = base64_encode($po_no);

$select_request_exist = mysqli_query($conn,"select * from purchase_order_approval where PO_NO = '$po_no' ");
$selected = mysqli_num_rows($select_request_exist);	 
	 
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
		 <td class="center"><?php echo $po_no; ?></td>
		 <td class="center"><?php echo $po_date; ?></td>
        <td class="center"><a href='purchase_order_detail.php?id=<?php echo $enc; ?>' title='Click Here For Purchase Order Detail' target='_blank'><?php echo $supplier; ?></td></a>
       
		<td class="center"><?php echo $branch_name; ?></td>
				<td class="center"><?php echo $payment_terms; ?></td>
			<td class="center"><?php echo $remarks; ?></td>
			<td class="center"><?php echo $without_request; ?></td>
			<?php
			if($is_approved != null)
			{
				if($without_request == null)
				{
		?>		
<td class="center"><?php echo $is_approved; ?></td>	
<?php				
				}
				else
				{
?>		
<td class="center"><a href="#" title="Click Here For Approval Details" data-toggle="modal" data-target="#boostrapModal-2" onclick="approval_details(<?php echo $po_no; ?>)" ><?php echo $is_approved; ?></a></td>	
<?php						
				}

			}
			else if($selected > 0)
	 {
?>
<td class="center"><a href="#" title="Click Here For Submitted Request Details" data-toggle="modal" data-target="#boostrapModal-2" onclick="approval_details(<?php echo $po_no; ?>)" ><?php echo 'Request Submitted..' ?></a></td>	
<?php
	 }		
			else
			{
	?>			
		<td class="center"><?php echo 'Request Not Submitted'; ?></td>	
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

function approval_details(po_no)
{
        $("#approval_details").load("order_request_approval_details.php?id="+po_no);
}
	
</script>	
  <?php
  include('include/javascript.php');
  ?>
  <!--javascript End-->
</body>
</html>
