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
              <h3 class="box-title">Purchase Order Detail</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 	<th>S.No</th>
					<th>Item</th>
					<th>Uom</th>
					<th>Rate</th>
					<th>Quantity</th>
					<th>Discount</th>
					<th>Amount</th>
					<th>Remarks</th>
                </tr>
                </thead>
               
			<tbody>
						 <?php 
						 $po_no = base64_decode($_GET['id']); 
		  $i=1;
$real_amount = 0;
	$r = mysqli_query($conn, "select * from po_detail a , item_setup2 b ,uom_setup c where a.PO_NO = '$po_no' and a.ITEM_CODE = b.item_id and
	a.uom = c.DESCRIPTION"); 
  
	while (($rows = mysqli_fetch_array($r)) != false) {
	
$po_no = $rows['PO_NO'];
$item_code = $rows['ITEM_CODE'];	 
$item_name = $rows['ITEM_NAME'];
$uom = $rows['UOM'];	 
$quantity = $rows['QUANTITY'];	 
$remarks = $rows['REMARKS'];	 
$trno = $rows['TRNO'];	 
$rate = $rows['RATE'];
$discount = $rows['DISCOUNT'];	 
$uom_name = $rows['DESCRIPTION'];
$total_amount = $rate * $quantity - $discount;	
	 
	 $real_amount+=$total_amount;
	 
	 $enc = base64_encode($po_no);
	 
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
		 <td class="center"><?php echo $item_name; ?></td>
		<td class="center"><?php echo $uom_name; ?></td>
				 		 <td class="center" align="right"><?php echo number_format($rate); ?></td>	
			<td class="center"><?php echo number_format($quantity); ?></td>
			<td class="center" align="right"><?php echo number_format($discount); ?></td>
			<td class="center" align="right"><?php echo number_format($total_amount); ?></td>			
			<td class="center"><?php echo $remarks; ?></td>	
        
                </tr>
          <?php $i++;}  ?>
							<tr>
							
	 <td class="center"><?php echo '<b>Total </b>' ?></td>
		 <td class="center"></td>
		 		 <td class="center"></td>
		<td class="center"></td>
			<td class="center"></td>
			<td class="center"></td>
			<td class="center" align="right"><b><?php echo number_format($real_amount); ?></b></td>			
			<td class="center"></td>	
							
							</tr>
					</tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		<div align="center">
<a href='purchase_order_pdf_2.php?id=<?php echo $enc; ?>' target='_blank' ><button class="btn btn-primary btn-bordered waves-effect waves-light" >Print</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			
			<?php
			$select_approve = mysqli_query($conn,"select APPROVED from po_master where po_no = '$po_no' ");
			while($r = mysqli_fetch_array($select_approve))
			{
				$approved = $r['APPROVED'];
			}

$select_request_exist = mysqli_query($conn,"select * from purchase_order_approval where po_no = '$po_no' ");
$selected = mysqli_num_rows($select_request_exist);	 
	 
	 
			
			if($approved == 'Y' || $approved == 'N')
			{
				?>
				Request Already Submitted
				<?php
			}
			else if($selected > 0)
			{
				?>
				Request Already Submitted
			
<?php				
			}
			else
			{
			?>
			
<a href="make_approval_request_2.php?id=<?php echo $enc; ?>" ><button class="btn btn-primary btn-bordered waves-effect waves-light" >Make Approval Request</button></a>
			
			<?php
			}
			?>

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
	
  <?php
  include('include/javascript.php');
  ?>
  <!--javascript End-->
</body>
</html>
