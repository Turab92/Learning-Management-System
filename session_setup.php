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
$pagename="Session Setup";
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
              <h3 class="box-title">Session Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">To Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="todate" name="todate">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">From Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="fromdate" name="fromdate" >
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Time In</label>

                  <div class="col-sm-6">
                    <input type="time" class="form-control" id="timein" name="timein" >
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
               <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Time Out</label>

                  <div class="col-sm-6">
                    <input type="time" class="form-control" id="timeout" name="timeout" >
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Surcharge</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="inputPassword3" name="surcharge" >
                  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Status</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="status">
                    <option value="Y">Enabled</option>
					<option value="N">Disabled</option>
                  </select>
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
				session_setup();
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
              <h3 class="box-title">Session Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Timn In</th>
                  <th>Time Out</th>
				  <th>Surcharge</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT `SESSION_ID`, `FROM_DATE`, `TO_DATE`, `ACTIVE`, `TIME_IN`, `TIME_OUT`, `SURCHARGE` FROM `sessions_setup`  order by SESSION_ID desc");
            foreach($fetch_emp as $emp)
            {
                $SESSION_ID=$emp['SESSION_ID'];
                $FROM_DATE=$emp['FROM_DATE'];
				$TO_DATE=$emp['TO_DATE'];
                $TIME_IN=$emp['TIME_IN'];
				$TIME_OUT=$emp['TIME_OUT'];
                $SURCHARGE=$emp['SURCHARGE'];
                $ACTIVE=$emp['ACTIVE'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $FROM_DATE; ?></td>
				    <td><?php echo $TO_DATE; ?></td> 
					<td><?php echo $TIME_IN; ?></td>
					<td><?php echo $TIME_OUT; ?></td>
					<td><?php echo $SURCHARGE; ?></td>
					<td><?php echo $ACTIVE; ?></td>
					
					<td><span class='action'><a href='edit_session_setup.php?edit=<?php echo $SESSION_ID; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?SESSION_ID=<?php echo $SESSION_ID; ?>' class='delete show' title='Delete'>X</a></span></td>
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
