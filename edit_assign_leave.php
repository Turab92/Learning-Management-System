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
					 $assign_leave_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `assign_leave` as al JOIN leave_type as lt on al.leave_id=lt.leave_type_id JOIN department dp on al.depart_id=dp.DEPARTMENT_ID JOIN designation de on al.design_id=de.DESIGNATION_ID where al.assign_leave_id='$assign_leave_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Assign Leaves</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Leave</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="leave" id="leave">
                    <option value='<?php echo $erow['leave_type_id']; ?>'><?php echo $erow['leave_name']; ?></option>
					<?php
							$r=mysqli_query($conn,"select leave_type_id,leave_name from leave_type ");
							while ($k=mysqli_fetch_array($r)){
								$leave_type_id=$k['leave_type_id'];
								 $leave_name=$k['leave_name'];
								echo "<option value='$leave_type_id' >$leave_name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
                 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Department</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="depart" id="depart">
                    <option value='<?php echo $erow['DEPARTMENT_ID']; ?>'><?php echo $erow['DESCRIPTION']; ?></option>
					<?php
							$r=mysqli_query($conn,"select DEPARTMENT_ID ,DESCRIPTION from department where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$DEPARTMENT_ID=$k['DEPARTMENT_ID'];
								 $DESCRIPTION=$k['DESCRIPTION'];
								echo "<option value='$DEPARTMENT_ID' >$DESCRIPTION</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Designation</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="design" id="design">
                    <option value='<?php echo $erow['DESIGNATION_ID']; ?>'><?php echo $erow['designation_name']; ?></option>
					<?php
							$r=mysqli_query($conn,"select DESIGNATION_ID,designation_name from designation where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$DESIGNATION_ID=$k['DESIGNATION_ID'];
								 $designation_name=$k['designation_name'];
								echo "<option value='$DESIGNATION_ID' >$designation_name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				
				</div>
				
				 <div class="col-sm-6">
               
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">No Of Leaves</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="leaveno" name="leaveno" value="<?php echo $erow['no_of_leave']; ?>">
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Max Leaves Per Month</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="maxleave" name="maxleave" value="<?php echo $erow['max_leave']; ?>">
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
							
							$leave=$_POST['leave'];
							$depart=$_POST['depart'];
							$design=$_POST['design'];
							$leaveno=$_POST['leaveno'];
							$maxleave=$_POST['maxleave'];
							
							
						   $k=mysqli_query($conn,"select * from assign_leave WHERE leave_id='$leave' AND depart_id='$depart' AND design_id='$design'");
							   $k_count=mysqli_num_rows($k);
							   if($k_count==1){
								   echo "<div class='alert alert-success'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>warning!</strong> Menu Already Alloted.
									</div>";
										   echo "<script>setTimeout(\"location.href = 'assign_leaves.php';\",2000);</script>";

							   }
							   else{
										$query="UPDATE `assign_leave` SET `leave_id`='".$leave."',`depart_id`='".$depart."',`design_id`='".$design."',`no_of_leave`='".$leaveno."',`max_leave`='".$maxleave."'   WHERE `assign_leave_id` = '$assign_leave_id'";
										$result = $conn->query($query);
										 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
										echo "<script>location.href='assign_leaves.php'; </script>";
									}
							
								
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
