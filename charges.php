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
$pagename="Charges Type";
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
              <h3 class="box-title">Charges Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="descrip" name="descrip" placeholder="Enter some Text">
                  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Nature</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="nature" id="nature">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select `NATURE_ID`,`DESCRIPTION` from nature_payments where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$NATURE_ID=$k['NATURE_ID'];
								 $DESCRIPTION=$k['DESCRIPTION'];
								echo "<option value='$NATURE_ID' >$DESCRIPTION</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Royalty Percent</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="percent" name="percent" placeholder="Enter some value">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Royalty fix</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="fix" name="fix" placeholder="Enter some value">
                  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">On Admission</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="admission" id="admission">
				  <option value="">Status</option>
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">On Siblings</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="sibling" id="sibling">
				  <option value="">Status</option>
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Status</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="status" id="status">
				  <option value="">Status</option>
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
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
				charges_setup();
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
              <h3 class="box-title">Charges Types</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
				  <th>Description</th>
				  <th>Royality Percent</th>
				  <th>Royality Fix</th>
				  <th>Active</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT CHARGE_TYPE_ID, CHARGES_DESCRIPTION, ACTIVE, ROYALITY_PERCENT, ROYALITY_FIX FROM `charges_types` order by CHARGE_TYPE_ID desc");
            foreach($fetch_emp as $emp)
            {
                $CHARGE_TYPE_ID=$emp['CHARGE_TYPE_ID'];
                $CHARGES_DESCRIPTION=$emp['CHARGES_DESCRIPTION'];
				 $ROYALITY_PERCENT=$emp['ROYALITY_PERCENT'];
                $ROYALITY_FIX=$emp['ROYALITY_FIX'];
				 $ACTIVE=$emp['ACTIVE'];
                
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $CHARGES_DESCRIPTION; ?></td>
					 <td><?php echo $ROYALITY_PERCENT; ?></td>
					<td><?php echo $ROYALITY_FIX; ?></td>
					 <td><?php echo $ACTIVE; ?></td>
					
					
					 
					   
					
					<td><span class='action'><a href='edit_charges.php?edit=<?php echo $CHARGE_TYPE_ID; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?CHARGE_TYPE_ID=<?php echo $CHARGE_TYPE_ID; ?>' class='delete show' title='Delete'>X</a></span></td>
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
