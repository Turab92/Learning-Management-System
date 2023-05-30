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
$pagename="Left Student List";
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
              <h3 class="box-title">Student Profile</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
				   <th>G.R No</th>
                  <th>Name</th>
                  <th>Father Name</th>
                  <th>Left Date</th>
                  <th>Address</th>
				  <th>Image</th>
				
					
						
                </tr>
                </thead>
               
			   <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"SELECT * FROM student_current_status where left_date is not null order by student_id DESC");
            foreach($fetch_emp as $emp)
            {
                $STUDENT_ID=$emp['STUDENT_ID'];
                $APPLICANT_NAME=$emp['APPLICANT_NAME'];
				 $FATHER_NAME=$emp['FATHER_NAME'];
                $DATE_OF_LEFT=$emp['LEFT_DATE'];
				 $IMG=$emp['IMG'];
                $APPLICANT_ADDRESS=$emp['APPLICANT_ADDRESS'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $STUDENT_ID; ?></td>
					 <td><span class='action'><a href='left_student_profile.php?edit=<?php echo $STUDENT_ID; ?>'><?php echo $APPLICANT_NAME; ?></a></span></td>
					   <td><?php echo $FATHER_NAME; ?></td> 
					   <td><?php echo $DATE_OF_LEFT; ?></td>
					    <td><?php echo $APPLICANT_ADDRESS; ?></td>
					  <td><img src='student_images/<?php echo $IMG ?>' width='80px;' height='80px;' /></td>
					  
					   
					<!--<td><span class='action'><a href='edit_student_view.php?edit=<?php echo $STUDENT_ID; ?>'>Edit</a></span></td>-->
                    
					
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
