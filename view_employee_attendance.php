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
$pagename="View Attendance";
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
   
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Employee Attendance</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Employee</th>
                  <th>Branch</th>
                  <th>Designation</th>
				   <th>Date</th>
                  <th>Time In</th>
				  <th>Time Out</th>
				  <th>Present</th>
				  
               
                </tr>
                </thead>
               
			   <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"select a.emp_id,a.EMP_NAME,b.ATT_DATE,b.TIME_IN, b.TIME_OUT,b.ATTENDENT_ID,a.designation_id,b.attendent_type,b.present,b.branch_id,c.branch_id,c.BRANCH_NAME,d.designation_id,d.designation_name from employees a, daily_attendance b ,designation d,
school_branches c where a.emp_id = b.ATTENDENT_ID and b.attendent_type = 'E' and b.branch_id = c.branch_id and a.designation_id = d.designation_id order by ATT_DATE DESC,TIME_IN DESC,TIME_OUT DESC");
            foreach($fetch_emp as $rows)
            { 
				$att_id=$rows['ATTENDENT_ID'];
				 $employee_name=$rows['EMP_NAME'];
				 $branch_name=$rows['BRANCH_NAME'];
				 $attdate=$rows['ATT_DATE'];
				 $time_in = $rows['TIME_IN'];
				 $time_out = $rows['TIME_OUT'];
				 $present=$rows['present'];
				 $desgination = $rows['designation_name'];
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $employee_name; ?></td>
					  <td><?php echo $branch_name; ?></td>
					   <td><?php echo $desgination; ?></td> 
					   <td><?php echo $attdate; ?></td>
					    <td><?php echo $time_in; ?></td>
					   <td><?php echo $time_out; ?></td> 
					   <td><?php echo $present; ?></td>
					   
					
					
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
