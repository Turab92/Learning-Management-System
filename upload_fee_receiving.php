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
$pagename="Upload Fee Receiving";
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
	  
			
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Upload Fee Receiving</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
			
			 
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Upload CSV File:</label>
                   <div class="col-sm-6">
				   <input type="file" name="file" id="BSbtninfo">
				  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">List Name:</label>
                   <div class="col-sm-6">
				    <input type="text" name="list_name" class="form-control" id="pwd">
				  </div>
                </div>
				
			
				
			
				
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="import" class="btn btn-primary col-md-offset-3 col-md-6">Add</button>
              </div>
              <!-- /.box-footer -->
            </form>
<script>
$('#BSbtndanger').filestyle({
buttonName : 'btn-danger',
		buttonText : ' File selection'
});
$('#BSbtnsuccess').filestyle({
buttonName : 'btn-success',
		buttonText : ' Open'
});
$('#BSbtninfo').filestyle({
buttonName : 'btn-primary',
		buttonText : ' Select a File'
});                        
</script>
          </div>
        
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	
	<?php 
if(isset($_POST["import"]))
{
    
    
    
    //mysqli_select_db($conn) or die (mysql_error());
    $filename=$_FILES['file']["tmp_name"];
    if($_FILES['file']["size"] > 0)
    {
       $file = fopen($filename, "r");
      //$sql_data = "SELECT * FROM prod_list_1 ";
      $list=$_POST['list_name'];

      $count = 0;                                         // add this line
      while (($emapData = fgetcsv($file, 30000, ",")) !== FALSE)
      {
          //print_r($emapData);
          //exit();
          $count++;                                      // add this line
		  
			//$old_date = date($emapData[13]);            // works
			$middle = strtotime($emapData[0]);             // returns bool(false)
			$mysqldate1 = date('d-m-y', $middle);
			
			
          if($count>1){                                  // add this line
            $sql = "INSERT INTO `student_fee_receiving`(`transaction_date`, `activity_branch`, `DIB_ref_no`, `payment_type`, `GRNO`, `Dr_Cr`, `PKR_Amount`) VALUES  ('$mysqldate1','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]')";
            mysqli_query($conn,$sql);
          }                                              // add this line
		 
      }
	  
	 
	   $arr=mysqli_query($conn,"SELECT GRNO from student_fee_receiving");
	  
				while ($rowss = mysqli_fetch_array($arr))
				{
					$challan_no=$rowss['GRNO'];
					
					$update12 = mysqli_query($conn,"UPDATE `fee_voucher_master` SET `is_receive`='1' WHERE challan_no='$challan_no'");
				}
    }
    else
        echo 'Invalid File:Please Upload CSV File';
}
?>
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Fee Receiving Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Transaction Date</th>
                  <th>Activity Branch</th>
                  <th>DIB Ref #</th>
				  <th>Payment Type</th>
                  <th>GR.NO</th>
                  <th>Dr/Cr</th>
				  <th>PKR Amount</th>
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"SELECT `fee_receive_id`, `transaction_date`, `activity_branch`, `DIB_ref_no`, `payment_type`, `GRNO`, `Dr_Cr`, `PKR_Amount` FROM `student_fee_receiving` order by fee_receive_id desc");
            foreach($fetch_emp as $emp)
            {
                $fee_receive_id=$emp['fee_receive_id'];
                $transaction_date=$emp['transaction_date'];
				$activity_branch=$emp['activity_branch'];
				$DIB_ref_no=$emp['DIB_ref_no'];
				$payment_type=$emp['payment_type'];
				$GRNO=$emp['GRNO'];
				$Dr_Cr=$emp['Dr_Cr'];
				$PKR_Amount=$emp['PKR_Amount'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $transaction_date; ?></td>
					<td><?php echo $activity_branch; ?></td>
					<td><?php echo $DIB_ref_no; ?></td>
					<td><?php echo $payment_type; ?></td>
					<td><?php echo $GRNO; ?></td>
					<td><?php echo $Dr_Cr; ?></td>
					<td><?php echo $PKR_Amount; ?></td>
					 
					   
					
					
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
