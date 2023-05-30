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
              <h3 class="box-title">Student Attendance</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Student Name</th>
                  <th>Class Name</th>
                  <th>Attendance Date</th>
                  <th>Attendance Time In</th>
				  <th>Attendance Time Out</th>
				  <th>Present</th>
				  
               
                </tr>
                </thead>
               
			   <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"select a.att_date,a.TIME_IN,a.attendent_id,a.attendent_type,a.present,a.class_id,a.section_id,a.branch_id,a.TIME_OUT,b.student_id,b.applicant_name,b.branch_id,
c.class_id,c.class_description,d.section_id,d.section_description,e.branch_id,e.branch_name
 from daily_attendance a,student_current_status b,class_setup c,class_setup_section d,school_branches e
where a.attendent_id = b.student_id and a.class_id = c.class_id and a.section_id = d.section_id and b.branch_id = e.branch_id
 and a.attendent_type = 'S' order by a.att_date desc");
            foreach($fetch_emp as $rows)
            { 
				$time_in = $rows['TIME_IN'];
				$present = $rows['present'];
				$att_date = $rows['att_date'];
				$time_out = $rows['TIME_OUT'];
				$student = $rows['applicant_name'];
				$class = $rows['class_description'];
				$section = $rows['section_description'];
				
				$branch_name = $rows['branch_name'];
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $student; ?></td>
					  <td><?php echo $class; ?></td>
					   <td><?php echo $att_date; ?></td> 
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
	
	
	
	
	<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Student Fees Balance</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Student Name</th>
                  <th>For Month</th>
                  <th>Fee Voucher No</th>
                  <th>Charge Descriptions</th>
				  <th>Amount</th>
				 
               
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
					   <td><?php echo $s_no; ?></td> 
					   <td><?php echo $s_no; ?></td>
					    <td><?php echo $s_no; ?></td>
						 
					   
					  
					   
					
					
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
