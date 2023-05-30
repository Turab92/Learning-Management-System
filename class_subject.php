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
$pagename="Assign Subject To Class";
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
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Class Subject</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Class</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="class" id="class">
                     <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select CLASS_ID,CLASS_DESCRIPTION from class_setup where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$CLASS_ID=$k['CLASS_ID'];
								 $CLASS_DESCRIPTION=$k['CLASS_DESCRIPTION'];
								echo "<option value='$CLASS_ID' >$CLASS_DESCRIPTION</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Subject</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="subject" id="subject">
                   <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select sub_id,sub_name from subjects ");
							while ($k=mysqli_fetch_array($r)){
								$sub_id=$k['sub_id'];
								 $sub_name=$k['sub_name'];
								echo "<option value='$sub_id' >$sub_name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
               
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Subject Type</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="subtype" id="subtype">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select sub_type_id,sub_type_name from subject_type");
							while ($k=mysqli_fetch_array($r)){
								$sub_type_id=$k['sub_type_id'];
								 $sub_type_name=$k['sub_type_name'];
								echo "<option value='$sub_type_id' >$sub_type_name</option>";
							}
					?>
                  </select>
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
          <?php
				class_subject_setup();
			?>
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
              <h3 class="box-title">Class Subject Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Class</th>
                  <th>Subject</th>
                  <th>Subject Type</th> 
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
            $fetch_emp = mysqli_query($conn,"SELECT cba.assign_sub_id, cs.CLASS_DESCRIPTION, s.sub_name,st.sub_type_name FROM `class_subject_assign` as cba JOIN class_setup as cs on cba.class_id=cs.CLASS_ID JOIN subjects as s on cba.subject_id=s.sub_id join subject_type as st on cba.subject_type_id=st.sub_type_id order by cba.assign_sub_id desc");
            foreach($fetch_emp as $emp)
            {
                $assign_sub_id=$emp['assign_sub_id'];
                $CLASS_DESCRIPTION=$emp['CLASS_DESCRIPTION'];
				$sub_name=$emp['sub_name'];
                $sub_type_name=$emp['sub_type_name'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $CLASS_DESCRIPTION; ?></td>
				    <td><?php echo $sub_name; ?></td>
					<td><?php echo $sub_type_name; ?></td> 
					  
					
					<td><span class='action'><a href='edit_class_subject.php?edit=<?php echo $assign_sub_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?assign_sub_id=<?php echo $assign_sub_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
