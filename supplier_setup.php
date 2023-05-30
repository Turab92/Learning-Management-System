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
$pagename="Supplier Setup";
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
              <h3 class="box-title">Supplier Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Supplier Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="supplier" name="supplier" placeholder="Name" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Address</label>

                  <div class="col-sm-6">
                   <textarea class="form-control" required name="address" ></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Email Address</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="email" name="email" placeholder="email" required>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Phone Number</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="number" name="number" required>
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Supplier Type</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="type" id="type" required>
                    <option value=''>Select Supplier Type</option>
					<?php
							$r=mysqli_query($conn,"select * from supplier_type");
							while ($k=mysqli_fetch_array($r)){
								$SUPPLIER_TYPE_ID=$k['SUPPLIER_TYPE_ID'];
								 $SUPPLIER_TYPE_NAME=$k['SUPPLIER_TYPE_NAME'];
								echo "<option value='$SUPPLIER_TYPE_ID' >$SUPPLIER_TYPE_NAME</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Landline  Number</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="landline" name="landline" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Shipping  Address</label>

                  <div class="col-sm-6">
                   <textarea class="form-control" required name="shipping" ></textarea>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">CNIC Number</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="cnic" name="cnic" required>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">NTN Number</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="ntn" name="ntn" required>
                  </div>
                </div>
				</div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Create Supplier</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		  <?php
				supplier_setup();
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
              <h3 class="box-title">Supplier Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped " >
                <thead>
                <tr>
					  <th>S.No</th>
					  <th>Name</th>
						<th>Email</th>
						<th>Address</th>
						<th>Phone Number</th>
						 <th>Landline</th>
						<th>Shipping Address</th>
						<th>Cnic Number</th>
						<th>NTN number</th>
						<th>Type</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT ss.SUPPLIER_ID, ss.NAME, ss.ADDRESS, ss.EMAIL, ss.PHONE, ss.LANDLINE, ss.SHIPPING_ADD, ss.CNIC, st.SUPPLIER_TYPE_NAME, ss.NTN FROM `supplier_setup` as ss JOIN supplier_type as st on ss.TYPE= st.SUPPLIER_TYPE_ID order by ss.SUPPLIER_ID desc");
            foreach($fetch_emp as $emp)
            {
                $SUPPLIER_ID=$emp['SUPPLIER_ID'];
                $NAME=$emp['NAME'];
				  $EMAIL=$emp['EMAIL'];
                $ADDRESS=$emp['ADDRESS'];
				 $LANDLINE=$emp['LANDLINE'];
                $SHIPPING_ADD=$emp['SHIPPING_ADD'];
				 $CNIC=$emp['CNIC'];
				  $SUPPLIER_TYPE_NAME=$emp['SUPPLIER_TYPE_NAME'];
                $NTN=$emp['NTN'];
				 $PHONE=$emp['PHONE'];
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $NAME; ?></td>
					<td><?php echo $EMAIL; ?></td>
					<td><?php echo $ADDRESS; ?></td> 
					<td><?php echo $PHONE; ?></td>
					<td><?php echo $LANDLINE; ?></td>
					<td><?php echo $SHIPPING_ADD; ?></td>
					<td><?php echo $CNIC; ?></td>
					<td><?php echo $NTN; ?></td> 
					<td><?php echo $SUPPLIER_TYPE_NAME; ?></td>
					   
					<td><span class='action'><a href='edit_supplier.php?edit=<?php echo $SUPPLIER_ID; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?SUPPLIER_ID=<?php echo $SUPPLIER_ID; ?>' class='delete show' title='Delete'>X</a></span></td>
           </tr>
                <?php $s_no++; }?>
                

            </tbody>
                
              </table>
			  </div>
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
