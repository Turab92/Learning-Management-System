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
$pagename="Student Card Setup";
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
  xmlhttp.open("GET","student_card_ajax.php?q="+str+"&&a="+str1,true);
  xmlhttp.send();
}
</script>


	<script>
function showStudent(str,str1,str2) {
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
  xmlhttp.open("GET","student_card_ajax1.php?q="+str+"&&a="+str1+"&&c="+str2,true);
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
  xmlhttp.open("GET","student_card_ajax_2.php?q="+str,true);
  xmlhttp.send();
}
</script>
<script>
function selectall(source) {
  checkboxes = document.getElementsByName('students[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
	</script>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Student Id Card</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  target="_blank" method="post" action="student_card_pdf" enctype="multipart/form-data">
              <div class="box-body">
			
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select Branch</label>

                  <div class="col-sm-6">
                   <select name="branch" class="form-control" required onchange="showClass(this.value)">
					 <option value="">Select Branch</option>
					 <?php
					 $r1 = mysqli_query($conn, "select* from school_branches where active = 'Y'"); 
					
					while (($rows1 = mysqli_fetch_array($r1)) != false) {
					 $branch_id = $rows1['branch_id'];
					 $brance_name=$rows1['branch_name'];
					 ?>
					 <option value="<?php echo $branch_id;?>"><?php echo $brance_name;?></option>
					 <?php
					}
								 
								 ?>
								 
								 </select>
                  </div>
                </div>
				
						        <div id="txtHint2"></div>
						
								<div id="txtHint"></div>
								
								<div id="txtHint1"></div>
				<label>Note (Only Those Student Record Will Apprear Whose ID Card Are Not Printed)</label>
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="sub" class="btn btn-info pull-right">Submit</button>
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
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Student Card Details (Following are the details of Student cars printed...)</h3>
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
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"select b.student_id,b.class_id,b.section_id,b.is_print,
c.student_id,c.applicant_name,c.left_date,d.class_id,d.class_description,e.section_id,e.section_description
 from student_current_class b,student_current_status c,class_setup d,class_setup_section e
   where b.is_print = '1' and b.student_id = c.student_id  and b.class_id = d.class_id and b.section_id = e.section_id and c.left_date is null");
            foreach($fetch_emp as $emp)
            {
                $student_name = $emp['applicant_name'];
				$class_description = $emp['class_description'];
				$section_description = $emp['section_description'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $student_name; ?></td>
					<td><?php echo $class_description; ?></td>
					<td><?php echo $section_description; ?></td>
					 
					   
					
					
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
