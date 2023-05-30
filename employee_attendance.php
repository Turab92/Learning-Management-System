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
$pagename="Employees Attendance";
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
              <h3 class="box-title">Employee Attendance</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="">
              <div class="box-body">
			
			   <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Date</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="date" name="date" value="<?php echo $time ?>" readonly>
                  </div>
                </div>
				<script>

function iptKeyUp(e) {
    e.which = e.which || e.keyCode;
    if(e.which == 13) {
    var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","ajax_employee_attendance.php?q="+document.getElementById("id").value+"&&in="+document.getElementById("in").checked+"&&out="+
	document.getElementById("out").checked+"&&branch="+document.getElementById("branch").value,false);
	xmlhttp.send(null);
	document.getElementById("txtHint4").innerHTML=xmlhttp.responseText;
	document.getElementById("id").focus();
	document.getElementById("id").value='';
	//document.getElementsByName('txt')[0].value= xmlhttp.responseText;
    }
}
</script>	
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch">
                   
					<?php
							$r=mysqli_query($conn,"select branch_id,branch_name from school_branches where active = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$branch_id=$k['branch_id'];
								 $branch_name=$k['branch_name'];
								echo "<option value='$branch_id' >$branch_name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				
				
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Employee RF ID</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="id" name="id" onkeyup="iptKeyUp(event)" autofocus >
                  </div>
                </div>
				
				<div class="col-sm-6">
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">IN</label>

                  <div class="col-sm-6">
                    <input type="radio" style="min-width:100px; min-height:30px;" id="in" name="check" checked>
                  </div>
                </div>
				</div>
				<div class="col-sm-6">
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">OUT</label>

                  <div class="col-sm-6">
                    <input type="radio" style="min-width:100px; min-height:30px;"  id="out" name="check" >
                  </div>
                </div>
				</div>
			</div>
             
             
            </form>
          </div>
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

	<div id="txtHint4"></div>
			
	
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
