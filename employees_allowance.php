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
$pagename="Employees Allowances";
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
                     xmlhttp.open("GET","showemployee.php?m="+str,true);
                     xmlhttp.send();
                 }
             </script>
			 
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Employees Allowances</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			
			  <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="branch" id="branch" onchange="showsubmenu(this.value);">
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
                  </select>
				  </div>
                </div>
				<div class="form-group">
					<div id="txtHint4"></div>
				</div>
				
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Allowance</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="allowance" id="allowance">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select allowance_id,allowance_name from allowances where status = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$allowance_id=$k['allowance_id'];
								 $allowance_name=$k['allowance_name'];
								echo "<option value='$allowance_id' >$allowance_name</option>";
							}
					?>
                  </select>
                  </select>
				  </div>
                </div>
				
				
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Allowance Amount</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="amount" name="amount">
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
				employee_allowance_setup();
			?>
        </div>
        <!--/.col (right) -->
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
