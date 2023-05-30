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
$pagename="Admission Form";
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
       <script>
                 function showsubmenu(str) {
                     if (str=="") {
                         document.getElementById("txtHint4").innerHTML="";
                         return;
                     }
                     if (window.XMLHttpRequest) {
                         // code for IE7+, Firefox, Chrome, Opera, Safari
                         xmlhttp=new XMLHttpRequest();
                     } else { // code for IE6, IE5
                         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                     }
                     xmlhttp.onreadystatechange=function() {
                         if (this.readyState==4 && this.status==200) {
                             document.getElementById("txtHint4").innerHTML=this.responseText;
                         }
                     }
                     xmlhttp.open("GET","showclasses.php?m="+str,true);
                     xmlhttp.send();
                 }
             </script>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Admission Form</h3>
            </div>
            <!-- /.box-header -->
			
			
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
			<div class="col-md-12">
			<div class="box box-info">
			<div class="box-header with-border">
              <h3 class="box-title">Student Details</h3>
            </div>
              <div class="box-body">
			  <div class="col-sm-6">
               
              <div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
					<div class="col-sm-8">
					 <select class="form-control"  name="branch" id="branch" onchange="showsubmenu(this.value);">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select branch_id,branch_name from school_branches where active = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$branch_id=$k['branch_id'];
								 $branch_name=$k['branch_name'];
								echo "<option value='$branch_id' >$branch_name</option>";
							}
					?>
                
					</select>
					</div>
					</div>
					<div class="form-group row">
					<div id="txtHint4"></div>
				</div>
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
                  <label for="inputEmail3" class="col-sm-3 control-label">Mother Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Nationality</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nationality" name="nationality" placeholder="nationality" required>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Contact</label>
					
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="contact" name="contact" placeholder="9233xxxxxxxxx" required>
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
                  <label for="inputPassword3" class="col-sm-2 control-label">Address</label>

                  <div class="col-sm-10">
                   <textarea name="address" id="address" rows="4"  class="form-control" required></textarea>
                  </div>
                </div>
				  <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">DOB</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="dob" name="dob" required>
                  </div>
					</div>
				  </div>
				 <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Gender</label>
					<div class="col-sm-8">
					<select class="form-control"  name="gender" id="gender" required>
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select G_ID,GENDER_DESCRIPTION from gender_setup");
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
				  </div>
				 <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Date Admission</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="dateadm" name="dateadm" required>
                  </div>
					</div>
				  </div>
				   <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Test Date</label>
					 <div class="col-sm-8">
                    <input type="date" class="form-control" id="testdate" name="testdate" placeholder="9233xxxxxxxxx" >
                  </div>
					</div>
				  </div>
				 <div class="col-sm-6">
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-4 control-label">Test Result</label>
					<div class="col-sm-8">
					<select class="form-control"  id="result" name="result" >
                    <option value="">Select</option>
					 <option value="Pass">Pass</option>
					</select>
					</div>
					</div>
				  </div>
				 
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Student Image</label>

                  <div class="col-sm-10">
                    <input type="file" name="image" id="image" class="form-control">
                  </div>
                </div>
				   
				   <div class="form-group">
					<label  for="inputPassword3" class="col-sm-2 control-label">Select Session</label>
					<div class="col-sm-10">
					<select class="form-control" id="session" name="session" required>
                     <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select SESSION_ID, FROM_DATE, TO_DATE  from sessions_setup where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$SESSION_ID=$k['SESSION_ID'];
								 $FROM_DATE=$k['FROM_DATE'];
								 $TO_DATE=$k['TO_DATE'];
								  $session_date=$FROM_DATE."-".$TO_DATE;
								echo "<option value='$SESSION_ID' >$session_date</option>";
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
                    <input type="text" class="form-control" id="contname" name="contname" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Mobile #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="mobnum" name="mobnum" placeholder="9233xxxxxxxxx">
                  </div>
                </div>
				
				
               
				</div>
				
				
				
				<div class="col-sm-6">
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Address</label>

                  <div class="col-sm-10">
                   <textarea name="contadd" id="contadd" rows="4"  class="form-control"></textarea>
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
                    <input type="text" class="form-control" id="guardname" name="guardname" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Guardian CNIC #</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="guardcnic" name="guardcnic" placeholder="XXXXX-XXXXXXX-X">
                  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Guardian Relation With Student</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="relation" name="relation" >
                  </div>
                </div>
				
               
				</div>
				
				
				
				<div class="col-sm-6">
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Guardian Nationality</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="guardnation" name="guardnation" >
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Profession</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="profession" name="profession">
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
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>

                  <div class="col-sm-10">
                    <p>DOES THE APPLICANT SUFFER FROM ANY CONTAGIOUS DISEASE ? PLEASE GIVE DETAILS OF LAST IMMUNITIZATION CERTIFICATE. I SOLEMNLY AFFIRMS THAT THE PARTICULARS ARE GIVEN BY ME IN THE ADDMISSION FORM ARE CORRECT .</p>
                  </div>
                </div>
                
				
               
				</div>
				
				
				
				<div class="col-sm-6">
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Disease Detail</label>

                  <div class="col-sm-10">
                   <textarea name="disease" id="disease" rows="4"  class="form-control"></textarea>
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
				admission_form_setup();
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
