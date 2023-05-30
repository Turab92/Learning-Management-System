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
      <?php
	  $request_id = base64_decode($_GET['id']);  

$select_request = mysqli_query($conn,"select * from purchase_request_master a , supplier_setup b , portal_user c ,school_branches d 
where a.req_id = '$request_id' and b.supplier_id  = a.req_from and a.user_id = c.user_id and d.branch_id = a.branch_id ");
while (($rows = mysqli_fetch_array($select_request)) != false) {
	
	$req_id = $rows['REQ_ID'];
	$req_date = $rows['REQ_DATE'];
	$remarks = $rows['REMARKS'];
	$name = $rows['NAME'];
	$user_name = $rows['USER_NAME'];
	$branch_name = $rows['branch_name'];
	 
	}

?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Request ID</label>

                  <div class="col-sm-6">
                  <input type="text" class="form-control" readonly  value="<?php echo $req_id; ?>"/>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Request Date</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" readonly  value="<?php echo $req_date; ?>" />
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Request From</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" readonly  value="<?php echo $name; ?>" />
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
					<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Branch Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" readonly  value="<?php echo $branch_name; ?>"/>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Comments</label>

                  <div class="col-sm-6">
                    <textarea class="form-control" id="comments" ></textarea>
                  </div>
                </div>
				</div>
              </div>
              <!-- /.box-body -->
           
            </form>
			<div class="col-md-10">
   
   <?php
   $select_request = mysqli_query($conn,"select * from purchase_request_approval where req_id = '$request_id' ");
   $selected_request_rows = mysqli_num_rows($select_request);
   
   if($selected_request_rows == 0)
   {
	   ?>
	
  <div align="center">
   <button class="btn btn-primary" onclick="show();" id="btn_request" > Request</button>
   </div>   
	   <?php
   }
   else
   {
	   ?>
	   
  <div align="center">
   <button class="btn btn-primary" onclick="show();" id="btn_request" disabled > Request</button>
   </div>
	   <?php
   }
   
   ?>
   
  
    <br>
<p align="center" id="wait" style="display:none;">Please Wait</p>
  
  <div id="d1"></div>

  <script>
  
  function show()
  {
	  document.getElementById("wait").style.display="block";
	      setTimeout("insert_record()", 1000);  // 5 seconds
  }
  
  function insert_record()
  {
	
var comments = document.getElementById("comments").value;
  var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","script_request.php?request_id="+<?php echo $request_id; ?>+"&&comments="+document.getElementById("comments").value,false);
	xmlhttp.send(null);
	
   var text =	document.getElementById("d1").innerHTML=xmlhttp.responseText;
	
document.getElementById("wait").style.display="none";
	document.getElementById("btn_request").disabled = true;
	
  }
  </script>
  
 </div>
 <br><br><br><br>
          </div>
		
		
		<div class="box-content">
					
					<div class="card">
			
			<div id="load"></div>
			
			</div>
				
				<!-- /.box-content -->
				</div>
    
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
  <script type="text/javascript">
$(document).ready(function(){
      doRefresh();
    });

    function doRefresh(){
		
        $("#load").load("request_approval_script.php?request_id="+<?php echo $request_id;?>);
    }
    $(function() {
        setInterval(doRefresh, 2000);
    });
</script>
  <!--javascript End-->
</body>
</html>
