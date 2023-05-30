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
$pagename="Student Register";
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
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Student Register</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" target="_blank" method="post" action="student_class" >
              <div class="box-body">
			
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select Branch</label>

                  <div class="col-sm-6">
                   <select name="class" class="form-control" required >
					 <option value="">Select Branch</option>
					 <?php
					 $r1 = mysqli_query($conn, "select* from school_branches where active = 'Y'"); 
						
							while (($rows1 = mysqli_fetch_array($r1)) != false) {
							 $branch_id = $rows1['branch_id'];
							 $brance_name=$rows1['branch_name'];
							 ?>
							 <option value="<?php echo $branch_id;?>"><?php echo $brance_name;?></option>
							 <?php
							}
								 
								 ?>
								 
								 </select>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">From Date </label>

                  <div class="col-sm-6">
					<input  name="issue" class="form-control" type="date" id="inp-type-1" placeholder="dd/mm/yy">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">To Date </label>

                  <div class="col-sm-6">
					<input  name="left" class="form-control" type="date" id="inp-type-1" placeholder="dd/mm/yy">
                  </div>
                </div>
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="sub" class="btn btn-info pull-right">Submit</button>
              </div>
			  <input type="hidden" name="user" value="<?php echo $loginuser ;?>" />
              <!-- /.box-footer -->
            </form>
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
