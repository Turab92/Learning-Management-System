<?php
 
  include ('include/function.php');


 $advance_id = $_GET['advance_id'];
 $adv_amount = $_GET['adv_amount'];
 $no_of_installments = $_GET['no_of_installments'];

 $schedule_amount = $adv_amount/$no_of_installments;
 
 $select_advance_date = mysqli_query($conn,"select ADVANCE_DATE from employee_advance where advance_id = '$advance_id' ");
 while($r = mysqli_fetch_array($select_advance_date))
 {
	  $advance_date = $r['ADVANCE_DATE'];
 }
$date = date("Y-m-d",strtotime($advance_date)); 

 for($i=1;$i<=$no_of_installments;$i++)
 {

$currentMonth = date("m",strtotime($date));
$nextMonth = date("m",strtotime($date."+1 month"));
if($currentMonth==$nextMonth-1)
{
	 $date = date('Y-m-d',strtotime($date."+1 month"));
}
else
{
	 $date = date('Y-m-d',strtotime("last day of next month",strtotime($date)));
}

 
$schedule_date = date('Y-m-d', strtotime($date));

$sql = "INSERT INTO employee_advance_refund_plan (ADVANCE_ID,SCHEDULED_AMOUNT,SCHEDULE_DATE) VALUES ('$advance_id','$schedule_amount','$schedule_date')";
	   $compiled = mysqli_query($conn, $sql);
    
	
 }
 



?>
<section class="content">
      <div class="row">

	<div class="col-xs-12">
								<div class="box">
				
					<div class="box-header">
              <h3 class="box-title">Refund Plan Details</h3>
            </div>
					<div class="box-body">
					<table id="example1" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>S No</th>
								<th>Scheduled Amount</th>
								<th>Schedule Date</th>
								
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>S No</th>
								<th>Scheduled Amount</th>
								<th>Schedule Date</th>
								
</tr>
								</tfoot>
						<tbody>
						 <?php 
		  $i=1;
		  
	$r = mysqli_query($conn, "select * from employee_advance_refund_plan where advance_id = '$advance_id'"); 
	while (($rows = mysqli_fetch_array($r)) != false) {
	
$schedule_amount = $rows['SCHEDULED_AMOUNT'];
$schedule_date = $rows['SCHEDULE_DATE'];
	 
	 
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
		 <td class="center"><?php echo $schedule_amount; ?></td>
		 <td class="center"><?php echo $schedule_date; ?></td>
	
        
                </tr>
          <?php $i++;}  ?>
												</tbody>
				</table>
					</div>
				</div>
				<button class="btn btn-primary btn-bordered waves-effect waves-light" onclick="save()">Save</button>
<br><br><br><br>
				<!-- /.box-content -->
			</div>
 </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	
