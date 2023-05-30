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
$pagename="Allot Items";
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
              <h3 class="box-title">Allot Items</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch Name</label>
                   <div class="col-md-6">
  
				<select name="branch" class="form-control" required />
				<option value="">Select Branch</option>										
			<?php
									
					$select_branch = mysqli_query($conn,"select * from school_branches where active='Y'  ");	
					while($row = mysqli_fetch_array($select_branch))
					{
						$classic_id = $row['branch_id'];
						$classic_name = $row['branch_name'];
						?>
						<option value="<?php echo $classic_id; ?> "><?php echo $classic_name;?></option>
						<?php
					}
					
					?>
					</select>
					</div>
                </div>
			 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Item Name</label>
                   <div class="col-md-6">
  
				<select name="item" class="form-control" required />
					<option value="">Select Item</option>										
				<?php
									
					$select_item = mysqli_query($conn,"select * from item_setup2  ");	
					while($row = mysqli_fetch_array($select_item))
					{
						$item_id = $row['ITEM_ID'];
						$item_name = $row['ITEM_NAME'];
						?>
						<option value="<?php echo $item_id; ?> "><?php echo $item_name;?></option>
						<?php
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
				allot_item();
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
              <h3 class="box-title">Item Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                   <th>Items</th>
					<th>Branch</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT ai.TR_NO, its.ITEM_NAME,b.branch_name FROM `allot_items` AS ai JOIN school_branches b on ai.BRANCH_ID=b.branch_id JOIN item_setup2 AS its on ai.ITEM_ID=its.ITEM_ID  order by ai.TR_NO desc");
            foreach($fetch_emp as $emp)
            {
               $allot_item_id = $emp['TR_NO'];
			   $item_name = $emp['ITEM_NAME'];
			   $branch_name = $emp['branch_name'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $item_name; ?></td>
					<td><?php echo $branch_name; ?></td>
					 
					   
					
					<td><span class='action'><a href='edit_allot_item.php?edit=<?php echo $allot_item_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?allot_item_id=<?php echo $allot_item_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
