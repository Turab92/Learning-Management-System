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
				if(isset($_GET['stid'])) {
					 $ADMISSION_FORM_ID = $_GET['stid'];
					 $fetch_emp = mysqli_query($conn,"select * from admission_test as atm JOIN class_setup as cs on atm.CLASS_ID=cs.CLASS_ID JOIN school_branches as sb on atm.BRANCH_ID= sb.branch_id join gender_setup as gs on atm.GENDER=gs.G_ID join religion_setup as rs on atm.RELIGION=rs.REG_ID where atm.ADMISSION_FORM_ID='$ADMISSION_FORM_ID'");
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
                  <label  for="inputPassword3" class="col-sm-3 control-label">G.R No</label>
                   <div class="col-sm-6">
				  
                  <?php  $query = mysqli_query($conn, "select * from STUDENT_CURRENT_STATUS order by STUDENT_ID ASC"); 
	
							while (($rows_f = mysqli_fetch_array($query)) != false) {
							 $student_ids=$rows_f['STUDENT_ID'];
							}
							$std_ids=$student_ids+1;
							
							?>
                  <input type="text" class="form-control" id="grno" name="grno" value="<?php echo $std_ids; ?>" readonly>
				  </div>
                </div>
			   <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch" readonly>
                    <option value='<?php echo $erow['branch_id']; ?>'><?php echo $erow['branch_name']; ?></option>
					
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Class</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="class" id="class" readonly>
                    <option value='<?php echo $erow['CLASS_ID']; ?>'><?php echo $erow['CLASS_DESCRIPTION']; ?></option>
					
                  </select>
				  </div>
                </div>
				
             
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $erow['APPLICANT_NAME']; ?>" readonly>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Father Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $erow['FATHER_NAME']; ?>" readonly>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Mother Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Name" value="<?php echo $erow['MOTHER_NAME']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Nationality</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $erow['APPLICANT_NATIONALITY']; ?>" readonly>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Contact</label>
					
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $erow['APPLICANT_CONTACT_NO']; ?>" readonly >
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-8">
                   <textarea name="remark" id="remark" rows="5" class="form-control"><?php echo $erow['SPECIAL_CASE_REMARKS']; ?></textarea>
                  </div>
                </div>
				</div>
				
				
				
				<div class="col-sm-6">
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Address</label>

                  <div class="col-sm-10">
                   <textarea name="address" id="address" rows="4"  class="form-control" readonly><?php echo $erow['APPLICANT_ADDRESS']; ?></textarea>
                  </div>
                </div>
				  <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">DOB</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $erow['DATE_OF_BIRTH']; ?>" readonly>
                  </div>
					</div>
				  </div>
				 <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Gender</label>
					<div class="col-sm-8">
					<select class="form-control"  name="gender" id="gender" readonly>
                    <option value='<?php echo $erow['G_ID']; ?>'><?php echo $erow['GENDER_DESCRIPTION']; ?></option>
					
                 
					</select>
					</div>
					</div>
				  </div>
			  
				  <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Religion</label>
					<div class="col-sm-8">
					<select class="form-control" name="religion" id="religion" readonly>
                   <option value='<?php echo $erow['REG_ID']; ?>'><?php echo $erow['REG_NAME']; ?></option>
					
					</select>
					</div>
					</div>
				  </div>
				 <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Date Admission</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="dateadm" name="dateadm" value="<?php echo $erow['DATE_OF_SUBMISSION']; ?>" readonly>
                  </div>
					</div>
				  </div>
				  
				 
				
				   <div class="form-group">
					<label  for="inputPassword3" class="col-sm-2 control-label">Select Session</label>
					<div class="col-sm-10">
					<select class="form-control" id="session" name="session" readonly>
					<?php
							$r=mysqli_query($conn,"select SESSION_ID, FROM_DATE, TO_DATE  from sessions_setup where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$SESSION_ID=$k['SESSION_ID'];
								 $FROM_DATE=$k['FROM_DATE'];
								 $TO_DATE=$k['TO_DATE'];
								  $session_date=$FROM_DATE."-".$TO_DATE;
							}
					?>
                     <option value='<?php echo $erow['SESSION_ID']; ?>'><?php echo $session_date; ?></option>
					
					</select>
					</div>
					</div>
					
					 <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Blood Group</label>
					 <div class="col-sm-8">
                    <input type="text" class="form-control" id="blood" name="blood">
                  </div>
					</div>
				  </div>
				   <div class="col-sm-6">
					 <div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Select Section</label>
					<div class="col-sm-8">
					 <select class="form-control"  name="section" id="section" required>
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select SECTION_ID,SECTION_DESCRIPTION from class_setup_section where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$SECTION_ID=$k['SECTION_ID'];
								 $SECTION_DESCRIPTION=$k['SECTION_DESCRIPTION'];
								echo "<option value='$SECTION_ID' >$SECTION_DESCRIPTION</option>";
							}
					?>
                
					</select>
					</div>
					</div>
				  </div>
				   <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Roll No</label>
					 <div class="col-sm-8">
                    <input type="number" class="form-control" id="rollno" name="rollno">
                  </div>
					</div>
				  </div>
				   <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">From Date</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="fromdate" name="fromdate">
                  </div>
					</div>
				  </div>
				   <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">To Date</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="todate" name="todate">
                  </div>
					</div>
				  </div>
				   <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">RF ID</label>
					 <div class="col-sm-8">
                    <input type="number" class="form-control" id="rfid" name="rfid">
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
                    <input type="text" class="form-control" id="contname" name="contname" value="<?php echo $erow['CONTACT_PERSON_NAME']; ?>" readonly>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="email" name="email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Mobile #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="mobnum" name="mobnum" value="<?php echo $erow['CONTACT_PERSON_MOB']; ?>" readonly>
                  </div>
                </div>
				
				
               
				</div>
				
				
				
				<div class="col-sm-6">
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-8">
                   <textarea name="contadd" id="contadd" rows="4"  class="form-control" readonly><?php echo $erow['CONTACT_PERSON_ADDRESS']; ?></textarea>
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
                  <label for="inputEmail3" class="col-sm-3 control-label">Reference Form No</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="formno" name="formno">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="refname" name="refname" >
                  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">CNIC #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="refcnic" name="refcnic" placeholder="xxxxx-xxxxxxx-x">
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Choose Reference Pictures(If Required)</label>

                  <div class="col-sm-8">
                    <input type="file" name="image" id="image" class="form-control">
                  </div>
                </div>
               
				</div>
				
				
				
				<div class="col-sm-6">
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-8">
                   <textarea name="refaddress" id="refaddress" rows="4"  class="form-control"></textarea>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Mobile #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="refmobno" name="refmobno" placeholder="923xxxxxxxxxx" >
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
                    <input type="text" class="form-control" id="siblingcnic" name="siblingcnic" placeholder="xxxxx-xxxxxxx-x">
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
				
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Guardian Relation With Student</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="relation" name="relation" value="<?php echo $erow['APPLICANT_GUARDIAN_RELATION']; ?>">
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
              <h3 class="box-title">Disease Detail</h3>
            </div>
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Disease Detail</label>

                  <div class="col-sm-10">
                    <p>DOES THE APPLICANT SUFFER FROM ANY CONTAGIOUS DISEASE ? PLEASE GIVE DETAILS OF LAST IMMUNITIZATION CERTIFICATE. I SOLEMNLY AFFIRMS THAT THE PARTICULARS ARE GIVEN BY ME IN THE ADDMISSION FORM ARE CORRECT .</p>
                  </div>
                </div>
                
				
               
				</div>
				
				
				
				<div class="col-sm-6">
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Disease Detail</label>

                  <div class="col-sm-10">
                   <textarea name="disease" id="disease" rows="4"  class="form-control"><?php echo $erow['DIESEASE_DETAIL']; ?></textarea>
                  </div>
                </div>
				   
			    </div>
				
              </div>
             
			  </div>
			  </div>
			   <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Submit</button>
              </div>
			  
            </form>
          </div>
       <?php
			student_profile_setup();
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
