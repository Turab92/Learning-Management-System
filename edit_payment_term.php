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
					 $TERM_ID = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `payment_terms` where TERM_ID='$TERM_ID'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Payment Description</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Term Description</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="termdescrip" name="termdescrip" value="<?php echo $erow['DESCRIPTION']; ?>">
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">No Of Days</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="ondays" name="ondays" value="<?php echo $erow['NO_DAYS']; ?>">
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Payment Per</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="payment" name="payment" value="<?php echo $erow['PAYMENT_PER']; ?>">
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
							
								$termdescrip=$_POST['termdescrip'];
								$ondays=$_POST['ondays'];
								$payment=$_POST['payment'];
								
							
								$query="UPDATE `payment_terms` SET `DESCRIPTION`='".$termdescrip."',`NO_DAYS`='".$ondays."' ,`PAYMENT_PER`='".$payment."'   WHERE `TERM_ID` = '$TERM_ID'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='payment_terms'; </script>";
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
