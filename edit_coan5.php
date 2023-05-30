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
				if(isset($_GET['edit']) ) {
					
					 $TR_NO = $_GET['edit'];
					 
					 $fetch_emp = mysqli_query($conn,"select b.ACC_TYPE,b.ACC_DETAIL_TYPE,b.chart_head_code,b.CHART_ACC_CODE, b.PROJECT_ID,b.tr_no,h.ACC_DESCRIPTION as accoundesc,c.HEAD_DESC,t.DESCRIPTION,p.CHART_ACC_DESC,sb.branch_name 
  from chart_detail_project b, account_types h, chart_head c, account_types_detail t,chart_detail p,school_branches sb
  where b.tr_no='$TR_NO'
  and 
        b.acc_type=h.ACCOUNT_TYPE     
        and b.chart_head_code=c.HEAD_CODE
        and b.acc_detail_type=t.ACC_DETAIL_TYPE
        and p.chart_head_code=b.chart_head_code
        and p.chart_acc_code=b.chart_acc_code
		and b.PROJECT_ID=sb.branch_id");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>

        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Chart of Account Company</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Account Type</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type" id="type" readonly>
                    <option value='<?php echo $erow['ACC_TYPE']; ?>'><?php echo $erow['accoundesc']; ?></option>
					
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Account Nature</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type1" id="type1" readonly>
                    <option value='<?php echo $erow['ACC_DETAIL_TYPE']; ?>'><?php echo $erow['DESCRIPTION']; ?></option>
					
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Account Head Code</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type2" id="type2" readonly>
                    <option value='<?php echo $erow['chart_head_code']; ?>'><?php echo $erow['HEAD_DESC']; ?></option>
					
                  </select>
				  </div>
                </div>
			  <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Account Code</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type3" id="type3" readonly>
                    <option value='<?php echo $erow['CHART_ACC_CODE']; ?>'><?php echo $erow['CHART_ACC_DESC']; ?></option>
					
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Account Type</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch" required>
                    <option value='<?php echo $erow['PROJECT_ID']; ?>'><?php echo $erow['branch_name']; ?></option>
					<?php
							$r=mysqli_query($conn,"select * from school_branches");
							while ($k=mysqli_fetch_array($r)){
								$branch_id=$k['branch_id'];
								 $branch_name=$k['branch_name'];
								echo "<option value='$branch_id' >$branch_name</option>";
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
							
								$type=$_POST['type'];
								$type1=$_POST['type1'];
								$type2=$_POST['type2'];
								$type3=$_POST['type3'];
								$branch=$_POST['branch'];
								
								
								$r1 = mysqli_query($conn, "select * from chart_detail_project where acc_type = '$type' and acc_detail_type = '$type1' and chart_head_code = '$type2' and chart_acc_code = '$type3' and PROJECT_ID = '$branch'");  
	
		
							$run=mysqli_num_rows($r1);
							
							if($run==0){
							
								$query="UPDATE `chart_detail_project` SET `PROJECT_ID`='".$branch."'   WHERE  TR_NO='$TR_NO' ";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='coan5'; </script>";
							}
							else
							{
								echo "<script>alert('Record Already Exist')</script>";
								echo "<script>location.href='coan5'; </script>";
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

