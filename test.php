 <?php
 include ('include/function.php');
$dis_pay=0;
			$arr=mysqli_query($conn,"SELECT challan_no,total_amount,is_receive FROM `fee_voucher_master` WHERE student_id ='6'");
			$k_count=mysqli_num_rows($arr);
		
				while ($rowss = mysqli_fetch_array($arr))
				{
					$challan_no12=$rowss['challan_no'];
					$total_amount=$rowss['total_amount'];
					$is_receive = $rowss['is_receive'];
					
				}
				if($is_receive == 1)
				{
				
					$arr_d=mysqli_query($conn,"SELECT `discount` FROM `fee_voucher_detail` WHERE challan_no ='$challan_no12'");
					foreach($arr_d as $rows)
					{
						$discount=$rows['discount'];
						
						$dis_amount=array($discount);
						$dis_amount11=array_sum($dis_amount);
						$dis_pay += $dis_amount11;
					}
				
					
						$arrear=$dis_pay;
					
				}
				else
				{
					$arr_d=mysqli_query($conn,"SELECT `discount` FROM `fee_voucher_detail` WHERE challan_no ='$challan_no12'");
					foreach($arr_d as $rows)
					{
						$discount=$rows['discount'];
						
						$dis_amount=array($discount);
						$dis_amount11=array_sum($dis_amount);
						$dis_pay += $dis_amount11;
					}
				
					
						$arrear=$dis_pay + $total_amount;
						
				}
				?>