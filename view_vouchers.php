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
$pagename="View Posted Vouchers";
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
<div class="modal fade" id="boostrapModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-1">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel-1">Voucher Post Details</h4>
			</div>
			<div class="modal-body">
				<div id="approval_details"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				
			</div>
		</div>
	</div>
</div>
    
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
		 <div class="box-header">
              <h3 class="box-title">View Posted Vouchers</h3>
            </div>
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
					<th>S.No</th>
					<th>Fiscal Year</th>
					<th>Posted</th>
					<th>Vno</th>
					<th>Vtype</th>
					<th>Vdate</th>
					<th>ChqDate</th>
					<th>Chq No</th>
					<th>Remarks</th>
					<th>Acc Type</th>
					<th>Acc Type Desc</th>
					<th>Acc Detail Type</th>
					<th>Acc Detail Type Desc</th>
					<th>Head Desc</th>
					<th>Chart Acc Desc</th>
					<th>Debit</th>
					<th>Credit</th>
					<th>Company</th>
					<th>Project</th>
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"select p.fiscal_year,
       p.posted,
       p.VNO,
       p.VTYPE,p.VTYPE_ID,
       p.vdate,
       p.CHQDT,
       p.CHQNO,
       p.REMARKS,
       p.acc_type,
       p.acc_type_desc,
       p.acc_detail_type,
       p.acc_detail_type_desc,
       p.HEAD_DESC,
       p.CHART_ACC_DESC,
       p.OFF_debit,
       p.OFF_CREDIT,
       p.Total_Debit,
       p.Total_Credit,
	   p.project_id,
       f.comp_name,p.company_id,
       j.branch_name,a.sno,a.from_date,a.to_date
  from posted_vouchers p, comp_info f, school_branches j,fiscal_year a
 where p.company_id = f.company_id
   and p.project_id = j.branch_id 
   and p.fiscal_year = a.sno  order by p.vno asc");
            foreach($fetch_emp as $rows)
            {
				$FISCALYEAR = $rows['FISCAL_YEAR'];
				$POSTED = $rows['POSTED'];
				$VNO = $rows['VNO'];
				$VTYPE = $rows['VTYPE'];
				$VDATE = $rows['VDATE'];
				$CHQDT = $rows['CHQDT'];
				$CHQNO = $rows['CHQNO'];
				$REMARKS = $rows['REMARKS'];
				$ACC_TYPE = $rows['ACC_TYPE'];
				$ACC_TYPE_DESC = $rows['ACC_TYPE_DESC'];
				$ACC_DETAIL_TYPE = $rows['ACC_DETAIL_TYPE'];
				$ACC_DETAIL_TYPE_DESC = $rows['ACC_DETAIL_TYPE_DESC'];
				$HEAD_DESC = $rows['HEAD_DESC'];
				$CHART_ACC_DESC = $rows['CHART_ACC_DESC'];
				$OFF_DEBIT = $rows['OFF_DEBIT'];
				$OFF_CREDIT = $rows['OFF_CREDIT'];
				$TOTAL_DEBIT = $rows['TOTAL_DEBIT'];
				$TOTAL_CREDIT = $rows['TOTAL_CREDIT'];
				$COMP_NAME = $rows['COMP_NAME'];
				$project_name = $rows['BRANCH_NAME'];
				$projctid = $rows['PROJECT_ID'];
				$enc1 = base64_encode($VNO);
				$company_id = $rows['COMPANY_ID'];
				$vtype_id = $rows['VTYPE_ID']; 
				$from_date = $rows['FROM_DATE'];
				$to_date = $rows['TO_DATE'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td class="center"><?php echo $from_date."-".$to_date; ?></td>
		
 <td class="center"><a href="#" title="Click Here For Voucher Post Details" data-toggle="modal" data-target="#boostrapModal-2" onclick="approval_details(<?php echo $projctid;?>,<?php echo $VNO;?>,<?php echo $vtype_id;?>,<?php echo $company_id; ?>,<?php echo $FISCALYEAR; ?>)" ><?php echo $POSTED; ?></a></td>
		 
	<td class="center"><a href="voucher_detail?p=<?php echo base64_encode($projctid); ?>&v=<?php echo base64_encode($VNO); ?>&t=<?php echo base64_encode($VTYPE);?>&c=<?php echo base64_encode($company_id);?>&f=<?php echo base64_encode($FISCALYEAR); ?>" target="_blank" title="Click to see voucher" ><?php echo $VNO; ?></a></td>
		<td class="center"><?php echo $VTYPE; ?></td>
		<td class="center"><?php echo $VDATE; ?></td>
		<td class="center"><?php echo $CHQDT; ?></td>
		<td class="center"><?php echo $CHQNO; ?></td>
		<td class="center"><?php echo $REMARKS; ?></td>
		<td class="center"><?php echo $ACC_TYPE; ?></td>
		<td class="center"><?php echo $ACC_TYPE_DESC; ?></td>
		<td class="center"><?php echo $ACC_DETAIL_TYPE; ?></td>
		<td class="center"><?php echo $ACC_DETAIL_TYPE_DESC; ?></td>
		<td class="center"><?php echo $HEAD_DESC; ?></td>
		<td class="center"><?php echo $CHART_ACC_DESC; ?></td>
		<td class="center"><?php echo $TOTAL_DEBIT; ?></td>
		<td class="center"><?php echo $TOTAL_CREDIT; ?></td>
		<td class="center"><?php echo $COMP_NAME; ?></td>
		<td class="center"><?php echo $project_name; ?></td>
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
<script>

function approval_details(project_id,voucher_no,vtype_id,company_id,fiscal_year)
{
	
$("#approval_details").load("voucher_posted_details.php?project_id="+project_id+"&voucher_no="+voucher_no+"&vtype="+vtype_id+"&company_id="+company_id+"&fiscal_year="+fiscal_year);
}
	
</script>	
	
	
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
