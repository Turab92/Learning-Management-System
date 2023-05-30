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
$pagename="Create Employee Profile";
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
              <h3 class="box-title">Employee Setup</h3>
            </div>
            <!-- /.box-header -->
			
			
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action=""  enctype="multipart/form-data">
			<div class="col-md-12">
			
              <div class="box-body">
			  <div class="col-sm-6">
               
            
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Father Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="fname" name="fname" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-8">
                   <textarea name="address" id="address" rows="4"  class="form-control" required></textarea>
                  </div>
                </div>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">CNIC #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="cnic" name="cnic" placeholder="XXXXX-XXXXXXX-X" required>
                  </div>
                </div>
				 <div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Department</label>
					<div class="col-sm-8">
					<select class="form-control"  name="department" id="department" required>
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
					<label  for="inputPassword3" class="col-sm-3 control-label">Designation</label>
					<div class="col-sm-8">
					<select class="form-control"  name="designation" id="designation" required>
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
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Contact</label>
					
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="contact" name="contact" placeholder="9233xxxxxxxxx" required>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Employee Image</label>

                  <div class="col-sm-8">
                    <input type="file" name="image" id="image" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Account</label>
					
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="account" name="account"  >
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-8">
                   <textarea name="remark" id="remark" rows="5" class="form-control"></textarea>
                  </div>
                </div>
				</div>
				
				
				
				<div class="col-sm-6">
				
				 
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Date of Joining</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="joining" name="joining" required>
                  </div>
					</div>
				  
				
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Gender</label>
					<div class="col-sm-8">
					<select class="form-control"  name="gender" id="gender" required>
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select G_ID,GENDER_DESCRIPTION from gender_setup ");
							while ($k=mysqli_fetch_array($r)){
								$G_ID=$k['G_ID'];
								 $GENDER_DESCRIPTION=$k['GENDER_DESCRIPTION'];
								echo "<option value='$G_ID' >$GENDER_DESCRIPTION</option>";
							}
					?>
					</select>
					</div>
					</div>
				 
			  
				 
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Religion</label>
					<div class="col-sm-8">
					<select class="form-control" name="religion" id="religion" required>
                   <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select REG_ID,REG_NAME from religion_setup");
							while ($k=mysqli_fetch_array($r)){
								$REG_ID=$k['REG_ID'];
								 $REG_NAME=$k['REG_NAME'];
								echo "<option value='$REG_ID' >$REG_NAME</option>";
							}
					?>
					</select>
					</div>
					</div>
				 
				  
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Employee Type</label>
					<div class="col-sm-8">
					<select class="form-control" name="emptype" id="emptype" required>
                     <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select TYPE_ID,EMPLOYEE_TYPE from employee_type_setup ");
							while ($k=mysqli_fetch_array($r)){
								$TYPE_ID=$k['TYPE_ID'];
								 $EMPLOYEE_TYPE=$k['EMPLOYEE_TYPE'];
								echo "<option value='$TYPE_ID' >$EMPLOYEE_TYPE</option>";
							}
					?>
					</select>
					</div>
					
				  </div>
				   
					<div class="form-group">
					<label  for="inputPassword3" class="col-md-3 control-label">Qualification</label>
					<div class="col-sm-8">
					<select class="form-control" name="qualification" id="qualification" required>
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select qualification_id,qualification_name from qualification ");
							while ($k=mysqli_fetch_array($r)){
								$qualification_id=$k['qualification_id'];
								 $qualification_name=$k['qualification_name'];
								echo "<option value='$qualification_id' >$qualification_name</option>";
							}
					?>
					</select>
					</div>
					</div>
				 
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Experience(Month)</label>
					
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="experience" name="experience" required >
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Reference</label>
					
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="reference" name="reference"  >
                  </div>
                </div>
				 
					<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Pay Rate</label>
					
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="payrate" name="payrate"  >
                  </div>
                </div>
				   
				   <div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Depositry Bank</label>
					<div class="col-sm-8">
					<select class="form-control" id="depositry" name="depositry">
                     <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select BANK_ID,BANK_NAME from banks_setup where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$BANK_ID=$k['BANK_ID'];
								 $BANK_NAME=$k['BANK_NAME'];
								echo "<option value='$BANK_ID' >$BANK_NAME</option>";
							}
					?>
					</select>
					</div>
					</div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">RF ID</label>
					
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="rfid" name="rfid"  required>
                  </div>
                </div>
				 
					
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Grade</label>
					<div class="col-sm-8">
					<select class="form-control" name="grade" id="grade" required>
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select grade_id,grade_name from employee_grade ");
							while ($k=mysqli_fetch_array($r)){
								$grade_id=$k['grade_id'];
								 $grade_name=$k['grade_name'];
								echo "<option value='$grade_id' >$grade_name</option>";
							}
					?>
					</select>
					</div>
					</div>
				 
					
			    </div>
				
              </div>
              <!-- /.box-body -->
             
              <!-- /.box-footer -->
			  
			  </div>
			  
			 
			  
			   <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Submit</button>
              </div>
			  
            </form>
          </div>
           <?php
				employee_setup();
			?>
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
