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
					 $CHARGE_TYPE_ID = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `charges_types` as ct JOIN nature_payments as np on ct.NATURE_ID=np.NATURE_ID  WHERE ct.CHARGE_TYPE_ID='$CHARGE_TYPE_ID'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Charges Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="descrip" name="descrip" value="<?php echo $erow['CHARGES_DESCRIPTION']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Nature</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="nature" id="nature">
                    <option value='<?php echo $erow['NATURE_ID']; ?>'><?php echo $erow['DESCRIPTION']; ?></option>
					<?php
							$r=mysqli_query($conn,"select `NATURE_ID`,`DESCRIPTION` from nature_payments where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$NATURE_ID=$k['NATURE_ID'];
								 $DESCRIPTION=$k['DESCRIPTION'];
								echo "<option value='$NATURE_ID' >$DESCRIPTION</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Royalty Percent</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="percent" name="percent" value="<?php echo $erow['ROYALITY_PERCENT']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Royalty fix</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="fix" name="fix" value="<?php echo $erow['ROYALITY_FIX']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">On Admission</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="admission" id="admission">
				  <option value="<?php echo $erow['ON_ADMI']; ?>"><?php echo $erow['ON_ADMI']; ?></option>
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">On Siblings</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="sibling" id="sibling">
				  <option value="<?php echo $erow['CHK']; ?>"><?php echo $erow['CHK']; ?></option>
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Status</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="status" id="status">
				  <option value="<?php echo $erow['ACTIVE']; ?>"><?php echo $erow['ACTIVE']; ?></option>
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
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
							
								$descrip=$_POST['descrip'];
								$nature=$_POST['nature'];
								$percent=$_POST['percent'];
								$fix=$_POST['fix'];
								$admission=$_POST['admission'];
								$sibling=$_POST['sibling'];
								$status=$_POST['status'];
								
								
							
								$query="UPDATE `charges_types` SET `CHARGES_DESCRIPTION`='".$descrip."',`NATURE_ID`='".$nature."',`ROYALITY_PERCENT`='".$percent."',`ROYALITY_FIX`='".$fix."',`ON_ADMI`='".$admission."',`CHK`='".$sibling."',`ACTIVE`='".$status."'   WHERE `CHARGE_TYPE_ID` = '$CHARGE_TYPE_ID'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='charges.php'; </script>";
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
