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
					 $std_prev_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `student_previous_detail` as spd JOIN student_current_status as scs on spd.student_id = scs.student_id JOIN school_branches as sb on scs.BRANCH_ID = sb.branch_id where spd.std_prev_id='$std_prev_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Document</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
			
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Student Name</label>

                  <div class="col-sm-6">
				
                    <input type="text" class="form-control" id="stdname" name="stdname" value="<?php echo $erow['APPLICANT_NAME']; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Prevoius Academy</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="previous" name="previous" value="<?php echo $erow['academy_name']; ?>">
                  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">From date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="fromdate" name="fromdate" value="<?php echo $erow['from_date']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">To Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="todate" name="todate" value="<?php echo $erow['to_date']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">From Class</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="fromclass" name="fromclass" value="<?php echo $erow['from_class']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">To Class</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="toclass" name="toclass" value="<?php echo $erow['to_class']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Last Class Percent</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="lastpercent" name="lastpercent" value="<?php echo $erow['last_class_percent']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Reason For Left Previous School</label>

                  <div class="col-sm-6">
                    <textarea name="reason" id="reason" rows="4" class="form-control"><?php echo $erow['reason_for_left']; ?></textarea>
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
							
							
							$previous=$_POST['previous'];
							$fromdate=$_POST['fromdate'];
							$todate=$_POST['todate'];
							$fromclass=$_POST['fromclass'];
							$toclass=$_POST['toclass'];
							$lastpercent=$_POST['lastpercent'];
							$reason=$_POST['reason'];
							
							
							
								
									$query="UPDATE `student_previous_detail` SET `academy_name`='".$previous."',`from_date`='".$fromdate."',`to_date`='".$todate."',`from_class`='".$fromclass."',`to_class`='".$toclass."',`last_class_percent`='".$lastpercent."',`reason_for_left`='".$reason."'   WHERE `std_prev_id` = '$std_prev_id'";
									$result = $conn->query($query);
									 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
									echo "<script>location.href='prev_docs.php'; </script>";
							   
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
