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
$pagename="Student Contact Details";
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
              <h3 class="box-title">Student House</h3>
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
                  <label for="inputEmail3" class="col-sm-3 control-label">Father Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $erow['FATHER_NAME']; ?>" readonly>
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
                  <label for="inputEmail3" class="col-sm-3 control-label">Father Contact</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="fcontact" name="fcontact" placeholder="92" required>
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
                  <label for="inputEmail3" class="col-sm-3 control-label">Mother Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $erow['MOTHER_NAME']; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Mother Contact</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="mcontact" name="mcontact" placeholder="92" >
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
				student_parent_contact()
		  ?>
	
	
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">House Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Student Name</th>
				   <th>Father Name</th>
				   <th>Father Contact</th>
				   <th>Mother Name</th>
				   <th>Mother Contact</th>
				   <th>Branch</th>  
				   <th>Active</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT spc.parent_cont_id, spc.father_name, spc.father_contact, spc.mother_name, spc.mother_contact, spc.active, scs.APPLICANT_NAME, sb.branch_name FROM `student_parent_contact` as spc JOIN student_current_status as scs on spc.student_id = scs.student_id JOIN school_branches as sb on spc.branch_id = sb.branch_id order by spc.parent_cont_id desc");
            foreach($fetch_emp as $emp)
            {
				$parent_cont_id=$emp['parent_cont_id'];
                $father_name=$emp['father_name'];
				$father_contact=$emp['father_contact'];
                $mother_name=$emp['mother_name'];
				$mother_contact=$emp['mother_contact'];
                $active=$emp['active'];
				$APPLICANT_NAME=$emp['APPLICANT_NAME'];
                $branch_name=$emp['branch_name'];
				
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $APPLICANT_NAME; ?></td>
					<td><?php echo $father_name; ?></td>
					<td><?php echo $father_contact; ?></td>
					<td><?php echo $mother_name; ?></td>
					<td><?php echo $mother_contact; ?></td>
					<td><?php echo $branch_name; ?></td>
					<td><?php echo $active; ?></td>
					
					   
					
					<td><span class='action'><a href='edit_student_parent_contact.php?edit=<?php echo $parent_cont_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?parent_cont_id=<?php echo $parent_cont_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
