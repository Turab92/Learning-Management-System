<?php
include ('include/function.php');
?>

					<div class="table-responsive" style="height:400px;">
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Name</th>
								<th>Address</th>
								<th>Type</th>
								<th>Active</th>
								
							</tr>
						</thead>
				
						<tbody>
						 <?php 
		  $i=1;
		  
	$r = mysqli_query($conn, "select * from school_branches "); 
	
	while (($rows = mysqli_fetch_array($r)) != false) {
		
     $id = $rows['branch_id'];		
	 $description=$rows['branch_name'];
	 $branch_address=$rows['branch_address'];
	 $active=$rows['active'];
	 $branch_type=$rows['branch_type'];
	
	 
	$enc = base64_encode($id);
	 
	 
	 
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
		 <td class="center"><?php echo $description; ?></td>
       <td class="center"><?php echo $branch_address; ?></td>
	   <td class="center"><?php echo $branch_type; ?></td>
	   <td class="center"><?php echo $active; ?></td>
	      
        
                </tr>
          <?php $i++;}  ?>
		  
		  
												</tbody>
				</table>
					</div>
