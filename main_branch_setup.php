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
$pagename="Add Branch";
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
              <h3 class="box-title">Branch Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Branch Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="branchname" name="branchname" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Branch Address</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="branchaddress" name="branchaddress" placeholder="Address">
                  </div>
                </div>
				
				
				</div>
				
				 <div class="col-sm-6">
               
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch Type</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="branchtype" id="branchtype">
				  <option>Select Type</option>
                    <option value='Main Branch'>Main Branch</option>
					<option value='Sub Branch'>Sub Branch</option>
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
				branch_setup();
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
              <h3 class="box-title">Branch Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Branch Name</th>
                  <th>Address</th>
                  <th>Type</th>
				   <th>Active</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT `branch_id`, `branch_name`, `branch_address`, `active`, `branch_type` FROM `school_branches` order by branch_id desc");
            foreach($fetch_emp as $emp)
            {
                $branch_id=$emp['branch_id'];
                $branch_name=$emp['branch_name'];
				$branch_address=$emp['branch_address'];
                $active=$emp['active'];
				$branch_type=$emp['branch_type'];
                
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $branch_name; ?></td>
					<td><?php echo $branch_address; ?></td>
					<td><?php echo $branch_type; ?></td> 
					<td><?php echo $active; ?></td>
					    
					
					<td><span class='action'><a href='edit_branch_setup.php?edit=<?php echo $branch_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?branch_id=<?php echo $branch_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
