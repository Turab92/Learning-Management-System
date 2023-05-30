<?php
include ('include/function.php');
$bank=$_GET['bank'];
$ref=$_GET['ref'];
$for_month = date('Y/m/d', strtotime($_GET['for_month']));
$payrolldate=date('Y/m/d', strtotime($_GET['payrolldate']));
$payrolltype=$_GET['payrolltype'];
$cheqno=$_GET['cheqno'];
$user=$_GET['user'];
$branch=$_GET['branch'];
$project=$_GET['project'];
$post="Y";

$r1 = mysqli_query($conn, "select MAX(TRNO) as TRANS_ID from monthly_payroll_master order by trno ASC"); 
	while (($rows1 = mysqli_fetch_array($r1)) != false) {
	 $att_id1=$rows1['TRANS_ID'];
	}
	$trans=$att_id1+1;
	
	$sql="INSERT INTO monthly_payroll_master (FOR_THE_MONTH,PC_IP,USER_ID,TRANS_DATE,PAYROLL_TYPE,BRANCH_ID,BANK_ID,CHEAQUE_NO,POST,PAYROLL_REFERENCE,PAYROLL_DATE,PROJECT_ID) VALUES ('$for_month','$ip','$user','$customized_date','$payrolltype','$branch','$bank','$cheqno','$post','$ref','$payrolldate','$project')";
	    $compiled = mysqli_query($conn, $sql);
	  

if($compiled){
	
//$cursor=mysqli_query($conn, "begin proc_generate_payroll ('$project',$for_month,'$payrolltype'); end;"); 
		//if($cursor)
		//{
			?>
			
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Monthly Details</h4>
					<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Emp Name</th>
								<th>WDays</th>
								<th>Rate</th>
								<th>Salary</th>
								<th>Allowances</th>
								<th>Other Insentives</th>
								<th>Leaves</th>
								<th>Loan</th>
								<th>Advance</th>
								<th>Other Deduction</th>
								<th>Curr Month Pay</th>
							</tr>
						</thead>
						
						<tbody>
						 <?php 
		  $i=1;
	$tot_pay=0;	  
	$r = mysqli_query($conn, "select e.EMP_NAME,
       t.WDAYS,
       t.PAYRATE,
	   t.SALARY,
       t.ALLOWANCES,
       t.OTHER_INSENTIVES,
       t.LEAVES,
       t.LOAN,
       t.ADVANCE,
       t.OTHER_DEDUCTION,
       t.CURR_MONTH_PAY
  from monthly_payroll t, employees e
 where t.emp_id = e.emp_id
 and t.trno='$trans'"); 

	while (($rows = mysqli_fetch_array($r)) != false) {
	

    $EMPNAME = $rows['EMP_NAME'];
    $WDAYS = $rows['WDAYS'];
	$PAYRATE = $rows['PAYRATE'];
	$SALARY = $rows['SALARY'];
	$ALLOWANCES = $rows['ALLOWANCES'];	
   $OTHER_INSENTIVES = $rows['OTHER_INSENTIVES'];
   $LEAVES = $rows['LEAVES'];
   $LOAN = $rows['LOAN'];   
   $ADVANCE = $rows['ADVANCE'];   
   $OTHER_DEDUCITON = $rows['OTHER_DEDUCTION'];   
   $CURR_MONTH_PAY = $rows['CURR_MONTH_PAY'];   
   $tot_pay += array_sum(array($CURR_MONTH_PAY));
	 
	 //$enc = base64_encode($report_id);
	 
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
		 <td class="center"><?php echo $EMPNAME; ?></td>
		 <td class="center"><?php echo $WDAYS; ?></td>
		 <td class="center"><?php echo $PAYRATE; ?></td>
		 <td class="center"><?php echo $SALARY; ?></td>
		 <td class="center"><?php echo $ALLOWANCES; ?></td>
		 <td class="center"><?php echo $OTHER_INSENTIVES; ?></td>
		 <td class="center"><?php echo $LEAVES; ?></td>
		 <td class="center"><?php echo $LOAN; ?></td>
		 <td class="center"><?php echo $ADVANCE; ?></td>
		 <td class="center"><?php echo $OTHER_DEDUCITON; ?></td>
		 <td class="center"><?php echo $CURR_MONTH_PAY; ?></td>
        
                </tr>
          <?php $i++;}  ?>
		  
		  <tr>
		  <td class="center"></td>
		 <td class="center"></td>
		 <td class="center"></td>
		 <td class="center"></td>
		 <td class="center"></td>
		 <td class="center"></td>
		 <td class="center"></td>
		 <td class="center"></td>
		 <td class="center"></td>
		 <td class="center"></td>
		 <td class="center">Total : </td>
		 <td class="center"><?php echo $tot_pay; ?></td>
        
                </tr>
		  
		  
		  
												</tbody>
				</table>
					</div>
				</div>
				<!-- /.box-content -->
			</div>
			
		<?php
		//}
}
else
{
	echo "Error";
}
?>