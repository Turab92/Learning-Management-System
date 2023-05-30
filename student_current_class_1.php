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
$pagename="View Class Students";
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
  xmlhttp.open("GET","bearer_ajax.php?q="+str+"&&a="+str1,true);
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
  xmlhttp.open("GET","bearer_ajax_2.php?q="+str,true);
  xmlhttp.send();
}
</script>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Student Current Class</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="">
              <div class="box-body">
			
			   <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch Name</label>
                  <div class="col-md-6"> 
                                      <select class="form-control" name="branch" onchange="showClass(this.value)" required >
                                          <option value="">Select Branch</option>
                                       <?php
									   
                                          $sql="select * from school_branches where active = 'Y' ";
        		$run=mysqli_query($conn,$sql);
									 while(($row = mysqli_fetch_array($run)) != false) 
									 {										
									         
        			$branch_id=$row['branch_id'];
                    $branch_name=$row['branch_name'];
                    echo"<option value='$branch_id'>$branch_name</option>";
									
                }
                                          ?>
                                          
                                       </select></div>
                </div>
				<div id="txtHint2"></div>
							
							<div id="txtHint1"></div>
				
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="sub" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	 <!-- Main content -->
	 <?php
						if(isset($_POST['sub'])){
							
							$branch = $_POST['branch'];
					        $class = $_POST['class'];
							$section = $_POST['section'];
				
							
						?>	
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Class Student Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Student Name</th>
                  <th>Class</th>
				  <th>Section</th>
                  <th>Roll No</th>
                  <th>Branch</th>
				  <th>Edit</th>
                 
                </tr>
                </thead>
               <tbody>
						 <?php 
		  $i=1;
		  
		
			 $r = mysqli_query($conn, "select  a.section_id,a.class_id,a.STUDENT_ID,a.ROLL_NO,a.active,b.STUDENT_ID,b.APPLICANT_NAME,b.left_date,b.branch_id,c.class_id,
			 c.CLASS_DESCRIPTION,d.section_id,d.SECTION_DESCRIPTION,e.branch_id,e.branch_name
              from student_current_class a,student_current_status b , class_setup c , class_setup_section d , school_branches e
								 where a.section_id = '$section' and a.class_id = '$class' and a.STUDENT_ID = b.STUDENT_ID and b.left_date IS NULL and a.active = 'Y' and b.branch_id = '$branch' and a.class_id = c.class_id and a.section_id = d.section_id and b.branch_id = 
								 e.branch_id ");  

	while (($rows = mysqli_fetch_array($r)) != false) {
		
	$sid=$rows['STUDENT_ID'];	
	$student_name = $rows['APPLICANT_NAME'];
	$class_name=$rows['CLASS_DESCRIPTION'];
	 $section_name=$rows['SECTION_DESCRIPTION'];
	 $roll_no=$rows['ROLL_NO'];
	 $branch = $rows['branch_name'];
	 
	 $enc = base64_encode($sid);
	 
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
	 <td class="center"><?php echo $student_name; ?></td>
		 <td class="center"><?php echo $class_name; ?></td>
        <td class="center"><?php echo $section_name; ?></td>
        <td class="center"><?php echo $roll_no; ?></td>
		<td class="center"><?php echo $branch; ?></td>
		
		
		<td>
     <?php echo "<a href='edit_current_class?edit=$enc'>"; ?>
                        <button class='btn btn-primary' type='button'>
                            <i class="fa fa-pencil"></i>
                        </button></a>
                    </td>  		
				  
				   	
    
	
		
	
        
                </tr>
          <?php $i++;}  ?>
							
							
		
    
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
