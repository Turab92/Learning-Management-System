<?php

include ('include/function.php');
require('code128.php');



	$pdf=new PDF_Code128();
$pdf->AddPage();
$pdf->SetFont('Symbol','',10);


$employee = $_POST['employees'];

$logo = 'assets/images/rcslogo1.jpg';



	
	
	$sql="select * from employees a ,designation b where a.emp_id = '$employee' and a.designation_id = b.designation_id ";
        		$run=mysqli_query($conn,$sql);
        		
						 while(($row = mysqli_fetch_array($run)) != false) 
						 {										

								 $emp_name = $row['EMP_NAME'];
								 $image = $row['EMP_IMG'];
								 $father_name = $row['EMP_FATHER_NAME'];
								 $designation = $row['designation_name'];
								 $rf_id = $row['RF_ID'];
					
					// $query = "update student_current_class set is_print = 1 where student_current_class = '$student_class'";
					// $update = oci_parse($conn,$query);
					// oci_execute($update);

	$pdf->ln(20);
$pdf->Cell(95 ,65,'',1, 0);
$pdf->Cell(95 ,65,'',1, 0);
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 190);
$pdf->Cell(95 ,16, $pdf->Image($logo, 12, $pdf->GetY() + 1, 32.78).$pdf->Image($logo, 65, $pdf->GetY() + 1, 32.78),1, 0);


$pdf->Code128(125, $pdf->GetY() + 50,$rf_id,50,12);



$pdf->SetX($pdf->GetX() - 0);
$pdf->Cell(95 ,16,$pdf->Image($logo, 110, $pdf->GetY() + 12, 85.78),0, 1);


$pdf->ln(3);

$pdf->SetX($pdf->GetX() - 145);

$pdf->Cell( 27 ,35, 
 $pdf->Image("emp_images/".$image,75, $pdf->GetY(), 27)
, 1, 0);

$pdf->SetFont("Symbol","U",11);
$pdf->SetX($pdf->GetX() - 280);
$pdf->Cell(25 ,7,'Employee Card',0, 1);

$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,8,'Name :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$emp_name,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,8,'Father Name :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$father_name,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,7,'Designation :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,7,$designation,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->Cell(25 ,8,'Date-Of-Issue :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$today = date("j F, Y"),0, 1,'L');



$pdf->SetX($pdf->GetX() - 210);

$pdf->Cell(95 ,8,'Real Core Solutions',1, 1,'C');

}
	


$pdf->output();

 ?>
		