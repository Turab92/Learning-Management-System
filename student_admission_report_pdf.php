<?php
include ('include/function.php');
session_start();
$id1= $_SESSION['name'];

		
$sql = mysqli_query($conn, "select * from portal_user c where user_name='$id1'");
		
		 while(($rows_sql = mysqli_fetch_array($sql)) != false) 
		{
		$u_id=$rows_sql['USER_ID'];
		$b_id =$rows_sql['BRANCH_ID'];
		}
		
$gr_no = $_POST['names'];

  
  if($id1 == 'admin')
						{
							
							   $sql=mysqli_query($conn,"select * from student_current_status a,student_current_class s ,class_setup c,school_branches b,class_setup_section e, religion_setup r,gender_setup g where a.branch_id=b.branch_id and s.class_id=c.class_id and a.STUDENT_ID='$gr_no' and a.student_id = s.student_id and s.active = 'Y' and s.section_id = e.section_id and a.RELIGION=r.REG_ID and a.GENDER=g.G_ID");
                    
					while (($row = mysqli_fetch_array($sql)) != false) {
  
                     $student_id=$row['STUDENT_ID'];
        			$applicant_name=$row['APPLICANT_NAME'];
					$class_description=$row['CLASS_DESCRIPTION'];
					$father_name=$row['FATHER_NAME'];
        			$mother_name=$row['MOTHER_NAME'];
					$section = $row['SECTION_DESCRIPTION'];
                      $dob=$row['DATE_OF_BIRTH'];
                      $applicant_address=$row['APPLICANT_ADDRESS'];
					$applicant_nationality=$row['APPLICANT_NATIONALITY'];
					$gender=$row['GENDER_DESCRIPTION'];
					$religion=$row['REG_NAME'];
					$applicant_contact_res_no=$row['APPLICANT_CONTACT_RES_NO'];
					$blood_group=$row['BLOOD_GROUP'];
					$guardian_name=$row['GUARDIAN_NAME'];
					$gcn=$row['GUARDIAN_CNIC_NO'];
					$gnt=$row['GUARDIAN_NATIONALITY'];
					$gp=$row['GUARDIAN_PROFFESSION'];
					$rfn=$row['REFERENCE_FORM_NO'];
					$rpn=$row['REFERENCE_PERSON_NAME'];
					$rpcn=$row['REFERENCE_PERSON_CNIC_NO'];
					$rpa=$row['REFERENCE_PERSON_ADDRESS'];
					$rpcm=$row['REFERENCE_PERSON_CONTACT_MOB'];
					$cpn=$row['CONTACT_PERSON_NAME'];
					$cpm=$row['CONTACT_PERSON_MOB'];
					$cpa=$row['CONTACT_PERSON_ADDRESS'];
					$cpe=$row['CONTACT_PERSON_EMAIL'];
					$scn=$row['SIBLINGS_CNIC_NO'];
						$e=$row['EMAIL'];
						$img=$row['IMG_LOC'];
						$scr=$row['SPECIAL_CASE_REMARKS'];
						$br=$row['branch_name'];
					$rn=$row['ROLL_NO'];
					$rf=$row['RF_ID'];
					$td=$row['DATE_OF_SUBMISSION'];
					$fd=$row['LEFT_DATE'];
					$sld=$row['SIBLINGS_LEFT_DATE'];
						$scn=$row['SIBLING_CNIC_NO'];
					$reference_pictures = $row['REFERENCE_PICTURES'];	
					$from_date = $row['FROM_DATE'];
					$to_date = $row['TO_DATE'];
					$disease_detail = $row['DISEASE_DETAILS'];
					

                     }
							   
							   
require('code128.php');

$pdf=new PDF_Code128('P','mm',array(220,260));
$pdf->AddPage();
$pdf->SetFont('Symbol','',12);

$logo = 'assets/images/rcslogo1.jpg';

$pdf->Cell(50,21,$pdf->Image($logo, 14, $pdf->GetY() + 1, 40.78),0,0,"C");

$pdf->Cell(80,6,'Education Management System',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(25,6,'',0,0,"L");
$pdf->Cell(80,6,'Report=> student_admission_report_pdf',0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',11);
$pdf->Cell(15,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Genereted By : '.strtoupper($id1),0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',10);
$pdf->Cell(15,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Date : '.strtoupper($time),0,0,"L");
$pdf->ln();

$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(50,10,'Student Admission Report ',0,1,"L");
$pdf->ln(3);
$pdf->Cell(200,6,'Student Info',0,1,"C");

$pdf->Cell(200,0,'',1,1,"L");
$pdf->Cell(190,1,'',0,1,"L");

$pdf->Cell(200,74,'',1,0,"L");
$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(10,2,'',0,1,"L");

$pdf->SetX($pdf->GetX() - 50);
if($img == null)
{
$pdf->Cell(27,7,'No Image Found');
}
else
{
	$pdf->Cell(27,35,$pdf->Image("student_images/".$img, 180, $pdf->GetY(), 27),1,0,"L");
}
$pdf->SetX($pdf->GetX() - 195);
$pdf->Cell(28,7,'Rf ID :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(30,7,$rf,0,0,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(28,7,'Student ID :',0,0,"L");
$pdf->Cell(30,7,$student_id,0,0,"L");
$pdf->SetFont('Symbol','BU',11);

$pdf->Cell(18,7,'Roll No :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(28,7,$rn,0,1,"L");
$pdf->SetFont('Symbol','BU',11);

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Student Name :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$applicant_name,0,0,"L");
$pdf->Cell(28,7,'Father Name :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$father_name,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Mother Name :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$mother_name,0,0,"L");
$pdf->Cell(28,7,'Date Of Birth :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$dob,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Address :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->MultiCell(134,7,$applicant_address,0,1);


$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Gender : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(30,7,$gender,0,0,"L");
$pdf->Cell(28,7,'Religion :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(30,7,$religion,0,0,"L");
$pdf->Cell(24,7,'Blood Group :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(22,7,$blood_group,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Residential No : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$applicant_contact_res_no,0,0,"L");
$pdf->Cell(28,7,'Admission Date :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$td,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Branch : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$br,0,0,"L");
$pdf->Cell(28,7,'Class :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$class_description,0,1,"L");


$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Section :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$section,0,0,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(28,7,'Siblings CNIC :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$scn,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);

$pdf->Cell(28,7,'Disease Details :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->MultiCell(134,7,$disease_detail,0,1);

$pdf->ln(14);

$pdf->Cell(200,6,'Guardian Info',0,1,"C");

$pdf->Cell(200,0,'',1,1,"L");
$pdf->Cell(190,1,'',0,1,"L");

$pdf->Cell(200,20,'',1,0,"L");
$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(10,2,'',0,1,"L");


$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Guardian Name :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$guardian_name,0,0,"L");
$pdf->Cell(28,7,'CNIC No :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$gcn,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Nationality :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$gnt,0,0,"L");
$pdf->Cell(28,7,'Profession :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$gp,0,1,"L");


$pdf->ln(8);

$pdf->Cell(200,6,'Contact Person',0,1,"C");

$pdf->Cell(200,0,'',1,1,"L");
$pdf->Cell(190,1,'',0,1,"L");

$pdf->Cell(200,33,'',1,0,"L");

$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(10,2,'',0,1,"L");

				
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,' Name :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$cpn,0,0,"L");
$pdf->Cell(28,7,'Mobile No : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$cpm,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Address :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->MultiCell(134,7,$cpa,0,1);

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Email :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(134,7,$cpe,0,1);


$pdf->ln(14);

$pdf->Cell(200,6,'Reference Info',0,1,"C");

$pdf->Cell(200,0,'',1,1,"L");
$pdf->Cell(190,1,'',0,1,"L");

$pdf->Cell(200,33,'',1,0,"L");

$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(10,2,'',0,1,"L");


$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,' Form No :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$rfn,0,0,"L");
$pdf->Cell(28,7,'Name : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$rpn,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,' CNIC No :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$rpcn,0,0,"L");
$pdf->Cell(28,7,'Contact No : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$rpcm,0,1,"L");
	

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,' Address :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(134,7,$rpa,0,1);



$pdf->output();
							
						}
						else
						{
							
	$query = "select * from student_current_status a,student_current_class s ,class_setup c,school_branches b,class_setup_section e where a.branch_id=b.branch_id and s.class_id=c.class_id and a.STUDENT_ID='$gr_no' and a.student_id = s.student_id and s.active = 'Y' and s.section_id = e.section_id and a.branch_id = '$b_id' ";
         $query_run = mysqli_query($conn,$query);
		 
		 $numrows = mysqli_fetch_all($query_run);
		 
		 if($numrows == 0)
		 {	
	     echo "<script>alert('No Student Found')</script>";
		 echo "<script>window.open('student_admission_report_report','_self')</script>";
    exit();
		 }
		 else
		 {
							
	   $sql=mysqli_query($conn,"select * from student_current_status a,student_current_class s ,class_setup c,school_branches b,class_setup_section e, religion_setup r,gender_setup g where a.branch_id=b.branch_id and s.class_id=c.class_id and a.STUDENT_ID='$gr_no' and a.student_id = s.student_id and s.active = 'Y' and s.section_id = e.section_id and a.RELIGION=r.REG_ID and a.GENDER=g.G_ID");
                    
					while (($row = mysqli_fetch_array($sql)) != false) {
  
                     $student_id=$row['STUDENT_ID'];
        			$applicant_name=$row['APPLICANT_NAME'];
					$class_description=$row['CLASS_DESCRIPTION'];
					$father_name=$row['FATHER_NAME'];
        			$mother_name=$row['MOTHER_NAME'];
					$section = $row['SECTION_DESCRIPTION'];
                      $dob=$row['DATE_OF_BIRTH'];
                      $applicant_address=$row['APPLICANT_ADDRESS'];
					$applicant_nationality=$row['APPLICANT_NATIONALITY'];
					$gender=$row['GENDER_DESCRIPTION'];
					$religion=$row['REG_NAME'];
					$applicant_contact_res_no=$row['APPLICANT_CONTACT_RES_NO'];
					$blood_group=$row['BLOOD_GROUP'];
					$guardian_name=$row['GUARDIAN_NAME'];
					$gcn=$row['GUARDIAN_CNIC_NO'];
					$gnt=$row['GUARDIAN_NATIONALITY'];
					$gp=$row['GUARDIAN_PROFFESSION'];
					$rfn=$row['REFERENCE_FORM_NO'];
					$rpn=$row['REFERENCE_PERSON_NAME'];
					$rpcn=$row['REFERENCE_PERSON_CNIC_NO'];
					$rpa=$row['REFERENCE_PERSON_ADDRESS'];
					$rpcm=$row['REFERENCE_PERSON_CONTACT_MOB'];
					$cpn=$row['CONTACT_PERSON_NAME'];
					$cpm=$row['CONTACT_PERSON_MOB'];
					$cpa=$row['CONTACT_PERSON_ADDRESS'];
					$cpe=$row['CONTACT_PERSON_EMAIL'];
					$scn=$row['SIBLINGS_CNIC_NO'];
						$e=$row['EMAIL'];
						$img=$row['IMG_LOC'];
						$scr=$row['SPECIAL_CASE_REMARKS'];
						$br=$row['branch_name'];
					$rn=$row['ROLL_NO'];
					$rf=$row['RF_ID'];
					$td=$row['DATE_OF_SUBMISSION'];
					$fd=$row['LEFT_DATE'];
					$sld=$row['SIBLINGS_LEFT_DATE'];
						$scn=$row['SIBLING_CNIC_NO'];
					$reference_pictures = $row['REFERENCE_PICTURES'];	
					$from_date = $row['FROM_DATE'];
					$to_date = $row['TO_DATE'];
					$disease_detail = $row['DISEASE_DETAILS'];
					

                     }
							
require('code128.php');

$pdf=new PDF_Code128('P','mm',array(220,260));
$pdf->AddPage();
$pdf->SetFont('Symbol','',12);

$logo = 'assets/images/rcslogo1.jpg';

$pdf->Cell(50,21,$pdf->Image($logo, 14, $pdf->GetY() + 1, 40.78),0,0,"C");

$pdf->Cell(80,6,'Education Management System',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(25,6,'',0,0,"L");
$pdf->Cell(80,6,'Report=> student_admission_report_pdf',0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',11);
$pdf->Cell(15,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Genereted By : '.strtoupper($id1),0,1,"L");
$pdf->SetX($pdf->GetX() - 160);
$pdf->SetFont('Symbol','B',10);
$pdf->Cell(15,6,'',0,0,"L");
$pdf->Cell(80,6,'',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(80,6,'Date : '.strtoupper($time),0,0,"L");
$pdf->ln();

$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(50,6,'Student Admission Report ',0,1,"L");
$pdf->ln(3);
$pdf->Cell(200,6,'Student Info',0,1,"C");

$pdf->Cell(200,0,'',1,1,"L");
$pdf->Cell(190,1,'',0,1,"L");

$pdf->Cell(200,74,'',1,0,"L");
$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(10,2,'',0,1,"L");

$pdf->SetX($pdf->GetX() - 50);

if($img == null)
{
$pdf->Cell(27,7,'No Image Found');
}
else
{
	$pdf->Cell(27,35,$pdf->Image("student_images/".$img, 180, $pdf->GetY(), 27),1,0,"L");
}

$pdf->SetX($pdf->GetX() - 195);
$pdf->Cell(28,7,'Rf ID :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(30,7,$rf,0,0,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(28,7,'Student ID :',0,0,"L");
$pdf->Cell(30,7,$student_id,0,0,"L");
$pdf->SetFont('Symbol','BU',11);

$pdf->Cell(18,7,'Roll No :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(28,7,$rn,0,1,"L");
$pdf->SetFont('Symbol','BU',11);

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Student Name :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$applicant_name,0,0,"L");
$pdf->Cell(28,7,'Father Name :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$father_name,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Mother Name :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$mother_name,0,0,"L");
$pdf->Cell(28,7,'Date Of Birth :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$dob,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Address :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->MultiCell(134,7,$applicant_address,0,1);


$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Gender : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(30,7,$gender,0,0,"L");
$pdf->Cell(28,7,'Religion :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(30,7,$religion,0,0,"L");
$pdf->Cell(24,7,'Blood Group :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(22,7,$blood_group,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Residential No : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$applicant_contact_res_no,0,0,"L");
$pdf->Cell(28,7,'Admission Date :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$td,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Branch : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$br,0,0,"L");
$pdf->Cell(28,7,'Class :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$class_description,0,1,"L");


$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Section :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$section,0,0,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(28,7,'Siblings CNIC :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$scn,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);

$pdf->Cell(28,7,'Disease Details :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->MultiCell(134,7,$disease_detail,0,1);

$pdf->ln(14);

$pdf->Cell(200,6,'Guardian Info',0,1,"C");

$pdf->Cell(200,0,'',1,1,"L");
$pdf->Cell(190,1,'',0,1,"L");

$pdf->Cell(200,20,'',1,0,"L");
$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(10,2,'',0,1,"L");


$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Guardian Name :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$guardian_name,0,0,"L");
$pdf->Cell(28,7,'CNIC No :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$gcn,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Nationality :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$gnt,0,0,"L");
$pdf->Cell(28,7,'Profession :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$gp,0,1,"L");


$pdf->ln(8);

$pdf->Cell(200,6,'Contact Person',0,1,"C");

$pdf->Cell(200,0,'',1,1,"L");
$pdf->Cell(190,1,'',0,1,"L");

$pdf->Cell(200,33,'',1,0,"L");

$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(10,2,'',0,1,"L");

				
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,' Name :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$cpn,0,0,"L");
$pdf->Cell(28,7,'Mobile No : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$cpm,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Address :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->MultiCell(134,7,$cpa,0,1);

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,'Email :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(134,7,$cpe,0,1);


$pdf->ln(14);

$pdf->Cell(200,6,'Reference Info',0,1,"C");

$pdf->Cell(200,0,'',1,1,"L");
$pdf->Cell(190,1,'',0,1,"L");

$pdf->Cell(200,33,'',1,0,"L");

$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(10,2,'',0,1,"L");


$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,' Form No :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$rfn,0,0,"L");
$pdf->Cell(28,7,'Name : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$rpn,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,' CNIC No :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$rpcn,0,0,"L");
$pdf->Cell(28,7,'Contact No : ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(53,7,$rpcm,0,1,"L");
	

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(28,7,' Address :',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(134,7,$rpa,0,1);



$pdf->output();

							
		 }
							
						}


				   
              

?>
