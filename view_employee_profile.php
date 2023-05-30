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
$pagename="View Employee Profile";
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
              <h3 class="box-title">Employees Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
				  <th>Employee Name</th>
				   <th>Father Name</th>
                  <th>Contact No</th>
                  <th>Image</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT `EMP_ID`, `EMP_NAME`, `EMP_FATHER_NAME`,  `CONTACT_NO`, `EMP_IMG` FROM `employees` where 	STATUS = 'Y' order by EMP_ID desc");
            foreach($fetch_emp as $emp)
            {
                $EMP_ID=$emp['EMP_ID'];
				$EMP_FATHER_NAME=$emp['EMP_FATHER_NAME'];
                $EMP_NAME=$emp['EMP_NAME'];
				$CONTACT_NO=$emp['CONTACT_NO'];
                $EMP_IMG=$emp['EMP_IMG'];
				
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><span class='action'><a href='employee_detail.php?edit=<?php echo $EMP_ID; ?>'><?php echo $EMP_NAME; ?></a></span></td>
					  <td><?php echo $EMP_FATHER_NAME; ?></td>
					   <td><?php echo $CONTACT_NO; ?></td> 
					   <td><img src='emp_images/<?php echo $EMP_IMG ?>' width='80px;' height='80px;' /></td>

					<td><span class='action'><a href='edit_employee.php?edit=<?php echo $EMP_ID; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?EMP_ID=<?php echo $EMP_ID; ?>' class='delete show' title='Delete'>X</a></span></td>
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
