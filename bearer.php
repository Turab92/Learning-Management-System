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
$pagename="Bearer";
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
              <h3 class="box-title">Student Bearer</h3>
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
			
			$fetch_emp = mysqli_query($conn,"SELECT scs.STUDENT_ID,scs.APPLICANT_NAME, cs.CLASS_DESCRIPTION,csc.SECTION_DESCRIPTION FROM `student_current_status` as scs join class_setup as cs on scs.class_id = cs.CLASS_ID JOIN class_setup_section as csc on scs.section_id = csc.SECTION_ID WHERE scs.STUDENT_ID ='$grno'");
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
              <h3 class="box-title">Bearer Info</h3>
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
				
				</div>
				 <div class="col-sm-6">
					<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Bearer Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bearname" name="bearname" required>
                  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Bearer Contact</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bearcont" name="bearcont" placeholder="92xx-xxxxxxx" required>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Bearer Change Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="chngdate" name="chngdate">
                  </div>
                </div>
				
				</div>
				 <div class="col-sm-6">
					<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Bearer CNIC</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bearnic" name="bearnic" placeholder="xxxxx-xxxxxxx-x" required>
                  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Date of Issue</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="issuedate" name="issuedate" required>
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
				student_bearer_setup()
		  ?>
	
	
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bearer Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Student Name</th>
				   <th>Bearer Name</th>
				   <th>Bearer CNIC</th>
				   <th>Bearer Contact</th>
				   <th>Branch</th>
				   <th>Left date</th>
				   <th>Active</th>
				   <th>Date of Issue</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT scb.bearer_id, scb.bearer_name, scs.APPLICANT_NAME,sb.branch_name ,scb.bearer_nic, scb.bearer_contact, scb.date_of_issue, scb.change_date, scb.active FROM `student_current_bearer` as scb JOIN student_current_status as scs on scb.student_id=scs.STUDENT_ID JOIN school_branches as sb on scs.BRANCH_ID = sb.branch_id order by scb.bearer_id desc");
            foreach($fetch_emp as $emp)
            {
                $bearer_id=$emp['bearer_id'];
                $bearer_name=$emp['bearer_name'];
                $APPLICANT_NAME=$emp['APPLICANT_NAME'];
                $bearer_nic=$emp['bearer_nic'];
                $bearer_contact=$emp['bearer_contact'];
                $date_of_issue=$emp['date_of_issue'];
                $change_date=$emp['change_date'];
				$active=$emp['active'];
				$branch_name=$emp['branch_name'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $APPLICANT_NAME; ?></td>
					<td><?php echo $bearer_name; ?></td>
					<td><?php echo $bearer_nic; ?></td>
					<td><?php echo $bearer_contact; ?></td>
					<td><?php echo $branch_name; ?></td>
					<td><?php echo $change_date; ?></td>
					<td><?php echo $active; ?></td>
					<td><?php echo $date_of_issue; ?></td>
					   
					
					<td><span class='action'><a href='edit_student_bearer.php?edit=<?php echo $bearer_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?bearer_id=<?php echo $bearer_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
