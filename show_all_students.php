<?php
include ('include/function.php');

$branch_id = $_GET['id'];

?>

					<div class="table-responsive" style="height:400px;">
					<table id="example" class="table table-striped table-bordered display" style="width:100%">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Name</th> 
								<th>Father Name</th> 
								<th>Date Of Admission</th> 
								<th>Student Address</th>
								
							</tr>
						</thead>
				
						<tbody>
						 <?php 
		  $i=1;
		  
		  if($branch_id == 0)
		  {
	    $sql2=mysqli_query($conn,"SELECT * FROM student_current_status where left_date is null order by student_id DESC");
		  }
		  else
		  {
	    $sql2=mysqli_query($conn,"SELECT * FROM student_current_status where left_date is null and branch_id = '$branch_id' order by student_id DESC");			  
		  }
        		
        		while (($row2 = mysqli_fetch_array($sql2)) != false) {

					$si=$row2['STUDENT_ID'];
      			    $sn=$row2['APPLICANT_NAME'];
                    $fn=$row2['FATHER_NAME'];
					 $adms=$row2['DATE_OF_SUBMISSION'];
					  $img=$row2['IMG_LOC'];
					  $add=$row2['APPLICANT_ADDRESS'];
					   
					  
				
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $i; ?></td>
		 <td class='center'>
		 <a href='student_profile.php?edit=<?php echo $si; ?>' target='_blank'>
		<?php echo $sn; ?></td>
        <td class='center'><?php echo $fn; ?></td>
         <td class='center'><?php echo $adms; ?></td>
		<td class='center'><?php echo $add; ?></td> 
        
                </tr>
          <?php $i++;}  ?>
		  
		  
												</tbody>
				</table>
					</div>
