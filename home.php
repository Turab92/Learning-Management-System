<?php
session_start();
include ('include/function.php');

if($_SESSION['name'] ==""){

    echo "<script>alert('You must Login to continue')</script>";
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
$id1= $_SESSION['name'];
$usr=mysqli_query($conn,"select * from portal_user WHERE USER_NAME='$id1'");
while ($y=mysqli_fetch_array($usr)){
    $userid=$y['user_id'];
    $username=$y['USER_NAME'];
	$branch_id = $y['branch_id'];
}
if(isset($_GET['mid']))
		{
$mainmenuid= base64_decode($_GET['mid']);
$menu_id=$_SESSION['menu_id'] = $mainmenuid;
		}
		else
		{
$menu_id=$_SESSION['menu_id'];			
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
     
    </section><br><br>
<link rel="stylesheet" href="include/main.css">
   <!-- Modal -->
  <div class="modal fade" id="branch" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">School Branches</h4>
        </div>
        <div class="modal-body">
         <div id="allBranch"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  

  <!--Past Employees-->
  
  <div class="modal fade" id="pastemp" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Employees Joined Past Six Months</h4>
        </div>
        <div class="modal-body">
         <div id="pastEmployees"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  <!--Past Student-->
  
  <div class="modal fade" id="paststd" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Students Admitted Past Six Months</h4>
        </div>
        <div class="modal-body">
         <div id="pastStudents"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  
  
    <!-- Modal -->
  <div class="modal fade" id="student" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Students</h4>
        </div>
        <div class="modal-body">
         <div id="allStudent"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

    <!-- Modal -->
  <div class="modal fade" id="employee" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Employees</h4>
        </div>
        <div class="modal-body">
		
         <div id="allEmployee"></div>
		 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  <script>
function branch() {
	
        $("#allBranch").load("show_all_branch.php");
    
}

function student(str) {
	
        $("#allStudent").load("show_all_students.php?id="+str);
    
}

function employee(str) {
	
        $("#allEmployee").load("show_all_employees.php?id="+str);
    
}

function past_students(str) {
	
        $("#pastStudents").load("past_students.php?id="+str);
    
}

function past_employees(str) {
	
        $("#pastEmployees").load("past_employees.php?id="+str);
    
}

</script>

<div id="wrapper">
	<div class="main-content">
	
			<div class="row small-spacing">
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico fa fa-bank text-inverse"></i>
<?php						
	if($id1 == 'admin')
	{
		$total = mysqli_query($conn,"select count(branch_id) from school_branches where active = 'Y'");
		
		while($row = mysqli_fetch_array($total))
		{
			$branch_count = $row['count(branch_id)'];
		}
		
?>
    <h4 class="counter text-inverse" ><?php echo $branch_count; ?></h4>
	<a href="#" title="Click Here For School Branches"><p onclick="branch()" data-toggle="modal" data-target="#branch">Total Branches</p></a>

<?php
	}
	else if ($branch_id != null)
	{
				$select_branch = mysqli_query($conn,"select branch_name from school_branches where branch_id = '$branch_id' ");
		
		while($row = mysqli_fetch_array($select_branch))
		{
			$branch_name = $row['branch_name'];
		}
	?>	
				<h5 class="counter text-inverse"><?php echo $branch_name; ?></h5>
						<p class="text">Branch Name</p>
		
		<?php
	}
?>	
					
					</div>
				</div>
				<!-- /.box-content -->
			</div>
			
			<!-- /.col-lg-3 col-md-6 col-xs-12 -->
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico fa fa-user text-success"></i>
						
						<?php						
	if($id1 == 'admin')
	{
		$total = mysqli_query($conn,"select count(student_id) from student_current_status");
		
		while($row = mysqli_fetch_array($total))
		{
			$student_count = $row['count(student_id)'];
		}
		
?>

	<h4 class="counter text-success" ><?php echo $student_count; ?></h4>
	<a href="#" title="Click Here For Student Details"><p onclick="student(<?php echo 0;?>)" data-toggle="modal" data-target="#student">Total Student</p></a>	
		
<?php
	}
	else if ($branch_id != null)
	{
		$total = mysqli_query($conn,"select count(student_id) from student_current_status where branch_id = '$branch_id' ");
		
		while($row = mysqli_fetch_array($total))
		{
			$student_count = $row['count(student_id)'];
		}
		
?>
    		<h4 class="counter text-success"><?php echo $student_count; ?></h4>
						<a href="#" title="Click Here For Student Details"><p onclick="student(<?php echo $branch_id;?>)" data-toggle="modal" data-target="#student">Total Student</p></a>	
		
		<?php
	}
?>						
					
					</div>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-3 col-md-6 col-xs-12 -->
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico fa fa-users text-primary"></i>
					

	<?php						
	if($id1 == 'admin')
	{
		$total = mysqli_query($conn,"select count(emp_id) from employees");
		
		while($row = mysqli_fetch_array($total))
		{
			$employee_count = $row['count(emp_id)'];
		}
		
?>
    		<h4 class="counter text-primary"><?php echo $employee_count; ?></h4>
	<a href="#" title="Click Here For Employee Details"><p onclick="employee(<?php echo 0; ?>)" data-toggle="modal" data-target="#employee">Total Employees</p></a>		
<?php
	}
	else if ($branch_id != null)
	{
		$total = mysqli_query($conn,"select count(employee_id) from employees_current_branch where branch_id = '$branch_id' ");
		
		while($row = mysqli_fetch_array($total))
		{
			$employee_count = $row['count(employee_id)'];
		}
		
?>
    		<h4 class="counter text-primary"><?php echo $employee_count; ?></h4>
			<a href="#" title="Click Here For Employee Details"><p onclick="employee(<?php echo $branch_id; ?>)" data-toggle="modal" data-target="#employee">Total Employees</p></a>
		
		<?php
	}
?>										
					
					
					</div>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-3 col-md-6 col-xs-12 -->
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico fa fa-bar-chart-o text-info"></i>
						
									<?php						
	if($id1 == 'admin')
	{

$select = mysqli_query($conn,"select count(student_id) from student_current_Status a 
where '$trans_date' - trans_date <= 180 and '$trans_date' - trans_date > 0 ");

while($rows = mysqli_fetch_array($select))
{
     $recent_student_count = $rows['count(student_id)'];
}
		
?>
    		<h4 class="counter text-info"><?php echo $recent_student_count; ?></h4>
			
		<a href="#" title="Click Here For Recently Admitted Students"><p onclick="past_students(<?php echo 0; ?>)" data-toggle="modal" data-target="#paststd">Student Admitted Past Six Months</p></a>
<?php
	}
	else if ($branch_id != null)
	{
$select = mysqli_query($conn,"select count(student_id) from student_current_Status a 
where '$trans_date' - trans_date <= 180 and '$trans_date' - trans_date > 0 and branch_id = '$branch_id'");

while($rows = mysqli_fetch_array($select))
{
     $recent_student_count = $rows['count(student_id)'];
}
		
?>
    		<h4 class="counter text-info"><?php echo $recent_student_count; ?></h4>
			<a href="#" title="Click Here For Recently Admitted Students"><p onclick="past_students(<?php echo $branch_id; ?>)" data-toggle="modal" data-target="#paststd">Student Admitted Past Six Months</p></a>
		
		<?php
	}
?>
					
					</div>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-3 col-md-6 col-xs-12 -->
			
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content">
					<div class="statistics-box with-icon">
<i class="ico ti-user text-primary"></i>
						
									<?php						
	if($id1 == 'admin')
	{

$select = mysqli_query($conn,"select count(emp_id) from employees 
where '$trans_date' - date_of_joining <= 180 and '$trans_date' - date_of_joining > 0 ");

while($rows = mysqli_fetch_array($select))
{
     $recent_employee_count = $rows['count(emp_id)'];
}
		
?>
    		<h4 class="counter text-info"><?php echo $recent_employee_count; ?></h4>
							<a href="#" title="Click Here For Recently Admitted Employees"><p onclick="past_employees(<?php echo 0; ?>)" data-toggle="modal" data-target="#pastemp">Employees Admitted Past Six Months</p></a>	
<?php
	}
	else if ($branch_id != null)
	{
$select = mysqli_query($conn,"select count(emp_id) from employees a ,employees_current_branch e 
where '$trans_date' - date_of_joining <= 180 and '$trans_date' - date_of_joining > 0
and a.emp_id = e.employee_id and e.branch_id = '$branch_id'");

while($rows = mysqli_fetch_array($select))
{
     $recent_employee_count = $rows['count(emp_id)'];
}
		
?>
    		<h4 class="counter text-info"><?php echo $recent_employee_count; ?></h4>
							<a href="#" title="Click Here For Recently Employees"><p onclick="past_employees(<?php echo $branch_id; ?>)" data-toggle="modal" data-target="#pastemp">Employees Admitted Past Six Months</p></a>
		<?php
	}
?>
					
					</div>
				</div>
				<!-- /.box-content -->
			</div>
			
			
		</div>
		<!-- .row -->
	
<div class="row small-spacing">
			<!-- /.col-lg-4 col-xs-12 -->
</div>
<div class="row row-inline-block small-spacing">
			

<div class="col-lg-6 col-xs-12">
<div class="box-content">
<h4 class="box-title">Student Attendance</h4>
<!-- /.box-title -->
					
<div class="table-responsive"  style="overflow-y:scroll; height:500px;">				
<table class=" example table table-striped table-bordered display" >
						<thead>
							<tr>
								<th>S.No</th>
								<th>Student</th>
								<th>Date</th>
								<th>Time In</th>
								<th>Time Out</th>
								<th>Class</th>
								<th>Section</th>
								<th>Branch</th>

								</tr>
						</thead>
						<tfoot>
							<tr>
								<th>S.No</th>
								<th>Student</th>
								<th>Date</th>
								<th>Time In</th>
								<th>Time Out</th>
								<th>Class</th>
								<th>Section</th>
								<th>Branch</th>

								
						</tfoot>
						<tbody>
						 <?php 
		  $i=1;

		 include ('include/config.php');

		  if($id1 == 'admin')
		  {
$rs = mysqli_query($conn, "select a.att_date,a.TIME_IN,a.attendent_id,a.attendent_type,a.present,a.class_id,a.section_id,a.branch_id,a.TIME_OUT,b.student_id,b.applicant_name,b.branch_id,
c.class_id,c.class_description,d.section_id,d.section_description,e.branch_id,e.branch_name
 from daily_attendance a,student_current_status b,class_setup c,class_setup_section d,school_branches e
where a.attendent_id = b.student_id and a.class_id = c.class_id and a.section_id = d.section_id and b.branch_id = e.branch_id
 and a.attendent_type = 'S' order by a.att_date desc"); 
		  }
		  else if($branch_id != null)
		  {
  
  $rs = mysqli_query($conn, "select a.att_date,a.TIME_IN,a.attendent_id,a.attendent_type,a.present,a.class_id,a.section_id,a.branch_id,a.TIME_OUT,b.student_id,b.applicant_name,b.branch_id,
c.class_id,c.class_description,d.section_id,d.section_description,e.branch_id,e.branch_name
 from daily_attendance a,student_current_status b,class_setup c,class_setup_section d,school_branches e
where a.attendent_id = b.student_id and a.class_id = c.class_id and a.section_id = d.section_id and b.branch_id = e.branch_id 
and b.branch_id = '$branch_id' and a.attendent_type = 'S' order by a.att_date desc");
  
		  }

	
	while (($rows = mysqli_fetch_array($rs)) != false) {
		
    $time_in = $rows['TIME_IN'];
	$present = $rows['present'];
	$att_date = $rows['att_date'];
	$time_out = $rows['TIME_OUT'];
	$student = $rows['applicant_name'];
	$class = $rows['class_description'];
	$section = $rows['section_description'];
	
	$branch_name = $rows['branch_name'];
	
	$enc = base64_encode($id);
	 
	 
	 
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
		 <td class="center"><?php echo $student; ?></td>
		 <td class="center"><?php echo $att_date; ?></td>
       <td class="center"><?php echo $time_in; ?></td>
	   <td class="center"><?php echo $time_out; ?></td>	
		 <td class="center"><?php echo $class; ?></td>
	 <td class="center"><?php echo $section; ?></td>
		 <td class="center"><?php echo $branch_name; ?></td>

                </tr>
          <?php $i++;}  ?>
												</tbody>
				</table>
</div>
				</div>
				<!-- /.box-content -->
			</div>

			
			<div class="col-lg-6 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Employee Attendance</h4>
					<!-- /.box-title -->
					
					<div class="table-responsive"  style="overflow-y:scroll; height:500px;">
					
										<table class=" table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Employee</th>
								<th>Date</th>
								<th>Time In</th>
								<th>Time Out</th>								
         						<th>Designation</th>
								<th>Branch</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
							<th>S.No</th>
								<th>Employee</th>
								<th>Date</th>
								<th>Time In</th>
								<th>Time Out</th>
         						<th>Designation</th>
								<th>Branch</th>
								
						</tfoot>
						<tbody>
						 <?php 
		  $i=1;

		 include ('include/config.php');

		  if($id1 == 'admin')
		  {
$rs = mysqli_query($conn, "select a.emp_id,a.emp_name,b.att_date,b.TIME_IN,b.TIME_OUT,b.attendent_id,a.designation_id,b.attendent_type,b.present,b.branch_id,c.branch_id,c.branch_name,d.designation_id,d.designation_name from employees a, daily_attendance b ,designation d,
school_branches c where a.emp_id = b.attendent_id and b.attendent_type = 'E' and b.branch_id = c.branch_id and a.designation_id = d.designation_id order by ATT_DATE DESC,TIME_IN DESC,TIME_OUT DESC");
		  }
		  else if($branch_id != null)
		  {
$rs = mysqli_query($conn, "select a.emp_id,a.emp_name,b.att_date,b.TIME_IN,b.TIME_OUT,b.attendent_id,a.designation_id,b.attendent_type,b.present,b.branch_id,c.branch_id,c.branch_name,d.designation_id,d.designation_name from employees a, daily_attendance b ,designation d,
school_branches c where a.emp_id = b.attendent_id and b.attendent_type = 'E' and b.branch_id = c.branch_id and b.branch_id = '$branch_id' and a.designation_id = d.designation_id order by ATT_DATE DESC,TIME_IN DESC,TIME_OUT DESC");
		  }
 
	
	while ($rows = mysqli_fetch_array($rs)) {
		
    $time_in = $rows['TIME_IN'];
	$time_out = $rows['TIME_OUT'];
	$att_date = $rows['att_date'];
	$branch_name = $rows['branch_name'];
	$designation = $rows['designation_name'];
	$emp_name = $rows['emp_name'];
	$enc = base64_encode($id);
	 
	ini_set('max_execution_time', 500);
	
	?>
	
	 <td class="center"><?php echo $i; ?></td>
		 <td class="center"><?php echo $emp_name; ?></td>
		 <td class="center"><?php echo $att_date; ?></td>		 
       <td class="center"><?php echo $time_in; ?></td>
	   <td class="center"><?php echo $time_out; ?></td>
<td class="center"><?php echo $designation; ?></td>
<td class="center"><?php echo $branch_name;?></td>        
                </tr>
          <?php $i++;}  ?>
												</tbody>
				</table>

				</div>
				
				</div>
				<!-- /.box-content -->
			</div>

			</div>
			

		<!-- /.row row-inline-block small-spacing -->		
	
	</div>
	
	<!-- /.main-content -->
</div>
	
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
