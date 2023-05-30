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
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Current Class</h3>
            </div>
            <!-- /.box-header -->
			<?php 
			$dec = base64_decode($_GET['edit']);
	$r1 = mysqli_query($conn, "   select  a.section_id,a.class_id,a.STUDENT_ID,a.active,b.STUDENT_ID,b.APPLICANT_NAME,b.left_date,b.branch_id,c.class_id,
			 c.CLASS_DESCRIPTION,d.section_id,d.SECTION_DESCRIPTION,e.branch_id,e.branch_name,a.ROLL_NO
              from student_current_class a,student_current_status b , class_setup c , class_setup_section d , school_branches e
								 where a.STUDENT_ID = b.STUDENT_ID and b.left_date IS NULL and a.active = 'Y' and a.STUDENT_ID = '$dec' and a.class_id = c.class_id and a.section_id = d.section_id and b.branch_id = 
								 e.branch_id "); 
	while (($rows1 = mysqli_fetch_array($r1)) != false) {

	 	$sid=$rows1['STUDENT_ID'];	
	$student_name = $rows1['APPLICANT_NAME'];
	$class_name=$rows1['CLASS_DESCRIPTION'];
	 $section_name=$rows1['SECTION_DESCRIPTION'];
	 $roll_no=$rows1['ROLL_NO'];
	 $branch = $rows1['branch_name'];
	 
	 
	}
	

	
					?>
            <!-- form start -->
            <form class="form-horizontal" method="post" action="">
              <div class="box-body">
			
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-3 control-label">Student Name </label>
					<div class="col-md-6">
						<input type="text" readonly value="<?php echo $student_name; ?>" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-3 control-label">Class Name </label>
					<div class="col-md-6">
						<input type="text" readonly value="<?php echo $class_name; ?>" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-3 control-label">Section Name </label>
					<div class="col-md-6">
						<input type="text" readonly value="<?php echo $section_name; ?>" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-3 control-label">Roll No</label>
					<div class="col-md-6">
						<input type="text"  value="<?php echo $roll_no; ?>" class="form-control" name="roll_no" />
					</div>
				</div>
				
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="sub" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
			<?php
				if(isset($_POST['sub'])){
					
					$roll_no = $_POST['roll_no'];
				
							
					$sql = "UPDATE student_current_class SET roll_no = '$roll_no' where student_id = '$dec' and active = 'Y'";
					   $compiled = mysqli_query($conn, $sql);
					
					if($compiled){
						
						echo "<script>alert('Record Updated')</script>";
						echo "<script>window.open('student_current_class_1','_self')</script>";	
					}
					else {
						
						echo "<script>alert('Error')</script>";
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
	 <!-- Main content -->

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
