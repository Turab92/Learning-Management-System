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

		<!--SELECT e.EMP_ID, e.EMP_NAME, e.EMP_FATHER_NAME, e.EMP_CNIC, e.CONTACT_NO, e.DATE_OF_JOINING, gs.GENDER_DESCRIPTION, rs.REG_NAME, e.PAY_RATE, e.REMARKS, e.REFRENCE,  e.EMP_ADDRESS, e.EMP_EXPERIENCE,q.qualification_name, e.EMP_IMG, de.DESCRIPTION, dp.DESCRIPTION, ets.EMPLOYEE_TYPE, e.ACCOUNT_NO, bs.BANK_NAME, eg.grade_name,   e.RF_ID FROM `employees` as e JOIN gender_setup as gs on e.GENDER= gs.G_ID JOIN religion_setup as rs on e.RELIGION=rs.REG_ID JOIN qualification as q on e.EMP_QUALIFICATION=q.qualification_id JOIN designation as de on e.DESIGNATION_ID=de.DESIGNATION_ID JOIN department as dp on e.DEPARTMENT_ID=dp.DEPARTMENT_ID JOIN employee_type_setup as ets on e.EMP_TYPE=ets.TYPE_ID JOIN banks_setup as bs on e.DEPOSIT_BANK_ID = bs.BANK_ID JOIN employee_grade as eg on e.GRADE_ID=eg.grade_id where e.EMP_ID='$EMP_ID'-->
    <!-- Main content -->
    <section class="content">
      <div class="row">
       <?php
				if(isset($_GET['edit'])) {
					 $EMP_ID = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `employees` as e JOIN gender_setup as gs on e.GENDER= gs.G_ID JOIN religion_setup as rs on e.RELIGION=rs.REG_ID JOIN qualification as q on e.EMP_QUALIFICATION=q.qualification_id JOIN designation as de on e.DESIGNATION_ID=de.DESIGNATION_ID JOIN department as dp on e.DEPARTMENT_ID=dp.DEPARTMENT_ID JOIN employee_type_setup as ets on e.EMP_TYPE=ets.TYPE_ID JOIN banks_setup as bs on e.DEPOSIT_BANK_ID = bs.BANK_ID JOIN employee_grade as eg on e.GRADE_ID=eg.grade_id where e.EMP_ID='$EMP_ID'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Employee Info</h3>
            </div>
            <!-- /.box-header -->
			
			
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action=""  enctype="multipart/form-data">
			<div class="col-md-12">
			
              <div class="box-body">
			  <div class="col-sm-6">
               
            
				 <div class="form-group">
                  <label  class="col-sm-4">Name:</label>

                  <div class="col-sm-8">
                    <?php echo $erow['EMP_NAME']; ?>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-4">Father Name:</label>

                  <div class="col-sm-8">
                   <?php echo $erow['EMP_FATHER_NAME']; ?>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-4">Address:</label>

                  <div class="col-sm-8">
                  <?php echo $erow['EMP_ADDRESS']; ?>
                  </div>
                </div>
               <div class="form-group">
                  <label class="col-sm-4">CNIC #:</label>

                  <div class="col-sm-8">
                   <?php echo $erow['EMP_CNIC']; ?>
                  </div>
                </div>
				 <div class="form-group">
					<label   class="col-sm-4">Department:</label>
					<div class="col-sm-8">
					
                   <?php echo $erow['DESCRIPTION']; ?>
					
					
					</div>
					</div>
					 <div class="form-group">
					<label  class="col-sm-4 ">Designation:</label>
					<div class="col-sm-8">
				
                   <?php echo $erow['designation_name']; ?>
					
					</div>
					</div>
				<div class="form-group">
                  <label  class="col-sm-4">Contact:</label>
					
                  <div class="col-sm-8">
                    <?php echo $erow['CONTACT_NO']; ?>
                  </div>
                </div>
				 
				<div class="form-group">
                  <label  class="col-sm-4">Account No:</label>
					
                  <div class="col-sm-8">
                   <?php echo $erow['ACCOUNT_NO']; ?>
                  </div>
                </div>
				<div class="form-group">
                  <label  class="col-sm-4">Remarks:</label>

                  <div class="col-sm-8">
                  <?php echo $erow['REMARKS']; ?>
                  </div>
                </div>
				<div class="form-group">
					<label   class="col-sm-4">Date of Joining:</label>
					 <div class="col-sm-8">
                   <?php echo $erow['DATE_OF_JOINING']; ?>
                  </div>
					</div>
				  
				
					<div class="form-group">
					<label  class="col-sm-4">Gender:</label>
					<div class="col-sm-8">
					 <?php echo $erow['GENDER_DESCRIPTION']; ?>
                    
					
					</div>
					</div>
				 
			  
				 
					<div class="form-group">
					<label   class="col-sm-4">Religion:</label>
					<div class="col-sm-8">
					<?php echo $erow['REG_NAME']; ?>
                   
					</div>
					</div>
				 
				  
					<div class="form-group">
					<label  class="col-sm-4">Employee Type:</label>
					<div class="col-sm-8">
					<?php echo $erow['EMPLOYEE_TYPE']; ?>
                    
					</div>
					
				  </div>
				   
					<div class="form-group">
					<label  class="col-md-4">Qualification:</label>
					<div class="col-sm-8">
					<?php echo $erow['qualification_name']; ?>
                    
					</div>
					</div>
				 
				
				<div class="form-group">
                  <label  class="col-sm-4 ">Experience(Month):</label>
					
                  <div class="col-sm-8">
                   <?php echo $erow['EMP_EXPERIENCE']; ?>
                  </div>
                </div>
				 
					<div class="form-group">
                  <label  class="col-sm-4">Pay Rate:</label>
					
                  <div class="col-sm-8">
                    <?php echo $erow['PAY_RATE']; ?>
                  </div>
                </div>
				   
				   <div class="form-group">
					<label   class="col-sm-4 ">Depositry Bank:</label>
					<div class="col-sm-8">
					<?php echo $erow['BANK_NAME']; ?>
                     
					</div>
					</div>
				
				<div class="form-group">
                  <label  class="col-sm-4">RF ID:</label>
					
                  <div class="col-sm-8">
                   <?php echo $erow['RF_ID']; ?>
                  </div>
                </div>
				 
					
					<div class="form-group">
					<label  class="col-sm-4">Grade:</label>
					<div class="col-sm-8">
					<?php echo $erow['grade_name']; ?>
					
					</div>
					</div>
				</div>
				
				
				
				<div class="col-sm-6">
				
				 <div class="form-group">
					
					 <div class="col-sm-8">
                   <img src='emp_images/<?php echo $erow['EMP_IMG']; ?>' width='160%;' height='100%;' />
                  </div>
					</div>
				 
					
				 
					
			    </div>
				
              </div>
              <!-- /.box-body -->
             
              <!-- /.box-footer -->
			  
			  </div>
			  
			 
			  
			   <div class="box-footer">
                
              </div>
			  
            </form>
			
          </div>
          
        </div>
        <!--/.col (right) -->
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
