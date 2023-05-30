
<?php
require('pdf/fpdf.php');

include ('include/function.php');


	                    $branch = $_POST['branch'];
						$class = $_POST['class'];
	                    $user = $_POST['user'];
						

class PDF extends FPDF
{
	
	function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Simple table
function data($data)
{
   
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->MultiCell(180,6,$col,0);
            $this->Cell(1,1,'',0,1);
    }
}
	
}


$pdf = new PDF('P','mm','A4');		

error_reporting(0);

$pdf->SetTopMargin(25);


$pdf->AddPage();

 $pdf->SetFont('Arial','B',12);

$pic = 'assets/images/rcslogo1.jpg';


$pdf->Cell(70,10,
$pdf->Image($pic,70, 5, 75, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false),0,0);

$pdf->SetY($pdf->GetY() - 15);
$pdf->SetX($pdf->GetX() - 80);
$pdf->SetFont('Symbol','',9);
$pdf->Cell(20,6,'',0,0,"L");
$pdf->Cell(80,6,'Report=> class_ledger_pdf',0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',11);
$pdf->Cell(20,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Genereted By : '.strtoupper($user),0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',10);
$pdf->Cell(20,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Date : '.strtoupper($time),0,0,"L");
$pdf->ln();

  $issue = date('n/d/Y', strtotime($_POST['issue']));
 $left = date('n/d/Y', strtotime($_POST['left']));
	
 $pdf->SetFont('Arial','B',12);

   $pdf->Cell(80);
  
    $r1 = mysqli_query($conn, "select distinct a.SESSION_ID,a.class_id,a.branch_id,a.active,b.class_id,b.CLASS_DESCRIPTION,c.branch_id,c.branch_name from student_current_class a , 
 class_setup b,school_branches c where a.class_id  = '$class' and a.active = 'Y' and a.branch_id = '$branch' and a.class_id = b.class_id 
 and a.branch_id = c.branch_id"); 
	
	while (($rows1 =mysqli_fetch_array($r1)) != false) {

	$session_id = $rows1['SESSION_ID'];
    $class_name = $rows1['CLASS_DESCRIPTION'];	
	$branch_name = $rows1['branch_name'];
	  
	}
   
   
    $pdf->Cell(30,30,'EDUCATION MANAGEMENT SYSTEM',0,1,'C');

    $pdf->Cell(80);
    // Title
 $pdf->SetFont('Arial','',12);

    $pdf->Cell(30,10,'Fee - Balances',0,1,'C');
	 
 $pdf->Ln(1);

	$pdf->Cell(40);
	$pdf->Cell(20,8,'Branch :',0,0);
	$pdf->Cell(60,8,$branch_name,0,0);

	$pdf->Cell(15,8,'Class :',0,0);
	$pdf->Cell(35,8,$class_name,0,0);
	
	
$pdf->Ln(20);
     $pdf->SetFont('Arial','',8);
	 
$pdf->Cell(15,10,'S No',1,0,'C');
$pdf->Cell(25,10,'Student ID',1,0,'C');
$pdf->Cell(50,10,'Student Name',1,0,'C');
$pdf->Cell(33,10,'Fees Receivable',1,0,'C');
$pdf->Cell(33,10,'Fees Received',1,0,'C');
$pdf->Cell(33,10,'Balance',1,1,'C');


  $i=0;
		  
	$r = mysqli_query($conn, "select sum(a.fee_amount),sum(b.amount),a.STUDENT_ID,c.APPLICANT_NAME from student_fees_structure a ,stud_fees_structure_detail b,student_current_Status c ,student_current_class d where b.RCV_DATE BETWEEN  ('$issue' and '$left') and d.class_id = '$class' and d.active = 'Y' and c.STUDENT_ID = d.STUDENT_ID and c.left_date is null and c.branch_id = '$branch' and a.session_id = '$session_id'  and a.fees_voucher_no = b.fees_voucher_no and a.STUDENT_ID = c.STUDENT_ID
 group by a.STUDENT_ID,c.APPLICANT_NAME");  
	
	while (($rows = mysqli_fetch_array($r)) != false) {
		
    $student_id = $rows['STUDENT_ID'];
	$student_name = $rows['APPLICANT_NAME'];
	$total_receivable_amount = $rows['SUM(A.FEE_AMOUNT)'];
	$total_received_amount = $rows['SUM(B.AMOUNT)'];
	$balance = $total_receivable_amount - $total_received_amount;
	
	$total_receivable += $total_receivable_amount;
  $total += $total_received_amount;
	$total_balance += $balance;
		
		$i+=1;
		
$pdf->Cell(15,10,$i,1,0,'C');
$pdf->Cell(25,10,$student_id,1,0,'C');
$pdf->Cell(50,10,$student_name,1,0,'C');
$pdf->Cell(33,10,$total_receivable_amount,1,0,'C');
$pdf->Cell(33,10,$total_received_amount,1,0,'C');
$pdf->Cell(33,10,$balance,1,1,'C');					
	
	
 } 
				 
				  $pdf->SetFont('Arial','B',8);
				 
$pdf->Cell(90,10,'Total Balance',1,0,'C');

$pdf->Cell(33,10,$total_receivable,1,0,'C');
$pdf->Cell(33,10,$total,1,0,'C');
$pdf->Cell(33,10,$total_balance,1,1,'C');					 
			
$pdf->Output();
			
				 ?>
											
		
	

