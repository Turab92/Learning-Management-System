<?php
include ('include/function.php');
  $class = $_POST['class'];
 $section = $_POST['section'];
 $user = $_POST['user'];
 $branch = $_POST['branch'];
 



require 'pdf/fpdf.php';
$pdf = new FPDF();



              $sql="select distinct a.section_id,a.class_id,b.section_id,b.section_description,c.class_id,c.CLASS_DESCRIPTION
			  from student_current_class a,class_setup c,class_setup_section b where a.class_id = '$class' and a.section_id = b.section_id
			  and a.class_id = c.class_id
";
        		$run=mysqli_query($conn,$sql);
        		
						 while(($row = mysqli_fetch_array($run)) != false) 
							 {	
					
					 $class_name = $row['CLASS_DESCRIPTION'];
					 
							 }
							 $page = 0;
				foreach($section as $sections)
 {
	 
	 
	          $pdf->AddPage();
			  $page+=1;

$pdf->SetFont('Symbol','',12);

$logo = 'assets/images/rcslogo1.jpg';

$pdf->Cell(50,21,$pdf->Image($logo, 14, $pdf->GetY() + 1, 40.78),0,0,"C");

$pdf->Cell(80,6,'Education Management System',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(20,6,'',0,0,"L");
$pdf->Cell(80,6,'Report=> class_strength_pdf',0,1,"L");
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

$pdf->SetFont("Symbol","BU",11);
$pdf->SetFillColor(227, 232, 237);

$pdf->Cell(60,12,'Class Strength Section Wise',0,0);
$pdf->Cell(90,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Page : '.$page,0,1,"L");
                 	$s_no = 0;
				     $sql="select a.section_id,a.SECTION_DESCRIPTION from class_setup_section a where a.section_id = '$sections'";
        		$run=mysqli_query($conn,$sql);
        		
									 while(($row = mysqli_fetch_array($run)) != false) 
							 {	
					
					 $section = $row['SECTION_DESCRIPTION'];
					 
							 

					 
$pdf->SetFont("Symbol","B",8);
$pdf->ln(5);
$pdf->Cell(194,6,$class_name,1,1,'C',1);
$pdf->Cell(194,6,$section,1,1,'C',1);
$pdf->Cell(11,6,'S No',1,0,'C',1);
$pdf->Cell(12,6,'Roll#',1,0,'C',1);
$pdf->Cell(14,6,'GR#',1,0,'C',1);
$pdf->Cell(45,6,'Student Name',1,0,'C',1);
$pdf->Cell(42,6,'Father Name',1,0,'C',1);
$pdf->Cell(23,6,'D.O.B',1,0,'C',1);
$pdf->Cell(22,6,'Admitted',1,0,'C',1);
$pdf->Cell(25,6,'Contact No',1,1,'C',1);
$student_no = 0;
				
					 $query="select a.STUDENT_ID,a.class_id,a.section_id,a.ROLL_NO,b.STUDENT_ID,b.APPLICANT_NAME,b.FATHER_NAME,
					 b.DATE_OF_BIRTH,b.DATE_OF_SUBMISSION,b.CONTACT_PERSON_MOB,b.left_date,b.branch_id
					 from student_current_class a,student_current_status b where a.class_id = '$class'
and a.section_id = '$sections' and active='Y' and a.STUDENT_ID = b.STUDENT_ID and b.left_date is null and b.branch_id = '$branch' ";
        		$select=mysqli_query($conn,$query);
        		
				 while(($row1 = mysqli_fetch_array($select)) != false) 
				 {		
				     $student_id = $row1['STUDENT_ID'];				 
                     $roll_no = $row1['ROLL_NO'];								 
					 $student = $row1['APPLICANT_NAME'];
					 $father_name = $row1['FATHER_NAME'];
                     $date_of_birth = $row1['DATE_OF_BIRTH'];
					 $date_of_addmission = $row1['DATE_OF_SUBMISSION'];
					 $contact = $row1['CONTACT_PERSON_MOB'];
                     $student_no += 1;
$s_no +=1;
$pdf->SetFont("Symbol","",8);
$pdf->Cell(11,6,$s_no,1,0,'C');
$pdf->Cell(12,6,$roll_no,1,0,'C');
$pdf->Cell(14,6,$student_id,1,0,'C');
$pdf->Cell(45,6,$student,1,0,'C');
$pdf->Cell(42,6,$father_name,1,0,'C');
$pdf->Cell(23,6,$date_of_birth,1,0,'C');
$pdf->Cell(22,6,$date_of_addmission,1,0,'C');
$pdf->Cell(25,6,$contact,1,1,'C');


                }
			$pdf->SetFont("Symbol","",12);	
		$pdf->Cell(35,6,'Total In Class : ',1,0,'C');
$pdf->Cell(35,6,$student_no,1,1,'C');		
			
 }
 
 }
                
$pdf->output();
// ?>




