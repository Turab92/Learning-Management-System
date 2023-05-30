<?php

include ('include/function.php');

session_start();

$id1= $_SESSION['name'];
 $company_id = base64_decode($_GET['c_id']);
 $project_id = base64_decode($_GET['p_id']);
 $fiscal_year_id = base64_decode($_GET['f_id']);
 $vno = base64_decode($_GET['vno']);
$vtype = base64_decode($_GET['v_type']);

$select_vtype = mysqli_query($conn,"select description from voucher_types where voucher_type_id = '$vtype' ");

while($r = mysqli_fetch_array($select_vtype))
{
$vtype_description = $r['DESCRIPTION'];
}

error_reporting(0);
require('code128.php');

$select_post = mysqli_query($conn,"select posted from v_master where vno = '$vno' and vtype = '$vtype_description' and fiscal_year = '$fiscal_year_id'
 and project_id = '$project_id' and company_id = '$company_id'");

while($r = mysqli_fetch_array($select_post))
{
	$status = $r['POSTED'];
}

$sql=mysqli_query($conn,"select z.branch_id,z.branch_name,a.VNO||'-'||a.VTYPE VNO,a.VDATE,A.PROJECT_ID,bank_folio,a.company_id,a.fiscal_year,
a.REMARKS on_account_of,a.receive_by,y.company_id,y.comp_name,
b.voucher_nature,
a.CHQNO Cheaque_no,
a.CHQDT,
a.HEAD_CODE,
a.HEAD_DESC,
a.CHART_ACC_CODE,
a.CHART_ACC_DESC||'('||supplier_name(a.SUPNO,a.SUPTYPE)||')' CHART_ACC_DESC,
-------A.CHK,
sum(a.Total_Debit) Total_Debit,
sum(a.Total_Credit) Total_Credit,a.detail_remarks
from POSTED_VOUCHERS_PRINT a,voucher_types b ,school_branches z,comp_info y
where vno = '$vno'
and vtype= '$vtype_description' and a.project_id = z.branch_id and a.company_id = y.company_id
and a.VTYPE = b.description
and a.fiscal_year = '$fiscal_year_id'
and a.company_id = '$company_id'
and a.project_id = '$project_id'
group by a.VNO,a.VTYPE ,a.VDATE,A.PROJECT_ID,bank_folio,a.company_id,a.fiscal_year,
a.REMARKS,
b.voucher_nature,
a.CHQNO ,
a.CHQDT,
a.HEAD_CODE,
a.HEAD_DESC,
a.CHART_ACC_CODE,
a.CHART_ACC_DESC||'('||supplier_name(a.SUPNO,a.SUPTYPE)||')' ,a.detail_remarks,a.receive_by,z.branch_id,z.branch_name,y.company_id,y.comp_name");
 
            while($row=mysqli_fetch_array($sql)){			
			
           $vno=$row['VNO'];
		    $vdate=$row['VDATE'];
                 $remarks=$row['REMARKS'];
				 $bf=$row['BANK_FOLIO'];
				$cn=$row['CHEAQUE_NO'];
				$cd=$row['CHQDT'];
		   $project=$row['BRANCH_NAME'];
		   $rb=$row['RECEIVE_BY'];
		   $oao=$row['ON_ACCOUNT_OF'];
		   $debit=$row['TOTAL_DEBIT'];
		   $credit=$row['TOTAL_CREDIT'];
		   		   $company=$row['COMP_NAME'];

$totaldebit+= $debit;
		   
			}


function numberTowords($num)
{ 
$ones = array( 
1 => "one", 
2 => "two", 
3 => "three", 
4 => "four", 
5 => "five", 
6 => "six", 
7 => "seven", 
8 => "eight", 
9 => "nine", 
10 => "ten", 
11 => "eleven", 
12 => "twelve", 
13 => "thirteen", 
14 => "fourteen", 
15 => "fifteen", 
16 => "sixteen", 
17 => "seventeen", 
18 => "eighteen", 
19 => "nineteen" 
); 
$tens = array( 
2 => "twenty", 
3 => "thirty", 
4 => "forty", 
5 => "fifty", 
6 => "sixty", 
7 => "seventy", 
8 => "eighty", 
9 => "ninety" 
); 
$hundreds = array( 
"hundred", 
"thousand", 
"million", 
"billion", 
"trillion", 
"quadrillion" 
); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
if($i < 20){ 
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
$rettxt .= $tens[substr($i,0,1)]; 
$rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
$rettxt .= " ".$tens[substr($i,1,1)]; 
$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
} 
} 
if($decnum > 0){ 
$rettxt .= " and "; 
if($decnum < 20){ 
$rettxt .= $ones[$decnum]; 
}elseif($decnum < 100){ 
$rettxt .= $tens[substr($decnum,0,1)]; 
$rettxt .= " ".$ones[substr($decnum,1,1)]; 
} 
} 
return $rettxt; 
}

$pdf = new PDF_Code128();

$id1 = 'admin';
		
$pdf->AddPage();
$pdf->SetFont("","",9);
$pdf->Cell(280,6,'Report=> voucher_report_pdf',0,1,"C");
$pdf->Cell(280,6,'Genereted By : '.strtoupper($id1),0,1,"C");
$pdf->Cell(280,6,'Date : '.strtoupper($time),0,1,"C");

$pdf->SetFont("Symbol","B",9);
$pdf->Cell(0,200,'',1,0,"C");


$pdf->SetFont("Symbol","BU",12);

$pic = 'logo/rcslogo1.jpg';

$pdf->Cell(70,10,
$pdf->Image($pic,10, 5, 75, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false),0,0);

   
$pdf->SetX($pdf->GetX() - 100);
$pdf->Cell(0,2,'',0,1,'C');
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(0,20,'Reciept Voucher',0,'');



$pdf->SetX($pdf->GetX() - 120);
$pdf->Cell(0,2,'',0,1,'C');
$pdf->SetX($pdf->GetX() - 210);
if($status == 'Y')
{
$pdf->Cell(0,35,'POSTED',0,'');	
}
else
{
$pdf->Cell(0,35,'NOT POSTED',0,'');		
}
$pdf->ln(10);

$pdf->SetFont("Symbol","B",12);
$pdf->SetX($pdf->GetX() - 120);
$pdf->Cell(0,2,'',0,1,'C');
$pdf->SetX($pdf->GetX() - 135);
$pdf->Cell(25,10,$company,0,1,'C');
$pdf->SetX($pdf->GetX() - 135);
$pdf->Cell(25,10,$project,0,1,'C');
//
$pdf->ln(10);


$pdf->SetY($pdf->GetY() - 7);

$pdf->SetX($pdf->GetX() - 75);

$pdf->Cell(30,10,'Voucher No',0,'','');
$pdf->SetFont("Symbol","BU",10);
$pdf->Cell(10,10,$vno,10);
$pdf->SetX($pdf->GetX() - 40);
$pdf->SetFont("Symbol","B",10);
$pdf->Cell(30,25,'Date',0,'','');
$pdf->SetFont("Symbol","BU",10);

$pdf->Cell(20,25,$vdate,10);
$pdf->SetX($pdf->GetX() - 50);
$pdf->SetFont("Symbol","B",10);

$pdf->Cell(30,40,'Rs',0,'','');
$pdf->SetFont("Symbol","BU",10);

$pdf->Cell(20,40,number_format($totaldebit),10);
$pdf->SetX($pdf->GetX() - 50);
$pdf->SetFont("Symbol","B",10);

$pdf->Cell(30,55,'Bank Folio #',0,'','');
$pdf->SetFont("Symbol","BU",10);

$pdf->Cell(10,55,$bf,10);
$pdf->SetX($pdf->GetX() - 40);
$pdf->SetFont("Symbol","B",10);

$pdf->Cell(30,70,'Cheque #',0,'','');
$pdf->SetFont("Symbol","BU",10);

$pdf->Cell(20,70,$cn,10);
$pdf->SetX($pdf->GetX() - 50);
$pdf->SetFont("Symbol","B",10);

$pdf->Cell(30,85,'Cheque Date',0,'','');
$pdf->SetFont("Symbol","BU",10);

$pdf->Cell(20,85,$cd,10);
//
$pdf->SetY($pdf->GetY() + 5);
//
$pdf->SetFont("Symbol","",10);
$pdf->SetX($pdf->GetX() - 120);
$pdf->Cell(0,2,'',0,1,'C');
$pdf->SetX($pdf->GetX() - 210);

$pdf->Cell(30,3,'Project:',0,'','');
$pdf->SetFont("Symbol","BU",10);

$pdf->Cell(100,3,$project,10,0,'L');



$pdf->SetFont("Symbol","",10);
$pdf->SetX($pdf->GetX() - 130);

$pdf->Cell(30,18,'Recieved By:',0,'','');
$pdf->SetFont("Symbol","BU",10);

$pdf->Cell(90,18,$rb,10,0,'L');

$pdf->SetFont("Symbol","",10);
$pdf->SetX($pdf->GetX() - 120);

$pdf->Cell(30,33,'Sum Of Amount:',0,'','');
$pdf->SetFont("Symbol","BU",10);

$pdf->Cell(50,33,ucfirst(numberTowords($totaldebit))." "."Only ",10);


$pdf->SetFont("Symbol","",10);
$pdf->SetX($pdf->GetX() - 290);

$pdf->Cell(30,48,'Remarks :',0,'','');
$pdf->SetFont("Symbol","BU",10);
$pdf->Cell(50,48,$oao,10,1);

$pdf->SetFont("Symbol","",9);
$pdf->Cell(60,5,'On A/C Of',1,0,'C');
$pdf->Cell(80,5,'Detail remarks',1,0,'C');
$pdf->Cell(25,5,'Debit',1,0,'C');
$pdf->Cell(25,5,'Credit',1,0,'C');
$pdf->ln();


 $company_id = base64_decode($_GET['c_id']);
 $project_id = base64_decode($_GET['p_id']);
 $fiscal_year_id = base64_decode($_GET['f_id']);
 $vno = base64_decode($_GET['vno']);
$vtype = base64_decode($_GET['v_type']);

$select_vtype = mysqli_query($conn,"select description from voucher_types where type_id = '$vtype' ");

while($r = mysqli_fetch_array($select_vtype))
{
$vtype_description = $r['DESCRIPTION'];
}

$sql1=mysqli_query($conn,"select project_desc(a.project_id) project_name,a.VNO||'-'||a.VTYPE VNO,a.VDATE,A.PROJECT_ID,bank_folio,a.company_id,a.fiscal_year,
a.REMARKS on_account_of,a.receive_by,
b.voucher_nature,
a.CHQNO Cheaque_no,
a.CHQDT,
a.HEAD_CODE,
a.HEAD_DESC,
a.CHART_ACC_CODE,
a.CHART_ACC_DESC||'('||supplier_name(a.SUPNO,a.SUPTYPE)||')' CHART_ACC_DESC,
-------A.CHK,
sum(a.Total_Debit) Total_Debit,
sum(a.Total_Credit) Total_Credit,a.detail_remarks
from POSTED_VOUCHERS_PRINT a,voucher_types b
where vno= '$vno'
and vtype='$vtype_description'
and a.VTYPE = b.description
and a.fiscal_year = '$fiscal_year_id'
and a.company_id = '$company_id'
and a.project_id = '$project_id'
group by a.VNO,a.VTYPE ,a.VDATE,A.PROJECT_ID,bank_folio,a.company_id,a.fiscal_year,
a.REMARKS,
b.voucher_nature,
a.CHQNO ,
a.CHQDT,
a.HEAD_CODE,
a.HEAD_DESC,
a.CHART_ACC_CODE,
a.CHART_ACC_DESC||'('||supplier_name(a.SUPNO,a.SUPTYPE)||')' ,a.detail_remarks,a.receive_by

");
 
            while($row1=mysqli_fetch_array($sql1)){

			$cad=$row1['CHART_ACC_DESC'];
		   $oao1=$row1['DETAIL_REMARKS'];
		   $debit1=$row1['TOTAL_DEBIT'];
		   $credit1=$row1['TOTAL_CREDIT'];
		   $total_credit+=$credit1;
		   $total_debit+=$debit1;

$pdf->SetFont("Symbol","",9);
$pdf->Cell(60,5,$cad,1,'C');
$pdf->Cell(80,5,$oao1,1,'C');
$pdf->Cell(25,5,number_format($debit1),1,0,'R');
$pdf->Cell(25,5,number_format($credit1),1,1,'R');

			}
$pdf->SetFont("Symbol","B",11);			
$pdf->Cell(140,5,'Total',1,'C');
$pdf->Cell(25,5,number_format($total_debit),1,0,'R');
$pdf->Cell(25,5,number_format($total_credit),1,0,'R');

$pdf->ln(30);
$pdf->SetFont("Symbol","",10);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(0,0,'',0,1,'C');
$pdf->SetX($pdf->GetX() - 210);
$pdf->SetFont("Symbol","U",10);
$pdf->Cell(20,5,'_______'.ucfirst($id1).'______',0);
$pdf->SetX($pdf->GetX() - 225);
$pdf->Cell(20,20,'Generated By',0);


$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(0,0,'',0,1,'C');
$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(20,5,'_________________',0);
$pdf->SetX($pdf->GetX() - 225);
$pdf->Cell(30,20,'Checked By',0);
$pdf->SetX($pdf->GetX() - 240);
$pdf->Cell(30,30,'GM Finance',0);


$pdf->SetX($pdf->GetX() - 130);
$pdf->Cell(0,0,'',0,1,'C');
$pdf->SetX($pdf->GetX() - 130);
$pdf->Cell(20,5,'_________________',0);
$pdf->SetX($pdf->GetX() - 230);
$pdf->Cell(30,20,'Authorized Signatory',0);


$pdf->SetX($pdf->GetX() - 90);
$pdf->Cell(0,0,'',0,1,'C');
$pdf->SetX($pdf->GetX() - 90);
$pdf->Cell(20,5,'_________________',0);
$pdf->SetX($pdf->GetX() - 230);
$pdf->Cell(30,20,'Sanction By Director',0);


$pdf->SetX($pdf->GetX() - 50);
$pdf->Cell(0,0,'',0,1,'C');
$pdf->SetX($pdf->GetX() - 50);
$pdf->Cell(20,5,'________________',0);
$pdf->SetX($pdf->GetX() - 230);
$pdf->Cell(30,20,'Reciever Signature',0);




$pdf->output();

?>