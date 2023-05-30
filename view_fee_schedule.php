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
$pagename="View Student Schedule";
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
              <h3 class="box-title">Fee Schedule</h3>
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
				
					<div id="txtHint2"></div>
				
				
					<div id="txtHint1"></div>
			
				
					<div id="txtHint"></div>
			
			
				
			
				
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
			<div class="table-responsive"  style="overflow-y:scroll;">	
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Session</th>
				  <th>Branch</th>
				  <th>Class</th>
				  <th>Section</th>
				  <th>Student</th>
				  <th>Nature</th>
                  <th>Amount</th>
				  <th>Discount</th>
				  <th>Other.Chg</th>
				  <th>Fee Month</th>
				  <th>Receive Date</th>
				  <th>Is Receive</th>
				  <th>Remark</th>
				  <th>Edit</th>
				  
				  
                 
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"SELECT ss.schedule_id, sse.FROM_DATE,sse.TO_DATE, sb.branch_name, cs.CLASS_DESCRIPTION, csc.SECTION_DESCRIPTION, scs.APPLICANT_NAME, np.DESCRIPTION, ss.amount, ss.discount, ss.other_charges, ss.fee_month, ss.receive_date, ss.is_receive, ss.remarks FROM `student_schedule` as ss JOIN sessions_setup as sse on ss.session_id=sse.SESSION_ID JOIN school_branches as sb on ss.branch_id=sb.branch_id JOIN class_setup as cs on ss.class_id=cs.CLASS_ID JOIN class_setup_section as csc on ss.section_id=csc.SECTION_ID JOIN student_current_status as scs on ss.student_id=scs.STUDENT_ID JOIN nature_payments as np on ss.nature_id=np.NATURE_ID where ss.branch_id='$branch' and ss.class_id='$class' and ss.section_id='$section' and ss.student_id='$student_id'");
            foreach($fetch_emp as $emp)
            {
                $schedule_id=$emp['schedule_id'];
                $FROM_DATE=$emp['FROM_DATE'];
				$TO_DATE=$emp['TO_DATE'];
                $branch_name=$emp['branch_name'];
				$CLASS_DESCRIPTION=$emp['CLASS_DESCRIPTION'];
                $SECTION_DESCRIPTION=$emp['SECTION_DESCRIPTION'];
				$APPLICANT_NAME=$emp['APPLICANT_NAME'];
                $DESCRIPTION=$emp['DESCRIPTION'];
				$amount=$emp['amount'];
                $discount=$emp['discount'];
				$other_charges=$emp['other_charges'];
                $fee_month=$emp['fee_month'];
				$receive_date=$emp['receive_date'];
                $is_receive=$emp['is_receive'];
				$remarks=$emp['remarks'];
             
				$FROM=date('Y', strtotime($FROM_DATE));
				$TO=date('Y', strtotime($TO_DATE));
				 $session_date=$FROM."-".$TO;
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $session_date; ?></td>
					<td><?php echo $branch_name; ?></td>
					<td><?php echo $CLASS_DESCRIPTION; ?></td>
					<td><?php echo $SECTION_DESCRIPTION; ?></td>
					<td><?php echo $APPLICANT_NAME; ?></td>
					<td><?php echo $DESCRIPTION; ?></td>
					<td><?php echo $amount; ?></td>
					<td><?php echo $discount; ?></td>
					<td><?php echo $other_charges; ?></td>
					<td><?php echo $fee_month; ?></td>
					<td><?php echo $receive_date; ?></td>
					<td><?php echo $is_receive; ?></td>
					<td><?php echo $remarks; ?></td>
					 
					   
					
					<td><span class='action'><a href='edit_fee_schedule.php?edit=<?php echo $schedule_id; ?>'>Edit</a></span></td>
                   <!-- <td><span class='action'><a href='delete.php?NATURE_ID=<?php echo $NATURE_ID; ?>' class='delete show' title='Delete'>X</a></span></td>-->
           </tr>
                <?php $s_no++; }?>
                

            </tbody>
              </table>
			  </div>
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
