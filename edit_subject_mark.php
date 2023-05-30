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
$pagename="Subject Marks";
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
		<?php
				if(isset($_GET['edit'])) {
					 $dec = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `class_subject_marks` as csm JOIN class_setup as c on csm.class_id=c.CLASS_ID JOIN subjects as s on csm.subject_id=s.sub_id where csm.cs_mark_id='$dec'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Subject Marks</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
		
					<div class="form-group">
						<label  for="inputPassword3" class="col-sm-3 control-label">Class:</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" name="class" value="<?php echo $erow['CLASS_DESCRIPTION']; ?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label  for="inputPassword3" class="col-sm-3 control-label">Subject:</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" name="subject" value="<?php echo $erow['sub_name']; ?>" readonly>
						</div>
					</div>
					<div class="form-group">
						<label  for="inputPassword3" class="col-sm-3 control-label">Total Mark:</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" name="total" value="<?php echo $erow['total_marks']; ?>"required>
						</div>
					</div>
					<div class="form-group">
						<label  for="inputPassword3" class="col-sm-3 control-label">Passing Marks:</label>
						<div class="col-sm-6">
						  <input type="text" class="form-control" name="pass" value="<?php echo $erow['passing_marks']; ?>" required>
						</div>
					</div>
					
					
			
			</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		 <?php
				if (isset($_POST['btnsub'])) {
					
						
						$total=$_POST['total'];
						$pass=$_POST['pass'];
						
					
						$query="UPDATE `class_subject_marks` SET `total_marks`='".$total."',`passing_marks`='".$pass."'   WHERE `cs_mark_id` = '$dec'";
						$result = $conn->query($query);
						 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
						echo "<script>location.href='subject_marks'; </script>";
				}
				?>
		  
          <!-- /.box -->
    
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
