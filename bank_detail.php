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

$bank_id = base64_decode($_GET['bankid']);

$select_bank = mysqli_query($conn, "select * from banks_setup where bank_id = '$bank_id'");
		
		 while(($rows_sm = mysqli_fetch_array($select_bank)) != false) 
		{
  $bank_name = $rows_sm['BANK_NAME'];
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
                  <label for="inputEmail3" class="col-sm-3 control-label">Bank Name</label>

                  <div class="col-sm-6">
                    <input type="hidden" class="form-control" id="bankid" name="bankid" value="<?php echo $bank_id; ?>"readonly>
                    <input type="text" class="form-control" id="bankname" name="bankname" value="<?php echo $bank_name; ?>"readonly>
                  </div>
                </div>
			 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select Project</label>

                  <div class="col-sm-6">
                   <select name="project" class="form-control" required  >
						<option value="">Select Project</option>
						<?php
						$select_company = mysqli_query($conn,"select * from school_branches where active='Y' ");
						
						while($row = mysqli_fetch_array($select_company))
						{
							$branch_id = $row['branch_id'];
							$branch_name = $row['branch_name'];
							?>
							<option value="<?php echo $branch_id;  ?>"><?php echo $branch_name; ?></option>
							<?php
						}
						?>
					</select>
					
                  </div>
				 
                </div>
				<div class="form-group">
					<label for="inp-type-1" class="col-sm-offset-1 col-md-3">Active</label>
					<div class="col-md-6">
				 <input type="checkbox"  name="active" value="Y" required />		
					</div>
				</div>
							
				
				
				
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
         <?php
				bank_detail();
			?>
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
