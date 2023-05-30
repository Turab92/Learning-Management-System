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

$advance_id = base64_decode($_GET['edit']);
 
 	$r = mysqli_query($conn, "select a.ADVANCE_ID,a.EMPLOYEE_ID,a.ADVANCE_DATE,a.ADVANCE_AMOUNT,a.CHEQUE_NO,a.CHEQUE_DATE,a.NO_OF_INSTALLMENT,a.BRANCH_NAME,b.DESCRIPTION,c.BANK_NAME,d.EMP_NAME,b.MODE_ID,c.BANK_ID from employee_advance a,payment_mode b ,banks_setup c,employees d where a.EMPLOYEE_ID = d.emp_id and a.BANK_ID = c.BANK_ID
and a.payment_mode = b.MODE_ID and a.ADVANCE_ID = '$advance_id' "); 
	while (($r = mysqli_fetch_array($r)) != false) {

$advance_id = $r['ADVANCE_ID'];
$employee_id = $r['EMPLOYEE_ID'];	 
	 $advance_date = $r['ADVANCE_DATE'];
	 $advance_amount = $r['ADVANCE_AMOUNT'];
	 $cheque_no = $r['CHEQUE_NO'];
	 $cheque_date = $r['CHEQUE_DATE'];
	 $no_of_installment = $r['NO_OF_INSTALLMENT'];
	 $branch_name = $r['BRANCH_NAME'];
	 $payment_id = $r['MODE_ID'];
	 $payment_mode = $r['DESCRIPTION'];
	 $bank_id = $r['BANK_ID'];
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

					<input type="text" class="form-control" id="adv_date" value="<?php echo $advance_date;?>" />			 
					</div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Advance Amount</label>
                  <div class="col-md-6">
				<input type="text" class="form-control"  value="<?php echo $advance_amount;?>" id="adv_amount" />
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
						<input type="text" class="form-control"  value="<?php echo $no_of_installment;?>" id="no_of_installment"/>
								</div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Payment Mode</label>
                   <div class="col-md-6">
						
						<select name="payment_mode" class="form-control" required id="payment_mode" >
						<option value="<?php echo $payment_id;?>"><?php echo $payment_mode;?></option>

						<?php
						$select_payment_mode = mysqli_query($conn,"select * from payment_mode");
						while($row = mysqli_fetch_array($select_payment_mode))
						{
							$mode_id = $row['MODE_ID'];
							$description = $row['DESCRIPTION'];
						?>	
						<option value="<?php echo $mode_id;?>"><?php echo $description; ?></option>	
							<?php
						}
						?>

					</select>	
								</div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Bank</label>
                   <div class="col-md-6">
					
					<select name="bank" class="form-control" required id="bank" >
					  <option value="<?php echo $bank_id;?>"><?php echo $bank_name;?></option>
						<?php
							$sql=mysqli_query($conn,"select * from banks_setup");
									while(($row=mysqli_fetch_array($sql)) != false){           
										$id=$row['BANK_ID'];
										$name=$row['BANK_NAME'];
										echo"<option  value='$id'>$name</option>";
									}
															  ?>
									
					</select>
								</div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Cheque No</label>
                   <div class="col-md-6">
					<input type="text" class="form-control" id="cheque_no"  value="<?php echo $cheque_no;?>" />
								</div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Cheque Date</label>
                   <div class="col-md-6">
					 <input type="text" class="form-control" id="cheque_date" value="<?php echo $cheque_date;?>" />
								</div>
                </div>
				</div>
		
		<div align="center">				
                        <button class="btn btn-primary btn-bordered waves-effect waves-light" type='button' onclick="save()">
Save
						</button></a>
	</div>

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
	<div id="refund_plan"></div>
			
					<script>
			
function save()
{

	var advance_id = document.getElementById("advance_id").value;
	var adv_amount = document.getElementById("adv_amount").value;
	var no_of_installments = document.getElementById("no_of_installment").value;
	var adv_date = document.getElementById("adv_date").value;
    var payment_mode = document.getElementById("payment_mode").value;
	var bank = document.getElementById("bank").value;
    var cheque_no = document.getElementById("cheque_no").value;
    var cheque_date = document.getElementById("cheque_date").value;	
	
	// alert(advance_id);alert(adv_amount);alert(no_of_installments);
	// alert(adv_date);alert(payment_mode);alert(bank);alert(cheque_no);
	// alert(cheque_date);
	
var xmlhttp=new XMLHttpRequest();
xmlhttp.open("GET","edit_employee_advance_js.php?advance_id="+advance_id+"&adv_amount="+adv_amount+"&no_of_installments="+no_of_installments+
"&adv_date="+adv_date+"&payment_mode="+payment_mode+"&bank="+bank+"&cheque_no="+cheque_no+
"&cheque_date="+cheque_date,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("refund_plan").innerHTML=xmlhttp.responseText;
	
	alert('Record Updated');
	
	// location.reload();
	window.open('view_employee_advance','_self');


	
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
