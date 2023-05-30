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
					 $SUPPLIER_ID = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `supplier_setup` as ss JOIN supplier_type as st on ss.TYPE= st.SUPPLIER_TYPE_ID  where ss.SUPPLIER_ID='$SUPPLIER_ID'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Supplier Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Supplier Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="supplier" name="supplier" value="<?php echo $erow['NAME']; ?>" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-6">
                   <textarea class="form-control" required name="address" ><?php echo $erow['ADDRESS']; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Email Address</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $erow['EMAIL']; ?>" required>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Phone Number</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="number" name="number" value="<?php echo $erow['PHONE']; ?>"  required>
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Supplier Type</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type" id="type" required>
                    <option value='<?php echo $erow['SUPPLIER_TYPE_ID']; ?>'><?php echo $erow['SUPPLIER_TYPE_NAME']; ?></option>
					<?php
							$r=mysqli_query($conn,"select * from supplier_type");
							while ($k=mysqli_fetch_array($r)){
								$SUPPLIER_TYPE_ID=$k['SUPPLIER_TYPE_ID'];
								 $SUPPLIER_TYPE_NAME=$k['SUPPLIER_TYPE_NAME'];
								echo "<option value='$SUPPLIER_TYPE_ID' >$SUPPLIER_TYPE_NAME</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Landline  Number</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="landline" name="landline" value="<?php echo $erow['LANDLINE']; ?>" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Shipping  Address</label>

                  <div class="col-sm-6">
                   <textarea class="form-control" required name="shipping" ><?php echo $erow['SHIPPING_ADD']; ?></textarea>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">CNIC Number</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="cnic" name="cnic" value="<?php echo $erow['CNIC']; ?>" required>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">NTN Number</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="ntn" name="ntn" value="<?php echo $erow['NTN']; ?>" required>
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
							
														
								$supplier=$_POST['supplier'];
								$address=$_POST['address'];
								$email=$_POST['email'];
								$number=$_POST['number'];
								$type=$_POST['type'];
								$landline=$_POST['landline'];
								$shipping=$_POST['shipping'];
								$cnic=$_POST['cnic'];
								$ntn=$_POST['ntn'];
							
								$query="UPDATE `supplier_setup` SET `NAME`='".$supplier."',`ADDRESS`='".$address."',`EMAIL`='".$email."',`PHONE`='".$number."',`TYPE`='".$type."',`LANDLINE`='".$landline."',`SHIPPING_ADD`='".$shipping."',`CNIC`='".$cnic."',`NTN`='".$ntn."'  WHERE `SUPPLIER_ID` = '$SUPPLIER_ID'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='supplier_setup'; </script>";
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
