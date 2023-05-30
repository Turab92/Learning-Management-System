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
$pagename="Fees Receiving History";
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
              <h3 class="box-title">Fee Receiving Student</h3>
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
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Fee Schedule</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Nature</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"SELECT `NATURE_ID`, `DESCRIPTION` FROM `nature_payments` where ACTIVE='Y' order by NATURE_ID desc");
            foreach($fetch_emp as $emp)
            {
                $NATURE_ID=$emp['NATURE_ID'];
                $DESCRIPTION=$emp['DESCRIPTION'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $DESCRIPTION; ?></td>
					 
					   
					
					<td><span class='action'><a href='edit_nature.php?edit=<?php echo $NATURE_ID; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?NATURE_ID=<?php echo $NATURE_ID; ?>' class='delete show' title='Delete'>X</a></span></td>
           </tr>
                <?php $s_no++; }?>
                

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
