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
$pagename="Fiscal Year";
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
			
function show_project(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
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
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","ajax_fiscal_year.php?q="+str,true);
  xmlhttp.send();
}
</script>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Voucher Types</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Select Company</label>

                  <div class="col-sm-6">
                   <select name="company" class="form-control" required onchange="show_project(this.value)" >
									<option value="">Select Company</option>
									<?php
									$select_company = mysqli_query($conn,"select * from comp_info order by company_id asc ");
									
									while($row = mysqli_fetch_array($select_company))
									{
										$company_id = $row['COMPANY_ID'];
										$company = $row['COMP_NAME'];
										?>
										<option value="<?php echo $company_id;  ?>"><?php echo $company; ?></option>
										<?php
									}
									?>
									</select>
                  </div>
                </div>
				<div id="txtHint"></div>
				
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">From Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="fromdate" name="fromdate">
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">TO Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="todate" name="todate">
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
				fiscal_year();
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
				  <th>Company</th>
				  <th>Project</th>
				   <th>Active</th>
				  <th>From Date</th>
				   <th>To Date</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT fs.SNO, fs.FROM_DATE, fs.TO_DATE, fs.ACTIVE, ci.COMP_NAME, sb.branch_name FROM `fiscal_year` as fs JOIN school_branches as sb on fs.PROJECT_ID=sb.branch_id JOIN comp_info AS ci on fs.COMPANY_ID=ci.COMPANY_ID order by fs.SNO desc");
            foreach($fetch_emp as $emp)
            {
                $SNO=$emp['SNO'];
                $FROM_DATE=$emp['FROM_DATE'];
				 $TO_DATE=$emp['TO_DATE'];
				 $ACTIVE=$emp['ACTIVE'];
				 $COMP_NAME=$emp['COMP_NAME'];
				 $branch_name=$emp['branch_name'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $COMP_NAME; ?></td>
					<td><?php echo $branch_name; ?></td>
					<td><?php echo $ACTIVE; ?></td>
					<td><?php echo $FROM_DATE; ?></td>
					<td><?php echo $TO_DATE; ?></td>
					 
					   
					
					<td><span class='action'><a href='edit_fiscal_year.php?edit=<?php echo $SNO; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?SNO=<?php echo $SNO; ?>' class='delete show' title='Delete'>X</a></span></td>
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
