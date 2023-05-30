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
$pagename="Alloting Sub Menu";
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
                 function showsubmenu(str) {
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
                     xmlhttp.open("GET","showsubmenu.php?m="+str,true);
                     xmlhttp.send();
                 }
             </script>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Sub Menu Allot</h3>
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
				 <select name="mainmenu" class="form-control" onchange="showsubmenu(this.value);" required>

					<option value="" selected>Select Main Menu</option>
					<?php $main_query="select * from main_menu WHERE  status='Y'";
					$main_run = mysqli_query($conn,$main_query);
					foreach ($main_run as $main) {
						$main_id= $main['m_id'];
						$main_name= $main['menu_title'];
						?>
						<option value="<?php echo $main_id ?>"><?php echo $main_name ?></option>
					<?php } ?>

					</select>
				  </div>
                </div>
				<div class="form-group row">
					<div id="txtHint4"></div>
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
				allot_sub_menu();
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
              <h3 class="box-title">User Alloted Sub Menu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>S.No</th>
                  <th>UserName</th>
                  <th>MainMenu</th>
				  <th>SubMenu</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT e.user_name, ur.report_title, ar.allot_id,mm.menu_title FROM `allot_report_user`as ar join user_reports as ur on ar.report_id=ur.report_id join portal_user as e on ar.user_id=e.user_id join main_menu as mm on ur.parent_id=mm.m_id order by  ar.allot_id desc");
           foreach($fetch_emp as $emp)
            {
                $user_name=$emp['user_name'];
                $report_title=$emp['report_title'];
				$allot_id=$emp['allot_id'];
				$menu_title=$emp['menu_title'];
               
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $user_name; ?></td>
					  <td><?php echo $menu_title; ?></td>
					   <td><?php echo $report_title; ?></td>
					   
					
					<td><span class='action'><a href='edit_allot_submenu.php?edit=<?php echo $allot_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?allot_id=<?php echo $allot_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
  </script>
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
