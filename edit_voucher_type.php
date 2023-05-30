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
					 $VOUCHER_TYPE_ID = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `voucher_types` where VOUCHER_TYPE_ID='$VOUCHER_TYPE_ID'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Voucher Types</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Voucher Description</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="voucherdesc" name="voucherdesc" value="<?php echo $erow['DESCRIPTION']; ?>">
                  </div>
                </div>
				
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Voucher Nature</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="nature" name="nature" value="<?php echo $erow['VOUCHER_NATURE']; ?>">
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
							
								$voucherdesc=$_POST['voucherdesc'];
								$nature=$_POST['nature'];
								
							
								$query="UPDATE `voucher_types` SET `DESCRIPTION`='".$voucherdesc."',`VOUCHER_NATURE`='".$nature."'    WHERE `VOUCHER_TYPE_ID` = '$VOUCHER_TYPE_ID'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='voucher_types'; </script>";
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
