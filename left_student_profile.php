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
					 $std_ID = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"select * from student_current_status a,student_current_class s ,class_setup c,school_branches b,class_setup_section e,religion_setup r,gender_setup g where a.branch_id=b.branch_id and s.class_id=c.class_id and a.STUDENT_ID='$std_ID' and a.student_id = s.student_id and s.active = 'Y' and s.section_id = e.section_id and r.REG_ID=a.RELIGION AND g.G_ID=a.GENDER");
					 $erow=mysqli_fetch_array($fetch_emp);
					
				}
				?>
				
	<div id="wrapper">			
	<div class="main-content">
      <div class="row small-spacing">
			<div class="col-md-3 col-xs-12">
				
					<div class="profile-avatar" >
					<div >
					<img src='student_images/<?php echo $erow['IMG'] ?>' width='200px;' height='200px;' /></div>
						
						
											</div>
					<!-- .profile-avatar -->
				
				
				<!-- /.box-content bordered -->
<br></br>
<br></br>


			
				<!-- /.box-content -->
			</div>
			
			<!-- /.col-md-3 col-xs-12 -->
			<div class="col-md-9 col-xs-12">
				<div class="row">
					<div class="col-xs-12">
						<div class="box-content card bordered-all primary">
							<h4 class="box-title bg-primary"><i class="fa fa-user ico"></i>Student Info</h4>
							<!-- /.box-title -->
							
							<!-- /.dropdown js__dropdown -->
							<div class="card-content">
								<div class="row">
								<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>RF ID:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['RF_ID'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
								<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Branch:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['branch_name'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>G.R NO:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['STUDENT_ID'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									
									
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Roll NO:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['ROLL_NO'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Name:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['APPLICANT_NAME'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Father Name:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo$erow['FATHER_NAME']; ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Mother Name:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['MOTHER_NAME'];   ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Date Of Birth</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['DATE_OF_BIRTH'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Address</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['APPLICANT_ADDRESS'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Gender</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['GENDER_DESCRIPTION'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Religion</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['REG_NAME'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Blood Group</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['BLOOD_GROUP'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Residential No</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['APPLICANT_CONTACT_RES_NO'];  ?></a></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
								
																		<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Class</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['CLASS_DESCRIPTION']; ?></a></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Section</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['SECTION_DESCRIPTION'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>From Date:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['FROM_DATE'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>To Date:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['TO_DATE'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Siblings CNIC:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['SIBLING_CNIC_NO'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
											<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Disease Details:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['DISEASE_DETAILS'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Left Date:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['LEFT_DATE'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-xs-5"><label><b>Left Reason:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['left_reason'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
								</div>
								<!-- /.row -->
							</div>
							<!-- /.card-content -->
						</div>
						<!-- /.box-content card -->
					</div>
					</div>
					</div>
					</div>
					<div class="col-md-4 col-md-offset-0">
						<div class="box-content card bordered-all primary">
							<h4 class="box-title bg-primary"><i class="fa fa-file-user ico"></i> Guardian</h4>
							<!-- /.box-title -->
						
							<div class="card-content">
								<div class="row">
								
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b>Name:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['GUARDIAN_NAME'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b> CNIC :</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['GUARDIAN_CNIC_NO'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b>Nationality: </b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7">&nbsp;<?php echo $erow['GUARDIAN_NATIONALITY'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b>Profession</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['GUARDIAN_PROFFESSION'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
								
								</div>
							</div>
							<!-- /.card-content -->
						</div>
						<!-- /.box-content card -->
					</div> 
					
					<div class="col-md-4 col-xs-12">
						<div class="box-content card bordered-all primary">
							<h4 class="box-title bg-primary"><i class="fa fa-file-user ico"></i> Contact person</h4>
							<!-- /.box-title -->
							
							<!-- /.dropdown js__dropdown -->
							<div class="card-content">
								<div class="row">
								
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b> Name:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['CONTACT_PERSON_NAME'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b> Mobile No:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['CONTACT_PERSON_MOB'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
										<!-- /.col-md-6 -->
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b> Email:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['CONTACT_PERSON_EMAIL'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b> Address:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['CONTACT_PERSON_ADDRESS'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									
								</div>
							</div>
							
					<!-- /.col-md-6 -->
				
					<!-- /.col-md-6 -->
				</div>
			
				<!-- /.row -->
			</div>
			
			<div class="col-md-4 col-xs-6">
				<div class="box-content card bordered-all primary">
							<h4 class="box-title bg-primary"><i class="fa fa-user ico"></i> Reference</h4>
							<!-- /.box-title -->
							
							<div class="card-content">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b> Form No:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['REFERENCE_FORM_NO'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b>  Name:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['REFERENCE_PERSON_NAME'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b> CNIC:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['REFERENCE_PERSON_CNIC_NO'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<!-- /.col-md-6 -->
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b>Address:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['REFERENCE_PERSON_ADDRESS'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
									<div class="col-md-12">
										<div class="row">
											<div class="col-xs-5"><label><b>Contact:</b></label></div>
											<!-- /.col-xs-5 -->
											<div class="col-xs-7"><?php echo $erow['REFERENCE_PERSON_CONTACT_MOB'];  ?></div>
											<!-- /.col-xs-7 -->
										</div>
										<!-- /.row -->
									</div>
	
								
								</div>				</div>
							<!-- /.card-content -->
						</div>

			</div>
					
					<div class="col-md-12 col-xs-6">
				<div class="box-content card bordered-all primary">

							<h4 class="box-title bg-primary">Reference Pictures</h4>
	
							<div class="card-content">
								<div class="row">

<div class="col-md-3">
<div class="profile-avatar" >
					<div >
					<img src='reference_image/<?php echo $erow['REFERENCE_PICTURES'] ?>' width='200px;' height='200px;' /></div>
						
						
											</div></div>
									

								
								</div>				</div>
							<!-- /.card-content -->
						</div>

			</div>
					
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
