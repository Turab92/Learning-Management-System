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
$pagename="Assign Leaves";
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
              <h3 class="box-title">Assign Leaves</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Leave</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="leave" id="leave">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select leave_type_id,leave_name from leave_type ");
							while ($k=mysqli_fetch_array($r)){
								$leave_type_id=$k['leave_type_id'];
								 $leave_name=$k['leave_name'];
								echo "<option value='$leave_type_id' >$leave_name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
                 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Department</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="depart" id="depart">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select DEPARTMENT_ID,DESCRIPTION from department where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$DEPARTMENT_ID=$k['DEPARTMENT_ID'];
								 $DESCRIPTION=$k['DESCRIPTION'];
								echo "<option value='$DEPARTMENT_ID' >$DESCRIPTION</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Designation</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="design" id="design">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select DESIGNATION_ID,designation_name from designation where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$DESIGNATION_ID=$k['DESIGNATION_ID'];
								 $designation_name=$k['designation_name'];
								echo "<option value='$DESIGNATION_ID' >$designation_name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				
				</div>
				
				 <div class="col-sm-6">
               
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">No Of Leaves</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="leaveno" name="leaveno">
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Max Leaves Per Month</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="maxleave" name="maxleave">
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
				assign_leave_setup();
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
              <h3 class="box-title">Assinged Leave Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Leave Type</th>
                  <th>Department</th>
                  <th>Designation</th>
                  <th>No Of Leave</th>
				   <th>Max Leave Per Month</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT al.assign_leave_id, lt.leave_name, dp.DESCRIPTION,de.designation_name, al.no_of_leave, al.max_leave FROM `assign_leave` as al JOIN leave_type as lt on al.leave_id=lt.leave_type_id JOIN department dp on al.depart_id=dp.DEPARTMENT_ID JOIN designation de on al.design_id=de.DESIGNATION_ID order by al.assign_leave_id desc");
            foreach($fetch_emp as $emp)
            {
                 $assign_leave_id=$emp['assign_leave_id'];
                 $leave_name=$emp['leave_name'];
				 $DESCRIPTION=$emp['DESCRIPTION'];
                 $designation_name=$emp['designation_name'];
				 $no_of_leave=$emp['no_of_leave'];
				 $max_leave=$emp['max_leave'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $leave_name; ?></td>
					  <td><?php echo $DESCRIPTION; ?></td>
					   <td><?php echo $designation_name; ?></td> 
					   <td><?php echo $no_of_leave; ?></td>
					   <td><?php echo $max_leave; ?></td>
					   
					
					<td><span class='action'><a href='edit_assign_leave.php?edit=<?php echo $assign_leave_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?assign_leave_id=<?php echo $assign_leave_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
