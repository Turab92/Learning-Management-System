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
$pagename="Generate Student Schedule";
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
  xmlhttp.open("GET","ajax_show_student.php?q="+str+"&&a="+str1+"&&c="+str2,true);
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
function showClass(str) {
  if (str=="") {
    document.getElementById("txtHint2").innerHTML="";
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
      document.getElementById("txtHint2").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","ajax_show_class.php?q="+str,true);
  xmlhttp.send();
}
</script>
			
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Fee Slab</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			 
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch" onchange="showClass(this.value);">
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
					<div id="txtHint2"></div>
				</div>
				<div class="form-group row">
					<div id="txtHint1"></div>
				</div>
				<div class="form-group row">
					<div id="txtHint"></div>
				</div>
			
				
			
				
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	
	<?php
						if(isset($_POST['btnsub'])){
							
						$branch = $_POST['branch'];
						$class = $_POST['class'];
	                    $section = $_POST['section']; 
                        $student_id = $_POST['pass'];	                    
						
						$sql = mysqli_query($conn, "select * from student_current_status a , student_current_class b ,class_setup c, class_setup_section d where a.student_id = b.student_id and b.student_id = '$student_id' and b.class_id = '$class' and b.section_id = '$section' and b.class_id = c.class_id and b.section_id = d.section_id and b.active = 'Y' ");
		
		 while($rows_sql = mysqli_fetch_array($sql)) 
		{
		   $student_id = $rows_sql['STUDENT_ID'];
		   $student_name = $rows_sql['APPLICANT_NAME'];
		   $father_name = $rows_sql['FATHER_NAME'];
		   $date_of_birth = $rows_sql['DATE_OF_BIRTH'];
		   $class_id = $rows_sql['CLASS_ID'];
		   $class_name = $rows_sql['CLASS_DESCRIPTION'];
		   $section_id = $rows_sql['SECTION_ID'];
		   $section = $rows_sql['SECTION_DESCRIPTION'];
		  		
		}
             ?>
	
	
	
	
	
	 <section class="content">
      <div class="row">
        <!-- left column -->
       
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Student Info</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Student ID</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="stdid" name="stdid" value="<?php echo $student_id; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Student Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="stdname" name="stdname" value="<?php echo $student_name; ?>" readonly>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Father Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $father_name; ?>" readonly>
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Class</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="class" name="class" value="<?php echo $class_name; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Section</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="section" name="section" value="<?php echo $section; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Date Of Birth</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $date_of_birth; ?>" readonly>
                  </div>
                </div>
				
				</div>
              </div>
		<script>
function showStructure(str) {
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
  xmlhttp.open("GET","ajax_fees.php?q="+str,true);
  xmlhttp.send();
}
</script>
			
					<?php
					$query = mysqli_query($conn,"SELECT * FROM STUDENT_FEES_STRUCTURE WHERE student_id='$student_id' AND class_id='$class_id'");
		
		
		 $numrows = mysqli_num_rows($query);
			if($numrows == 0){
					?>	  
			  
			  
			  
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" onClick="showStructure(<?php echo $student_id; ?>);" class="btn btn-info pull-right">Generate</button>
              </div>
			  
			  <?php
				}
			 else{
				?>
				<div class="form-group">
								<div class="col-sm-6 col-sm-offset-4">
							<li class="margin-bottom-10">Schedule Alredy Generated</li>
								</div>
							</div>
						<?php
						}
							?>
              <!-- /.box-footer -->
            </form>
          </div>
		 
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
	
	<?php			
						
						
}


?>
	
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
