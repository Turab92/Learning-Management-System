<?php
 
include ('include/function.php');
error_reporting(1);

session_start();

$message = base64_encode(1);



	
  $project_id = $_GET['project'];
  $company_id = $_GET['company']; 
 $fiscal_year = $_GET['fiscal'];
 $v_no = $_GET['vno'];
 $v_type = $_GET['v_type'];
  $head_code = $_GET['head_code'];
  $chart_acc_desc = $_GET['chart_acc_desc'];
 $acc_code = $_GET['acc_code'];
  $debit = $_GET['debit'];
 $credit = $_GET['credit'];
 $acc_detail_type = $_GET['acc_detail_type'];
 $acc_type = $_GET['acc_type'];
 $remarks = $_GET['remarks'];
 $supplier_array = $_GET['supplier_type']; 
 
 $array = explode(',',$supplier_array);
 $supplier_id = $array[0];
 $supplier_type = $array[1];
 
  $select_vtype_name = mysqli_query($conn,"select * from voucher_types where voucher_type_id = '$v_type' ");

 while($r = mysqli_fetch_array($select_vtype_name))
 {
	 $vtype_desc = $r['DESCRIPTION'];
 }
 
 // if($debit == null && $credit == null)
 // {
	 // echo "<center>Please Fill Debit Or Credit Field</center>";
 // }
 // else if($supplier_array == null)
 // {
	 // echo "<center>Please Select Supplier</center>";
 // }
 // else if($debit != null && $credit != null)
 // {
	 // echo "<center>Sorry Please Enter Debit Or Credit Field</center>";
 // }
 // else
 // {
	 ///
	
$select_detail = mysqli_query($conn,"select *  from v_detail where vno = '$v_no' and vtype = '$vtype_desc' and head_code = '$head_code' and chart_acc_code = '$acc_code' and company_id = '$company_id' and fiscal_year = '$fiscal_year' and project_id = '$project_id' ");

$select_detail_rows = mysqli_fetch_all($select_detail,$selected_detail);

if($select_detail_rows == 0)
{
	
	
$sql = "INSERT INTO V_DETAIL (VNO,VTYPE,HEAD_CODE,CHART_ACC_CODE,DEBIT,CREDIT,ACC_DETAIL_TYPE,ACC_TYPE,COMPANY_ID,FISCAL_YEAR,PROJECT_ID,REMARKS,SUPNO,SUPTYPE)".
 "VALUES('$v_no','$vtype_desc','$head_code','$acc_code','$debit','$credit','$acc_detail_type','$acc_type','$company_id','$fiscal_year','$project_id','$remarks','$supplier_id','$supplier_type')";
	   $compiled = mysqli_query($conn, $sql);

	if($compiled){
 
 
?>
   <style>
   th,td{
	   font-size:12px;
	   
   }
   </style>	
     <div class="box">
   <div class="box-body">
					<table id="example1" class="table table-bordered table-striped" style="width:100%">
						<thead>
							<tr>
								<th>S.No</th>
                              <th>Acc Detail </th>
								<th>Acc Type</th>
								<th>Head Code</th>
								<th> Acc Code</th>
								<th> Acc Desc</th>
		                        <th>Remarks</th>
								<th >Debit</th>
								<th>Credit</th>
								<th>Delete</th>
							</tr>
						</thead>

						<tbody>
						</tr>
						 <?php 
		  $i=1;

	$r = mysqli_query($conn, "select * from v_detail a ,prj_project_setup b,comp_info c,fiscal_year d,chart_detail e where a.vtype='$vtype_desc' and a.company_id = '$company_id' and a.fiscal_year = '$fiscal_year' and a.project_id = '$project_id' and a.vno = '$v_no' and a.project_id = b.project_id and e.acc_type = a.acc_type and e.acc_detail_type = a.acc_detail_type and e.chart_head_code = a.head_code and e.chart_acc_code = 
	a.chart_acc_code and c.company_id = a.company_id and a.fiscal_year = d.sno	"); 

	while (($rows = mysqli_fetch_array($r)) != false) {
	
	$vno = $rows['VNO'];
	$vtype = $rows['VTYPE'];
	$head_code = $rows['HEAD_CODE'];
	$chart_acc_code = $rows['CHART_ACC_CODE'];
	$debit = $rows['DEBIT'];
	$credit = $rows['CREDIT'];
	$company_name = $rows['COMP_NAME'];
	$project_name = $rows['PARTICULARS'];
	$from_date = $rows['FROM_DATE'];
	$to_date = $rows['TO_DATE'];
	$company_id = $rows['COMPANY_ID']; 
	$project_id = $rows['PROJECT_ID'];
    $fiscal_year_id = $rows['SNO'];	
	 $acc_detail_type = $rows['ACC_DETAIL_TYPE'];
	 $acc_type = $rows['ACC_TYPE'];
	 $chart_acc_desc = $rows['CHART_ACC_DESC'];
	$remarks = $rows['REMARKS'];
	 
	ini_set('max_execution_time', 500);
	?>
	<tr id="row<?php echo $i; ?>" class='showme'>
	 <td class="center"><?php echo $i; ?></td>
	 		<td class="center" ><?php echo $acc_detail_type; ?></td>
        <td class="center" ><?php echo $acc_type; ?></td>
        <td class="center" id="head_code<?php echo $i;?>" ><?php echo $head_code; ?></td>
        <td class="center" ><?php echo $chart_acc_code; ?></td>
		<td align="center" ><?php echo $chart_acc_desc; ?></td>
		<td class="center" ><?php echo $remarks; ?></td>
		<td align="right" id="debit<?php echo $i; ?>" ><?php echo number_format($debit); ?></td>
		<td align="right" id="credit<?php echo $i; ?>"><?php echo number_format($credit); ?></td>
		
        <?php

		$total_debit += $debit;
		$total_credit += $credit;
		?>
<td><input type='button' id='del_button' value='Delete' style="height:40px; width:85px; font-size:12px;" class="btn btn-primary" onclick='delrow(<?php echo $i; ?>,<?php echo $company_id; ?>,<?php echo $project_id;?>,<?php echo $fiscal_year_id; ?>,<?php echo $chart_acc_code; ?> )' ></td>        
				
                </tr>
				
          <?php $i++;}  ?>
						
				<tr>
				<td><b>Total</b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td id="total_debit" align="right" style="font-size:15px;" style="height:40px; width:85px; font-size:12px;" ><?php echo number_format($total_debit); ?></td>
				<td id="total_credit" align="right" style="font-size:15px;"style="height:40px; width:85px; font-size:12px;" ><?php echo number_format($total_credit); ?></td>
				<td></td>
				</tr>	
				</tbody>
					</table>
					</div>
					</div>
   <div id="voucher_delete"></div>
   
   <?php
   $rights = 'Post';

   $select_post = mysqli_query($conn,"select * from posted_unpost_rights where user_id = '$u_id' and rights_desc = '$rights' ");
  
   $selected_post_rows = mysqli_fetch_all($select_post,$selected_post); 
  
   if($selected_post_rows > 0)
   {
	   ?>
	   <div align="center">
	      <button id="save_voucher" onClick="saved(<?php echo $company_id; ?>,<?php echo $project_id;?>,<?php echo $fiscal_year; ?>,<?php echo $v_no; ?>,<?php echo $v_type; ?>)" 
 class="btn btn-primary btn-bordered waves-effect waves-light">Save</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	      <button id="btn_post" onClick="voucher_post(<?php echo $company_id; ?>,<?php echo $project_id;?>,<?php echo $fiscal_year; ?>,<?php echo $v_no; ?>,<?php echo $v_type; ?>)" 
 class="btn btn-primary btn-bordered waves-effect waves-light" >Post</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 

  <a href="voucher_pdf_2.php?c_id=<?php echo base64_encode($company_id);?>&p_id=<?php echo base64_encode($project_id);?>&f_id=<?php echo base64_encode($fiscal_year);?>&
  vno=<?php echo base64_encode($v_no);?>&v_type=<?php echo base64_encode($v_type);?>" target="_blank" ><button id="print" class="btn btn-primary btn-bordered waves-effect waves-light" >Print Voucher</button></a>	   
</div>
  
	   <?php
   }
   else
   {
	   ?>
	   <div align="center">
	      <button id="btn_save" onClick="save(<?php echo $company_id; ?>,<?php echo $project_id;?>,<?php echo $fiscal_year; ?>,<?php echo $v_no; ?>,<?php echo $v_type; ?>)" 
 class="btn btn-primary btn-bordered waves-effect waves-light">Save</button>

  <a href="voucher_pdf_2.php?c_id=<?php echo $company_id;?>&p_id=<?php echo $project_id;?>&f_id=<?php echo $fiscal_year;?>&
  vno=<?php echo $v_no;?>&v_type=<?php echo $v_type;?>" target="_blank" ><button id="print" class="btn btn-primary btn-bordered waves-effect waves-light" >Print Voucher</button></a>	   
</div>
 
	   <?php
   }
  
   ?>
   
<div id="post_voucher"></div>

   <div id="voucher_saved"></div>
  <?php 
	}
	else {
		
	echo "Error";
	
	}

}
else
{
	//
	echo "<center>Detail Already Exist</center>";
	echo "<br>";
	?>
	<style>
   th,td{
	   font-size:12px;
	   
   }
   </style>
     <div class="box">
   <div class="box-body">
					<table id="example1" class="table table-bordered table-striped" style="width:100%">
						<thead>
							<tr>
								<th>S.No</th>
                              <th>Acc Detail </th>
								<th>Acc Type</th>
								<th>Head Code</th>
								<th> Acc Code</th>
								<th> Acc Desc</th>
		                        <th>Remarks</th>
								<th >Debit</th>
								<th>Credit</th>
								<th>Delete</th>
							</tr>
						</thead>

						<tbody>
						</tr>
						 <?php 
		  $i=1;

	$r = mysqli_query($conn, "select * from v_detail a ,prj_project_setup b,comp_info c,fiscal_year d,chart_detail e where a.vtype='$vtype_desc' and a.company_id = '$company_id' and a.fiscal_year = '$fiscal_year' and a.project_id = '$project_id' and a.vno = '$v_no' and a.project_id = b.project_id and e.acc_type = a.acc_type and e.acc_detail_type = a.acc_detail_type and e.chart_head_code = a.head_code and e.chart_acc_code = 
	a.chart_acc_code and c.company_id = a.company_id and a.fiscal_year = d.sno	"); 
	
	while (($rows = mysqli_fetch_array($r)) != false) {
	
	$vno = $rows['VNO'];
	$vtype = $rows['VTYPE'];
	$head_code = $rows['HEAD_CODE'];
	$chart_acc_code = $rows['CHART_ACC_CODE'];
	$debit = $rows['DEBIT'];
	$credit = $rows['CREDIT'];
	$company_name = $rows['COMP_NAME'];
	$project_name = $rows['PARTICULARS'];
	$from_date = $rows['FROM_DATE'];
	$to_date = $rows['TO_DATE'];
	$company_id = $rows['COMPANY_ID']; 
	$project_id = $rows['PROJECT_ID'];
    $fiscal_year_id = $rows['SNO'];	
	 $acc_detail_type = $rows['ACC_DETAIL_TYPE'];
	 $acc_type = $rows['ACC_TYPE'];
	 $chart_acc_desc = $rows['CHART_ACC_DESC'];
	$remarks = $rows['REMARKS'];
	 
	ini_set('max_execution_time', 500);
	?>
	<tr id="row<?php echo $i; ?>" class='showme'>
	 <td class="center"><?php echo $i; ?></td>
	 		<td class="center" ><?php echo $acc_detail_type; ?></td>
        <td class="center" ><?php echo $acc_type; ?></td>
        <td class="center" id="head_code<?php echo $i;?>" ><?php echo $head_code; ?></td>
        <td class="center" ><?php echo $chart_acc_code; ?></td>
		<td align="center" ><?php echo $chart_acc_desc; ?></td>
		<td class="center" ><?php echo $remarks; ?></td>
		<td align="right" id="debit<?php echo $i; ?>" ><?php echo number_format($debit); ?></td>
		<td align="right" id="credit<?php echo $i; ?>"><?php echo number_format($credit); ?></td>
		
        <?php

		$total_debit += $debit;
		$total_credit += $credit;
		?>
<td><input type='button' id='del_button' value='Delete' class="btn btn-primary" style="height:40px; width:85px; font-size:12px;" onclick='delrow(<?php echo $i; ?>,<?php echo $company_id; ?>,<?php echo $project_id;?>,<?php echo $fiscal_year_id; ?>,<?php echo $chart_acc_code; ?> )' ></td>        
				
                </tr>
				
          <?php $i++;}  ?>
						
				<tr>
				<td><b>Total</b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td id="total_debit" align="right" style="font-size:15px;" ><?php echo number_format($total_debit); ?></td>
				<td id="total_credit" align="right" style="font-size:15px;" ><?php echo number_format($total_credit); ?></td>
				<td></td>
				</tr>	
				</tbody>
					</table>
					</div>
					</div>
   
   <div id="voucher_delete"></div>
   
   <?php
   $rights = 'Post';
 
   $select_post = mysqli_query($conn,"select * from posted_unpost_rights where user_id = '$u_id' and rights_desc = '$rights' ");
  
   $selected_post_rows = mysqli_fetch_all($select_post,$selected_post); 
  
   if($selected_post_rows > 0)
   {
	   ?>
	   <div align="center">
	      <button id="save_voucher" onClick="saved(<?php echo $company_id; ?>,<?php echo $project_id;?>,<?php echo $fiscal_year; ?>,<?php echo $v_no; ?>,<?php echo $v_type; ?>)" 
 class="btn btn-primary btn-bordered waves-effect waves-light">Save</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	      <button id="btn_post" onClick="voucher_post(<?php echo $company_id; ?>,<?php echo $project_id;?>,<?php echo $fiscal_year; ?>,<?php echo $v_no; ?>,<?php echo $v_type; ?>)" 
 class="btn btn-primary btn-bordered waves-effect waves-light" >Post</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 

  <a href="voucher_pdf_2.php?c_id=<?php echo base64_encode($company_id);?>&p_id=<?php echo base64_encode($project_id);?>&f_id=<?php echo base64_encode($fiscal_year);?>&
  vno=<?php echo base64_encode($v_no);?>&v_type=<?php echo base64_encode($v_type);?>" target="_blank" ><button id="print" class="btn btn-primary btn-bordered waves-effect waves-light" >Print Voucher</button></a>	   
</div>
  
	   <?php
   }
   else
   {
	   ?>
	   <div align="center">
	      <button id="btn_save" onClick="save(<?php echo $company_id; ?>,<?php echo $project_id;?>,<?php echo $fiscal_year; ?>,<?php echo $v_no; ?>,<?php echo $v_type; ?>)" 
 class="btn btn-primary btn-bordered waves-effect waves-light">Save</button>

  <a href="voucher_pdf_2.php?c_id=<?php echo $company_id;?>&p_id=<?php echo $project_id;?>&f_id=<?php echo $fiscal_year;?>&
  vno=<?php echo $v_no;?>&v_type=<?php echo $v_type;?>" target="_blank" ><button id="print" class="btn btn-primary btn-bordered waves-effect waves-light" >Print Voucher</button></a>	   
</div>
 
	   <?php
   }
  
   ?>
   
<div id="post_voucher"></div>

   <div id="voucher_saved"></div>
	<?php
	//
}
	
	
///////////////
 // }

 
?>