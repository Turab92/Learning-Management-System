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
					 $user_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * from portal_user as pu join school_branches as sb on pu.branch_id=sb.branch_id where pu.user_id='$user_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
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
              <h3 class="box-title">Edit User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">User Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $erow['USER_NAME']; ?>">
                  </div>
                </div>
               <!-- <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Password</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="password" name="password" value="<?php echo ($erow['user_pass']); ?>">
                  </div>
                </div>-->
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Created By</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="createdby" name="createdby" value="<?php echo $erow['CREATED_BY']; ?>" readonly>
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch">
                    <option value='<?php echo $erow['branch_id']; ?>'><?php echo $erow['branch_name']; ?></option>
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
                  <label  for="inputPassword3" class="col-sm-3 control-label">Status</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="status" id="status">
				  <option value='<?php echo $erow['status']; ?>'><?php echo $erow['status']; ?></option>
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
                  </select>
				  </div>
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
							
								$username=$_POST['username'];
								//$password=$_POST['password'];
							    $branch=$_POST['branch'];
								$status=$_POST['status'];
							
								$query="UPDATE `portal_user` SET `USER_NAME`='".$username."',`status`='".$status."',`branch_id`='".$branch."'   WHERE `user_id` = '$user_id'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='create_user.php'; </script>";
						}
						?>
          </div>
		  
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
