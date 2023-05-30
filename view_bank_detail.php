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
	   $dec = base64_decode($_GET['bankid']);
	$r1 = mysqli_query($conn, "select * from BANKS_SETUP where BANK_ID = '$dec'"); 
	
	while (($rows = mysqli_fetch_array($r1)) != false) {
	 $id = $rows['BANK_ID'];		
	 $att_id=$rows['BANK_NAME'];
	 $att_id2=$rows['ACC_TYPE'];
	 $att_id3=$rows['ACC_DETAIL_TYPE'];
$att_id4=$rows['ACC_HEAD_CODE'];
$att_id5=$rows['ACC_CHARTACC_CODE']; 
$att_id6=$rows['BANK_ACCOUNT_NO'];
$active = $rows['ACTIVE'];
$chk = $rows['CHK'];	 
$def = $rows['DEF'];	
$portal_chk = $rows['PORTAL_CHK'];	
	
	}
	

	
					?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Bank Master</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			 <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Bank Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bankname" name="bankname"value="<?php echo $att_id;?>" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">ACC Type</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="acctype" name="acctype" value="<?php echo $att_id2;?>" disabled>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">ACC Detail Type</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="detailtype" name="detailtype" value="<?php echo $att_id3;?>" disabled>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">ACC Head Code</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="headcode" name="headcode" value="<?php echo $att_id4;?>" disabled>
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
				  <div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Chartacc Code</label>

					  <div class="col-sm-6">
						<input type="number" class="form-control" id="chartcode" name="chartcode" value="<?php echo $att_id5;?>" disabled>
					  </div>
					</div>
					<div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Bank Account No</label>

					  <div class="col-sm-6">
						<input type="text" class="form-control" id="accoutno" name="accoutno" value="<?php echo $att_id6;?>" disabled>
					  </div>
					</div>
					
					 
<?php
if($active == 'Y')
{
?>				
					<div class="form-group">
					<div class="col-sm-offset-2 col-md-1">
					<label >Active </label>
					<input type="checkbox"  name="active" value="Y" checked disabled />
					</div>
<?php	
}
else
{
	?>
					<div class="form-group">
					<div class="col-sm-offset-2 col-md-1">
					<label >Active </label>
					<input type="checkbox"  name="active" value="Y" disabled />
					</div>
					
<?php
}
if($chk == 'Y')
{
	?>					
					 <div class="col-sm-offset-3 col-md-1">
					<label >Chk </label>
					<input type="checkbox"  name="chk" value="Y" checked disabled />
					</div>
					</div>
<?php
}
else
{
	?>
					<div class="col-sm-offset-3 col-md-1">
					<label >Chk </label>
					<input type="checkbox"  name="chk" value="Y"  disabled />
					</div>
					</div>
					
					
<?php
}
if($def == 'Y')
{
	?>				
					<div class="form-group">
					<div class="col-sm-offset-2 col-md-1">
					<label >Default </label>
					<input type="checkbox"  name="default" value="Y" checked disabled />
					</div>
<?php
}
else
{
	?>
					<div class="form-group">
					<div class="col-sm-offset-2 col-md-1">
					<label >Default </label>
					<input type="checkbox"  name="default" value="Y" disabled />
					</div>
					
<?php
}
if($portal_chk == 'Y')
{
	?>
					 <div class="col-sm-offset-3 col-md-1">
					<label >Portal</label>
					<input type="checkbox"  name="portal" value="Y" checked  disabled />
					</div>
					</div>
<?php
}
else
{
	?>
					 <div class="col-sm-offset-3 col-md-1">
					<label >Portal</label>
					<input type="checkbox"  name="portal" value="Y" disabled />
					</div>
					</div>
<?php
}
?>				
				</div>
              </div>
              <!-- /.box-body -->
              
            </form>
			
          </div>
		
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	<?php
			if(isset($_GET['bankid']))
			{
				$bank_id = base64_decode($_GET['bankid']);

				$select_bank = mysqli_query($conn,"select *  from banks_setup where bank_id = '$bank_id'  ");
				
				while($r = mysqli_fetch_array($select_bank))
				{
					$bank_name = $r['BANK_NAME'];

				}
				//
				?>
	 <!-- Main content -->
    <section class="content">
      <div class="row">
	  
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h4 class="box-title">Bank Detail ( <?php echo $bank_name; ?> ) </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
               <th>S.No</th>
				<th>Project</th>
				<th>Active</th>
				<th>Active Date</th>
				<th>Edit</th>
               
                </tr>
                </thead>
               
			   <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;								
            $fetch_emp = mysqli_query($conn,"select a.PROJECT_ID,a.BANK_ID,a.ACTIVE_DATE,a.ACTIVE,b.branch_id,b.branch_name from 
bank_detail_project a ,school_branches b where a.PROJECT_ID = b.branch_id and a.BANK_ID = '$bank_id'");
            foreach($fetch_emp as $emp)
            {
				$project_id = $emp['PROJECT_ID'];	
				$bank_id = $emp['BANK_ID'];
				$project_name = $emp['branch_name'];
				$active_date = $emp['ACTIVE_DATE'];
				$active = $emp['ACTIVE'];
				
				
				$enc_prj = base64_encode($project_id);
				$enc_bank = base64_encode($bank_id);
             
                ?>
                
                     <td><?php echo $s_no; ?></td>
					 <td><?php echo $project_name; ?></td> 
					 <td><?php echo $active; ?></td>
					 <td><?php echo $active_date; ?></td>
					
					
					     
					
					<td><?php echo "<a href='edit_bank_detail.php?bank=$enc_bank&prj=$enc_prj'>"; ?>
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
	
	<?php
//
				}
				?>
				
	
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
