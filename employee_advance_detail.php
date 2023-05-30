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
//include 'edit_delete_function.php';	


	$edit_report = 'Edit';
	$delete_report = 'Delete';
	
	$select_edit = mysqli_query($conn,"select * from employee_right as er join rights as r on er.right_id=r.right_id where r.rights_name = '$edit_report' and er.user_id = '$userid' ");
	
	$select_edit_rows = mysqli_num_rows($select_edit);
	if($select_edit_rows > 0)
	{
$edit_count = 1;
	}
	else
	{
$edit_count = 0;
	}
	
	$select_delete = mysqli_query($conn,"select * from employee_right as er join rights as r on er.right_id=r.right_id where r.rights_name = '$delete_report' and er.user_id = '$userid'"); 
    
    $select_delete_rows = mysqli_num_rows($select_delete); 
	if($select_delete_rows)
	{
$delete_count = 1;
	}
	else
	{
$delete_count = 0;
	}
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
<?php 

$advance_id = base64_decode($_GET['adv_id']);
 
 	$r = mysqli_query($conn, "select a.ADVANCE_ID,a.EMPLOYEE_ID,a.ADVANCE_DATE,a.ADVANCE_AMOUNT,a.CHEQUE_NO,a.CHEQUE_DATE,a.NO_OF_INSTALLMENT,a.BRANCH_NAME,b.DESCRIPTION,c.BANK_NAME,d.EMP_NAME from employee_advance a,payment_mode b ,banks_setup c,employees d where a.EMPLOYEE_ID = d.emp_id and a.bank_id = c.bank_id
and a.payment_mode = b.mode_id and a.ADVANCE_ID = '$advance_id' "); 
	while (($r = mysqli_fetch_array($r)) != false) {

$advance_id = $r['ADVANCE_ID'];
$employee_id = $r['EMPLOYEE_ID'];	 
	 $advance_date = $r['ADVANCE_DATE'];
	 $advance_amount = $r['ADVANCE_AMOUNT'];
	 $cheque_no = $r['CHEQUE_NO'];
	 $cheque_date = $r['CHEQUE_DATE'];
	 $no_of_installment = $r['NO_OF_INSTALLMENT'];
	 $branch_name = $r['BRANCH_NAME'];
	 echo "<script>alert('$branch_name')</script>";
	 $payment_mode = $r['DESCRIPTION'];
	 $bank_name = $r['BANK_NAME'];
	 $emp_name = $r['EMP_NAME'];
	 
	}
 

 ?>

        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Advance</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Advance Id</label>

                 <div class="col-md-6">
					<input type="text" class="form-control" readonly value="<?php echo $advance_id;?>" id="advance_id" />
 				</div>
                </div>
				
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Employee</label>

                  <div class="col-md-6">
					<input type="text" class="form-control" readonly value="<?php echo $emp_name;?>" />
					</div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Advance Date</label>

                 <div class="col-md-6">

					<input type="text" class="form-control" readonly value="<?php echo $advance_date;?>" />			 
					</div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Advance Amount</label>
                  <div class="col-md-6">
				<input type="text" class="form-control" readonly value="<?php echo $advance_amount;?>" id="adv_amount" />
					</div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch</label>
                  <div class="col-md-6">
				<input type="text" class="form-control" readonly value="<?php echo $branch_name;?>" />
					</div>
                </div>
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">No Of Installment</label>
                   <div class="col-md-6">
						<input type="text" class="form-control" readonly value="<?php echo $no_of_installment;?>" id="no_of_installment"/>
								</div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Payment Mode</label>
                   <div class="col-md-6">
						<input type="text" class="form-control" readonly value="<?php echo $payment_mode;?>" />
								</div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Bank</label>
                   <div class="col-md-6">
					<input type="text" class="form-control" readonly value="<?php echo $bank_name;?>" />
								</div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Cheque No</label>
                   <div class="col-md-6">
					<input type="text" class="form-control" readonly value="<?php echo $cheque_no;?>" />
								</div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Cheque Date</label>
                   <div class="col-md-6">
					 <input type="text" class="form-control" readonly value="<?php echo $cheque_date;?>" />
								</div>
                </div>
				</div>
				
				<?php

$select = mysqli_query($conn,"select * from employee_advance_refund_plan where advance_id = '$advance_id' ");
$selected_row = mysqli_num_rows($select);

if($selected_row == 0)
{
?>	
					
					<div align="center">
								<br>
							<br></br>
			
	<button class="btn btn-primary btn-bordered waves-effect waves-light" onclick="generate_refund()" />Create Refund Plan</button>
	<br><br>
								</div>
<?php
}
else
{
?>
					<div align="center">
								<br>
							<br></br>
			
	<input type="submit" value="Create Refund Plan" disabled class="btn btn-primary btn-bordered waves-effect waves-light" />
	<br><br>
								</div>
<?php	
}
?>							

	<?php
if($edit_count == 1)
{
	
	$select = mysqli_query($conn,"select * from employee_advance_refund_plan where advance_id = '$advance_id' ");
	$selected_row = mysqli_num_rows($select);
	$enc = base64_encode($advance_id);
	if($selected_row == 0)
	{
?>
  	<div align="center">				
                            <?php echo "<a href='edit_employee_advance.php?edit=$enc'>"; ?>
                        <button class="btn btn-primary btn-bordered waves-effect waves-light" type='button'>
Edit
						</button></a>
	</div>
<?php
	}
	else
	{
?>
  	<div align="center">				
                            <?php echo "<a href='edit_class.php?edit=$enc'>"; ?>
                        <button class="btn btn-primary btn-bordered waves-effect waves-light" type='button' disabled>
Edit
						</button></a>
	</div>
<?php
	}		
}
?>  
				
				
				
				
              </div>
              <!-- /.box-body -->
             
              <!-- /.box-footer -->
            </form>
			
          </div>
		  
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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
				<th>Scheduled Amount</th>
				<th>Schedule Date</th>
				<th>Clear</th>
				<th>Clearing Date</th>
				 
               
                </tr>
                </thead>
               
			   <tbody>
						 <?php 
		  $i=1;
		  
	$r = mysqli_query($conn, "select * from employee_advance_refund_plan where advance_id = '$advance_id' "); 
	while (($rows = mysqli_fetch_array($r)) != false) {
	
	$schedule_amount = $rows['SCHEDULED_AMOUNT'];
	$schedule_date = $rows['SCHEDULE_DATE'];
	$clear = $rows['CLEAR'];
    $clearing_date = $rows['CLEARING_DATE'];
	
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
		 <td class="center"><?php echo $schedule_amount; ?></td>
        <td class="center"><?php echo $schedule_date; ?></td>
        <td class="center"><?php echo $clear; ?></td>
		<td class="center"><?php echo $clearing_date; ?></td>
	
	
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
	<div id="refund_plan"></div>
			
					<script>
			
			function generate_refund()
{

if(confirm("Are U Sure ?"))
{
	var advance_id = document.getElementById("advance_id").value;
	var adv_amount = document.getElementById("adv_amount").value;
	var no_of_installments = document.getElementById("no_of_installment").value;

	
var xmlhttp=new XMLHttpRequest();
xmlhttp.open("GET","refund_plan_2.php?advance_id="+advance_id+"&adv_amount="+adv_amount+"&no_of_installments="+no_of_installments,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("refund_plan").innerHTML=xmlhttp.responseText;
	
	alert('Refund Plan Created');
	
	location.reload();

}
else
{
	
}

	
}

			</script>
		
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
