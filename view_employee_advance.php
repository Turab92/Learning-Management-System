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
$pagename="View Employee Advance";
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
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Campus Management System
       
      </h1>
     
    </section>

    <!-- Main content -->
   

	
	
	
	
	<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Employee Advance</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>S.No</th>
				<th>Employee</th>
				<th>Branch</th>
				<th>Adv Date</th>
				<th>Adv Amount</th>
				<th>No Of Installments</th>
				<th>Payment Mode</th>
				<th>Bank</th>
				<th>Cheque No</th>
				<th>Cheque Date</th>
				 
               
                </tr>
                </thead>
               
			   <tbody>
						 <?php 
		  $i=1;
		  
	$select = mysqli_query($conn, "select a.ADVANCE_ID,a.EMPLOYEE_ID,a.ADVANCE_DATE,a.ADVANCE_AMOUNT,a.payment_mode,a.bank_id,a.CHEQUE_NO,a.CHEQUE_DATE,a.remarks,a.NO_OF_INSTALLMENT,
a.branch_name,b.mode_id,b.DESCRIPTION,c.bank_id,c.BANK_NAME,d.emp_id,d.EMP_NAME 
from employee_advance a,payment_mode b,banks_setup c,employees d
where a.EMPLOYEE_ID = d.emp_id and a.bank_id = c.bank_id and a.payment_mode = b.mode_id order by advance_date desc"); 
	while ($r = mysqli_fetch_array($select)) {

$advance_id = $r['ADVANCE_ID'];

$employee_id = $r['EMPLOYEE_ID'];	 
	 $advance_date = $r['ADVANCE_DATE'];
	 $advance_amount = $r['ADVANCE_AMOUNT'];
	 $cheque_no = $r['CHEQUE_NO'];
	 $cheque_date = $r['CHEQUE_DATE'];
	 $no_of_installment = $r['NO_OF_INSTALLMENT'];
	 $branch_name = $r['branch_name'];

	 $payment_mode = $r['DESCRIPTION'];
	 $bank_name = $r['BANK_NAME'];
	 $emp_name = $r['EMP_NAME'];
	 $enc = base64_encode($advance_id);
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
<td class="center"><a href="employee_advance_detail?adv_id=<?php echo $enc; ?>" ><?php echo $emp_name; ?></a></td>
        <td class="center"><?php echo $branch_name; ?></td>
		        <td class="center"><?php echo $advance_date; ?></td>
        <td class="center"><?php echo $advance_amount; ?></td>
		<td class="center"><?php echo $no_of_installment; ?></td>
				<td class="center"><?php echo $payment_mode; ?></td>
		<td class="center"><?php echo $bank_name; ?></td>
		<td class="center"><?php echo $cheque_no; ?></td>
    	<td class="center"><?php echo $cheque_date; ?></td>
  
        
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
  <?php
  include('include/javascript.php');
  ?>
  <!--javascript End-->
</body>
</html>
