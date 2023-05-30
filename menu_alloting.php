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
$pagename="Menu Alloting";
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
              <h3 class="box-title">Main Menu Allot</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			
			   <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select User</label>
                   <div class="col-sm-6">
				   <select class="form-control"  name="user" id="user" required>
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select user_id,USER_NAME from portal_user where status = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$user_id=$k['user_id'];
								 $USER_NAME=$k['USER_NAME'];
								echo "<option value='$user_id' >$USER_NAME</option>";
							}
					?>
                  </select>
				  </div>
                </div>
              
				
				
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Main Menu</label>
                   <div class="col-sm-6">
				    <button type="button" class="btn btn-default btn-sm " data-toggle="dropdown"> Select<span class="caret"></span></button>
				  <ul class="dropdown-menu">
					  <div style="height:200px; overflow:auto;"
					  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" onClick="selectall(this)" />&nbsp;&nbsp;&nbsp;Select All</li>
					  <?php

					 $r=mysqli_query($conn,'select m_id,menu_title from main_menu where status = "Y"');
					  foreach($r as $cat)
					  {
						  ?>

						  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="items[]" value="<?php echo $cat['m_id'];  ?>"/>&nbsp;&nbsp;&nbsp;<?php echo $cat['menu_title'];  ?></li>
						  <?php
					  }
					  ?>
                   </div>
                   </ul>
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
			allot_main_menu();
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
              <h3 class="box-title">User Alloted Menu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>S.No</th>
                  <th>UserName</th>
                  <th>Menu</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT am.allot__id,m.menu_title,m.menu_link,u.user_name from allot_main_menu as am join portal_user as u on am.user_id=u.user_id join main_menu as m on am.menu_id=m.m_id order by
			am.allot__id desc");
            foreach($fetch_emp as $emp)
            {
                $allot__id=$emp['allot__id'];
				$user_name=$emp['user_name'];
                $menu_title=$emp['menu_title'];
				
                
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $user_name; ?></td>
					 <td><?php echo $menu_title; ?></td>
					  
					   
					
					<td><span class='action'><a href='edit_allot_main.php?edit=<?php echo $allot__id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?allot__id=<?php echo $allot__id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
   <script>
         function selectall(source) {
             checkboxes = document.getElementsByName('items[]');
             for(var i=0, n=checkboxes.length;i<n;i++) {
                 checkboxes[i].checked = source.checked;
             }
         }
     </script>
  <!--javascript End-->
</body>
</html>
