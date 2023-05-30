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
$pagename="Create Sub Modules";
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
              <h3 class="box-title">Create Sub Menu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
			   <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Main Menu</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="mainmenu" id="mainmenu">
                    <option value="">Select</option>
					<?php
							$r=mysqli_query($conn,"select m_id,menu_title from main_menu where 	status = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$m_id=$k['m_id'];
								 $menu_title=$k['menu_title'];
								echo "<option value='$m_id' >$menu_title</option>";
							}
					?>
                  </select>
				  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Sub Menu Title</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="submenu" name="submenu" placeholder="Title">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Sub Menu Link</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="link" name="link" placeholder="Link">
                  </div>
                </div>
				
				
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Status</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="status" id="status">
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
                  </select>
				  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Sequence</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="sequence" name="sequence" placeholder="Sequence">
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
			submenu_setup();
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
              <h3 class="box-title">Sub Menu Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Main Menu</th>
                  <th>SubMenu Title</th>
                  <th>Link</th>
                  <th>Seq</th>
				  <th>Status</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT ur.report_id, ur.report_name, ur.report_title, ur.status, mm.menu_title, ur.sequence_id FROM `user_reports` as ur join main_menu as mm on ur.parent_id=mm.m_id order by ur.report_id desc");
            foreach($fetch_emp as $emp)
            {
                $report_id=$emp['report_id'];
                $report_name=$emp['report_name'];
				$report_title=$emp['report_title'];
                $status=$emp['status'];
				$menu_title=$emp['menu_title'];
                $sequence_id=$emp['sequence_id'];
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $menu_title; ?></td>
					  <td><?php echo $report_title; ?></td>
					   <td><?php echo $report_name; ?></td> 
					   <td><?php echo $sequence_id; ?></td>
					    <td><?php
					
					if($status == 'Y')
					{
					?>
					<a href='status.php?report_id=<?php echo $report_id; ?>&status=N'  class='delete show'>Disable</a>
					<?php
					}
					else
					{
					?>
						<a href='status.php?report_id=<?php echo $report_id; ?> &status=Y'  class='delete show' >Enable</a>
					<?php
					}
					?></td>
					
					<td><span class='action'><a href='edit_submenu.php?edit=<?php echo $report_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?report_id=<?php echo $report_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
