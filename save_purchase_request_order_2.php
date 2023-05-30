<?php
 
 include ('include/function.php');
 


    $po_no = $_GET['po_no'];

	?>		

			<div class="col-lg-12">
						<br>
						
						<div class="box-content card bordered-all primary">
					<h4 class="box-title bg-primary">
	Purchase Order Detail
						

					</h4>
					
					<div class="card-content">
				
						
					   <div class="table-responsive">
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Item Name</th>
								<th>UOM </th>
								<th>Rate</th>
								<th>Quantity</th>
								<th>Discount</th>
								<th>Amount</th>
								<th>Edit/Save</th>
								<th>Delete</th>
							</tr>
						</thead>
						
						<tbody>
						 <?php 
		  $i=1;
				$real_amount=0;
	$r = mysqli_query($conn, "select a.DISCOUNT,a.PO_NO,a.QUANTITY,a.TRNO,a.RATE,b.ITEM_NAME,c.DESCRIPTION from po_detail a , item_setup2 b ,uom_setup c where a.PO_NO = '$po_no' and a.ITEM_CODE = b.ITEM_ID 
	and a.UOM = c.DESCRIPTION"); 
  
	
	while (($rows = mysqli_fetch_array($r)) != false) {
	
	$po_no = $rows['PO_NO'];
	$uom = $rows['DESCRIPTION'];
	$quantity = $rows['QUANTITY'];
    $item_name = $rows['ITEM_NAME'];
    $tr_no = $rows['TRNO']; 
    $rate = $rows['RATE']; 
	$discount = $rows['DISCOUNT']; 
	$total_amount = $rate * $quantity - $discount; 
	 
	 $real_amount += $total_amount;
	 
	ini_set('max_execution_time', 500);
	?>
	<tr id="row<?php echo $i; ?>" class='showme'>
	 <td class="center"><?php echo $i; ?></td>
		 <td class="center"><?php echo $item_name; ?></td>
		<td class="center"><?php echo $uom; ?></td>
		<td class="center" align="right"><?php echo number_format($rate); ?></td>
			<td class="center" id="quantity<?php echo $i; ?>"  align="right"><?php echo $quantity; ?></td>
					<td class="center" align="right"><?php echo number_format($discount); ?></td>
							<td class="center" align="right"><?php echo number_format($total_amount); ?></td>
	<td class="center"><input type='button' class='btn btn-primary' style="width:75px; height:40px; font-size:12px;" id='edit_button<?php echo $i;?>' value='Edit' onclick='edit_row(<?php echo $i; ?>,<?php echo $tr_no; ?>)' >
	<input type='button' id='save_button<?php echo $i;?>' class='btn btn-primary' style="width:75px; height:40px; font-size:12px; display:none;" value='Save' onclick='save_row(<?php echo $i; ?>,<?php echo $tr_no; ?>,<?php echo $po_no;?>)' >
	</td>
<td class="center"><input type='button' id='del_button' class='btn btn-primary' style="width:80px; height:40px; font-size:12px;" value='Delete' onclick='delrow(<?php echo $i; ?>,<?php echo $tr_no; ?>,<?php echo $po_no; ?>)' ></td>
	
        
                </tr>
          <?php $i++;}  ?>
							
	 <td class="center"><b><?php echo 'Total'; ?></b></td>
		 <td class="center"></td>
		<td class="center"></td>
		<td class="center" align="right"></td>
			<td class="center" ></td>
					<td class="center" ></td>
							<td class="center" align="right"><b><?php echo number_format($real_amount); ?></b></td>
	<td class="center"></td>
<td class="center"></td>
						
												</tbody>
					</table>
					</div> 

					
<div align="center">

<div id="detail_delete"></div>
<br>

	      <button id="btn_save" onClick="save()" 
 class="btn btn-primary btn-bordered waves-effect waves-light">Save</button>

</div>					
						<br><br>
						</div>
			
			</div>
			
			</div>
			
	