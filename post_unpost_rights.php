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
        <!-- left column -->
       
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Post Unpost Rights</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
			
			  <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select User</label>
                   <div class="col-sm-6">
				   <select class="form-control"  name="user" id="user">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select user_id,USER_NAME from portal_user where status = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$user_id=$k['user_id'];
								 $USER_NAME=$k['USER_NAME'];
								echo "<option value='$user_id' >$USER_NAME</option>";
							}
					?>
                  </select>
				  </div>
                </div>
              
				
				
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Rights</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="rights" id="rights">
				  <option value=''>Select</option>
                    <option value="Post">Post</option>
					<option value="Unpost">Unpost</option>
					<option value="Edit Voucher">Edit Voucher</option>
                  </select>
				  </div>
                </div>
				
				
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
    
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
              <h3 class="box-title">Post Unpost Rights Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>UserName</th>
                  <th>Rights Desc</th>
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
            //$fetch_emp = mysqli_query($conn,"SELECT b.brand_id,b.brand_name,b.status,b.trans_date,u.name from tb_brand as b join user as u on b.user_id=u.user_id order by b.brand_id desc");
           // foreach($fetch_emp as $emp)
            //{
               // $brand_id=$emp['brand_id'];
               // $brand_name=$emp['brand_name'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $s_no; ?></td>
					  <td><?php echo $s_no; ?></td>
					   
					
					<td><span class='action'><a href='edit_brand_setup.php?edit=<?php echo $brand_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?brand_id=<?php echo $brand_id; ?>' class='delete show' title='Delete'>X</a></span></td>
           </tr>
                <?php $s_no++;// }?>
                

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
