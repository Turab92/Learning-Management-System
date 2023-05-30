 <?php
  include ('include/function.php');

$chart_acc_desc = $_GET['code'];
$project_id = $_GET['prj'];
$company_id = $_GET['com'];
$fiscal_year = $_GET['fiscal_year'];
$vno = $_GET['vno'];
$v_type = $_GET['v_type'];

 $select_vtype_name = mysqli_query($conn,"select * from voucher_types where voucher_type_id = '$v_type' ");

 while($r = mysqli_fetch_array($select_vtype_name))
 {
	 $vtype_desc = $r['DESCRIPTION'];
 }

$r = mysqli_query($conn, "SELECT chart_acc_desc,chart_acc_code,chart_head_code,ACC_DETAIL_TYPE ,ACCOUNT_TYPE,FLG FROM
(SELECT b.chart_acc_desc,b.chart_acc_code,b.chart_head_code,C.ACC_DETAIL_TYPE ,H.ACCOUNT_TYPE,d.project_id, FLG from chart_head a,
chart_detail b,ACCOUNT_TYPES_DETAIL C,ACCOUNT_TYPES H,Chart_Detail_Project d,CHART_DETAIL_COMPANY R where b.chart_head_code = a.head_code
AND  A.ACC_DETAIL_TYPE=C.ACC_DETAIL_TYPE AND  B.ACC_DETAIL_TYPE=C.ACC_DETAIL_TYPE AND  A.ACC_TYPE=H.ACCOUNT_TYPE and b.acc_type=d.acc_type
and b.acc_detail_type=d.acc_detail_type and b.chart_head_code=d.chart_head_code and b.chart_acc_code=d.chart_acc_code AND B.ACC_TYPE = R.ACC_TYPE
AND B.ACC_DETAIL_TYPE = R.ACC_DETAIL_TYPE AND B.CHART_HEAD_CODE = R.CHART_HEAD_CODE AND B.CHART_ACC_CODE = R.CHART_ACC_CODE
AND D.PROJECT_ID = '$project_id' AND R.COMPANY_ID = '$company_id' and ifnull(b.active,'N')='Y' AND  ifnull(D.ACTIVE,'N')='Y'
) as t
where project_id= '$project_id' and chart_acc_desc = '$chart_acc_desc'
ORDER BY chart_acc_desc"); 
	
	while (($rows = mysqli_fetch_array($r)) != false) {
	
 $chart_acc_desc = $rows['chart_acc_desc'];
 $chart_acc_code = $rows['chart_acc_code'];
 $chart_head_code = $rows['chart_head_code'];	 
 $acc_detail_type = $rows['ACC_DETAIL_TYPE'];
 $account_type = $rows['ACCOUNT_TYPE'];
 
	}
 ?>
 
  <div class="col-lg-12">
 
 <div class="col-lg-4">
						<form class="form-horizontal" method="post" >
					
						
			<div class="form-group">
	<label for="inp-type-1" class="col-md-5" >Head Code</label>		
	<div class="col-md-6">

  <input type="text" style="width:175px; height:20px; font-size:12px;" readonly value="<?php echo $chart_head_code; ?>" id="head_code" />	
	</div>
			</div>
			
			
												<div class="form-group">
									<label for="inp-type-1" class="col-md-5" >Acc Detail Type</label>
								<div class="col-md-6">
				
			<input type="text"  name="acc_detail_type" id="acc_detail_type" style="width:175px; height:20px; font-size:12px;" readonly value="<?php echo $acc_detail_type; ?>" >
								</div>
							</div>
			
			
													<div class="form-group">
					<label for="inp-type-1" class="col-md-5" >Debit</label>
								<div class="col-md-6">
								
<input type="number" name="debit" id="debit" placeholder="Debit..." required style="width:175px; height:20px; font-size:12px;" min="1" >
								</div>
							</div>
							
																					<div class="form-group">
								<label for="inp-type-1" class="col-md-5" >Remarks</label>
			<div class="col-md-6">
<textarea id="remarks_details" cols="24" rows="3" ></textarea>
								</div>
							</div>
							
							</div>

							
							
							<div class="col-lg-4">
							<div class="form-group">
										<label for="inp-type-1" class="col-md-5" >Acc Code</label>
			<div class="col-md-6">

	<input type="text" readonly value="<?php echo $chart_acc_code;?>" id="acc_code"  style="width:175px; height:20px; font-size:12px;" />
								</div>
							</div>
														<br>
							
							<div class="form-group">
											<label for="inp-type-1" class="col-md-5" >Voucher No</label>
			<div class="col-md-6">
				<input type="text" readonly  style="width:175px; height:20px; font-size:12px;" value="<?php echo $vno; ?>"  />
								</div>
							</div>
							
								
														<br><br>
							<div class="form-group">
											<label for="inp-type-1" class="col-md-5" >Credit</label>
								<div class="col-md-6">
								
<input type="number" name="credit" id="credit" placeholder="Credit..." required style="width:175px; height:20px; font-size:12px;" min="1">
								</div>
							</div>
																					<br></br>
							

							</div>
							
							<div class="col-lg-4">
<div class="form-group">
<label for="inp-type-1" class="col-md-5" >Acc Desc</label>
														<div class="col-md-6">
														
	<input type="text" name="chart_acc_desc" id="chart_acc_desc" readonly value="<?php echo $chart_acc_desc; ?>" style="width:175px; height:20px; font-size:12px;" >
								</div>
							</div>
							<br>
														<div class="form-group">
								<label for="inp-type-1" class="col-md-5" >Acc Type</label>
			<div class="col-md-6">
			
	<input type="text" readonly  style="width:175px; height:20px; font-size:12px;" id="acc_type" value="<?php echo $account_type; ?>"  />
								</div>
							</div>
							<br>
								
													<div class="form-group">
					<label for="inp-type-1" class="col-md-5" >Select Supplier</label>
								<div class="col-md-6">
								
			<select id="supplier_type"   style="width:175px; height:20px; font-size:12px;"  >
			<option value="">Select Supplier</option>
			<?php 
			$select_supplier = mysqli_query($conn,"SELECT * 
FROM 
(select A.AG_ID,A.AG_NAME,'S' SUPPLIER_TYPE
from set_supplier_master A 
UNION ALL
select A.AG_ID,A.AG_NAME,'C' SUPPLIER_TYPE
from set_AGENT_master A 
)
ORDER BY AG_NAME
");

while($r = mysqli_fetch_array($select_supplier))
{
	$ag_id = $r['AG_ID'];
	$ag_name = $r['AG_NAME'];
	$supplier_type = $r['SUPPLIER_TYPE'];
	?>
	<option value="<?php echo $ag_id.",".$supplier_type;?>"><?php echo $ag_name; ?></option>
	
	<?php
}
			?>
			
			</select>

								</div>
							</div>
							
							<br>
								
							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-2">
								
 <li class="margin-bottom-10"><button id="btn" onClick="add_detail(<?php echo $project_id; ?>,<?php echo $company_id; ?>,<?php echo $fiscal_year;?>,<?php echo $vno; ?>,<?php echo $v_type; ?>)" 
 class="btn btn-primary btn-bordered waves-effect waves-light">Add Detail</button></li>
								</div>
							</div>
							
							</div>

							</div>


							
							</form>
										
																
							
							
						