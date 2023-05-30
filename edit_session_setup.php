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
       <?php
				if(isset($_GET['edit'])) {
					 $SESSION_ID = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * from sessions_setup  where SESSION_ID='$SESSION_ID'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Session Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">To Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="todate" name="todate" value="<?php echo $erow['TO_DATE']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">From Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="fromdate" name="fromdate" value="<?php echo $erow['FROM_DATE']; ?>">
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Time In</label>

                  <div class="col-sm-6">
                    <input type="time" class="form-control" id="timein" name="timein" value="<?php echo $erow['TIME_IN']; ?>">
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Time Out</label>

                  <div class="col-sm-6">
                    <input type="time" class="form-control" id="timeout" name="timeout" value="<?php echo $erow['TIME_OUT']; ?>" >
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Surcharge</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="inputPassword3" name="surcharge"  value="<?php echo $erow['SURCHARGE']; ?>">
                  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Status</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="status">
				   <option value="<?php echo $erow['ACTIVE']; ?>"><?php echo $erow['ACTIVE']; ?></option>
                    <option value="Y">Enabled</option>
					<option value="N">Disabled</option>
                  </select>
				  </div>
                </div>
				</div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
			<?php
						if (isset($_POST['btnsub'])) {
							
								$todate=$_POST['todate'];
								$fromdate=$_POST['fromdate'];
							    $timein=$_POST['timein'];
								$timeout=$_POST['timeout'];
								 $surcharge=$_POST['surcharge'];
								$status=$_POST['status'];
							
								$query="UPDATE `sessions_setup` SET `TO_DATE`='".$todate."',`FROM_DATE`='".$fromdate."',`TIME_IN`='".$timein."',`TIME_OUT`='".$timeout."',`SURCHARGE`='".$surcharge."',`ACTIVE`='".$status."'   WHERE `SESSION_ID` = '$SESSION_ID'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='session_setup.php'; </script>";
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
