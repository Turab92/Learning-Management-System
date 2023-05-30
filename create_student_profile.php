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
$pagename="Create Student Profile";
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
              <h3 class="box-title">Create Student Profile</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Father Name</th>
                  <th>Branch</th>
                  <th>Class</th>
				  <th>Test Status</th>
				  <th>Image</th>
				  <th>Move To Waiting List</th>
               
                </tr>
                </thead>
               
			   <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"select atm.ADMISSION_FORM_ID,atm.APPLICANT_NAME, atm.FATHER_NAME, atm.TEST_RESULT, cs.CLASS_DESCRIPTION, atm.IMG, sb.branch_name from admission_test as atm JOIN class_setup as cs on atm.CLASS_ID=cs.CLASS_ID JOIN school_branches as sb on atm.BRANCH_ID= sb.branch_id where atm.is_profile_made is null and atm.waiting_list is null order by atm.ADMISSION_FORM_ID desc");
            foreach($fetch_emp as $emp)
            {
                $ADMISSION_FORM_ID=$emp['ADMISSION_FORM_ID'];
                $APPLICANT_NAME=$emp['APPLICANT_NAME'];
				 $FATHER_NAME=$emp['FATHER_NAME'];
                $TEST_RESULT=$emp['TEST_RESULT']; 
				$CLASS_DESCRIPTION=$emp['CLASS_DESCRIPTION'];
                $branch_name=$emp['branch_name'];
				$IMG=$emp['IMG'];
				
				
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
				    <td><span class='action'><a href='student.php?stid=<?php echo $ADMISSION_FORM_ID; ?>'><?php echo $APPLICANT_NAME; ?></a></span></td>
				    <td><?php echo $FATHER_NAME; ?></td>
				    <td><?php echo $branch_name; ?></td> 
				    <td><?php echo $CLASS_DESCRIPTION; ?></td>
					<td><?php echo $TEST_RESULT; ?></td>
					 <td><img src='student_images/<?php echo $IMG ?>' width='80px;' height='80px;' /></td>
					<td class="center"><a href='update_waiting_list.php?waiting=<?php echo $ADMISSION_FORM_ID; ?>' class="btn btn-info btn-lg"><span class='glyphicon glyphicon-flag'></span></a></td>
					
					
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
