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
					 $allot_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * from allot_report_user as sm join user_reports as ur on sm.report_id=ur.report_id join main_menu as mm on ur.parent_id=mm.m_id join portal_user as e  on sm.user_id=e.user_id where sm.allot_id='$allot_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
					 $main_menu_id=$erow['m_id'];
					 $main_title=$erow['menu_title'];
				}
				?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Sub Menu Allot</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			
			   <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select User</label>
                   <div class="col-sm-6">
				 <select class="form-control"  name="user" id="user" required>
                    <option value='<?php echo $erow['user_id']; ?>'><?php echo $erow['USER_NAME']; ?></option>
					<?php
							$r=mysqli_query($conn,"select user_id,USER_NAME from portal_user where status = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$user_id=$k['user_id'];
								 $USER_NAME=$k['USER_NAME'];
								echo "<option value='$user_id' >$USER_NAME</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				
				
				
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Main Menu</label>
                   <div class="col-sm-6">
				  <select name="mainmenu" class="form-control">

						<option value="<?php echo $main_menu_id  ?>" selected><?php echo $main_title ?></option>
						

				</select>
				  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Main Menu</label>
                   <div class="col-sm-6">
				 <select name="submenu" class="form-control">

							<option value="<?php echo $erow['report_id']; ?>" selected><?php echo $erow['report_title']; ?></option>
							<?php $main_query="select report_id,report_title from user_reports WHERE parent_id='$main_menu_id' AND status = 'Y'";
							$main_run = mysqli_query($conn,$main_query);
							foreach ($main_run as $main) {
								$report_id= $main['report_id'];
								$report_title= $main['report_title'];
								?>
								<option value="<?php echo $report_id ?>"><?php echo $report_title ?></option>
							<?php } ?>

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
							
							$user=$_POST['user'];
							$submenu=$_POST['submenu'];
							
						   $k=mysqli_query($conn,"select * from allot_report_user WHERE report_id='$submenu' AND user_id='$user'");
							   $k_count=mysqli_num_rows($k);
							   if($k_count==1){
								   echo "<div class='alert alert-success'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>warning!</strong> Menu Already Alloted.
									</div>";
										   echo "<script>setTimeout(\"location.href = 'report_alloting';\",2000);</script>";

							   }
							   else{
										$query="UPDATE `allot_report_user` SET `user_id`='".$user."',`report_id`='".$submenu."'   WHERE `allot_id` = '$allot_id'";
										$result = $conn->query($query);
										 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
										echo "<script>location.href='report_alloting'; </script>";
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
  </script>
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
