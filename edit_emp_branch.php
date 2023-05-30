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
					 $emp_allot_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `employees_current_branch` as ebs JOIN school_branches as sb on ebs.BRANCH_ID=sb.branch_id JOIN employees as e on ebs.EMPLOYEE_ID = e.EMP_ID where ebs.ALLOT_ID='$emp_allot_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Branch Description</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			
			   <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Employee</label>
                   <div class="col-sm-6">
				   <select class="form-control"  name="employee" id="employee">
                    <option value='<?php echo $erow['EMP_ID']; ?>'><?php echo $erow['EMP_NAME']; ?></option>
					<?php
							$r=mysqli_query($conn,"select EMP_ID,EMP_NAME from employees where status = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$EMP_ID=$k['EMP_ID'];
								 $EMP_NAME=$k['EMP_NAME'];
								echo "<option value='$EMP_ID' >$EMP_NAME</option>";
							}
					?>
                  </select>
				  </div>
                </div>
              
				
				
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
				
				
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
			<?php
						if (isset($_POST['btnsub'])) {
							
								$employee=$_POST['employee'];
								$branch=$_POST['branch'];
							
							 $k=mysqli_query($conn,"select * from employees_current_branch WHERE BRANCH_ID='$branch' AND EMPLOYEE_ID='$employee'");
							   $k_count=mysqli_num_rows($k);
							   if($k_count==1){
								   echo "<div class='alert alert-success'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>warning!</strong> Menu Already Alloted.
									</div>";
										   echo "<script>setTimeout(\"location.href = 'employee_branch_setup.php';\",2000);</script>";

							   }
							   else{
										$query="UPDATE `employees_current_branch` SET `EMPLOYEE_ID`='".$employee."',`BRANCH_ID`='".$branch."'  WHERE `ALLOT_ID` = '$emp_allot_id'";
										$result = $conn->query($query);
										 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
										echo "<script>location.href='employee_branch_setup.php'; </script>";
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
   <script>
         function selectall(source) {
             checkboxes = document.getElementsByName('items[]');
             for(var i=0, n=checkboxes.length;i<n;i++) {
                 checkboxes[i].checked = source.checked;
             }
         }
     </script>
  <!--javascript End-->
</body>
</html>
