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
        <!-- left column -->
       <?php
				if(isset($_GET['edit'])) {
					 $report_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `user_reports` as ur join main_menu as mm on ur.parent_id=mm.m_id where ur.report_id='$report_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create Sub Menu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
			   <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Main Menu</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="mainmenu" id="mainmenu">
                    <option value='<?php echo $erow['m_id']; ?>'><?php echo $erow['menu_title']; ?></option>
					<?php
							$r=mysqli_query($conn,"select m_id,menu_title from main_menu where 	status = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$m_id=$k['m_id'];
								 $menu_title=$k['menu_title'];
								echo "<option value='$m_id' >$menu_title</option>";
							}
					?>
                  </select>
				  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Sub Menu Title</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="submenu" name="submenu" value="<?php echo $erow['report_title']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Sub Menu Link</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="link" name="link" value="<?php echo $erow['report_name']; ?>">
                  </div>
                </div>
				
				
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Status</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="status" id="status">
				  <option value="<?php echo $erow['status']; ?>"><?php echo $erow['status']; ?></option>
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
                  </select>
				  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Sequence</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="sequence" name="sequence" value="<?php echo $erow['sequence_id']; ?>">
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
							
								$mainmenu=$_POST['mainmenu'];
								$submenu=$_POST['submenu'];
							    $link=$_POST['link'];
								$status=$_POST['status'];
								$sequence=$_POST['sequence'];
							
								$query="UPDATE `user_reports` SET `report_title`='".$submenu."',`status`='".$status."',`parent_id`='".$mainmenu."',`report_name`='".$link."',`sequence_id`='".$sequence."'   WHERE `report_id` = '$report_id'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='create_reports.php'; </script>";
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
