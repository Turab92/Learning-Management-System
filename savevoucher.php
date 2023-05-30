<?php
 
 include ('include/function.php');


  

 
  $company_id = $_GET['company'];
 $project_id = $_GET['project'];
 $fiscal_year = $_GET['fiscal_year'];
 $v_type = $_GET['v_type'];
 $voucher_date = $_GET['v_date'];
 $cheque_no = $_GET['cheque_no'];
  $cheque_date = $_GET['cheque_date'];
  $receive_by = $_GET['receive_by'];
 $remarks = $_GET['remarks'];


		
 $select_vtype_name = mysqli_query($conn,"select * from voucher_types where voucher_type_id = '$v_type' ");

 while($r = mysqli_fetch_array($select_vtype_name))
 {
	 $vtype_desc = $r['DESCRIPTION'];
 }
 
 if($company_id == null || $project_id == null || $fiscal_year == null || $v_type == null || $voucher_date == null   )
{
	echo "Please Fill All The Mandatory Fields";
}
else
	{

$select_vno = mysqli_query($conn,"select * from v_master where vtype_id = '$v_type' order by vno asc");
      
while($r = mysqli_fetch_array($select_vno))	
{
	$vno = $r['VNO'];
	$vno+=1;
	
}	


$sql = "INSERT INTO V_MASTER (VTYPE,VDATE,REMARKS,CHQDT,CHQNO,VTYPE_ID,PROJECT_ID,COMPANY_ID,FISCAL_YEAR,RECEIVE_BY)".
"VALUES('$vtype_desc','$voucher_date','$remarks','$cheque_date','$cheque_no','$v_type','$project_id','$company_id','$fiscal_year','$receive_by')";
	   $compiled = mysqli_query($conn, $sql);
	
	
	if($compiled){
		
		?>
		

<?php		
		// echo "<center>Voucher Created</center>";
		// echo "<br>";
			///?>
			

			<input type="hidden" id="vouch_no" value="<?php echo $vno; ?>" />
			<section class="content">
			<div class="row">
			<div class="col-md-12">
			<div class="box box-info">
			 <div class="box-header with-border">
					<h4 class="box-title">
				    Voucher Detail
						
						<!-- /.controls -->
					</h4>
				</div>					<!-- /.box-title -->
					<div class="box-body">
					<div class="col-sm-6">
	 			<div class="form-group">
					<label for="inputEmail3" class="col-sm-3 control-label">
	            Select Chart Acc Desc					
</label>				
		 <div class="col-sm-8">
	<select name="head_code"  class="form-control" required onchange="show_head_code(this.value,<?php echo $project_id; ?>,<?php echo $company_id ; ?>,<?php echo $fiscal_year; ?>,<?php echo $v_type; ?>,<?php echo $vno; ?>)"  >
				<option value="" >Select Acc Code </option>
						 <?php 
		  $i=1;
		  
	$r = mysqli_query($conn, "SELECT chart_acc_desc,
       chart_acc_code,
       chart_head_code,
       ACC_DETAIL_TYPE,
       ACCOUNT_TYPE,
       FLG
   from (SELECT b.chart_acc_desc,b.chart_acc_code,b.chart_head_code,C.ACC_DETAIL_TYPE ,H.ACCOUNT_TYPE,d.project_id, FLG from chart_head a, chart_detail b,ACCOUNT_TYPES_DETAIL C,ACCOUNT_TYPES H,Chart_Detail_Project d,CHART_DETAIL_COMPANY R where b.chart_head_code = a.head_code AND  A.ACC_DETAIL_TYPE=C.ACC_DETAIL_TYPE AND  B.ACC_DETAIL_TYPE=C.ACC_DETAIL_TYPE AND  A.ACC_TYPE=H.ACCOUNT_TYPE and b.acc_type=d.acc_type and b.acc_detail_type=d.acc_detail_type and b.chart_head_code=d.chart_head_code and b.chart_acc_code=d.chart_acc_code AND B.ACC_TYPE = R.ACC_TYPE AND B.ACC_DETAIL_TYPE = R.ACC_DETAIL_TYPE AND B.CHART_HEAD_CODE = R.CHART_HEAD_CODE AND B.CHART_ACC_CODE = R.CHART_ACC_CODE AND D.PROJECT_ID = '$project_id' AND R.COMPANY_ID = '$company_id' and ifnull(b.active,'N')='Y' AND  ifnull(D.ACTIVE,'N')='Y') as t
 where project_id = '$project_id'
 ORDER BY chart_acc_desc"); 
	
	while (($rows = mysqli_fetch_array($r)) != false) {
	
$chart_acc_desc = $rows['chart_acc_desc'];
$chart_acc_code = $rows['chart_acc_code'];
$chart_head_code = $rows['chart_head_code'];	 
	 
	 ?>
	<option value="<?php echo $chart_acc_desc; ?>"><?php echo $chart_acc_desc; ?></option>
	
	 
	 <?php
	 
	ini_set('max_execution_time', 500);
	} 

?>
	</select>
</div>	
						<br><br>
						</div>
						</div>
						<br><br>
						<div id="txt2"></div>

					<!-- /.ca/d-cont
					ent -->
				</div>
				<!-- /.box-content card white -->
			</div>
			<!-- /.col-lg-6 col-xs-12 -->
			</div>
			</div>
			</div>
			
			<?php
			//
	}
	else {
		
		echo "Error";
		
	}


//
?>

							
							
<?php
	////
	}
 
?>