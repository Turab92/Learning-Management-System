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
					 $bearer_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `student_current_bearer` as scb JOIN student_current_status as scs on scb.student_id=scs.STUDENT_ID JOIN school_branches as sb on scs.BRANCH_ID = sb.branch_id where scb.bearer_id='$bearer_id'");
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
                  <label for="inputPassword3" class="col-sm-3 control-label">Bearer Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bearname" name="bearname" value="<?php echo $erow['bearer_name']; ?>" required>
                  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Bearer Contact</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bearcont" name="bearcont" value="<?php echo $erow['bearer_contact']; ?>" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Bearer CNIC</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bearnic" name="bearnic" value="<?php echo $erow['bearer_nic']; ?>" required>
                  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Date of Issue</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="issuedate" name="issuedate" value="<?php echo $erow['date_of_issue']; ?>" required>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Bearer Change Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="chngdate" name="chngdate" value="<?php echo $erow['change_date']; ?>">
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
							
							
							$bearname=$_POST['bearname'];
							$bearcont=$_POST['bearcont'];
							$bearnic=$_POST['bearnic'];
							$issuedate=$_POST['issuedate'];
							$chngdate=$_POST['chngdate'];
							
							
							
							
								$query="UPDATE `student_current_bearer` SET `bearer_name`='".$bearname."',`bearer_contact`='".$bearcont."',`bearer_nic`='".$bearnic."',`date_of_issue`='".$issuedate."',`change_date`='".$chngdate."'   WHERE `bearer_id` = '$bearer_id'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='bearer.php'; </script>";
							
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
