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
					 $ALLOT_ID = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `class_branch_setup` as csc join class_setup as cs on csc.CLASS_ID=cs.CLASS_ID join school_branches as sb on csc.BRANCH_ID= SB.branch_id where csc.ALLOT_ID='$ALLOT_ID'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Class Branch Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			  <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch</label>
                   <div class="col-sm-6">
				   <select class="form-control" name="branch" id="branch">
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
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Class</label>
                   <div class="col-sm-6">
				   <select class="form-control"  name="class" id="class">
                    <option value='<?php echo $erow['CLASS_ID']; ?>'><?php echo $erow['CLASS_DESCRIPTION']; ?></option>
					<?php
							$r=mysqli_query($conn,"select CLASS_ID,CLASS_DESCRIPTION from class_setup where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$CLASS_ID=$k['CLASS_ID'];
								 $CLASS_DESCRIPTION=$k['CLASS_DESCRIPTION'];
								echo "<option value='$CLASS_ID' >$CLASS_DESCRIPTION</option>";
							}
					?>
                  </select>
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
							
							$branch=$_POST['branch'];
							$class=$_POST['class'];
							
						   $k=mysqli_query($conn,"select * from class_branch_setup WHERE CLASS_ID='$class' AND BRANCH_ID='$branch'");
							   $k_count=mysqli_num_rows($k);
							   if($k_count==1){
								   echo "<div class='alert alert-success'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>warning!</strong> Menu Already Alloted.
									</div>";
										   echo "<script>setTimeout(\"location.href = 'class_branch_setup.php';\",2000);</script>";

							   }
							   else{			
										$query="UPDATE `class_branch_setup` SET `CLASS_ID`='".$class."',`BRANCH_ID`='".$branch."'   WHERE `ALLOT_ID` = '$ALLOT_ID'";
										$result = $conn->query($query);
										 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
										echo "<script>location.href='class_branch_setup.php'; </script>";
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
   
  <!--javascript End-->
</body>
</html>
