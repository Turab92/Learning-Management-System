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
$pagename="Monthly Payroll";
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
        <!-- left column -->
       
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Payroll</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Project</label>
                   <div class="col-md-6">
								
					<select class="form-control " name="project" id="proj">
					<option>Select</option>
					<?php
						$r22 = mysqli_query($conn, "select * from prj_project_setup "); 
						while (($rows2 = mysqli_fetch_array($r22)) != false) {
						 $pj_id = $rows2['PROJECT_ID'];
						 $pj_name=$rows2['PARTICULARS'];
						 ?>
						 <option value="<?php echo $pj_id;?>"><?php echo $pj_name ;?></option>
						 <?php
						}
													 
								 ?>
											</select>
								</div>
                </div>
              
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select branch_id,branch_name from school_branches where active = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$branch_id=$k['branch_id'];
								 $branch_name=$k['branch_name'];
								echo "<option value='$branch_id' >$branch_name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Bank</label>
                   <div class="col-md-6">
					<select class="form-control " name="bank" id="bank">
					<option>Select</option>
					<?php
					 $r21 = mysqli_query($conn, "select* from banks_setup "); 
						while (($rows21 = mysqli_fetch_array($r21)) != false) {
						 $BANK_ID = $rows21['BANK_ID'];
						 $BANK_NAME=$rows21['BANK_NAME'];
						 ?>
						 <option value="<?php echo $BANK_ID;?>"><?php echo $BANK_NAME;?></option>
						 <?php
						}
								 
								 ?>
											</select>
								</div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Reference #</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="ref" name="ref" >
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">For the month of</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="formonth" name="formonth" >
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Payroll Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="payrolldate" name="paydate" >
                  </div>
                </div>
               
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Payroll Type</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="payrolltype" id="payrolltype">
					 <option value=''>Select</option>
                    <option value='Payroll'>Payroll</option>
					<option value='Bonus'>Bonus</option>
					<option value='Bonus'>Payroll/Bonus</option>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Cheque No#</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="cheqno" name="cheqno" >
                  </div>
                </div>
				 </div>
				
				
              </div>
			  <input type="hidden" value="<?php echo $userid ?>" id="user"/>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
								<div class="col-sm-6 col-sm-offset-8">
							<li class="margin-bottom-10">
							<input type="button" name="sub" id="sub" class="btn btn-primary btn-bordered waves-effect waves-light" onClick="save_payroll_master();" value="Generate">
							</li>
								</div>
							</div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		 
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	<div id="d5"></div>	
	
	
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
  function save_payroll_master(){
	
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","payrollmaster.php?bank="+document.getElementById("bank").value
	+"&ref="+document.getElementById("ref").value
	+"&for_month="+document.getElementById('formonth').value
	+"&payrolldate="+document.getElementById('payrolldate').value
	+"&payrolltype="+document.getElementById('payrolltype').value
	+"&cheqno="+document.getElementById('cheqno').value
	+"&user="+document.getElementById('user').value
	+"&branch="+document.getElementById('branch').value
	+"&project="+document.getElementById('proj').value,false);
	xmlhttp.send(null);
	//location.reload('fee_slab.php');
	
	document.getElementById("d5").innerHTML=xmlhttp.responseText;
	
	alert("Saved");
	
}
  </script>
  <!--javascript End-->
</body>
</html>
