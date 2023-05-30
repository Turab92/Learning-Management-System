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
					
				
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="date" name="date" required>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Attendance</label>

                  <div class="col-sm-6">
                    
					<select class="form-control" id="attendance" name="attendance" >
                     <option value=''>Select All</option>
					 <option value='Y'>Present</option>
					 <option value='N'>Absent</option>
					
					 
					
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
        
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>

<?php
				if(isset($_POST['btnsub']))
				{
					
					$branch=$_POST['branch'];
					$class=$_POST['class'];
					$section=$_POST['section'];
					$date=$_POST['date'];
					$attendance=$_POST['attendance'];
				
				?>
	
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Attendance Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
				  <th>Branch</th>
				  <th>Class</th>
				  <th>Section</th>
				  <th>Student Name</th>
				  <th>Date</th>
				   <th>Attendance</th>
				  
                  <th></th>
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            if($attendance=='Y')
			{
				$fetch_emp = mysqli_query($conn,"SELECT DISTINCT scs.STUDENT_ID,da.PRESENT, da.ATT_DATE, scs.APPLICANT_NAME, cs.CLASS_DESCRIPTION, csc.SECTION_DESCRIPTION, sb.branch_name FROM student_current_status as scs JOIN daily_attendance as da on scs.STUDENT_ID not in (select d.ATTENDENT_ID from daily_attendance d) JOIN class_setup as cs on da.CLASS_ID=cs.CLASS_ID JOIN class_setup_section as csc on da.SECTION_ID=csc.SECTION_ID JOIN school_branches as sb on da.BRANCH_ID=sb.branch_id where da.BRANCH_ID='$branch' and da.CLASS_ID='$class' and da.SECTION_ID='$section' and da.ATT_DATE='$date' and scs.LEFT_DATE is null");
				
				//$attend="Present";
			}
			else if($attendance=='N')
			{
				$fetch_emp = mysqli_query($conn,"SELECT da.ATT_DATE,da.PRESENT, scs.APPLICANT_NAME, cs.CLASS_DESCRIPTION, csc.SECTION_DESCRIPTION, sb.branch_name FROM `daily_attendance` as da JOIN student_current_status as scs on da.ATTENDENT_ID=scs.STUDENT_ID JOIN class_setup as cs on da.CLASS_ID=cs.CLASS_ID JOIN class_setup_section as csc on da.SECTION_ID=csc.SECTION_ID JOIN school_branches as sb on da.BRANCH_ID=sb.branch_id where da.BRANCH_ID='$branch' and da.CLASS_ID='$class' and da.SECTION_ID='$section' and da.ATT_DATE='$date' and scs.STUDENT_ID =da.ATTENDENT_ID  and scs.LEFT_DATE is null");
				
				//$attend="Absent";
			}
			else
			{
				$fetch_emp = mysqli_query($conn,"SELECT DISTINCT scs.STUDENT_ID,da.PRESENT, da.ATT_DATE, scs.APPLICANT_NAME, cs.CLASS_DESCRIPTION, csc.SECTION_DESCRIPTION, sb.branch_name FROM student_current_status as scs JOIN daily_attendance as da on scs.STUDENT_ID not in (select d.ATTENDENT_ID from daily_attendance d) JOIN class_setup as cs on da.CLASS_ID=cs.CLASS_ID JOIN class_setup_section as csc on da.SECTION_ID=csc.SECTION_ID JOIN school_branches as sb on da.BRANCH_ID=sb.branch_id where da.BRANCH_ID='$branch' and da.CLASS_ID='$class' and da.SECTION_ID='$section' and da.ATT_DATE='$date' and scs.LEFT_DATE is null
				UNION
				SELECT scs.STUDENT_ID,da.PRESENT,da.ATT_DATE, scs.APPLICANT_NAME, cs.CLASS_DESCRIPTION, csc.SECTION_DESCRIPTION, sb.branch_name FROM `daily_attendance` as da JOIN student_current_status as scs on da.ATTENDENT_ID=scs.STUDENT_ID JOIN class_setup as cs on da.CLASS_ID=cs.CLASS_ID JOIN class_setup_section as csc on da.SECTION_ID=csc.SECTION_ID JOIN school_branches as sb on da.BRANCH_ID=sb.branch_id where da.BRANCH_ID='$branch' and da.CLASS_ID='$class' and da.SECTION_ID='$section' and da.ATT_DATE='$date' and scs.STUDENT_ID =da.ATTENDENT_ID  and scs.LEFT_DATE is null");
				
			}
			
            
            foreach($fetch_emp as $row)
            {
                 $ATT_DATE=$row['ATT_DATE'];
				 $APPLICANT_NAME=$row['APPLICANT_NAME'];
				 $PRESENT=$row['PRESENT'];
				 $CLASS_DESCRIPTION=$row['CLASS_DESCRIPTION'];
				 $SECTION_DESCRIPTION=$row['SECTION_DESCRIPTION'];
				 $branch_name=$row['branch_name'];
				
				if($PRESENT=='N')
				{
					$attend="Absent";
				}
				else
				{
					$attend="Present";
				}
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $branch_name; ?></td>
					 <td><?php echo $CLASS_DESCRIPTION; ?></td>
					 <td><?php echo $SECTION_DESCRIPTION; ?></td>
					 <td><?php echo $APPLICANT_NAME; ?></td>
					 <td><?php echo $ATT_DATE; ?></td>
					 <td><?php echo $attend; ?></td>
					  
					 
					   
					
					
           </tr>
                <?php $s_no++; }?>
                

            </tbody>
              </table>
            </div>
			<form action="fees_slip_dup_pdf.php" target="_blank" method="POST">
                      <div align="center">
					  <br>
					   
					    <input type="hidden" class="btn btn-primary"  name="branch"  value="<?php echo $branch ;?>" /> 
						 <input type="hidden" class="btn btn-primary" name="class"  value="<?php echo $class ;?>" /> 
						  <input type="hidden" class="btn btn-primary"  name="section"  value="<?php echo $section ;?>" /> 
						 <input type="hidden" class="btn btn-primary" name="date"  value="<?php echo $date ;?>" />
						 <input type="hidden" class="btn btn-primary" name="attendance"  value="<?php echo $attendance ;?>" />
						 
                           <input type="submit" class="btn btn-primary"  style="width:80px;" value="Print All" />     <br>                <!-- /.panel -->
                       </div>

			</form>
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
