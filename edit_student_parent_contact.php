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
					 $parent_cont_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT spc.parent_cont_id, spc.father_name, spc.father_contact, spc.mother_name, spc.mother_contact, spc.active, scs.APPLICANT_NAME, sb.branch_name FROM `student_parent_contact` as spc JOIN student_current_status as scs on spc.student_id = scs.student_id JOIN school_branches as sb on spc.branch_id = sb.branch_id where spc.parent_cont_id='$parent_cont_id'");
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
                  <label for="inputEmail3" class="col-sm-3 control-label">Father Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $erow['father_name']; ?>" readonly>
                  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Father Contact</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="fcontact" name="fcontact" value="<?php echo $erow['father_contact']; ?>" required>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Mother Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $erow['mother_name']; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Mother Contact</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="mcontact" name="mcontact" value="<?php echo $erow['mother_contact']; ?>" required>
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
							
							
							$fcontact=$_POST['fcontact'];
							$mcontact=$_POST['mcontact'];
							
							
							
							
							
								$query="UPDATE `student_parent_contact` SET `father_contact`='".$fcontact."',`mother_contact`='".$mcontact."'   WHERE `parent_cont_id` = '$parent_cont_id'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='house.php'; </script>";
							
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
