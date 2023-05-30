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
$pagename="Account Chart Company";
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
<script>
function showStudent2(str) {
  if (str=="") {
    document.getElementById("txtHint3").innerHTML="";
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
      document.getElementById("txtHint3").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","coan4_ajax.php?p="+str,true);
  xmlhttp.send();
}
</script>

        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Chart of Account Company</h3>
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
				  <div id="txtHint3"></div>
			 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Account Type</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="company" id="company" required>
                    <option value=''>Select Company</option>
					<?php
							$r=mysqli_query($conn,"select * from comp_info");
							while ($k=mysqli_fetch_array($r)){
								$COMPANY_ID=$k['COMPANY_ID'];
								 $COMP_NAME=$k['COMP_NAME'];
								echo "<option value='$COMPANY_ID' >$COMP_NAME</option>";
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
         <?php
				chart_company();
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
				   <th>Company Name</th>
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
            $fetch_emp = mysqli_query($conn,"select a.account_type_desc as adesc,
a.acc_detail_type_desc as bdesc,
a.head_desc,
a.chart_acc_desc,
e.comp_name,f.tr_no
from chart_account a,
comp_info e,
chart_detail_company f
where a.account_type = f.acc_type
and a.acc_detail_type = f.acc_detail_type
and a.head_code = f.chart_head_code
and a.chart_acc_code = f.chart_acc_code
and e.company_id = f.company_id order by  f.tr_no desc");
            foreach($fetch_emp as $emp)
            {
                $TR_NO=$emp['tr_no'];
				
                $COMP_NAME=$emp['comp_name'];
				 $CHART_ACC_DESC=$emp['chart_acc_desc'];
				 $ACC_DESCRIPTION=$emp['adesc'];
				 $DESCRIPTION=$emp['bdesc'];
				 $HEAD_DESC=$emp['head_desc'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $ACC_DESCRIPTION; ?></td>
					<td><?php echo $DESCRIPTION; ?></td>
					<td><?php echo $HEAD_DESC; ?></td>
					<td><?php echo $CHART_ACC_DESC; ?></td>
					<td><?php echo $COMP_NAME; ?></td>
					 
					   
					
					<td><span class='action'><a href='edit_coan4.php?edit=<?php echo $TR_NO; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?TR_NO=<?php echo $TR_NO; ?>' class='delete show' title='Delete'>X</a></span></td>
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
    <script>
         function selectall(source) {
             checkboxes = document.getElementsByName('items[]');
             for(var i=0, n=checkboxes.length;i<n;i++) {
                 checkboxes[i].checked = source.checked;
             }
         }
     </script>
</body>
</html>
