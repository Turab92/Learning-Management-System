<?php
	include ('include/function.php');

require 'pdf/fpdf.php';
$pdf = new FPDF('P','mm',array(550,550));
$pdf->AddPage();
$pdf->SetFont('Symbol','',12);

$user = $_POST['user'];

$logo = 'assets/images/rcslogo1.jpg';

$branch_id = $_POST['class'];

$query=mysqli_query($conn,"select * from school_branches where branch_id = '$branch_id' ");
                    
                   while (($row = mysqli_fetch_array($query)) != false) {
					   $branch_name = $row['branch_name'];
				   }


$pdf->Cell(50,21,$pdf->Image($logo, 14, $pdf->GetY() + 1, 40.78),0,0,"C");

$pdf->Cell(80,6,'Student Management System',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(355,6,'',0,0,"L");
$pdf->Cell(80,6,'Report=> student_register_pdf',0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',11);
$pdf->Cell(15,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Genereted By : '.strtoupper($user),0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',10);
$pdf->Cell(15,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Date : '.strtoupper($time),0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',10);
$pdf->Cell(15,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Branch : '.$branch_name,0,0,"L");


  $issue = date('Y/m/d', strtotime($_POST['issue']));
	$left = date('Y/m/d',strtotime($_POST['left']));



$pdf->SetFont('Symbol','',14);
$pdf->Cell(60,12,'G.R.N Register On '.$issue. ' To '.$left,0,1);

$pdf->SetFont("Arial","B",6);
$pdf->Cell(407,7,'Student',1,0);
$pdf->Cell(125,7,'Father',1,1);
$pdf->Cell(8,7,'S.no',1,0);
$pdf->Cell(9,7,'Gr.no',1,0);
$pdf->Cell(45,7,'Name',1,0);
$pdf->Cell(10,7,'Gender',1,0);
$pdf->Cell(105,7,'Address',1,0);
$pdf->Cell(30,7,'Mother Name',1,0);
$pdf->Cell(15,7,'Date Of Birth',1,0);

$pdf->Cell(15,7,'nationality',1,0);
$pdf->Cell(10,7,'Religion',1,0);

$pdf->Cell(45,7,'House',1,0);
$pdf->Cell(45,7,'Last School',1,0);

$pdf->Cell(25,7,'Date Of Admission',1,0);
$pdf->Cell(30,7,'Class',1,0);
$pdf->Cell(15,7,'Date of Left',1,0);

$pdf->Cell(45,7,' Name',1,0);
$pdf->Cell(30,7,' CNIC',1,0);
$pdf->Cell(30,7,' Profession',1,0);

$pdf->Cell(20,7,'Contact',1,1);


$s_no = 0 ;
$pdf->SetFont("Arial","",7);

$sql=mysqli_query($conn,"select * from student_current_status as scs join student_previous_detail as spd on scs.student_id=spd.student_id join class_setup as cs on scs.CLASS_ID=cs.CLASS_ID where scs.DATE_OF_SUBMISSION BETWEEN '$issue' and '$left' and scs.BRANCH_ID = '$branch_id'");
                   
                   while (($row = mysqli_fetch_array($sql)) != false) {
  $s_no += 1;
  
					$an=$row['APPLICANT_NAME'];
					 $aa=$row['APPLICANT_ADDRESS'];
					 $g=$row['GENDER'];
                   $iddd=$row['STUDENT_ID']; 
					
					$fn=$row['FATHER_NAME'];
        			$mn=$row['MOTHER_NAME'];
                      $dob=$row['DATE_OF_BIRTH'];
					   $dos=$row['DATE_OF_SUBMISSION'];
                     
					$ant=$row['APPLICANT_NATIONALITY'];
					
					$r=$row['RELIGION'];
						$c=$row['CLASS_DESCRIPTION'];
				
					$gcn=$row['GUARDIAN_CNIC_NO'];
					
					$gp=$row['GUARDIAN_PROFFESSION'];
					
					$gr=$row['ADMISSION_FORM_ID'];
					$pan=$row['academy_name'];
					
					$cpn=$row['CONTACT_PERSON_NAME'];
					$cpm=$row['CONTACT_PERSON_MOB'];
					
					$ld=$row['LEFT_DATE'];
					
						
	
$pdf->Cell(8,7,$s_no,1,0);
$pdf->Cell(9,7,$gr,1,0);
$pdf->Cell(45,7,$an,1,0);
$pdf->Cell(10,7,$g,1,0);
$pdf->Cell(105,7,$aa,1,0);
$pdf->Cell(30,7,$mn,1,0);
$pdf->Cell(15,7,$dob,1,0);

$pdf->Cell(15,7,$ant,1,0);
$pdf->Cell(10,7,$r,1,0);

$pdf->Cell(45,7,$cpn,1,0);
$pdf->Cell(45,7,$pan,1,0);

$pdf->Cell(25,7,$dos,1,0);
$pdf->Cell(30,7,$c,1,0);
$pdf->Cell(15,7,$ld,1,0);

$pdf->Cell(45,7,$fn,1,0);
$pdf->Cell(30,7,$gcn,1,0);
$pdf->Cell(30,7,$gp,1,0);

$pdf->Cell(20,7,$cpm,1,1);

 
		   



				    }

	
	
$pdf->output();

?>