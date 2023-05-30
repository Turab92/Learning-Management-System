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
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $erow['EMP_NAME']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Father Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $erow['EMP_FATHER_NAME']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-8">
                   <textarea name="address" id="address" rows="4"  class="form-control"><?php echo $erow['EMP_ADDRESS']; ?></textarea>
                  </div>
                </div>
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">CNIC #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="cnic" name="cnic" value="<?php echo $erow['EMP_CNIC']; ?>">
                  </div>
                </div>
				 <div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Department</label>
					<div class="col-sm-8">
					<select class="form-control"  name="department" id="department">
                   <option value='<?php echo $erow['DEPARTMENT_ID']; ?>'><?php echo $erow['DESCRIPTION']; ?></option>
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
					<select class="form-control"  name="designation" id="designation">
                   <option value='<?php echo $erow['DESIGNATION_ID']; ?>'><?php echo $erow['designation_name']; ?></option>
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
                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $erow['CONTACT_NO']; ?>" >
                  </div>
                </div>
				 
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Account No</label>
					
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="account" name="account"  value="<?php echo $erow['ACCOUNT_NO']; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-8">
                   <textarea name="remark" id="remark" rows="5" class="form-control"><?php echo $erow['REMARKS']; ?></textarea>
                  </div>
                </div>
				</div>
				
				
				
				<div class="col-sm-6">
				
				 
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Date of Joining</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="joining" name="joining" value="<?php echo $erow['DATE_OF_JOINING']; ?>" >
                  </div>
					</div>
				  
				
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Gender</label>
					<div class="col-sm-8">
					<select class="form-control"  name="gender" id="gender">
                    <option value='<?php echo $erow['G_ID']; ?>'><?php echo $erow['GENDER_DESCRIPTION']; ?></option>
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
					<select class="form-control" name="religion" id="religion">
                   <option value='<?php echo $erow['REG_ID']; ?>'><?php echo $erow['REG_NAME']; ?></option>
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
					<select class="form-control" name="emptype" id="emptype">
                     <option value='<?php echo $erow['TYPE_ID']; ?>'><?php echo $erow['EMPLOYEE_TYPE']; ?></option>
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
					<select class="form-control" name="qualification" id="qualification">
                    <option value='<?php echo $erow['qualification_id']; ?>'><?php echo $erow['qualification_name']; ?></option>
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
                    <input type="text" class="form-control" id="experience" name="experience" value="<?php echo $erow['EMP_EXPERIENCE']; ?>" >
                  </div>
                </div>
				 
					<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Pay Rate</label>
					
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="payrate" name="payrate" value="<?php echo $erow['PAY_RATE']; ?>" >
                  </div>
                </div>
				   
				   <div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Depositry Bank</label>
					<div class="col-sm-8">
					<select class="form-control" id="depositry" name="depositry">
                     <option value='<?php echo $erow['BANK_ID']; ?>'><?php echo $erow['BANK_NAME']; ?></option>
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
                    <input type="number" class="form-control" id="rfid" name="rfid" value="<?php echo $erow['RF_ID']; ?>" >
                  </div>
                </div>
				 
					
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Grade</label>
					<div class="col-sm-8">
					<select class="form-control" name="grade" id="grade">
                    <option value='<?php echo $erow['grade_id']; ?>'><?php echo $erow['grade_name']; ?></option>
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
					<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Employee Image</label>

                  <div class="col-sm-8">
				  <img src='emp_images/<?php echo $erow['EMP_IMG'];  ?>' width='80px;' height='80px;' />
                    <input type="file" name="image" id="image" class="form-control">
                  </div>
                </div>
				 
					
			    </div>
				
              </div>
              <!-- /.box-body -->
             
              <!-- /.box-footer -->
			  
			  </div>
			  
			 
			  
			   <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Update</button>
              </div>
			  
            </form>
			<?php
						if (isset($_POST['btnsub'])) {
							
								$name = $_POST['name'];
								$fname = $_POST['fname'];
								$address=$_POST['address'];
								$cnic=$_POST['cnic'];
								$department=$_POST['department'];
								$designation=$_POST['designation'];
								$contact = $_POST['contact'];
								$account = $_POST['account'];
								$remark=$_POST['remark'];
								$joining=$_POST['joining'];
								$gender=$_POST['gender'];
								$religion=$_POST['religion'];
								$emptype = $_POST['emptype'];
								$qualification = $_POST['qualification'];
								$experience=$_POST['experience'];
								$payrate=$_POST['payrate'];
								$depositry=$_POST['depositry'];
								$rfid=$_POST['rfid'];
								$grade=$_POST['grade'];
								$reference=$_POST['reference'];
								$file_name = $_FILES['image']['name'];

							if($file_name == "")
								{
							
									$query="UPDATE `employees` SET `EMP_NAME`='".$name."',`EMP_FATHER_NAME`='".$fname."',`EMP_CNIC`='".$cnic."',`CONTACT_NO`='".$contact."',`DATE_OF_JOINING`='".$joining."',`GENDER`='".$gender."',`RELIGION`='".$religion."',`PAY_RATE`='".$payrate."',`REMARKS`='".$remark."',`REFRENCE`='".$reference."',`EMP_ADDRESS`='".$address."',`EMP_EXPERIENCE`='".$experience."',`EMP_QUALIFICATION`='".$qualification."',`DESIGNATION_ID`='".$designation."',`DEPARTMENT_ID`='".$department."',`EMP_TYPE`='".$emptype."',`ACCOUNT_NO`='".$account."',`DEPOSIT_BANK_ID`='".$depositry."',`GRADE_ID`='".$grade."',`RF_ID`='".$rfid."' WHERE `EMP_ID` = '$EMP_ID'";
									$result = $conn->query($query);
									 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
									echo "<script>location.href='view_employee_profile.php'; </script>";
								}
							else
							{
								$errors= array();
		
								 $file_name = $_FILES['image']['name'];
								  $file_size =$_FILES['image']['size'];
								  $file_tmp =$_FILES['image']['tmp_name'];
								  $file_type=$_FILES['image']['type'];
								  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
								  
								  $expensions= array("jpeg","jpg","png");
								  
								  if(in_array($file_ext,$expensions)=== false){
									 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
								  }
								  
								  if($file_size > 1000000){
									 $errors[]='File size must be exactely 1000 KB';
								  }
								  
								  if(empty($errors)==true){
									 move_uploaded_file($file_tmp,"emp_images/".$file_name);
									 //echo "Success";
								  }else{
									 print_r($errors);
								  }
								  
								$query="UPDATE `employees` SET `EMP_NAME`='".$name."',`EMP_FATHER_NAME`='".$fname."',`EMP_CNIC`='".$cnic."',`CONTACT_NO`='".$contact."',`DATE_OF_JOINING`='".$joining."',`GENDER`='".$gender."',`RELIGION`='".$religion."',`PAY_RATE`='".$payrate."',`REMARKS`='".$remark."',`REFRENCE`='".$reference."',`EMP_ADDRESS`='".$address."',`EMP_EXPERIENCE`='".$experience."',`EMP_QUALIFICATION`='".$qualification."',`DESIGNATION_ID`='".$designation."',`DEPARTMENT_ID`='".$department."',`EMP_TYPE`='".$emptype."',`ACCOUNT_NO`='".$account."',`DEPOSIT_BANK_ID`='".$depositry."',`GRADE_ID`='".$grade."',`RF_ID`='".$rfid."',`EMP_IMG`='".$file_name."' WHERE `EMP_ID` = '$EMP_ID'";
									$result = $conn->query($query);
									 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
									echo "<script>location.href='view_employee_profile.php'; </script>";
							}
								
						}
						?>
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
