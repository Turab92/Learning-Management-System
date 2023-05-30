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
				if(isset($_GET['edit']) && ($_GET['edit2'])) {
					 $CHART_HEAD_CODE = $_GET['edit'];
					  $CHART_ACC_CODE = $_GET['edit2'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `chart_detail` as cd JOIN chart_head as ch on cd.CHART_HEAD_CODE=ch.HEAD_CODE JOIN account_types as act on cd.ACC_TYPE=act.ACCOUNT_TYPE JOIN account_types_detail as atd on cd.ACC_DETAIL_TYPE= atd.ACC_DETAIL_TYPE where cd.CHART_HEAD_CODE='$CHART_HEAD_CODE' AND cd.CHART_ACC_CODE='$CHART_ACC_CODE'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>

        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Chart of Account Code</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Account Type</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type" id="type" disabled>
                    <option value='<?php echo $erow['ACCOUNT_TYPE']; ?>'><?php echo $erow['ACC_DESCRIPTION']; ?></option>
					
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Account Nature</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type1" id="type1" disabled>
                    <option value='<?php echo $erow['ACC_DETAIL_TYPE']; ?>'><?php echo $erow['DESCRIPTION']; ?></option>
					
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Account Head Code</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type2" id="type2" disabled>
                    <option value='<?php echo $erow['HEAD_CODE']; ?>'><?php echo $erow['HEAD_DESC']; ?></option>
					
                  </select>
				  </div>
                </div>
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="descrip" name="descrip" value="<?php echo $erow['CHART_ACC_DESC']; ?>">
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
							
								$descrip=$_POST['descrip'];
								
							
								$query="UPDATE `chart_detail` SET `CHART_ACC_DESC`='".$descrip."'   WHERE  CHART_HEAD_CODE='$CHART_HEAD_CODE' and CHART_ACC_CODE='$CHART_ACC_CODE' ";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='coan3'; </script>";
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

