<?php
include ('include/function.php');
?>
<body>

	   <section class="content">
            <div class="row">
                <div class="col-xs-12" >
                    <div class="box ">
                        <div class="box-header">
                            <h3 class="box-title">
                                <i class="fa fa-fw fa-table"></i> Purchase Request Detail
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
									   <th>S.No</th>
                                        <th>Item</th>
                                        <th>Uom</th>
										<th>Rate</th>
                                        <th>Quantity</th>
										<th>Discount</th>
										<th>Amount</th>
										<th>Remark</th>
                                      
                                      
                                    </tr>
                                    </thead>
                                    <tbody>
									<form method='POST'>
                <?php
	 $simplestring = $_GET['simplestring'];?>
                                    <?php 

                                   
$i = 1;
             
    
$sql1=mysqli_query($conn,"select a.req_id,a.item_code,a.UOM,a.QUANTITY,a.REMARKS,a.RATE,a.DISCOUNT,c.item_id,c.ITEM_NAME from 
purchase_request_detail a,item_setup2 c where a.item_code = c.item_id and  a.req_id = '$simplestring' ");
           
            while(($row21=mysqli_fetch_array($sql1)) != false){
     echo "<tr>";
           $item=$row21['ITEM_NAME'];
                 $quantity=$row21['QUANTITY'];
           $uom=$row21['UOM'];
           $remark=$row21['REMARKS'];
		   $rate=$row21['RATE'];  
           $discount=$row21['DISCOUNT']; 
		   $total_amount = $rate * $quantity - $discount;
		   
   ?>
                     
	 <td class='center'><?php echo $i; ?></td>
    <td class='center'><?php echo $item; ?></td>
    <td class='center'><?php echo $uom; ?></td>
    <td class='center'><?php echo $rate; ?></td>
	<td class='center'><?php echo $quantity; ?></td>
	<td class='center'><?php echo $discount; ?></td>
	<td class='center'><?php echo $total_amount; ?></td>
    <td class='center'><?php echo $remark; ?></td>
	           
         
     </tr>
               
      <?php
        
         $i++;  
       }

                                ?>    
                                    


   </form>
                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>


</section>
				</body>