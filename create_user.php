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
$pagename="Create User";
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
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">User Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Password</label>

                  <div class="col-sm-6">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Created By</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="createdby" name="createdby" value="<?php echo $loginuser; ?>" readonly>
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch">
                    <option value=''>Select</option>
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
                  <label  for="inputPassword3" class="col-sm-3 control-label">Status</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="status" id="status">
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
                  </select>
				  </div>
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
				user_setup();
			?>
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
              <h3 class="box-title">User Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>UserName</th>
                  <th>Branch Name</th>
                  <th>Created By</th>
                  <th>Created On</th>
				   <th>Status</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT pu.user_id,pu.CREATED_BY,pu.status,pu.CREATED_ON,pu.USER_NAME,sb.branch_name from portal_user as pu join school_branches as sb on pu.branch_id=sb.branch_id order by pu.user_id desc");
            foreach($fetch_emp as $emp)
            {
                $user_id=$emp['user_id'];
                $USER_NAME=$emp['USER_NAME'];
				  $branch_name=$emp['branch_name'];
                $CREATED_BY=$emp['CREATED_BY'];
				 $CREATED_ON=$emp['CREATED_ON'];
                $status=$emp['status'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $USER_NAME; ?></td>
					  <td><?php echo $branch_name; ?></td>
					   <td><?php echo $CREATED_BY; ?></td> 
					   <td><?php echo $CREATED_ON; ?></td>
					    <td>
						<?php
					
					if($status == 'Y')
					{
					?>
					<a href='status.php?user_id=<?php echo $user_id; ?>&status=N'  class='delete show'>Disable</a>
					<?php
					}
					else
					{
					?>
						<a href='status.php?user_id=<?php echo $user_id; ?> &status=Y'  class='delete show' >Enable</a>
					<?php
					}
					?>
					</td>
					
					<td><span class='action'><a href='edit_user.php?edit=<?php echo $user_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?user_id=<?php echo $user_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
