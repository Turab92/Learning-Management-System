<?php
 
 include ('include/function.php');
 

 
 $select_barcode = mysqli_query($conn,"select BARCODE from purchase_order_barcode where po_no is null");
 while($r = mysqli_fetch_array($select_barcode))
 {
	 $barcode = $r['BARCODE'];
 }
 
  $supplier = $_GET['supplier'];
  $priority = $_GET['priority'];
  $payment_terms = $_GET['payment_terms'];
  $po_type = $_GET['po_type'];
  $remarks = $_GET['remarks'];
  $branch_id = $_GET['branch'];
  
 if( $supplier == null || $po_type == null || $payment_terms == null || $priority == null   )
{
	echo "Please Fill All The Mandatory Fields";
}
else
	{
///
	
	$select_pono = 	mysqli_query($conn,"select * from po_master order by po_no asc");

	while($r = mysqli_fetch_array($select_pono))
	{
		$po_no = $r['PO_NO'];
	}
	$without_request = 'Y';
	
	 $po_no+=1; 

	 $final_barcode = $barcode.$branch_id.$po_no;
	 
	 	$update = "update purchase_order_barcode set po_no='$po_no' where barcode='$barcode'";
		$updated = mysqli_query($conn, $update);
       
	  
	 
	$sql = "INSERT INTO PO_MASTER (PO_DATE,SUPPLIER_ID,REMARKS,USER_ID,PC_IP,PAYMENT_TERMS,PO_TYPE_ID,BRANCH_ID,WITHOUT_REQUEST,BARCODE) VALUES ('$customized_date','$supplier','$remarks','$userid','$ip','$payment_terms','$po_type','$branch_id','$without_request','$final_barcode')";
	   $compiled = mysqli_query($conn, $sql);
	
	
	
	if($compiled){
		
//			echo "Purchase Order Master Created";
	//	echo "<br>";
			///?>
			

		<div class="row small-spacing">

			<div class="col-lg-12">
			<input type="hidden" id="vouch_no" value="<?php echo $vno; ?>" />
			<div class="box box-info">
			<div class="box-header with-border">
					<h4 class="box-title">
				    Purchase Order Detail
					</h4>
					</div>				<!-- /.box-title -->
					<div class="box-body">
					<div class="col-md-12">
					
	 			<div class="col-md-4">
								<label for="inputPassword3" class="col-sm-3 control-label" >
	            Select Item					
</label>				
		
	<select name="item" id="item"  onchange="show_item_detail(this.value,<?php echo $po_no; ?>)" class="form-control"  >
				<option value="" >Select Item</option>
						 <?php 
		  $i=1;
		  
	$r = mysqli_query($conn, "select * from item_setup2 a,allot_items b where a.item_id = b.item_id and b.branch_id = '$branch_id' "); 
	
	while (($rows = mysqli_fetch_array($r)) != false) {
	
$item_id = $rows['ITEM_ID'];	
$item_name = $rows['ITEM_NAME'];	
	
	 ?>
	<option value="<?php echo $item_id; ?>"><?php echo $item_name; ?></option>
	
	 
	 <?php
	 
	ini_set('max_execution_time', 500);
	} 

?>
	</select>					
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