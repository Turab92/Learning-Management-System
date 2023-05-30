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
$pagename="Account Detail Type";
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
        <!-- left column -->
       
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Chart of Account Nature</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Account Type</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type" id="type">
                    <option value=''>Select Account Type</option>
					<?php
							$r=mysqli_query($conn,"select * from account_types");
							while ($k=mysqli_fetch_array($r)){
								$ACCOUNT_TYPE=$k['ACCOUNT_TYPE'];
								 $ACC_DESCRIPTION=$k['ACC_DESCRIPTION'];
								echo "<option value='$ACCOUNT_TYPE' >$ACC_DESCRIPTION</option>";
							}
					?>
                  </select>
				  </div>
                </div>
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="descrip" name="descrip" placeholder="description">
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
				account_detail_type();
			?>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Account Type</th>
				  <th>Description</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"SELECT act.ACC_DESCRIPTION, atd.ACC_DETAIL_TYPE, atd.DESCRIPTION FROM `account_types_detail` as atd join account_types as act on atd.ACCOUNT_TYPE= act.ACCOUNT_TYPE order by atd.ACC_DETAIL_TYPE desc");
            foreach($fetch_emp as $emp)
            {
                $ACC_DETAIL_TYPE=$emp['ACC_DETAIL_TYPE'];
                $ACC_DESCRIPTION=$emp['ACC_DESCRIPTION'];
				 $DESCRIPTION=$emp['DESCRIPTION'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $ACC_DESCRIPTION; ?></td>
					<td><?php echo $DESCRIPTION; ?></td>
					 
					   
					
					<td><span class='action'><a href='edit_coan.php?edit=<?php echo $ACC_DETAIL_TYPE; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?ACC_DETAIL_TYPE=<?php echo $ACC_DETAIL_TYPE; ?>' class='delete show' title='Delete'>X</a></span></td>
           </tr>
                <?php $s_no++; }?>
                

            </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
