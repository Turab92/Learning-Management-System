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
$pagename="Student Attendance";
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
                 function showclass(str) {
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
                     xmlhttp.open("GET","showclass1.php?m="+str,true);
                     xmlhttp.send();
                 }
             </script>
			<script>
				function showSection(str,str1) {
				  if (str=="") {
					document.getElementById("txtHint1").innerHTML="";
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
					  document.getElementById("txtHint1").innerHTML=this.responseText;
					}
				  }
				  xmlhttp.open("GET","ajax_show_section.php?q="+str+"&&a="+str1,true);
				  xmlhttp.send();
				}
				</script>
				<script>
					function showStudent(str,str1,str2) {
					  if (str=="") {
						document.getElementById("txtHint").innerHTML="";
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
						  document.getElementById("txtHint").innerHTML=this.responseText;
						}
					  }
					  xmlhttp.open("GET","showstudent.php?q="+str+"&&a="+str1+"&&c="+str2,true);
					  xmlhttp.send();
					}
					</script>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Student Attendance</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			 
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch" onchange="showclass(this.value);" required>
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
				
					<div id="txtHint4"></div>
				
					<div id="txtHint1"></div>
					<div id="txtHint"></div>
			
				
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="date" name="date" required>
                  </div>
                </div>
				
				<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Select Session</label>
					<div class="col-sm-6">
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
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
			
          </div>
         <?php
				student_attendance_setup();
			?>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>

	
	
	
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
 

	
	 <script>
         function selectall(source) {
             checkboxes = document.getElementsByName('student[]');
             for(var i=0, n=checkboxes.length;i<n;i++) {
                 checkboxes[i].checked = source.checked;
             }
         }
     </script>
  <!--javascript End-->
</body>
</html>
