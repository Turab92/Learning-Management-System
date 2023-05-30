<?php
error_reporting(0);
include ('include/function.php');

 $branch_id = $_GET['id'];

?>

					<div class="responsive">
					
										<table class=" example table table-striped table-bordered display" style="width:100%;height:40%;">
						<thead>
							<tr>
							<th>S.No</th>
								<th>Student</th>
								<th>Joining Date</th>
								<th>Branch</th>
								<th>Class</th>
		</tr>
						</thead>
						<tfoot>
							<tr>
								<th>S.No</th>
								<th>Student</th>
								<th>Joining Date</th>
								<th>Branch</th>
								<th>Class</th>
						</tfoot>
						<tbody>
						 <?php 
	
 include ('include/config.php');

$a = 0;

  if($branch_id == 0)
  {
$select = mysqli_fetch_array($conn,"select a.applicant_name,a.student_id,a.trans_date,'$trans_date' - a.trans_date as remaining_days,
a.class_id,a.branch_id,b.class_id,b.class_description,c.branch_id,c.branch_name from student_current_Status a,class_setup b,school_branches c 
where '$trans_date' - a.trans_date <= 180 and '$trans_date' - a.trans_date > 0  and 
a.class_id = b.class_id and a.branch_id = c.branch_id order by trans_Date desc");
  }
 else if($branch_id != null)
 {
	 $select = mysqli_fetch_array($conn,"select a.applicant_name,a.student_id,a.trans_date,'$trans_date' - a.trans_date as remaining_days,
a.class_id,a.branch_id,b.class_id,b.class_description,c.branch_id,c.branch_name from student_current_Status a,class_setup b,school_branches c 
where '$trans_date' - a.trans_date <= 180 and '$trans_date' - a.trans_date > 0  and 
a.class_id = b.class_id and a.branch_id = c.branch_id and a.branch_id = '$branch_id' order by trans_Date desc");
 }


while($rows = mysqli_fetch_array($select))
{
	$a+= 1;
 
     $student_name = $rows['APPLICANT_NAME'];
     $class_name = $rows['CLASS_DESCRIPTION']; 	
     $branch_name = $rows['BRANCH_NAME'];
     $remaining_days = $rows['REMAINING_DAYS'];   
     $trans_date = $rows['TRANS_DATE'];	
	 
	ini_set('max_execution_time', 500);
	?>
	 <td class="center"><?php echo $a; ?></td>
		 <td class="center"><?php echo $student_name; ?></td>
       <td class="center"><?php echo $trans_date; ?></td>
	   	 <td class="center"><?php echo $branch_name; ?></td>
       <td class="center"><?php echo $class_name; ?></td>
	    
                </tr>
          <?php 
		  }  ?>
												</tbody>
				</table>
</div>
