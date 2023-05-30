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

		<?php
				if(isset($_GET['edit'])) {
					 $emp_allow_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `employee_allowances` as ea JOIN school_branches as sb on ea.branch_id=sb.branch_id JOIN employees as e on ea.emp_id=e.EMP_ID JOIN allowances as a on ea.allowance_id = a.allowance_id where  ea.emp_allow_id='$emp_allow_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
       
	   
			 
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Employees Allowances</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			
			  <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="branch" id="branch" readonly>
                    <option value='<?php echo $erow['branch_id']; ?>'><?php echo $erow['branch_name']; ?></option>
					
                  </select>
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Employee</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="employee" id="employee" readonly>
                    <option value='<?php echo $erow['emp_id']; ?>'><?php echo $erow['EMP_NAME']; ?></option>
					
                  </select>
                  </select>
				  </div>
                </div>
				
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Allowance</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="allowance" id="allowance">
                    <option value='<?php echo $erow['allowance_id']; ?>'><?php echo $erow['allowance_name']; ?></option>
					<?php
							$r=mysqli_query($conn,"select allowance_id,allowance_name from allowances where status = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$allowance_id=$k['allowance_id'];
								 $allowance_name=$k['allowance_name'];
								echo "<option value='$allowance_id' >$allowance_name</option>";
							}
					?>
                  </select>
                  </select>
				  </div>
                </div>
				
				
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Allowance Amount</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $erow['amount']; ?>">
                  </div>
                </div>
				
				
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
			<?php
						if (isset($_POST['btnsub'])) {
							
							$branch=$_POST['branch'];
							$employee=$_POST['employee'];
							$allowance=$_POST['allowance'];
							$amount=$_POST['amount'];
							
							
							
						   $k=mysqli_query($conn,"select * from employee_allowances WHERE branch_id='$branch' AND emp_id='$employee' AND allowance_id='$allowance'");
							   $k_count=mysqli_num_rows($k);
							   if($k_count==1){
								   echo "<div class='alert alert-success'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>warning!</strong> Allowance Already Alloted.
									</div>";
									$query="UPDATE `employee_allowances` SET `amount`='".$amount."'   WHERE `emp_allow_id` = '$emp_allow_id'";
										$result = $conn->query($query);
									 echo "<div class='alert alert-success'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>warning!</strong> Amount Successfully Updated.
									</div>";
										   echo "<script>setTimeout(\"location.href = 'allowance_detail.php';\",2000);</script>";
										
										 
							   }
							   else{
										$query="UPDATE `employee_allowances` SET `allowance_id`='".$allowance."',`amount`='".$amount."'   WHERE `emp_allow_id` = '$emp_allow_id'";
										$result = $conn->query($query);
										 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
										echo "<script>location.href='allowance_detail.php'; </script>";
									}
							
								
						}
						?>
          </div>
       
        </div>
        <!--/.col (right) -->
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
