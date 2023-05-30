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

    <!-- Main content -->
    <section class="content">
      <div class="row">
       	<?php
				if(isset($_GET['edit'])) {
					 $STD_ID = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `student_current_status` as scs JOIN gender_setup as gs on scs.GENDER= gs.G_ID JOIN religion_setup as rs on scs.RELIGION=rs.REG_ID where scs.LEFT_DATE is null AND scs.STUDENT_ID = '$STD_ID'");
					 $erow=mysqli_fetch_array($fetch_emp);
					 
				}
				?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Student Profile</h3>
			  
            </div>
            <!-- /.box-header -->
			
			
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
			<div class="col-md-12">
			<div class="box box-info">
			<div class="box-header with-border">
              <h3 class="box-title">Student Details</h3>
			  <div class=" col-sm-offset-5">
			   <img src='student_images/<?php echo $erow['IMG']; ?>' width='100px;' height='100px;'  />
			   
			   </div>
            </div>
			
              <div class="box-body">
			   
			  <div class="col-sm-6">
              
			   <input type="hidden" class="form-control" id="formid" name="formid" value="<?php echo $ADMISSION_FORM_ID; ?>">
			   <input type="hidden" class="form-control" id="stdimage" name="stdimage" value="<?php echo $erow['IMG']; ?>">
			  
			  
			  
				
				
             
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $erow['APPLICANT_NAME']; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Father Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $erow['FATHER_NAME']; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Mother Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Name" value="<?php echo $erow['MOTHER_NAME']; ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Nationality</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $erow['APPLICANT_NATIONALITY']; ?>" >
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Contact</label>
					
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $erow['APPLICANT_CONTACT_RES_NO']; ?>"  >
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Student Image</label>

                  <div class="col-sm-10">
                    <input type="file" name="image" id="image" class="form-control">
                  </div>
                </div>
				</div>
				
				
				
				<div class="col-sm-6">
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Address</label>

                  <div class="col-sm-10">
                   <textarea name="address" id="address" rows="4"  class="form-control" ><?php echo $erow['APPLICANT_ADDRESS']; ?></textarea>
                  </div>
                </div>
				  <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">DOB</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $erow['DATE_OF_BIRTH']; ?>" >
                  </div>
					</div>
				  </div>
				 <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Gender</label>
					<div class="col-sm-8">
					<select class="form-control"  name="gender" id="gender" >
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
				  </div>
			  
				  <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Religion</label>
					<div class="col-sm-8">
					<select class="form-control" name="religion" id="religion" >
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
				  </div>
				 <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Date Admission</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="dateadm" name="dateadm" value="<?php echo $erow['DATE_OF_SUBMISSION']; ?>" >
                  </div>
					</div>
				  </div>
				  
				 
				
				   
					
					 <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Blood Group</label>
					 <div class="col-sm-8">
                    <input type="text" class="form-control" id="blood" name="blood" value="<?php echo $erow['BLOOD_GROUP']; ?>">
                  </div>
					</div>
				  </div>
				  
				  
				  
				 
				   <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">RF ID</label>
					 <div class="col-sm-8">
                    <input type="number" class="form-control" id="rfid" name="rfid" value="<?php echo $erow['RF_ID']; ?>">
                  </div>
					</div>
				  </div>
					
			    </div>
				
              </div>
              <!-- /.box-body -->
             
              <!-- /.box-footer -->
			  </div>
			  </div>
			  
			  <div class="col-md-12">
			<div class="box box-info">
			<div class="box-header with-border">
              <h3 class="box-title">Contact Person</h3>
            </div>
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="contname" name="contname" value="<?php echo $erow['CONTACT_PERSON_NAME']; ?>" >
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="contemail" name="contemail" value="<?php echo $erow['CONTACT_PERSON_EMAIL']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Mobile #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="mobnum" name="mobnum" value="<?php echo $erow['CONTACT_PERSON_MOB']; ?>" >
                  </div>
                </div>
				
				
               
				</div>
				
				
				
				<div class="col-sm-6">
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-8">
                   <textarea name="contadd" id="contadd" rows="4"  class="form-control" ><?php echo $erow['CONTACT_PERSON_ADDRESS']; ?></textarea>
                  </div>
                </div>
				   
			    </div>
				
              </div>
             
			  </div>
			  </div>
			  <div class="col-md-12">
			<div class="box box-info">
			<div class="box-header with-border">
              <h3 class="box-title">Reference</h3>
            </div>
              <div class="box-body">
			  <div class="col-sm-6">
               
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="refname" name="refname" value="<?php echo $erow['REFERENCE_PERSON_NAME']; ?>">
                  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">CNIC #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="refcnic" name="refcnic" value="<?php echo $erow['REFERENCE_PERSON_CNIC_NO']; ?>">
                  </div>
                </div>
				
               
				</div>
				
				
				
				<div class="col-sm-6">
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-8">
                   <textarea name="refaddress" id="refaddress" rows="4"  class="form-control"><?php echo $erow['REFERENCE_PERSON_ADDRESS']; ?></textarea>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Mobile #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="refmobno" name="refmobno" value="<?php echo $erow['REFERENCE_PERSON_CONTACT_MOB']; ?>">
                  </div>
                </div>
				 
			    </div>
				
              </div>
             
			  </div>
			  </div>
			  
			  <div class="col-md-12">
			<div class="box box-info">
			<div class="box-header with-border">
              <h3 class="box-title">Siblings</h3>
            </div>
              <div class="box-body">
			  <div class="col-sm-6">
                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Siblings CNIC No</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="siblingcnic" name="siblingcnic" value="<?php echo $erow['SIBLING_CNIC_NO']; ?>"">
                  </div>
                </div>
			  </div>
              </div>
             
			  </div>
			  </div>
			  
			   <div class="col-md-12">
			<div class="box box-info">
			<div class="box-header with-border">
              <h3 class="box-title">Guardians</h3>
            </div>
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Guardian Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="guardname" name="guardname" value="<?php echo $erow['GUARDIAN_NAME']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Guardian CNIC #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="guardcnic" name="guardcnic" value="<?php echo $erow['GUARDIAN_CNIC_NO']; ?>">
                  </div>
                </div>
				
				
				
               
				</div>
				
				
				
				<div class="col-sm-6">
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Guardian Nationality</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="guardnation" name="guardnation" value="<?php echo $erow['GUARDIAN_NATIONALITY']; ?>">
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Profession</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="profession" name="profession" value="<?php echo $erow['GUARDIAN_PROFFESSION']; ?>">
                  </div>
                </div>
				 
			    </div>
				
              </div>
             
			  </div>
			  </div>
			   <div class="col-md-12">
			<div class="box box-info">
			<div class="box-header with-border">
              <h3 class="box-title">Special Case</h3>
            </div>
              <div class="box-body">
			
				<div class="col-sm-6">
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-8">
                   <textarea name="remark" id="remark" rows="7" class="form-control"><?php echo $erow['SPECIAL_CASE_REMARKS']; ?></textarea>
                  </div>
                </div>
				  
			    </div>
				<div class="col-sm-6">
				  <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Left Date</label>

                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="leftdate" name="leftdate">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Left Reason</label>

                  <div class="col-sm-8">
                   <textarea name="leftreason" id="leftreason" rows="4" class="form-control"></textarea>
                  </div>
                </div>
				   
			    </div>
              </div>
             
			  </div>
			  </div>
			   <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Update</button>
              </div>
			  
            </form>
			<?php
						if (isset($_POST['btnsub'])) {
							
								$name = $_POST['name'];
								$fname = $_POST['fname'];
								$mname=$_POST['mname'];
								$nationality=$_POST['nationality'];
								$address=$_POST['address'];
								$dob=$_POST['dob'];
								$contact = $_POST['contact'];
								$blood = $_POST['blood'];
								$remark=$_POST['remark'];
								$dateadm=$_POST['dateadm'];
								$gender=$_POST['gender'];
								$religion=$_POST['religion'];
								$contname = $_POST['contname'];
								$contemail = $_POST['contemail'];
								$mobnum=$_POST['mobnum'];
								$contadd=$_POST['contadd'];
								$refname=$_POST['refname'];
								$rfid=$_POST['rfid'];
								$refcnic=$_POST['refcnic'];
								$refaddress=$_POST['refaddress'];
								$refmobno=$_POST['refmobno'];
								$siblingcnic=$_POST['siblingcnic'];
								$guardname=$_POST['guardname'];
								$guardcnic=$_POST['guardcnic'];
								$guardnation=$_POST['guardnation'];
								$profession=$_POST['profession'];
								$file_name = $_FILES['image']['name'];
								$leftdate = $_POST['leftdate'];
								$leftreason = $_POST['leftreason'];
								
							if($file_name == "" && $leftdate == "")
							{
								
								$query="UPDATE `student_current_status` SET `APPLICANT_NAME`='".$name."',`FATHER_NAME`='".$fname."',`MOTHER_NAME`='".$mname."',`DATE_OF_BIRTH`='".$dob."',`APPLICANT_ADDRESS`='".$address."',`GENDER`='".$gender."',`RELIGION`='".$religion."',`GUARDIAN_NAME`='".$guardname."',`SPECIAL_CASE_REMARKS`='".$remark."',`GUARDIAN_CNIC_NO`='".$guardcnic."',`GUARDIAN_NATIONALITY`='".$guardnation."',`GUARDIAN_PROFFESSION`='".$profession."',`APPLICANT_NATIONALITY`='".$nationality."',`DATE_OF_SUBMISSION`='".$dateadm."',`CONTACT_PERSON_NAME`='".$contname."',`CONTACT_PERSON_MOB`='".$mobnum."',`CONTACT_PERSON_ADDRESS`='".$contadd."',`CONTACT_PERSON_EMAIL`='".$contemail."',`SIBLING_CNIC_NO`='".$siblingcnic."',`RF_ID`='".$rfid."',`BLOOD_GROUP`='".$blood."',`APPLICANT_CONTACT_RES_NO`='".$contact."',`REFERENCE_PERSON_NAME`='".$refname."',`REFERENCE_PERSON_CNIC_NO`='".$refcnic."',`REFERENCE_PERSON_ADDRESS`='".$refaddress."',`REFERENCE_PERSON_CONTACT_MOB`='".$refmobno."' WHERE `STUDENT_ID` = '$STD_ID'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='student_view.php'; </script>";
										
							}
						else if($leftdate == ""){
							
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
								 move_uploaded_file($file_tmp,"Student_images/".$file_name);
								 //echo "Success";
							  }else{
								 print_r($errors);
							  }	
													
							
								$query="UPDATE `student_current_status` SET `APPLICANT_NAME`='".$name."',`FATHER_NAME`='".$fname."',`MOTHER_NAME`='".$mname."',`DATE_OF_BIRTH`='".$dob."',`APPLICANT_ADDRESS`='".$address."',`GENDER`='".$gender."',`RELIGION`='".$religion."',`GUARDIAN_NAME`='".$guardname."',`SPECIAL_CASE_REMARKS`='".$remark."',`GUARDIAN_CNIC_NO`='".$guardcnic."',`GUARDIAN_NATIONALITY`='".$guardnation."',`GUARDIAN_PROFFESSION`='".$profession."',`APPLICANT_NATIONALITY`='".$nationality."',`DATE_OF_SUBMISSION`='".$dateadm."',`CONTACT_PERSON_NAME`='".$contname."',`CONTACT_PERSON_MOB`='".$mobnum."',`CONTACT_PERSON_ADDRESS`='".$contadd."',`CONTACT_PERSON_EMAIL`='".$contemail."',`SIBLING_CNIC_NO`='".$siblingcnic."',`RF_ID`='".$rfid."',`BLOOD_GROUP`='".$blood."',`APPLICANT_CONTACT_RES_NO`='".$contact."',`REFERENCE_PERSON_NAME`='".$refname."',`REFERENCE_PERSON_CNIC_NO`='".$refcnic."',`REFERENCE_PERSON_ADDRESS`='".$refaddress."',`REFERENCE_PERSON_CONTACT_MOB`='".$refmobno."',`IMG`='".$file_name."' WHERE `STUDENT_ID` = '$STD_ID'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='student_view.php'; </script>";
							}
						else{
												
							
								$query="UPDATE `student_current_status` SET `APPLICANT_NAME`='".$name."',`FATHER_NAME`='".$fname."',`MOTHER_NAME`='".$mname."',`DATE_OF_BIRTH`='".$dob."',`APPLICANT_ADDRESS`='".$address."',`GENDER`='".$gender."',`RELIGION`='".$religion."',`GUARDIAN_NAME`='".$guardname."',`SPECIAL_CASE_REMARKS`='".$remark."',`GUARDIAN_CNIC_NO`='".$guardcnic."',`GUARDIAN_NATIONALITY`='".$guardnation."',`GUARDIAN_PROFFESSION`='".$profession."',`APPLICANT_NATIONALITY`='".$nationality."',`DATE_OF_SUBMISSION`='".$dateadm."',`CONTACT_PERSON_NAME`='".$contname."',`CONTACT_PERSON_MOB`='".$mobnum."',`CONTACT_PERSON_ADDRESS`='".$contadd."',`CONTACT_PERSON_EMAIL`='".$contemail."',`SIBLING_CNIC_NO`='".$siblingcnic."',`RF_ID`='".$rfid."',`BLOOD_GROUP`='".$blood."',`APPLICANT_CONTACT_RES_NO`='".$contact."',`REFERENCE_PERSON_NAME`='".$refname."',`REFERENCE_PERSON_CNIC_NO`='".$refcnic."',`REFERENCE_PERSON_ADDRESS`='".$refaddress."',`REFERENCE_PERSON_CONTACT_MOB`='".$refmobno."',`LEFT_DATE`='".$leftdate."',`left_reason`='".$leftreason."' WHERE `STUDENT_ID` = '$STD_ID'";
								$result = $conn->query($query);
								
								
								$r=mysqli_query($conn,"SELECT ADMISSION_FORM_ID FROM `student_current_status` WHERE `STUDENT_ID` = '$STD_ID'");
								while ($k=mysqli_fetch_array($r)){
									$ADMISSION_FORM_ID=$k['ADMISSION_FORM_ID'];
								}
								
								$query1="UPDATE `admission_test` SET `LEFT_DATE`='".$leftdate."',`LEFT_STATUS`='Y'  WHERE `ADMISSION_FORM_ID` = '$ADMISSION_FORM_ID'";
								$result1 = $conn->query($query1);
							
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='student_view.php'; </script>";
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
