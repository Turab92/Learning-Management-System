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
$pagename="Employee Allowance Detail";
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
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Allowance Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Branch Name</th>
				  <th>Employee Name</th>
                  <th>Allowance</th>
                  <th>Amount</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT ea.emp_allow_id, sb.branch_name, e.EMP_NAME, a.allowance_name, ea.amount, ea.status FROM `employee_allowances` as ea JOIN school_branches as sb on ea.branch_id=sb.branch_id JOIN employees as e on ea.emp_id=e.EMP_ID JOIN allowances as a on ea.allowance_id = a.allowance_id order by ea.emp_allow_id desc");
            foreach($fetch_emp as $emp)
            {
                $emp_allow_id=$emp['emp_allow_id'];
				$branch_name=$emp['branch_name'];
                $EMP_NAME=$emp['EMP_NAME'];
				$allowance_name=$emp['allowance_name'];
                $amount=$emp['amount'];
				$status=$emp['status'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $branch_name; ?></td>
					  <td><?php echo $EMP_NAME; ?></td>
					   <td><?php echo $allowance_name; ?></td> 
					   <td><?php echo $amount; ?></td>
					    <td>
						<?php
					
					if($status == 'Y')
					{
					?>
					<a href='status.php?emp_allow_id=<?php echo $emp_allow_id; ?>&status=N'  class='delete show'>Disable</a>
					<?php
					}
					else
					{
					?>
						<a href='status.php?emp_allow_id=<?php echo $emp_allow_id; ?> &status=Y'  class='delete show' >Enable</a>
					<?php
					}
					?>
					</td>
					
					<td><span class='action'><a href='edit_employee_allowance.php?edit=<?php echo $emp_allow_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?emp_allow_id=<?php echo $emp_allow_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
