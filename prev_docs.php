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
$pagename="Previous Details";
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
        <!-- left column -->
       
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Student Detail</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
              <div class="box-body">
			
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">G.R No</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="grno" name="grno" placeholder="Enter Student G.R No">
                  </div>
                </div>
             
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
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
	
	<?php
			if(isset($_POST["submit"])){
												
			$grno = $_POST['grno'];
			
			$fetch_emp = mysqli_query($conn,"SELECT scs.STUDENT_ID,scs.APPLICANT_NAME,scs.FATHER_NAME,scs.MOTHER_NAME,sb.branch_name,sb.branch_id, cs.CLASS_DESCRIPTION,csc.SECTION_DESCRIPTION FROM `student_current_status` as scs join class_setup as cs on scs.class_id = cs.CLASS_ID JOIN class_setup_section as csc on scs.section_id = csc.SECTION_ID JOIN school_branches AS sb on scs.branch_id = sb.branch_id WHERE scs.STUDENT_ID ='$grno'");
			$erow=mysqli_fetch_array($fetch_emp);
					 
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
              <h3 class="box-title">Document</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Student ID</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="stdid" name="stdid" value="<?php echo $erow['STUDENT_ID']; ?>" readonly>
                  </div>
                </div>
				    <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Class</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="class" name="class" value="<?php echo $erow['CLASS_DESCRIPTION']; ?>" readonly>
                  </div>
                </div>
				 
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Branch</label>

                  <div class="col-sm-6">
				  <input type="hidden" class="form-control" id="branchid" name="branchid" value="<?php echo $erow['branch_id']; ?>" readonly>
                    <input type="text" class="form-control" id="branch" name="branch" value="<?php echo $erow['branch_name']; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">From date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="fromdate" name="fromdate" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">From Class</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="fromclass" name="fromclass" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Last Class Percent</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="lastpercent" name="lastpercent" required>
                  </div>
                </div>
				
				
				</div>
				
				 <div class="col-sm-6">
					<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Student Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="stdname" name="stdname" value="<?php echo $erow['APPLICANT_NAME']; ?>" readonly>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Section</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="section" name="section" value="<?php echo $erow['SECTION_DESCRIPTION']; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Prevoius Academy</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="previous" name="previous" >
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">To Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="todate" name="todate" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">To Class</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="toclass" name="toclass" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Reason For Left Previous School</label>

                  <div class="col-sm-6">
                    <textarea name="reason" id="reason" rows="4" class="form-control"></textarea>
                  </div>
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
		 
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
			
	 <?php
			}
				student_previous_detail()
		  ?>
	
	
	
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Previous Student Descriptions</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Student Name</th>
				   <th>Branch</th>
				   <th>Previous Academy Name</th>
				   <th>From Date</th>
				   <th>To Date</th>
				   <th>From Class</th>
				   <th>To Class</th>
				   <th>Last Class Present</th>
				   <th>Reason For Left</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT spd.std_prev_id, scs.APPLICANT_NAME,sb.branch_name, spd.academy_name, spd.from_date, spd.to_date, spd.from_class, spd.to_class, spd.last_class_percent, spd.reason_for_left FROM `student_previous_detail` as spd JOIN student_current_status as scs on spd.student_id = scs.student_id JOIN school_branches as sb on scs.BRANCH_ID = sb.branch_id order by spd.std_prev_id desc");
            foreach($fetch_emp as $emp)
            {
                $std_prev_id=$emp['std_prev_id'];
                $APPLICANT_NAME=$emp['APPLICANT_NAME'];
				 $academy_name=$emp['academy_name'];
                $from_date=$emp['from_date'];
				 $to_date=$emp['to_date'];
                $from_class=$emp['from_class'];
				 $to_class=$emp['to_class'];
				 $branch_name=$emp['branch_name'];
                $last_class_percent=$emp['last_class_percent'];
				$reason_for_left=$emp['reason_for_left'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $APPLICANT_NAME; ?></td>
					<td><?php echo $branch_name; ?></td>
					<td><?php echo $academy_name; ?></td>
					<td><?php echo $from_date; ?></td>
					<td><?php echo $to_date; ?></td>
					<td><?php echo $from_class; ?></td>
					<td><?php echo $to_class; ?></td>
					<td><?php echo $last_class_percent; ?></td>
					<td><?php echo $reason_for_left; ?></td>
					   
					
					<td><span class='action'><a href='edit_student_previous_detail.php?edit=<?php echo $std_prev_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?std_prev_id=<?php echo $std_prev_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
