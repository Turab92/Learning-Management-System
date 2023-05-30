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
$pagename="View Fee Voucher";
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
              <h3 class="box-title">Fee Voucher</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">From Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="fromdate" name="fromdate" placeholder="Enter some Text">
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">To Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="todate" name="todate" placeholder="Enter Amount">
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
        
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	<?php
				if(isset($_POST['btnsub']))
				{
					
					$fromdate=$_POST['fromdate'];
					$todate=$_POST['todate'];
				
				?>
	
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Fee Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Chalan No</th>
				  <th>Student Name</th>
				  <th>Father Name</th>
				  <th>Class</th>
				  <th>Fee Month</th>
				  <th>Issue Date</th>
				  <th>Is Print</th>
				  <th>Is Duplicate</th>
				  <th>Is Receive</th>
				  <th>Paid</th>
                  <th>Edit</th>
				  <th>Print</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"SELECT fvm.voucher_id, fvm.challan_no, fvm.issue_date, fvm.due_date, fvm.expiry_date, fvm.branch_id,sb.branch_name, ss.FROM_DATE,ss.TO_DATE, css.SECTION_DESCRIPTION, cs.CLASS_DESCRIPTION, fvm.student_id,scs.APPLICANT_NAME,scs.FATHER_NAME, bs.BANK_ACCOUNT_NO,fm.fee_month,fvm.is_print,fvm.is_duplicate,fvm.is_receive,fvm.not_paid FROM `fee_voucher_master` as fvm JOIN school_branches as sb on fvm.branch_id=sb.branch_id JOIN sessions_setup as ss on fvm.session_id=ss.SESSION_ID JOIN class_setup_section as css on fvm.section_id=css.SECTION_ID JOIN class_setup as cs on fvm.class_id=cs.CLASS_ID JOIN student_current_status as scs on fvm.student_id=scs.STUDENT_ID JOIN banks_setup as bs on fvm.bank_id=bs.BANK_ID JOIN fee_voucher_month as fm on fvm.challan_no=fm.challan_no where  fvm.issue_date between '$fromdate' and '$todate'");
            foreach($fetch_emp as $row)
            {
                 $voucher_id=$row['voucher_id'];
				 $challan_no=$row['challan_no'];
				 $issue_date1=$row['issue_date'];
				 $due_date1=$row['due_date'];
				 $expiry_date1=$row['expiry_date'];
				 $branch_id=$row['branch_id'];
				 $branch_name=$row['branch_name'];
				 $SECTION_DESCRIPTION=$row['SECTION_DESCRIPTION'];
				 $CLASS_DESCRIPTION=$row['CLASS_DESCRIPTION'];
				 $FROM_DATE1=$row['FROM_DATE'];
				 $TO_DATE1=$row['TO_DATE'];
				 $student_id=$row['student_id'];
				 $APPLICANT_NAME = $row['APPLICANT_NAME'];
				 $FATHER_NAME = $row['FATHER_NAME'];
				 $BANK_ACCOUNT_NO = $row['BANK_ACCOUNT_NO'];
				 $fee_month1 = $row['fee_month'];
				 $is_print = $row['is_print'];
				 $is_duplicate = $row['is_duplicate'];
				 $is_receive = $row['is_receive'];
				 $not_paid = $row['not_paid'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $challan_no; ?></td>
					 <td><?php echo $APPLICANT_NAME; ?></td>
					 <td><?php echo $FATHER_NAME; ?></td>
					 <td><?php echo $CLASS_DESCRIPTION; ?></td>
					 <td><?php echo $fee_month1; ?></td>
					  <td><?php echo $issue_date1; ?></td>
					 <td><?php echo $is_print; ?></td>
					 <td><?php echo $is_duplicate; ?></td>
					  <td><?php echo $is_receive; ?></td>
					   
					<?php
					if($is_receive == 1 && $not_paid == 0)
					{
					?>
					<td class="center">Paid</td>
					<td class="center">No Edit</td>
					<td class="center"><a href='view_fee_slip.php?print=<?php echo $challan_no; ?>'  target="_blank"><button  class="btn btn-primary">View Print</button></a></td>				
					<?php
					}
					else if($is_receive == 0 && $not_paid == 1)
					{
					?>	
					<td class="center">Not Paid</td>
					<td class="center">No Edit</td>
					<td class="center"><a href='view_fee_slip.php?print=<?php echo $challan_no; ?>'  target="_blank"><button  class="btn btn-primary">View Print</button></a></td>
					
					<?php	
					}
					else
					{	
					?>
					<td class="center">In Progress</td>
					<td class="center"><a href='edit_fee_voucher.php?edit=<?php echo $challan_no; ?>'  ><button  class="btn btn-primary">Edit</button></a></td>
					<td class="center"><a href='fees_slip_dup_pdf.php?print=<?php echo $challan_no; ?>'  target="_blank"><button  class="btn btn-primary">Print</button></a></td>
					<?php
					}
					?>
					
                   
           </tr>
                <?php $s_no++; }?>
                

            </tbody>
              </table>
            </div>
			<!--<form action="fees_slip_dup_pdf.php" target="_blank" method="POST">
                      <div align="center">
					  <br>
					   
					    <input type="hidden" class="btn btn-primary"  name="fromdate"  value="<?php echo $fromdate ;?>" /> 
						 <input type="hidden" class="btn btn-primary" name="todate"  value="<?php echo $todate ;?>" /> 
                           <input type="submit" class="btn btn-primary"  style="width:80px;" value="Print All" />     <br>               
                       </div>

			</form>-->
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
