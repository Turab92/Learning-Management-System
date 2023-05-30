
<?php
include ('include/function.php');
require('pdf/fpdf.php');

session_start();


$id1=$_SESSION['name'];

		
$sql = mysqli_query($conn, "select * from portal_user c where user_name='$id1'");
		
		 while(($rows_sql = mysqli_fetch_array($sql)) != false) 
		{
		$u_id=$rows_sql['USER_ID'];
		$b_id =$rows_sql['BRANCH_ID'];
		}
		
		     $gr_no = $_POST['names'];
		
		if($id1 == 'admin')
						{
						$r1 = mysqli_query($conn, "select a.STUDENT_ID,a.APPLICANT_NAME,a.branch_id,b.student_id,b.CLASS_ID,b.section_id,b.active,c.branch_id,c.branch_name,b.SESSION_ID,d.CLASS_ID,d.CLASS_DESCRIPTION,e.section_id,e.SECTION_DESCRIPTION from
student_current_Status a,student_current_class b,school_branches c,class_setup d,class_Setup_section e where a.student_id = b.student_id and
b.CLASS_ID = d.CLASS_ID and b.section_id = e.section_id and a.branch_id = c.branch_id and b.active = 'Y' and a.student_id = '$gr_no'"); 	
							
							
	while (($rows1 = mysqli_fetch_array($r1)) != false) {

	$student_id = $rows1['STUDENT_ID']; 
	$applicant_name = $rows1['APPLICANT_NAME'];
	$branch_name = $rows1['branch_name'];
	$class_name = $rows1['CLASS_DESCRIPTION'];
	$class_id = $rows1['CLASS_ID'];
	$section_description = $rows1['SECTION_DESCRIPTION'];
	$session_id = $rows1['SESSION_ID'];  
	  
	}
							
						

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
$pdf->Cell(80,6,'Report=> student_ledger_pdf',0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',11);
$pdf->Cell(20,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Genereted By : '.strtoupper($id1),0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',10);
$pdf->Cell(20,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Date : '.strtoupper($time),0,0,"L");
$pdf->ln();

 $pdf->SetFont('Arial','B',12);

   $pdf->Cell(80);
   
	
    $pdf->Cell(30,30,'EDUCATION MANAGEMENT SYSTEM',0,1,'C');

    $pdf->Cell(80);
    // Title
 $pdf->SetFont('Arial','',12);

    $pdf->Cell(30,10,'Student Ledger',0,1,'C');

    $pdf->Ln(1);
	$pdf->SetFont("Arial","","12");
	$pdf->Cell(60);
	$pdf->Cell(40,8,'Student Name :',0,0);
	$pdf->Cell(70,8,$applicant_name,0,1);
	 
 $pdf->Ln(1);

	$pdf->Cell(10);
	$pdf->Cell(20,8,'Branch :',0,0);
	$pdf->Cell(60,8,$branch_name,0,0);

	$pdf->Cell(15,8,'Class :',0,0);
	$pdf->Cell(35,8,$class_name,0,0);
	
	$pdf->Cell(20,8,'Section :',0,0);
	$pdf->Cell(30,8,$section_description,0,1);
	
$pdf->Ln(5);
     $pdf->SetFont('Arial','',8);
	 
$pdf->Cell(32,6,'Date',1,0,'C');
$pdf->Cell(20,6,'Voucher No',1,0,'C');
$pdf->Cell(35,6,'Charges Types',1,0,'C');
$pdf->Cell(35,6,'Fees Receivable',1,0,'C');
$pdf->Cell(35,6,'Fees Received',1,0,'C');
$pdf->Cell(35,6,'Balance',1,1,'C');

					
	

  $i=0;
		  
	$r = mysqli_query($conn, "select * from student_fees_structure a , charges_types b where a.student_id = '$student_id' and a.class_id = '$class_id' and a.charges_type_id = b.type_id and a.session_id = '$session_id'");  
	
	while (($rows = mysqli_fetch_array($r)) != false) {
		
$fees_voucher_no = $rows['FEES_VOUCHER_NO'];
$discount = $rows['DISCOUNT'];
$fee_amount = $rows['FEE_AMOUNT'];
$fee_amount1=$fee_amount-$discount;
$total_receivable_amount += $fee_amount1;
$balance+=$fee_amount1;
$charges = $rows['DESCRIPTION'];
$schedule_date = $rows['SCHEDULE_DATE'];
		
$pdf->Cell(32,6,$schedule_date,1,0,'C');
	
$pdf->Cell(20,6,$fees_voucher_no,1,0,'C');
$pdf->Cell(35,6,$charges,1,0,'C');
$pdf->Cell(35,6,$fee_amount1,1,0,'C');
$pdf->Cell(35,6,'',1,0,'C');
$pdf->Cell(35,6,$balance,1,1,'C');
				
	
	
$query = mysqli_query($conn, "select * from stud_fees_structure_detail where fees_voucher_no = '$fees_voucher_no' "); 
	
	while (($rows = mysqli_fetch_array($query)) != false) {
		$i+=1;
		
$rcv_date = $rows['RCV_DATE'];
$amount = $rows['AMOUNT'];
$received_amount += $amount;
$balance = $balance - $amount;
	

$pdf->Cell(32,6,$rcv_date,1,0,'C');		

$pdf->Cell(20,6,$fees_voucher_no,1,0,'C');
$pdf->Cell(35,6,'',1,0,'C');
$pdf->Cell(35,6,'',1,0,'C');
$pdf->Cell(35,6,$amount,1,0,'C');
$pdf->Cell(35,6,$balance,1,1,'C');


		
				
				 }   } 
				 
				  $pdf->SetFont('Arial','B',8);
				 
$pdf->Cell(52,6,'Total Balance',1,0,'C');
$pdf->Cell(35,6,'',1,0,'C');	
$pdf->Cell(35,6,$total_receivable_amount,1,0,'C');
$pdf->Cell(35,6,$received_amount,1,0,'C');
$pdf->Cell(35,6,$balance,1,0,'C');

					 
			
$pdf->Output();	

					}
						else
						{
							
							 $query = "select a.STUDENT_ID,a.APPLICANT_NAME,a.branch_id,b.STUDENT_ID,b.CLASS_ID,b.section_id,b.active,c.branch_id,c.branch_name,b.SESSION_ID,d.CLASS_ID,d.CLASS_DESCRIPTION,e.section_id,e.SECTION_DESCRIPTION from
student_current_Status a,student_current_class b,school_branches c,class_setup d,class_Setup_section e where a.STUDENT_ID = b.STUDENT_ID and
b.CLASS_ID = d.CLASS_ID and b.section_id = e.section_id and a.branch_id = c.branch_id and b.active = 'Y' and a.STUDENT_ID = '$gr_no'  and a.branch_id = '$b_id'";
         $query_run = mysqli_query($conn,$query);
		
		 $numrows = mysqli_fetch_all($query_run);
		 
		 if($numrows == 0)
		 {	
	     echo "<script>alert('No Student Found')</script>";
		 echo "<script>window.open('student_ledger','_self')</script>";
    exit();
		 }
		 else
		 {
			 
			 $r1 = mysqli_query($conn, "select a.STUDENT_ID,a.APPLICANT_NAME,a.branch_id,b.STUDENT_ID,b.CLASS_ID,b.section_id,b.active,c.branch_id,c.branch_name,b.SESSION_ID,d.CLASS_ID,d.CLASS_DESCRIPTION,e.section_id,e.SECTION_DESCRIPTION from
student_current_Status a,student_current_class b,school_branches c,class_setup d,class_Setup_section e where a.STUDENT_ID = b.STUDENT_ID and
b.CLASS_ID = d.CLASS_ID and b.section_id = e.section_id and a.branch_id = c.branch_id and b.active = 'Y' and a.STUDENT_ID = '$gr_no' and a.branch_id = '$b_id' "); 

	while (($rows1 = mysqli_fetch_array($r1)) != false) {

	$student_id = $rows1['STUDENT_ID']; 
	$applicant_name = $rows1['APPLICANT_NAME'];
	$branch_name = $rows1['branch_name'];
	$class_name = $rows1['CLASS_DESCRIPTION'];
	$class_id = $rows1['CLASS_ID'];
	$section_description = $rows1['SECTION_DESCRIPTION'];
	$session_id = $rows1['SESSION_ID'];  
	  
	}
	
							
						

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
$pdf->Cell(80,6,'Report=> student_ledger_pdf',0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',11);
$pdf->Cell(20,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Genereted By : '.strtoupper($id1),0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',10);
$pdf->Cell(20,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Date : '.strtoupper($time),0,0,"L");
$pdf->ln();

 $pdf->SetFont('Arial','B',12);

   $pdf->Cell(80);
   
	
    $pdf->Cell(30,6,'STUDENT MANAGEMENT SYSTEM',0,1,'C');

    $pdf->Cell(80);
    // Title
 $pdf->SetFont('Arial','',12);

    $pdf->Cell(30,10,'Student Ledger',0,1,'C');

    $pdf->Ln(1);
	$pdf->SetFont("Arial","","12");
	$pdf->Cell(60);
	$pdf->Cell(40,8,'Student Name :',0,0);
	$pdf->Cell(70,8,$applicant_name,0,1);
	 
 $pdf->Ln(1);

	$pdf->Cell(10);
	$pdf->Cell(20,8,'Branch :',0,0);
	$pdf->Cell(60,8,$branch_name,0,0);

	$pdf->Cell(15,8,'Class :',0,0);
	$pdf->Cell(35,8,$class_name,0,0);
	
	$pdf->Cell(20,8,'Section :',0,0);
	$pdf->Cell(30,8,$section_description,0,1);
	
$pdf->Ln(5);
     $pdf->SetFont('Arial','',8);
	 
$pdf->Cell(32,6,'Date',1,0,'C');
$pdf->Cell(20,6,'Voucher No',1,0,'C');
$pdf->Cell(35,6,'Charges Types',1,0,'C');
$pdf->Cell(35,6,'Fees Receivable',1,0,'C');
$pdf->Cell(35,6,'Fees Received',1,0,'C');
$pdf->Cell(35,6,'Balance',1,1,'C');

					
	

  $i=0;
		  
	$r = mysqli_query($conn, "select * from student_fees_structure a , charges_types b where a.student_id = '$student_id' and a.class_id = '$class_id' and a.charges_type_id = b.type_id and a.session_id = '$session_id'");  
	
	while (($rows = mysqli_fetch_array($r)) != false) {
		
$fees_voucher_no = $rows['FEES_VOUCHER_NO'];
$fee_amount = $rows['FEE_AMOUNT'];
$total_receivable_amount += $fee_amount;
$balance+=$fee_amount;
$charges = $rows['DESCRIPTION'];
$schedule_date = $rows['SCHEDULE_DATE'];
		
$pdf->Cell(32,6,$schedule_date,1,0,'C');
	
$pdf->Cell(20,6,$fees_voucher_no,1,0,'C');
$pdf->Cell(35,6,$charges,1,0,'C');
$pdf->Cell(35,6,$fee_amount,1,0,'C');
$pdf->Cell(35,6,'',1,0,'C');
$pdf->Cell(35,6,$balance,1,1,'C');
				
	
	
$query = mysqli_query($conn, "select * from stud_fees_structure_detail where fees_voucher_no = '$fees_voucher_no' "); 
	
	while (($rows = mysqli_fetch_array($query)) != false) {
		$i+=1;
		
$rcv_date = $rows['RCV_DATE'];
$amount = $rows['AMOUNT'];
$received_amount += $amount;
$balance = $balance - $amount;
	

$pdf->Cell(32,6,$rcv_date,1,0,'C');		

$pdf->Cell(20,6,$fees_voucher_no,1,0,'C');
$pdf->Cell(35,6,'',1,0,'C');
$pdf->Cell(35,6,'',1,0,'C');
$pdf->Cell(35,6,$amount,1,0,'C');
$pdf->Cell(35,6,$balance,1,1,'C');


		
				
				 }   } 
				 
				  $pdf->SetFont('Arial','B',8);
				 
$pdf->Cell(52,6,'Total Balance',1,0,'C');
$pdf->Cell(35,6,'',1,0,'C');	
$pdf->Cell(35,6,$total_receivable_amount,1,0,'C');
$pdf->Cell(35,6,$received_amount,1,0,'C');
$pdf->Cell(35,6,$balance,1,0,'C');

					 
			
$pdf->Output();	
			 
		 }
 
	
							
						}
		
    
	

			
				 ?>
											
		
	

