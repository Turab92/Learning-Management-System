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
$pagename="Bank Assign to Branch";
auth_user($pagename,$userid);
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
					 $bank_assign_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `bank_assign_branch` as bsb JOIN school_branches as sb on bsb.branch_id=sb.branch_id JOIN banks_setup as bs on bsb.bank_id=bs.BANK_ID where bsb.bank_assign_id='$bank_assign_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <!-- right column -->
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Bank Assign Branch Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			  <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch</label>
                   <div class="col-sm-6">
				   <select class="form-control" name="branch" id="branch" >
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
                  <label  for="inputPassword3" class="col-sm-3 control-label">Bank</label>
                   <div class="col-sm-6">
				   <select class="form-control" name="bank" id="bank" >
                    <option value='<?php echo $erow['BANK_ID']; ?>'><?php echo $erow['BANK_NAME']; ?></option>
					<?php
							$r=mysqli_query($conn,"SELECT `BANK_ID`, `BANK_NAME` FROM `banks_setup` where ACTIVE='Y'");
							while ($k=mysqli_fetch_array($r)){
								$BANK_ID=$k['BANK_ID'];
								 $BANK_NAME=$k['BANK_NAME'];
								echo "<option value='$BANK_ID' >$BANK_NAME</option>";
							}
					?>
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
							
							$branch=$_POST['branch'];
							$bank=$_POST['bank'];
							
						   $k=mysqli_query($conn,"select * from bank_assign_branch WHERE bank_id='$bank' AND branch_id='$branch'");
							   $k_count=mysqli_num_rows($k);
							   if($k_count==1){
								   echo "<div class='alert alert-success'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>warning!</strong> Bank Already Assigned.
									</div>";
										   echo "<script>setTimeout(\"location.href = 'bank_assign_branch.php';\",2000);</script>";

							   }
							   else{			
										$query="UPDATE `bank_assign_branch` SET `bank_id`='".$bank."',`branch_id`='".$branch."'   WHERE `bank_assign_id` = '$bank_assign_id'";
										$result = $conn->query($query);
										 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
										echo "<script>location.href='bank_assign_branch.php'; </script>";
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
