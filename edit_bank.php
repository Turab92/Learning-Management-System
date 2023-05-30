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
	   $dec = base64_decode($_GET['edit']);
	$r1 = mysqli_query($conn, "select * from BANKS_SETUP where BANK_ID = '$dec'"); 
	
	while (($rows = mysqli_fetch_array($r1)) != false) {
	 $id = $rows['BANK_ID'];		
	 $att_id=$rows['BANK_NAME'];
	 $att_id2=$rows['ACC_TYPE'];
	 $att_id3=$rows['ACC_DETAIL_TYPE'];
$att_id4=$rows['ACC_HEAD_CODE'];
$att_id5=$rows['ACC_CHARTACC_CODE']; 
$att_id6=$rows['BANK_ACCOUNT_NO'];
$active = $rows['ACTIVE'];
$chk = $rows['CHK'];	 
$def = $rows['DEF'];	
$portal_chk = $rows['PORTAL_CHK'];	
	
	}
	

	
					?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Bank Master</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Bank Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bankname" name="bankname"value="<?php echo $att_id;?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">ACC Type</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="acctype" name="acctype" value="<?php echo $att_id2;?>" >
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">ACC Detail Type</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="detailtype" name="detailtype" value="<?php echo $att_id3;?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">ACC Head Code</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="headcode" name="headcode" value="<?php echo $att_id4;?>" >
                  </div>
                </div>
			
				
				
				  <div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Chartacc Code</label>

					  <div class="col-sm-6">
						<input type="number" class="form-control" id="chartcode" name="chartcode" value="<?php echo $att_id5;?>" >
					  </div>
					</div>
					<div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Bank Account No</label>

					  <div class="col-sm-6">
						<input type="text" class="form-control" id="accoutno" name="accoutno" value="<?php echo $att_id6;?>" >
					  </div>
					</div>
					
					 
<?php
if($active == 'Y')
{
?>				
					<div class="form-group">
					<div class="col-sm-offset-2 col-md-1">
					<label >Active </label>
					<input type="checkbox"  name="active" value="Y" checked  />
					</div>
<?php	
}
else
{
	?>
					<div class="form-group">
					<div class="col-sm-offset-2 col-md-1">
					<label >Active </label>
					<input type="checkbox"  name="active" value="Y"  />
					</div>
					
<?php
}
if($chk == 'Y')
{
	?>					
					 <div class="col-sm-offset-3 col-md-1">
					<label >Chk </label>
					<input type="checkbox"  name="chk" value="Y" checked  />
					</div>
					</div>
<?php
}
else
{
	?>
					<div class="col-sm-offset-3 col-md-1">
					<label >Chk </label>
					<input type="checkbox"  name="chk" value="Y"   />
					</div>
					</div>
					
					
<?php
}
if($def == 'Y')
{
	?>				
					<div class="form-group">
					<div class="col-sm-offset-2 col-md-1">
					<label >Default </label>
					<input type="checkbox"  name="default" value="Y" checked  />
					</div>
<?php
}
else
{
	?>
					<div class="form-group">
					<div class="col-sm-offset-2 col-md-1">
					<label >Default </label>
					<input type="checkbox"  name="default" value="Y"  />
					</div>
					
<?php
}
if($portal_chk == 'Y')
{
	?>
					 <div class="col-sm-offset-3 col-md-1">
					<label >Portal</label>
					<input type="checkbox"  name="portal" value="Y" checked   />
					</div>
					</div>
<?php
}
else
{
	?>
					 <div class="col-sm-offset-3 col-md-1">
					<label >Portal</label>
					<input type="checkbox"  name="portal" value="Y"  />
					</div>
					</div>
<?php
}
?>				
				
              </div>
			   <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-body -->
              
            </form>
			<?php
						if (isset($_POST['btnsub'])) {
							
								$bankname=$_POST['bankname'];
								$acctype=$_POST['acctype'];
								$detailtype=$_POST['detailtype'];
								$headcode=$_POST['headcode'];
								$chartcode=$_POST['chartcode'];
								$accoutno=$_POST['accoutno'];
								$active=$_POST['active'];
								$chk=$_POST['chk'];
								$default=$_POST['default'];
								$portal=$_POST['portal'];
							
								$query="UPDATE `BANKS_SETUP` SET `BANK_NAME`='".$bankname."',`ACC_TYPE`='".$acctype."',`ACC_DETAIL_TYPE`='".$detailtype."',`ACC_HEAD_CODE`='".$headcode."',`ACC_CHARTACC_CODE`='".$chartcode."',`BANK_ACCOUNT_NO`='".$accoutno."',`ACTIVE`='".$active."',`CHK`='".$chk."',`DEF`='".$default."',`PORTAL_CHK`='".$portal."'   WHERE `BANK_ID` = '$dec'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='bank'; </script>";
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
