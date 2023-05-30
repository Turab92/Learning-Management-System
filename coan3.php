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
$pagename="Account Chart Desc";
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
function showClass(str) {
  if (str=="") {
    document.getElementById("txtHint2").innerHTML="";
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
      document.getElementById("txtHint2").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","coan2_ajax.php?q="+str,true);
  xmlhttp.send();
}
</script>
<script>
function showStudent(str) {
  if (str=="") {
    document.getElementById("txtHint1").innerHTML="";
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
      document.getElementById("txtHint1").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","coan3_ajax.php?p="+str,true);
  xmlhttp.send();
}
</script>

        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Chart of Account Code</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Account Type</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type" id="type" required onchange="showClass(this.value)">
                    <option value=''>Select Account Type</option>
					<?php
							$r=mysqli_query($conn,"select * from account_types");
							while ($k=mysqli_fetch_array($r)){
								$ACCOUNT_TYPE=$k['ACCOUNT_TYPE'];
								 $ACC_DESCRIPTION=$k['ACC_DESCRIPTION'];
								echo "<option value='$ACCOUNT_TYPE' >$ACC_DESCRIPTION</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				 <div id="txtHint2"></div>
				  <div id="txtHint1"></div>
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="descrip" name="descrip" placeholder="description">
                  </div>
                </div>
				 <div class="col-sm-offset-1 col-md-2">
					<label><b>Active</b> <input type="checkbox" name="class_check" value="Y" /></label>
					
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
				account_code();
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
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Account Type</th>
				  <th>Nature</th>
				  <th>Head Code</th>
				  <th>Head Code Desc</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT cd.CHART_HEAD_CODE, cd.CHART_ACC_CODE, cd.CHART_ACC_DESC, act.ACC_DESCRIPTION, atd.DESCRIPTION,ch.HEAD_DESC  FROM `chart_detail` as cd JOIN chart_head as ch on cd.CHART_HEAD_CODE=ch.HEAD_CODE JOIN account_types as act on cd.ACC_TYPE=act.ACCOUNT_TYPE JOIN account_types_detail as atd on cd.ACC_DETAIL_TYPE= atd.ACC_DETAIL_TYPE");
            foreach($fetch_emp as $emp)
            {
                $CHART_HEAD_CODE=$emp['CHART_HEAD_CODE'];
                $CHART_ACC_CODE=$emp['CHART_ACC_CODE'];
				 $CHART_ACC_DESC=$emp['CHART_ACC_DESC'];
				 $ACC_DESCRIPTION=$emp['ACC_DESCRIPTION'];
				 $DESCRIPTION=$emp['DESCRIPTION'];
				 $HEAD_DESC=$emp['HEAD_DESC'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $ACC_DESCRIPTION; ?></td>
					<td><?php echo $DESCRIPTION; ?></td>
					<td><?php echo $HEAD_DESC; ?></td>
					<td><?php echo $CHART_ACC_DESC; ?></td>
					 
					   
					
					<td><span class='action'><a href='edit_coan3.php?edit=<?php echo $CHART_HEAD_CODE; ?>&edit2=<?php echo $CHART_ACC_CODE; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?del=<?php echo $CHART_HEAD_CODE; ?>&del2=<?php echo $CHART_ACC_CODE; ?>' class='delete show' title='Delete'>X</a></span></td>
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
