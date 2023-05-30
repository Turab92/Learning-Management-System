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
$pagename="Banks";
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
              <h3 class="box-title">Bank Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Bank Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bankname" name="bankname" placeholder="Some Text Value" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">ACC Type</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="acctype" name="acctype" placeholder="Some Text Value" required>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">ACC Detail Type</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="detailtype" name="detailtype" placeholder="Some Text Value" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">ACC Head Code</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="headcode" name="headcode" placeholder="Some Text Value" required>
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
				  <div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Chartacc Code</label>

					  <div class="col-sm-6">
						<input type="number" class="form-control" id="chartcode" name="chartcode" placeholder="Some Text Value" required>
					  </div>
					</div>
					<div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Bank Account No</label>

					  <div class="col-sm-6">
						<input type="text" class="form-control" id="accoutno" name="accoutno" placeholder="Some Text Value" required>
					  </div>
					</div>
					<div class="form-group">
					 <div class="col-sm-offset-2 col-md-1">
					<label >Active </label>
					<input type="checkbox"  name="active" value="Y" />
					</div>
					 <div class="col-sm-offset-3 col-md-1">
					<label >Chk </label>
					<input type="checkbox"  name="chk" value="Y" />
					</div>
					</div>
					<div class="form-group">
					 <div class="col-sm-offset-2 col-md-1">
					<label >Default </label>
					<input type="checkbox"  name="default" value="Y" />
					</div>
					 <div class="col-sm-offset-3 col-md-1">
					<label >Portal</label>
					<input type="checkbox"  name="portal" value="Y" />
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
				bank_setup();
			?>
          <!-- /.box -->
    
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
              <h3 class="box-title">Master Bank Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>S.No</th>
				<th>Bank Name</th>
				<th>Account No</th>
				<th>Acc Type</th>
				<th>Acc Detail Type</th>
				<th>H Code</th>
				<th>Acc Code</th>
				<th>Active</th>
				<th>Chk</th>
				<th>Default</th>
				<th>Portal Check</th>
				<th>Add Bank Detail</th>
				  <th>Edit</th>
				   <th></th>
               
                </tr>
                </thead>
               
			   <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;								
            $fetch_emp = mysqli_query($conn,"SELECT `BANK_ID`, `BANK_NAME`, `ACC_TYPE`, `ACC_DETAIL_TYPE`, `ACC_HEAD_CODE`, `ACC_CHARTACC_CODE`,  `ACTIVE`, `BANK_ACCOUNT_NO`, `CHK`, `DEF`, `PORTAL_CHK` FROM `banks_setup` order by BANK_ID desc");
            foreach($fetch_emp as $emp)
            {
                $BANK_ID=$emp['BANK_ID'];
                $BANK_NAME=$emp['BANK_NAME'];
				$ACC_TYPE=$emp['ACC_TYPE'];
                $ACC_DETAIL_TYPE=$emp['ACC_DETAIL_TYPE'];
				$ACC_HEAD_CODE=$emp['ACC_HEAD_CODE'];
                $ACC_CHARTACC_CODE=$emp['ACC_CHARTACC_CODE'];
				$ACTIVE=$emp['ACTIVE'];
                $BANK_ACCOUNT_NO=$emp['BANK_ACCOUNT_NO'];
				$CHK=$emp['CHK'];
                $DEF=$emp['DEF'];
				$PORTAL_CHK=$emp['PORTAL_CHK'];
               $enc = base64_encode($BANK_ID);
             
                ?>
                
                     <td><?php echo $s_no; ?></td>
					<td class="center"><a href="view_bank_detail.php?bankid=<?php echo $enc;?>" title="Click Here To View Bank Detail"><?php echo $BANK_NAME; ?></td></a>
					 <td><?php echo $BANK_ACCOUNT_NO; ?></td>
					 <td><?php echo $ACC_TYPE; ?></td> 
					 <td><?php echo $ACC_DETAIL_TYPE; ?></td>
					 <td><?php echo $ACC_HEAD_CODE; ?></td>
					 <td><?php echo $ACC_CHARTACC_CODE; ?></td>
					 <td><?php echo $ACTIVE; ?></td> 
					 <td><?php echo $CHK; ?></td>
					 <td><?php echo $DEF; ?></td>
					 <td><?php echo $PORTAL_CHK; ?></td> 
					
					     
					 <td><?php echo "<a href='bank_detail.php?bankid=$enc'>"; ?>
                        <button class='btn btn-primary' type='button'>
                            <i class="fa fa-pencil"></i>
                        </button></a>
                    </td>
					<td><?php echo "<a href='edit_bank.php?edit=$enc'>"; ?>
                        <button class='btn btn-primary' type='button'>
                            <i class="fa fa-pencil"></i>
                        </button></a>
                    </td>
                   
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
