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
$pagename="Employee Advance";
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
    <section class="content">
      <div class="row">
    <script>
function employee(str) {
  if (str=="") {
    document.getElementById("employee").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("employee").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","ajax_employee_advance.php?q="+str,true);
  xmlhttp.send();
}
</script>
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
                  <label for="inputEmail3" class="col-sm-3 control-label">Select Project</label>

                 <div class="col-md-6">
					<select name="project"  required id="project" class="form-control" onclick="employee(this.value)">
					<option value="">Select Project</option>

					<?php
						$select = mysqli_query($conn,"select * from school_branches ");
					
					while($row = mysqli_fetch_array($select))
					{
						$branch_id = $row['branch_id'];
						$branch_name = $row['branch_name'];
					?>	
					<option value="<?php echo $branch_id;?>"><?php echo $branch_name; ?></option>	
						<?php
					}
					?>

					</select>
 				</div>
                </div>
				<div id="employee">Select Project For Employees </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Bank</label>

                  <div class="col-md-6">
					<select name="bank" class="form-control" required id="bank" >
					  <option value="">Select Bank</option>
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
                  <label for="inputPassword3" class="col-sm-3 control-label">Payment Mode</label>

                 <div class="col-md-6">

					<select name="payment_mode" class="form-control" required id="payment_mode" >
						<option value="">Select Payment Mode</option>

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
                  <label  for="inputPassword3" class="col-sm-3 control-label">Remarks</label>
                  <div class="col-md-6">
				<textarea class="form-control" name="remarks" id="remarks" ></textarea>	
					</div>
                </div>
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Cheque No</label>
                   <div class="col-md-6">
						<input type="number" class="form-control" name="cheque_no" id="cheque_no" min="1">
								</div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Advance Amount</label>
                   <div class="col-md-6">
						<input type="number" class="form-control" name="adv_amount" required id="adv_amount" min="1" />
								</div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Cheque Date</label>
                   <div class="col-md-6">
					<input type="date" class="form-control" name="cheque_date" id="cheque_date" >
								</div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">No Of Installment</label>
                   <div class="col-md-6">
					<input type="number" class="form-control" name="no_of_installments" id="no_of_installments" min="1"> 
								</div>
                </div>
				</div>
              </div>
              <!-- /.box-body -->
             
              <!-- /.box-footer -->
            </form>
			 <div class="box-footer">
               <div class="form-group">
				<div class="col-sm-6 col-sm-offset-2">
				<br>

					<button class="btn btn-primary btn-bordered waves-effect waves-light" onclick="submit()">Submit</button>
					<br><br>
					<button class="btn btn-primary btn-bordered waves-effect waves-light" disabled onclick="generate_refund()" id="refund">Generate Refund Schedule</button>
		

	<br><br>
								</div>
							</div>
              </div>
          </div>
		  
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
		<div id="saved"></div>
		
				<div id="refund_plan"></div>
	
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
  <script>

function  submit()
{
var project = document.getElementById("project").value;
var employee = document.getElementById("employees").value;
var payment_mode = document.getElementById("payment_mode").value;
var bank = document.getElementById("bank").value;
var cheque_no = document.getElementById("cheque_no").value;
var cheque_date = document.getElementById("cheque_date").value;
var adv_amount = document.getElementById("adv_amount").value;
var no_of_installments = document.getElementById("no_of_installments").value;
var remarks = document.getElementById("remarks").value;

var xmlhttp=new XMLHttpRequest();
xmlhttp.open("GET","save_employee_advance.php?project="+project+"&employee="+employee+
"&payment_mode="+payment_mode+"&bank="+bank+"&cheque_no="+cheque_no+"&cheque_date="+cheque_date+"&adv_amount="+adv_amount+"&adv_amount="+adv_amount+"&no_of_installments="+no_of_installments+"&remarks="+remarks,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("saved").innerHTML=xmlhttp.responseText;

if(text = 'Employee Advance Saved')
{
	document.getElementById("refund").disabled = false;
}
	
}

function generate_refund()
{
	var advance_id = document.getElementById("advance_id").value;
	var adv_amount = document.getElementById("adv_amount").value;
	var no_of_installments = document.getElementById("no_of_installments").value;

var xmlhttp=new XMLHttpRequest();
xmlhttp.open("GET","refund_plan.php?advance_id="+advance_id+"&adv_amount="+adv_amount+"&no_of_installments="+no_of_installments,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("refund_plan").innerHTML=xmlhttp.responseText;
	
}

function save()
{
	alert('Record Saved');
	location.reload();
}

</script>
  <!--javascript End-->
</body>
</html>
