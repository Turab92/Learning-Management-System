<?php	
require('code128.php');

include ('include/function.php');

//$branch_id = $_GET['branch'];
//$challan_id = $_GET['challan_id'];
//$flag = $_GET['flag'];

$pdf=new PDF_Code128('L','mm',array(300,230));

//$print = $_GET['print'];
$fromdate = $_POST["fromdate"];
$todate = $_POST["todate"];
//error_reporting(0);
$flag=0;
$pic = 'assets/images/alkahf.png';
$pic2 = 'assets/images/bank_logo.png';

function ChapterTitle($pdf)
{
    // Arial 12
    $pdf->SetFont('Arial','',12);
    // Background color
    $pdf->SetFillColor(200,220,255);
    // Title
    $pdf->Cell(0,6,"Chapter  :",0,1,'L',true);
 
}


if(isset($_GET['print']))
{
	$print = $_GET['print'];

 $sql=mysqli_query($conn,"SELECT fvm.voucher_id, fvm.challan_no, fvm.issue_date, fvm.due_date, fvm.expiry_date, fvm.branch_id,sb.branch_name, ss.FROM_DATE,ss.TO_DATE, css.SECTION_DESCRIPTION, cs.CLASS_DESCRIPTION, fvm.student_id,scs.APPLICANT_NAME,scs.FATHER_NAME, bs.BANK_ACCOUNT_NO,fm.fee_month,fvm.session_id FROM `fee_voucher_master` as fvm JOIN school_branches as sb on fvm.branch_id=sb.branch_id JOIN sessions_setup as ss on fvm.session_id=ss.SESSION_ID JOIN class_setup_section as css on fvm.section_id=css.SECTION_ID JOIN class_setup as cs on fvm.class_id=cs.CLASS_ID JOIN student_current_status as scs on fvm.student_id=scs.STUDENT_ID JOIN banks_setup as bs on fvm.bank_id=bs.BANK_ID JOIN fee_voucher_month as fm on fvm.challan_no=fm.challan_no where fvm.challan_no='$print'");
}	
else
{
	$sql=mysqli_query($conn,"SELECT fvm.voucher_id, fvm.challan_no, fvm.issue_date, fvm.due_date, fvm.expiry_date, fvm.branch_id,sb.branch_name, ss.FROM_DATE,ss.TO_DATE, css.SECTION_DESCRIPTION, cs.CLASS_DESCRIPTION, fvm.student_id,scs.APPLICANT_NAME,scs.FATHER_NAME, bs.BANK_ACCOUNT_NO,fm.fee_month,fvm.session_id FROM `fee_voucher_master` as fvm JOIN school_branches as sb on fvm.branch_id=sb.branch_id JOIN sessions_setup as ss on fvm.session_id=ss.SESSION_ID JOIN class_setup_section as css on fvm.section_id=css.SECTION_ID JOIN class_setup as cs on fvm.class_id=cs.CLASS_ID JOIN student_current_status as scs on fvm.student_id=scs.STUDENT_ID JOIN banks_setup as bs on fvm.bank_id=bs.BANK_ID JOIN fee_voucher_month as fm on fvm.challan_no=fm.challan_no where fvm.issue_date between '$fromdate' and '$todate'");
}	
        		
						 while(($row = mysqli_fetch_array($sql)) != false) 
						 {	
				
								 $voucher_id=$row['voucher_id'];
								 $challan_no=$row['challan_no'];
                                 $issue_date1=$row['issue_date'];
								 $due_date1=$row['due_date'];
								 $expiry_date1=$row['expiry_date'];
								 $branch_id=$row['branch_id'];
								 $branch_name=$row['branch_name'];
								 $SECTION_DESCRIPTION=$row['SECTION_DESCRIPTION'];
								 $CLASS_DESCRIPTION=$row['CLASS_DESCRIPTION'];
								 $FROM_DATE1=$row['FROM_DATE'];
								 $TO_DATE1=$row['TO_DATE'];
								 $student_id=$row['student_id'];
								 $APPLICANT_NAME = $row['APPLICANT_NAME'];
                                 $FATHER_NAME = $row['FATHER_NAME'];
								 $BANK_ACCOUNT_NO = $row['BANK_ACCOUNT_NO'];
								 $session_id = $row['session_id'];
								  $fee_month1 = $row['fee_month'];
								 
								
								 
						  



$LATE_FEES=0;
//date procedures
$issue_date=strtotime($issue_date1);
$due_date=strtotime($due_date1);
$expiry_date=strtotime($expiry_date1);

$FROM_DATE=strtotime($FROM_DATE1);
$TO_DATE=strtotime($TO_DATE1);

$session_date=date('Y',$FROM_DATE)."-".date('Y',$TO_DATE);
$year_only=date('y');
$fee_month=$fee_month1."-".$year_only;

$pdf->AddPage();

$pdf->Cell(90,197,'',1,0,'L');
$pdf->Cell(6,1,'',0,0);
$pdf->Cell(89,197,'',1,0);
$pdf->Cell(6,1,'',0,0);
$pdf->Cell(89,197,'',1,0);
$pdf->SetX($pdf->GetX() - 187);
$pdf->Cell(.1,197,'',1,0);
$pdf->SetX($pdf->GetX() - 205);
$pdf->Cell(.1,197,'',1,0);

$pdf->SetFont("Symbol","U",12);
$pdf->SetX($pdf->GetX() - 220);
$pdf->Cell(10,7,$pdf->Image($pic,20, 13.5, 19, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false),0,0);
$pdf->SetX($pdf->GetX() - 220);
$pdf->Cell(10,7,$pdf->Image($pic,115, 13.5, 19, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false),0,0);
$pdf->SetX($pdf->GetX() - 248);
$pdf->Cell(10,7,$pdf->Image($pic,210, 13.5, 19, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false),0,1);
$pdf->SetFont("Symbol","B",15);
$pdf->SetX($pdf->GetX() - 288);
$pdf->Cell(75,4,'AL KAHF ACADEMY',0,0,'C');
$pdf->SetX($pdf->GetX() - 277);
$pdf->Cell(69,4,'AL KAHF ACADEMY',0,0,'C');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(71,5,'AL KAHF ACADEMY',0,1,'C');

$add = str_replace(' ', '', $BANK_ACCOUNT_NO);
$tot_add=strlen($add);
$f=str_split($add);

$actualcol=14;
$remainingcol=$actualcol-$tot_add;



$pdf->SetFont("Symbol","",8);
$pdf->SetX($pdf->GetX() - 272.5);
$pdf->Cell(6.3,3,'A/C: ',0,0);
foreach($f as $s){
		$pdf->Cell(3,2.8,strtoupper($s),1); 
}
	for($j=0;$j<=$remainingcol;$j++){
	
$pdf->Cell(3,2.8,'-',1); 

}
$pdf->SetX($pdf->GetX() - 256);
$pdf->Cell(6.3,3,'A/C: ',0,0);
foreach($f as $s){
		$pdf->Cell(3,2.8,strtoupper($s),1); 
}
	for($j=0;$j<=$remainingcol;$j++){
	
$pdf->Cell(3,2.8,'-',1); 

}
$pdf->SetX($pdf->GetX() - 256.5);
$pdf->Cell(6.3,3,'A/C: ',0,0);
foreach($f as $s){
		$pdf->Cell(3,2.8,strtoupper($s),1); 
}
	for($j=0;$j<=$remainingcol;$j++){
	
$pdf->Cell(3,2.8,'-',1); 

}
$pdf->Cell(6.3,3,'',0,1);
$pdf->SetFont("Symbol","U",7);
$pdf->SetX($pdf->GetX() - 270);
$pdf->Cell(10,0,$pdf->Image($pic2,90, 16.5, 8, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false),0,0);
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(10,0,$pdf->Image($pic2,185, 16.5, 8, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false),0,0);
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(10,0,$pdf->Image($pic2,280, 16.5, 8, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false),0,1);
$pdf->SetFont("Symbol","",7.5);

$pdf->SetX($pdf->GetX() - 272);
$pdf->SetFillColor(224,224,224);
$pdf->Cell(60,5,'Dubai Islamic Bank(North Nazimabad, Block-F Branch)',0,0,'L',true);
$pdf->SetX($pdf->GetX() - 265);
$pdf->Cell(60,5,'Dubai Islamic Bank(North Nazimabad, Block-F Branch)',0,0,'L',true);
$pdf->SetX($pdf->GetX() - 265);
$pdf->Cell(60,5,'Dubai Islamic Bank(North Nazimabad, Block-F Branch)',0,1,'L',true);
$pdf->SetFont("Symbol","BU",12);
$pdf->SetX($pdf->GetX() - 255);
$pdf->Cell(70,3,'',0,0);
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(70,3,'',0,0);
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(70,3,'',0,1);

$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(70,6,'  Bank Copy  ',0,0,'C');
$pdf->SetX($pdf->GetX() - 277);
$pdf->Cell(70,6,'  School Copy  ',0,0,'C');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(70,6,'  Student Copy  ',0,1,'C');
$pdf->SetFont("Symbol","B",11);
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(70,3,'',0,0);
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(70,3,'',0,0);
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(70,3,'',0,1);
// $pdf->SetX($pdf->GetX() - 290);
// $pdf->Cell(20,6,'Bank :',0,0);$pdf->Cell(50,6,'Habib Bank Metro',0,0,'C');
// $pdf->SetX($pdf->GetX() - 275);
// $pdf->Cell(20,6,'Bank :',0,0);$pdf->Cell(50,6,'Habib Bank Metro',0,0,'C');
// $pdf->SetX($pdf->GetX() - 272);
// $pdf->Cell(20,6,'Bank :',0,0);$pdf->Cell(50,6,'Habib Bank Metro',0,1,'C');
$pdf->SetFont("Arial","B",9);
$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(18,7,'Fee Challan No :',0,0);$pdf->Cell(45,7,$challan_no,0,0,'C');
$pdf->SetX($pdf->GetX() - 268);
$pdf->Cell(18,7,'Fee Challan No :',0,0);$pdf->Cell(45,7,$challan_no,0,0,'C');
$pdf->SetX($pdf->GetX() - 268);
$pdf->Cell(18,7,'Fee Challan No :',0,0);$pdf->Cell(45,7,$challan_no,0,1,'C');

$pdf->SetFont("Symbol","",9);

$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(30,7,'Student Name :',0,0);$pdf->Cell(45,7,$APPLICANT_NAME,0,0,'L');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,7,'Student Name :',0,0);$pdf->Cell(45,7,$APPLICANT_NAME,0,0,'L');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,7,'Student Name :',0,0);$pdf->Cell(45,7,$APPLICANT_NAME,0,1,'L');

$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(30,5,'Father Name :',0,0);$pdf->Cell(45,5,$FATHER_NAME,0,0,'L');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,5,'Father Name :',0,0);$pdf->Cell(45,5,$FATHER_NAME,0,0,'L');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,5,'Father Name :',0,0);$pdf->Cell(45,5,$FATHER_NAME,0,1,'L');

$pdf->SetX($pdf->GetX() - 290);

$pdf->Cell(30,7,'Branch :',0,0);$pdf->Cell(45,7,$branch_name,0,0,'L');
// $pdf->Cell(30,7,$section_description,0,0,'C');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,7,'Branch :',0,0);$pdf->Cell(45,7,$branch_name,0,0,'L');
// $pdf->Cell(30,7,$section_description,0,0,'C');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,7,'Branch :',0,0);$pdf->Cell(45,7,$branch_name,0,1,'L');

$pdf->SetX($pdf->GetX() - 290);

$pdf->Cell(30,5,'Class :',0,0);$pdf->Cell(45,5,$CLASS_DESCRIPTION,0,0,'L');
// $pdf->Cell(30,7,$section_description,0,0,'C');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,5,'Class :',0,0);$pdf->Cell(45,5,$CLASS_DESCRIPTION,0,0,'L');
// $pdf->Cell(30,7,$section_description,0,0,'C');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,5,'Class :',0,0);$pdf->Cell(45,5,$CLASS_DESCRIPTION,0,1,'L');

$pdf->SetX($pdf->GetX() - 290);

$pdf->Cell(30,7,'Session :',0,0);$pdf->Cell(45,7,$session_date,0,0,'L');
// $pdf->Cell(30,7,$section_description,0,0,'C');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,7,'Session :',0,0);$pdf->Cell(45,7,$session_date,0,0,'L');
// $pdf->Cell(30,7,$section_description,0,0,'C');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,7,'Session :',0,0);$pdf->Cell(45,7,$session_date,0,1,'L');

$pdf->SetX($pdf->GetX() - 290);

$pdf->Cell(30,7,'For The Months :',0,0);$pdf->Cell(45,7,$fee_month,0,0,'L');
// $pdf->Cell(30,7,$section_description,0,0,'C');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,7,'For The Months :',0,0);$pdf->Cell(45,7,$fee_month,0,0,'L');
// $pdf->Cell(30,7,$section_description,0,0,'C');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,7,'For The Months :',0,0);$pdf->Cell(45,7,$fee_month,0,1,'L');

$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(30,7,'Issue Date :',0,0);$pdf->Cell(45,7,date('d/M/Y',$issue_date) ,0,0,'L');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,7,'Issue Date :',0,0);$pdf->Cell(45,7,date('d/M/Y',$issue_date) ,0,0,'L');
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(30,7,'Issue Date :',0,0);$pdf->Cell(45,7,date('d/M/Y',$issue_date) ,0,1,'L');
$months = '';	


	//$pdf->SetFont("Symbol","",8);

//if($flag == 'OTHER_CHARGES')
//{
//$pdf->SetX($pdf->GetX() - 290);
//$pdf->Cell(25,5,'For The Months:',0,0,'L');
//$x_axis=$pdf->getx();
//$c_width=35;
//$c_height=5;
//$pdf->vcell($c_width,$c_height,$x_axis,$fee_month);
// $pdf->MultiCell(35,7,implode(',',$months),0,1);
//$pdf->SetX($pdf->GetX() - 265);
//$pdf->Cell(25,5,'For The Months:',0,0,'L');
//$x_axis=$pdf->getx();
//$c_width=35;
//$c_height=5;
//$pdf->vcell($c_width,$c_height,$x_axis,$fee_month);
//$pdf->SetX($pdf->GetX() - 265);
//$pdf->Cell(25,5,'For The Months:',0,1,'L');
//$x_axis=$pdf->getx();
//$c_width=35;
//$c_height=5;
//$pdf->vcell($c_width,$c_height,$x_axis,$fee_month);


//}
//else
//{

	
//$pdf->SetX($pdf->GetX() - 290);
//$pdf->Cell(35,7,'For The Months:',0,0);
//$x_axis=$pdf->getx();
//$c_width=35;
//$c_height=7;
//$pdf->vcell($c_width,$c_height,$x_axis,implode(',',$months));
// $pdf->MultiCell(35,7,implode(',',$months),0,1);
//$pdf->SetX($pdf->GetX() - 265);
//$pdf->Cell(25,7,'For The Months:',0,0);
//$x_axis=$pdf->getx();
//$c_width=35;
//$c_height=7;
//$pdf->vcell($c_width,$c_height,$x_axis,implode(',',$months));
//$pdf->SetX($pdf->GetX() - 265);
//$pdf->Cell(25,7,'For The Months:',0,0);
//$x_axis=$pdf->getx();
//$c_width=35;
//$c_height=7;
//$pdf->vcell($c_width,$c_height,$x_axis,implode(',',$months));


//}

//}

$pdf->SetFont("Symbol","",8);


 $pdf->SetX($pdf->GetX() - 255);
$pdf->Cell(35,5,'',0,0);$pdf->Cell(35,5,'',0,0,'C');
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(35,5,'',0,0);$pdf->Cell(35,5,'',0,0,'C');
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(35,5,'',0,0);$pdf->Cell(35,5,'',0,1,'C');	
$pdf->SetX($pdf->GetX() - 255);
$pdf->Cell(35,5,'',0,0);$pdf->Cell(35,5,'',0,0,'C');
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(35,5,'',0,0);$pdf->Cell(35,5,'',0,0,'C');
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(35,5,'',0,0);$pdf->Cell(35,5,'',0,1,'C');	


$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(35,5,'Description',1,0,'C');$pdf->Cell(35,5,'Amount',1,0,'C');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(35,5,'Description',1,0,'C');$pdf->Cell(35,5,'Amount',1,0,'C');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(35,5,'Description',1,0,'C');$pdf->Cell(35,5,'Amount',1,1,'C');	

 $fetch_emp = mysqli_query($conn,"SELECT  fvd.challan_no, fvd.nature_id,np.DESCRIPTION,np.AMOUNT,fvd.discount FROM `fee_voucher_detail` as  fvd JOIN nature_payments as np on fvd.nature_id=np.NATURE_ID  WHERE fvd.challan_no='$challan_no'");
			
			foreach($fetch_emp as $emp)
            {
                $challan_no=$emp['challan_no'];
                $nature_id=$emp['nature_id'];
				 $DESCRIPTION=$emp['DESCRIPTION'];
                $AMT=$emp['AMOUNT'];
				 $discount=$emp['discount'];
				 $AMOUNT=$AMT-$discount;
				 
			if($nature_id=='14')
			{
				 $k=mysqli_query($conn,"SELECT  `amount` FROM `student_schedule` WHERE session_id = '$session_id' and student_id ='$student_id' and nature_id = '14'");
				while ($rows = mysqli_fetch_array($k))
				{					
					$AMT = $rows['amount'];
					$AMOUNT=$AMT-$discount;
				}
			}
			

				$pdf->SetX($pdf->GetX() - 290);
				$pdf->Cell(35,5,$DESCRIPTION,1,0);$pdf->Cell(35,5,number_format($AMOUNT),1,0,'R');
				$pdf->SetX($pdf->GetX() - 275);
				$pdf->Cell(35,5,$DESCRIPTION,1,0);$pdf->Cell(35,5,number_format($AMOUNT),1,0,'R');
				$pdf->SetX($pdf->GetX() - 275);
				$pdf->Cell(35,5,$DESCRIPTION,1,0);$pdf->Cell(35,5,number_format($AMOUNT),1,1,'R');	
				
				$amount1=array($AMOUNT);
				$amount11=array_sum($amount1);
				$payable_by += $amount11;
				
				
			}
			$dis_pay=0;
				$arr=mysqli_query($conn,"SELECT challan_no,total_amount,is_receive FROM fee_voucher_master WHERE challan_no < (SELECT challan_no from fee_voucher_master where  challan_no='$challan_no' and student_id = '$student_id') and student_id = '$student_id'");
		
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
				
				$pdf->SetX($pdf->GetX() - 290);
				$pdf->Cell(35,5,'ARREARS',1,0);$pdf->Cell(35,5,number_format($arrear),1,0,'R');
				$pdf->SetX($pdf->GetX() - 275);
				$pdf->Cell(35,5,'ARREARS',1,0);$pdf->Cell(35,5,number_format($arrear),1,0,'R');
				$pdf->SetX($pdf->GetX() - 275);
				$pdf->Cell(35,5,'ARREARS',1,0);$pdf->Cell(35,5,number_format($arrear),1,1,'R');
				
				
				$total_payment=$payable_by+$arrear;
			
			
//////////////////////////////////////////////////////////////////////////////
// $pdf->SetFont("Arial","B",8);
// $pdf->SetX($pdf->GetX() - 290);
// $pdf->Cell(35,5,'Total Amount',1,0);$pdf->Cell(35,5,number_format($AMOUNT),1,0,'R');
// $pdf->SetX($pdf->GetX() - 275);
// $pdf->Cell(35,5,'Total Amount',1,0);$pdf->Cell(35,5,number_format($AMOUNT),1,0,'R');
// $pdf->SetX($pdf->GetX() - 275);
// $pdf->Cell(35,5,'Total Amount',1,0);$pdf->Cell(35,5,number_format($fee_amount),1,1,'R');	





$pdf->SetX($pdf->GetX() - 290);
		
$pdf->SetFont("Arial","B",8);
$pdf->Cell(35,5,'Total Amount',1,0);$pdf->Cell(35,5,number_format($total_payment),1,0,'R');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(35,5,'Total Amount',1,0);$pdf->Cell(35,5,number_format($total_payment),1,0,'R');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(35,5,'Total Amount',1,0);$pdf->Cell(35,5,number_format($total_payment),1,1,'R');	
 
$pdf->SetFont("Arial","",7);


//$pdf->SetX($pdf->GetX() - 290);
//$pdf->Cell(35,5,'Late Fees Arrears',1,0);$pdf->Cell(35,5,number_format($LATE_FEES),1,0,'R');
//$pdf->SetX($pdf->GetX() - 275);
//$pdf->Cell(35,5,'Late Fees Arrears',1,0);$pdf->Cell(35,5,number_format($LATE_FEES),1,0,'R');
//$pdf->SetX($pdf->GetX() - 275);
//$pdf->Cell(35,5,'Late Fees Arrears',1,0);$pdf->Cell(35,5,number_format($LATE_FEES),1,1,'R');	

$pdf->SetX($pdf->GetX() - 290);

$payable_after = $LATE_FEES + $payable_by;

//$pdf->SetFont("Arial","B",8);
//$pdf->Cell(35,5,'Payable After Due Date',1,0);$pdf->Cell(35,5,number_format($payable_after),1,0,'R');
//$pdf->SetX($pdf->GetX() - 275);
//$pdf->Cell(35,5,'Payable After Due Date',1,0);$pdf->Cell(35,5,number_format($payable_after),1,0,'R');
//$pdf->SetX($pdf->GetX() - 275);
//$pdf->Cell(35,5,'Payable After Due Date',1,0);$pdf->Cell(35,5,number_format($payable_after),1,1,'R');	



////////////////////////////////////////////////////////////////////////////////////////////
$pdf->SetFont("Symbol","",8);
$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(35,4,'',0,0);$pdf->Cell(35,4,'',0,0,'C');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(35,4,'',0,0);$pdf->Cell(35,4,'',0,0,'C');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(35,4,'',0,0);$pdf->Cell(35,4,'',0,1,'C');	


$pdf->SetFont("Symbol","B",7);


$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(70,5,'Payment Terms',0,0);
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(70,5,'Payment Terms',0,0);
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(70,5,'Payment Terms',0,0);

$pdf->SetX($pdf->GetX() - 255);
$pdf->Cell(35,4,'',0,0);$pdf->Cell(35,4,'',0,0,'C');
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(35,4,'',0,0);$pdf->Cell(35,4,'',0,0,'C');
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(35,4,'',0,0);$pdf->Cell(35,4,'',0,1,'C');	
$pdf->SetX($pdf->GetX() - 255);
$pdf->Cell(35,4,'',0,0);$pdf->Cell(35,4,'',0,0,'C');
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(35,4,'',0,0);$pdf->Cell(35,4,'',0,0,'C');
$pdf->SetX($pdf->GetX() - 249);
$pdf->Cell(35,4,'',0,0);$pdf->Cell(35,4,'',0,1,'C');	


//$pdf->SetX($pdf->GetX() - 290);
//$pdf->Cell(70,5,'FINE OF Rs.0 WILL BE LEVIED AFTER THE DUE DATE',0,0);
//$pdf->SetX($pdf->GetX() - 275);
//$pdf->Cell(70,5,'FINE OF Rs.0 WILL BE LEVIED AFTER THE DUE DATE',0,0);
//$pdf->SetX($pdf->GetX() - 272);
//$pdf->Cell(70,5,'FINE OF Rs.0 WILL BE LEVIED AFTER THE DUE DATE',0,1);

$pdf->SetFont("Arial","B",8);

	

$pdf->SetX($pdf->GetX() - 300);
$pdf->Cell(54,6,'Due Date :',0,0,'C');$pdf->Cell(25,6,date('d/M/Y',$due_date),0,0,'L');
$pdf->SetX($pdf->GetX() - 284);
$pdf->Cell(54,6,'Due Date :',0,0,'C');$pdf->Cell(25,6,date('d/M/Y',$due_date),0,0,'L');
$pdf->SetX($pdf->GetX() - 284);
$pdf->Cell(54,6,'Due Date :',0,0,'C');$pdf->Cell(25,6,date('d/M/Y',$due_date),0,1,'L');	

$pdf->SetX($pdf->GetX() - 300);
$pdf->Cell(54,6,'Expire Date :',0,0,'C');$pdf->Cell(25,6,date('d/M/Y',$expiry_date) ,0,0,'L');
$pdf->SetX($pdf->GetX() - 284);
$pdf->Cell(54,6,'Expire Date :',0,0,'C');$pdf->Cell(25,6,date('d/M/Y',$expiry_date) ,0,0,'L');
$pdf->SetX($pdf->GetX() - 284);
$pdf->Cell(54,6,'Expire Date :',0,0,'C');$pdf->Cell(25,6,date('d/M/Y',$expiry_date) ,0,1,'L');	

$pdf->Ln(15);

$pdf->SetFont("Arial","B",7);

$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(32,5,'_______________________',0,0,'C');
$pdf->Cell(45,5,'_______________________',0,0,'C');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(18,5,'_______________________',0,0,'C');
$pdf->Cell(57,5,'_______________________',0,0,'C');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(9,5,'_______________________',0,0,'C');
$pdf->Cell(65,5,'_______________________',0,1,'C');
$pdf->SetFont("Arial","B",8);
$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(30,5,'Cashier',0,0,'C');
$pdf->Cell(47,5,'Officer',0,0,'C');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(18,5,'Cashier',0,0,'C');
$pdf->Cell(57,5,'Officer',0,0,'C');
$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(9,5,'Cashier',0,0,'C');
$pdf->Cell(65,5,'Officer',0,0,'C');

$pdf->Ln(5);
$pdf->SetFont("Symbol","",6);

$pdf->SetX($pdf->GetX() - 290);
$pdf->Cell(70,5,'After dua date admission will be cancelled & reprocessing fees will be charged.',0,0,'C');

$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(70,5,'After dua date admission will be cancelled & reprocessing fees will be charged.',0,0,'C');

$pdf->SetX($pdf->GetX() - 275);
$pdf->Cell(70,5,'After dua date admission will be cancelled & reprocessing fees will be charged.',0,0,'C');

$payable_by=0;

}

$pdf->output();


?>