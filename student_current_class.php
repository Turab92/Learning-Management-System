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
$pagename="Student Promotion";
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
		document.getElementById("txtHint3").innerHTML="";
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
		  document.getElementById("txtHint3").innerHTML=this.responseText;
		}
	  }
	  xmlhttp.open("GET","ajax_show_section.php?q="+str+"&&a="+str1,true);
	  xmlhttp.send();
	}
	</script>

<script>
	function showSection2(str,str1) {
	  if (str=="") {
		document.getElementById("txtHint5").innerHTML="";
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
		  document.getElementById("txtHint5").innerHTML=this.responseText;
		}
	  }
	  xmlhttp.open("GET","new_section.php?q="+str+"&&a="+str1,true);
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
  xmlhttp.open("GET","campus_leaving_ajax1.php?q="+str,true);
  xmlhttp.send();
}
</script>

<script>
function showClass2(str) {
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
  xmlhttp.open("GET","new_class.php?q="+str,true);
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
	  xmlhttp.open("GET","showstudent.php?q="+str+"&&a="+str1+"&&c="+str2,true);
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
              <h3 class="box-title">Student Promote Class</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
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
					<div id="txtHint2"></div>	
					
							<div id="txtHint"></div>	
							<div id="txtHint3"></div>	
							<div id="txtHint1"></div>		
						
              
				<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Select New Branch</label>
					<div class="col-sm-6">
					 <select class="form-control"  name="branch2" id="branch2" onchange="showClass2(this.value);">
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
							<div id="txtHint5"></div>
				
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select New Session</label>
                 <div class="col-md-6">
									<select name="session" class="form-control" required >
				                    <option value="">Select Session</option>
				
				<?php
									 $query = mysqli_query($conn, "select * from sessions_setup where active = 'Y'"); 
	while (($rows_f = mysqli_fetch_array($query)) != false) {
	 $session_id=$rows_f['SESSION_ID'];
	 $to_date=$rows_f['TO_DATE'];
	 $from_date = $rows_f['FROM_DATE'];
	 
	 ?>
	 <option value="<?php echo $session_id; ?>"><?php echo $from_date." - ".$to_date; ?></option>
<?php
	 }
									
									?>
			
				                         </select>
								</div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-6">
                   <textarea name="remark" id="remark" rows="5" class="form-control"></textarea>
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
				student_promotion();
			?>
          <!-- /.box -->
    
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
              <h3 class="box-title">Student Class Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Student Name</th>
				  <th>Branch</th>
                  <th>Class</th>
				  <th>Section</th>
                  <th>Roll No</th>
				  <th>Active</th>
                  <th>Session</th>
				  <th>Remarks</th>
                 
                  
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"SELECT scc.STUDENT_CURRENT_CLASS, scs.APPLICANT_NAME, cs.CLASS_DESCRIPTION, scc.ACTIVE, csc.SECTION_DESCRIPTION, ss.FROM_DATE,ss.TO_DATE, scc.ROLL_NO, sb.branch_name, scc.REMARKS FROM `student_current_class` as scc JOIN student_current_status as scs on scc.student_id=scs.STUDENT_ID JOIN class_setup as cs on scc.class_id=cs.CLASS_ID JOIN class_setup_section as csc on scc.section_id=csc.SECTION_ID JOIN sessions_setup as ss on scc.session_id=ss.SESSION_ID JOIN school_branches as sb on scc.branch_id=sb.branch_id order by scc.STUDENT_CURRENT_CLASS desc");
            foreach($fetch_emp as $emp)
            {
                $STUDENT_CURRENT_CLASS=$emp['STUDENT_CURRENT_CLASS'];
                $APPLICANT_NAME=$emp['APPLICANT_NAME'];
				$CLASS_DESCRIPTION=$emp['CLASS_DESCRIPTION'];
                $ACTIVE=$emp['ACTIVE'];
				$SECTION_DESCRIPTION=$emp['SECTION_DESCRIPTION'];
                $FROM_DATE=$emp['FROM_DATE'];
				$TO_DATE=$emp['TO_DATE'];
				$ROLL_NO=$emp['ROLL_NO'];
                $branch_name=$emp['branch_name'];
				$remarks=$emp['REMARKS'];
             
			 
						$session=$FROM_DATE." - ".$TO_DATE;
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $APPLICANT_NAME; ?></td>
					  <td><?php echo $branch_name; ?></td>
					  <td><?php echo $CLASS_DESCRIPTION; ?></td>
					 <td><?php echo $SECTION_DESCRIPTION; ?></td>
					  <td><?php echo $ROLL_NO; ?></td>
					  <td><?php echo $ACTIVE; ?></td>
					 <td><?php echo $session; ?></td>
					 <td><?php echo $remarks; ?></td>
					  
					   
					
					<!--<td><span class='action'><a href='edit_promotion_setup.php?edit=<?php echo $STUDENT_CURRENT_CLASS; ?>'>Edit</a></span></td>-->
                    <!--<td><span class='action'><a href='delete.php?brand_id=<?php echo $STUDENT_CURRENT_CLASS; ?>' class='delete show' title='Delete'>X</a></span></td>-->
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
