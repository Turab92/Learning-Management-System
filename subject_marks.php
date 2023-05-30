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
$pagename="Subject Marks";
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
	
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Class Wise Subject Marks</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="GET" action="">
              <div class="box-body">
			
			    <div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Select Class</label>
					<div class="col-sm-6">
					 <select class="form-control"  name="class" id="class" required>
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select CLASS_ID, CLASS_DESCRIPTION from class_setup where  active = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$CLASS_ID=$k['CLASS_ID'];
								 $CLASS_DESCRIPTION=$k['CLASS_DESCRIPTION'];
								echo "<option value='$CLASS_ID' >$CLASS_DESCRIPTION</option>";
							}
					?>
                
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
		  
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	<?php
				if(isset($_GET['btnsub']))
				{
					
					$class=$_GET['class'];
					
					$sub=mysqli_query($conn,"SELECT csa.assign_sub_id, csa.class_id, csa.subject_id,s.sub_name FROM `class_subject_assign` as csa JOIN subjects as s on csa.subject_id=s.sub_id WHERE csa.class_id ='$class'");
					
					
				
				?>
	
	 <!-- Main content -->
    <section class="content">
      <div class="row">
	
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Class Wise Subject</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <?php
			 foreach($sub as $emp)
            {
				$subject_id=$emp['subject_id'];
				$sub_name=$emp['sub_name'];
				
			?>
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-1 control-label">Subject:</label>
					<div class="col-sm-3">
					 <input type="text" class="form-control" name="name" value="<?php echo $sub_name; ?>" readonly>
					  <input type="hidden" class="form-control" name="subject[]" value="<?php echo $subject_id; ?>">
					</div>
					<label  for="inputPassword3" class="col-sm-1 control-label">Total Marks:</label>
					<div class="col-sm-3">
					 <input type="text" class="form-control"  name="total[]" required>
					</div>
					<label  for="inputPassword3" class="col-sm-1 control-label">Passing Marks:</label>
					<div class="col-sm-3">
					 <input type="text" class="form-control"  name="pass[]" required>
					</div>
					<input type="hidden" class="form-control" id="class" name="class" value="<?php echo $class; ?>">
					</div>
					
					
			<?php
			}
			?>
			</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsave" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		  <?php
			subject_marks();
		  ?>
		  
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	<?php
				}
	?>
	
		 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Subject Marks Detail</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Class</th>
				  <th>Subject</th>
                  <th>Total Marks</th>
				  <th>Passing Marks</th>
                  <th>Edit</th>
				  
                 
                  
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"SELECT csm.cs_mark_id, c.CLASS_DESCRIPTION, s.sub_name, csm.total_marks, csm.passing_marks FROM `class_subject_marks` as csm JOIN class_setup as c on csm.class_id=c.CLASS_ID JOIN subjects as s on csm.subject_id=s.sub_id order by csm.cs_mark_id desc");
            foreach($fetch_emp as $emp)
            {
                $cs_mark_id=$emp['cs_mark_id'];
				$CLASS_DESCRIPTION=$emp['CLASS_DESCRIPTION'];
                $sub_name=$emp['sub_name'];
				$total_marks=$emp['total_marks'];
                $passing_marks=$emp['passing_marks'];
				
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $CLASS_DESCRIPTION; ?></td>
					  <td><?php echo $sub_name; ?></td>
					  <td><?php echo $total_marks; ?></td>
					 <td><?php echo $passing_marks; ?></td>
					 
					   
					
					<td><span class='action'><a href='edit_subject_mark.php?edit=<?php echo $cs_mark_id; ?>'>Edit</a></span></td>
                    <!--<td><span class='action'><a href='delete.php?brand_id=<?php echo $cs_mark_id; ?>' class='delete show' title='Delete'>X</a></span></td>-->
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
