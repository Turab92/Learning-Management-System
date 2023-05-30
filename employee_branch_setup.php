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
$pagename="Assign Branch To Employee";
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
              <h3 class="box-title">Employee Branch Description</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			
			   <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Employee</label>
                   <div class="col-sm-6">
				   <select class="form-control"  name="employee" id="employee">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select EMP_ID,EMP_NAME from employees where status = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$EMP_ID=$k['EMP_ID'];
								 $EMP_NAME=$k['EMP_NAME'];
								echo "<option value='$EMP_ID' >$EMP_NAME</option>";
							}
					?>
                  </select>
				  </div>
                </div>
              
				
				
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				    <button type="button" class="btn btn-default btn-sm " data-toggle="dropdown"> Select Branch<span class="caret"></span></button>
				  <ul class="dropdown-menu">
					  <div style="height:200px; overflow:auto;"
					  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" onClick="selectall(this)" />&nbsp;&nbsp;&nbsp;Select All</li>
					  <?php

					 $r=mysqli_query($conn,'select branch_id,branch_name from school_branches where active = "Y"');
					  foreach($r as $cat)
					  {
						  ?>

						  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="items[]" value="<?php echo $cat['branch_id'];  ?>"/>&nbsp;&nbsp;&nbsp;<?php echo $cat['branch_name'];  ?></li>
						  <?php
					  }
					  ?>
                   </div>
                   </ul>
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
				emp_branch_setup();
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
              <h3 class="box-title">Employee Branches Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>S.No</th>
                  <th>Employee</th>
                  <th>Branch</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT ebs.ALLOT_ID, e.EMP_NAME, sb.branch_name FROM `employees_current_branch` as ebs JOIN school_branches as sb on ebs.BRANCH_ID=sb.branch_id JOIN employees as e on ebs.EMPLOYEE_ID = e.EMP_ID order by
			ebs.ALLOT_ID desc");
            foreach($fetch_emp as $emp)
            {
                $ALLOT_ID=$emp['ALLOT_ID'];
				$EMP_NAME=$emp['EMP_NAME'];
                $branch_name=$emp['branch_name'];
				
                
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $EMP_NAME; ?></td>
					 <td><?php echo $branch_name; ?></td>
					  
					   
					
					<td><span class='action'><a href='edit_emp_branch.php?edit=<?php echo $ALLOT_ID; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?emp_allot_id=<?php echo $ALLOT_ID; ?>' class='delete show' title='Delete'>X</a></span></td>
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
