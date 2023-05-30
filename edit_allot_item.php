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
					 $TR_NO = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `allot_items` AS ai JOIN school_branches b on ai.BRANCH_ID=b.branch_id JOIN item_setup2 AS its on ai.ITEM_ID=its.ITEM_ID where ai.TR_NO='$TR_NO'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Allot Items</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch Name</label>
                   <div class="col-md-6">
  
				<select name="branch" class="form-control" readonly  />
				<option value="<?php echo $erow['branch_id']; ?>"><?php echo $erow['branch_name']; ?></option>										
			
					</select>
					</div>
                </div>
			 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Item Name</label>
                   <div class="col-md-6">
  
				<select name="item" class="form-control" required />
					<option value="<?php echo $erow['ITEM_ID']; ?>"><?php echo $erow['ITEM_NAME']; ?></option>										
				<?php
									
					$select_item = mysqli_query($conn,"select * from item_setup2  ");	
					while($row = mysqli_fetch_array($select_item))
					{
						$item_id = $row['ITEM_ID'];
						$item_name = $row['ITEM_NAME'];
						?>
						<option value="<?php echo $item_id; ?> "><?php echo $item_name;?></option>
						<?php
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
							$item=$_POST['item'];
							
						   $k=mysqli_query($conn,"select * from allot_items where item_id = '$item_id' and branch_id='$branch' ");
							   $k_count=mysqli_num_rows($k);
							   if($k_count=0){
								   $query="UPDATE `allot_items` SET `ITEM_ID`='".$item."'   WHERE `TR_NO` = '$TR_NO'";
										$result = $conn->query($query);
										 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
										echo "<script>location.href='allot_items'; </script>";
								  

							   }
							   else{			
										 echo "<div class='alert alert-success'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>warning!</strong> Menu Already Alloted.
									</div>";
										   echo "<script>setTimeout(\"location.href = 'allot_items';\",2000);</script>";
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
  <!--javascript End-->
</body>
</html>
