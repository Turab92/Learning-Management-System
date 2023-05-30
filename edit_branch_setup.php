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
					 $branch_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * from school_branches  where branch_id='$branch_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Branch Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Branch Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="branchname" name="branchname" value="<?php echo $erow['branch_name']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Branch Address</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="branchaddress" name="branchaddress" value="<?php echo $erow['branch_address']; ?>">
                  </div>
                </div>
				
				
				</div>
				
				 <div class="col-sm-6">
               
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch Type</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="branchtype" id="branchtype">
				  <option value="<?php echo $erow['branch_type']; ?>"><?php echo $erow['branch_type']; ?></option>
                    <option value='Main Branch'>Main Branch</option>
					<option value='Sub Branch'>Sub Branch</option>
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
							
								$branchname=$_POST['branchname'];
								$branchaddress=$_POST['branchaddress'];
							    $branchtype=$_POST['branchtype'];
								
							
								$query="UPDATE `school_branches` SET `branch_name`='".$branchname."',`branch_address`='".$branchaddress."',`branch_type`='".$branchtype."'   WHERE `branch_id` = '$branch_id'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='main_branch_setup.php'; </script>";
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
