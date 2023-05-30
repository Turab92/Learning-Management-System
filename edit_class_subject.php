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
					 $assign_sub_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `class_subject_assign` as cba JOIN class_setup as cs on cba.class_id=cs.CLASS_ID JOIN subjects as s on cba.subject_id=s.sub_id join subject_type as st on cba.subject_type_id=st.sub_type_id where cba.assign_sub_id='$assign_sub_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Class Subject</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Class</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="class" id="class">
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
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Subject</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="subject" id="subject">
                   <option value='<?php echo $erow['sub_id']; ?>'><?php echo $erow['sub_name']; ?></option>
					<?php
							$r=mysqli_query($conn,"select sub_id,sub_name from subjects ");
							while ($k=mysqli_fetch_array($r)){
								$sub_id=$k['sub_id'];
								 $sub_name=$k['sub_name'];
								echo "<option value='$sub_id' >$sub_name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
               
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Subject Type</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="subtype" id="subtype">
                    <option value='<?php echo $erow['sub_type_id']; ?>'><?php echo $erow['sub_type_name']; ?></option>
					<?php
							$r=mysqli_query($conn,"select sub_type_id,sub_type_name from subject_type");
							while ($k=mysqli_fetch_array($r)){
								$sub_type_id=$k['sub_type_id'];
								 $sub_type_name=$k['sub_type_name'];
								echo "<option value='$sub_type_id' >$sub_type_name</option>";
							}
					?>
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
							
								$class=$_POST['class'];
								
							    $subject=$_POST['subject'];
								$subtype=$_POST['subtype'];
							
							 $k=mysqli_query($conn,"select * from class_subject_assign WHERE class_id='$class' AND subject_id='$subject' AND subject_type_id='$subtype'");
							   $k_count=mysqli_num_rows($k);
							   if($k_count==1){
								   echo "<div class='alert alert-success'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>warning!</strong> Menu Already Alloted.
									</div>";
										   echo "<script>setTimeout(\"location.href = 'class_subject.php';\",2000);</script>";

							   }
							   else{
										$query="UPDATE `class_subject_assign` SET `class_id`='".$class."',`subject_id`='".$subject."',`subject_type_id`='".$subtype."'   WHERE `assign_sub_id` = '$assign_sub_id'";
										$result = $conn->query($query);
										 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
										echo "<script>location.href='class_subject.php'; </script>";
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
