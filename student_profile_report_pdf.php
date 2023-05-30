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
							
							   $sql=mysqli_query($conn,"select a.STUDENT_ID,a.APPLICANT_NAME,a.FATHER_NAME,a.DATE_OF_BIRTH,a.DATE_OF_SUBMISSION,a.CONTACT_PERSON_MOB,a.IMG_LOC
,b.STUDENT_ID,b.SECTION_ID,b.ROLL_NO,b.ACTIVE,b.class_id,b.LAST_PERCENTAGE,b.FROM_DATE,b.TO_DATE,c.class_id,c.CLASS_DESCRIPTION,d.section_id,d.SECTION_DESCRIPTION,e.branch_id,e.branch_name,a.branch_id
from student_current_status a , student_current_class b ,class_setup c,class_setup_section d ,school_branches e
where b.STUDENT_ID = '$gr_no' and a.STUDENT_ID = b.STUDENT_ID and b.active = 'Y' and b.class_id = c.class_id and b.section_id = d.section_id
and a.branch_id = e.branch_id ");
        		
        		
						 while(($row = mysqli_fetch_array($sql)) != false) 
						 {	
				
								 $id=$row['STUDENT_ID'];
								 $roll=$row['ROLL_NO'];
                                 $name=$row['APPLICANT_NAME'];
								 $father=$row['FATHER_NAME'];
								 $dateofbirth=$row['DATE_OF_BIRTH'];
								 $addmission_date=$row['DATE_OF_SUBMISSION'];
								 $class=$row['CLASS_DESCRIPTION'];
								 $section=$row['SECTION_DESCRIPTION'];
								 $contact=$row['CONTACT_PERSON_MOB'];
								 $from_date=$row['FROM_DATE'];
								 $to_date=$row['TO_DATE'];
								 $last_percentage=$row['LAST_PERCENTAGE'];
								 $img = $row['IMG_LOC'];
                                 $branch_name = $row['branch_name'];
                    
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
$pdf->Cell(80,6,'Report=> student_profile_report_pdf',0,1,"L");
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
$pdf->Cell(50,10,'Student Profile with ',0,1,"L");
$pdf->Cell(86,6,'Previous Academic and Attendance History',0,1,"L");

$pdf->Cell(200,0,'',1,1,"L");
$pdf->Cell(190,1,'',0,1,"L");

$pdf->Cell(180,100,'',1,0,"L");
$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(10,2,'',0,1,"L");

$pdf->SetX($pdf->GetX() - 90);
if($img == null)
{
$pdf->Cell(27,7,'No Image Found');
}
else
{
	$pdf->Cell(27,35,$pdf->Image("student_images/".$img, 140, $pdf->GetY(), 27),1,0,"L");
}
$pdf->SetX($pdf->GetX() - 155);
$pdf->Cell(23,7,'Gr No',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(30,7,$id,0,0,"C");
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(20,7,'Roll No',0,0,"L");
$pdf->Cell(25,7,$roll,0,1,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(30,7,'Student Name',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(40,7,$name,0,1,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(30,7,'Father Name ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(40,7,$father,0,1,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(30,7,'Date Of Birth',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(25,7,$dateofbirth,0,0,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(35,7,'Addmission Date',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(25,7,$addmission_date,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(30,7,'Class',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(25,7,$class,0,0,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(35,7,'Section ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(25,7,$section,0,1,"L");	
$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(30,7,'Branch Name',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(40,7,$branch_name,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(30,7,'Contact No',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(40,7,$contact,0,1,"L");

$pdf->Cell(40,2,'',0,1,"L");
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(175,0,'',1,1,"L",1,1);

$pdf->Cell(16,2,'',0,1);
$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 150);
$pdf->SetFillColor(239, 240, 242);
$pdf->Cell(35,6,'Previous History',1,1,'C',1);
$pdf->SetFont('Symbol','B',9);
	$pdf->Cell(16,2,'',0,1);
$pdf->SetX($pdf->GetX() - 219);
$pdf->Cell(112,6,'A c a d e m i c',1,0,'C',1);$pdf->Cell(65,6,'A t t e n d a n c e',1,1,'C',1);
	$pdf->SetFont('Symbol','B',10);
$pdf->SetX($pdf->GetX() - 219);
$pdf->Cell(23,7,'Class',1,0,'C',1);
$pdf->Cell(21,7,'Section ',1,0,'C',1);
$pdf->Cell(19,7,'From',1,0,'C',1);
$pdf->Cell(16,7,'To',1,0,'C',1);
$pdf->Cell(16,7,'Last %',1,0,'C',1);
$pdf->Cell(17,7,'Mark',1,0,'C',1);
$pdf->Cell(17,7,'Present',1,0,'C',1);
$pdf->Cell(16,7,'Leaves',1,0,'C',1);
$pdf->Cell(16,7,'% ',1,0,'C',1);
$pdf->Cell(16,7,'Late',1,1,'C',1);

$pdf->Cell(16,2,'',0,1,'C');
$pdf->SetFont('Symbol','U',8);
$pdf->SetX($pdf->GetX() - 219);
$pdf->Cell(23,5,$class,1,0,'C');
$pdf->Cell(21,5,$section,1,0,'C');
$pdf->Cell(19,5,$from_date,1,0,'C');
$pdf->Cell(16,5,$to_date,1,0,'C');
$pdf->Cell(16,5,$last_percentage,1,0,'C');
$pdf->Cell(17,5,'',1,0,'C');
$pdf->Cell(17,5,'',1,0,'C');
$pdf->Cell(16,5,'',1,0,'C');
$pdf->Cell(16,5,'',1,0,'C');
$pdf->Cell(16,5,'',1,1,'C');


$pdf->output();
							
						}
						else
						{
							
	$query = mysqli_query($conn,"select a.STUDENT_ID,a.APPLICANT_NAME,a.FATHER_NAME,a.DATE_OF_BIRTH,a.DATE_OF_SUBMISSION,a.CONTACT_PERSON_MOB,a.IMG_LOC,a.branch_id
,b.student_id,b.SECTION_ID,b.ROLL_NO,b.ACTIVE,b.class_id,b.last_percentage,b.from_date,b.to_date,c.class_id,c.class_description,d.section_id,d.section_description 
from student_current_status a , student_current_class b ,class_setup c,class_setup_section d
where b.student_id = '$gr_no' and a.student_id = b.student_id and b.active = 'Y' and b.class_id = c.class_id and b.section_id = d.section_id and a.branch_id = '$b_id' ");
        
		
		 $numrows = mysqli_fetch_all($query);
		 
		 if($numrows == 0)
		 {	
	     echo "<script>alert('No Student Found')</script>";
		 echo "<script>window.open('student_profile_report','_self')</script>";
    exit();
		 }
		 else
		 {
							
							   $sql=mysqli_query($conn,"select a.STUDENT_ID,a.APPLICANT_NAME,a.FATHER_NAME,a.DATE_OF_BIRTH,a.DATE_OF_SUBMISSION,a.CONTACT_PERSON_MOB,a.IMG_LOC
,b.STUDENT_ID,b.SECTION_ID,b.ROLL_NO,b.ACTIVE,b.class_id,b.LAST_PERCENTAGE,b.FROM_DATE,b.TO_DATE,c.class_id,c.CLASS_DESCRIPTION,d.section_id,d.SECTION_DESCRIPTION,e.branch_id,e.branch_name,a.branch_id 
from student_current_status a , student_current_class b ,class_setup c,class_setup_section d ,school_branches e
where b.STUDENT_ID = '$gr_no' and a.STUDENT_ID = b.STUDENT_ID and b.active = 'Y' and b.class_id = c.class_id and b.section_id = d.section_id
and a.branch_id = e.branch_id");
        		
        		
						 while(($row = mysqli_fetch_array($sql)) != false) 
						 {	
				
								$id=$row['STUDENT_ID'];
								 $roll=$row['ROLL_NO'];
                                 $name=$row['APPLICANT_NAME'];
								 $father=$row['FATHER_NAME'];
								 $dateofbirth=$row['DATE_OF_BIRTH'];
								 $addmission_date=$row['DATE_OF_SUBMISSION'];
								 $class=$row['CLASS_DESCRIPTION'];
								 $section=$row['SECTION_DESCRIPTION'];
								 $contact=$row['CONTACT_PERSON_MOB'];
								 $from_date=$row['FROM_DATE'];
								 $to_date=$row['TO_DATE'];
								 $last_percentage=$row['LAST_PERCENTAGE'];
								 $img = $row['IMG_LOC'];
                                 $branch_name = $row['branch_name'];
                    
									          }

require('code128.php');

$pdf=new PDF_Code128('P','mm',array(220,260));
$pdf->AddPage();
$pdf->SetFont('Symbol','',12);

$logo = 'assets/images/rcslogo1.jpg';

$pdf->Cell(50,21,$pdf->Image($logo, 14, $pdf->GetY() + 1, 40.78),0,0,"C");

$pdf->Cell(80,6,'Student Management System',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(25,6,'',0,0,"L");
$pdf->Cell(80,6,'Report=> student_profile_report_pdf',0,1,"L");
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
$pdf->Cell(50,6,'Student Profile with ',0,1,"L");
$pdf->Cell(86,6,'Previous Academic and Attendance History',0,1,"L");

$pdf->Cell(200,0,'',1,1,"L");
$pdf->Cell(190,1,'',0,1,"L");

$pdf->Cell(180,100,'',1,0,"L");
$pdf->SetX($pdf->GetX() - 170);
$pdf->Cell(10,2,'',0,1,"L");

$pdf->SetX($pdf->GetX() - 90);
if($img == null)
{
$pdf->Cell(27,7,'No Image Found');
}
else
{
	$pdf->Cell(27,35,$pdf->Image("student_images/".$img, 180, $pdf->GetY(), 27),1,0,"L");
}
$pdf->SetX($pdf->GetX() - 155);
$pdf->Cell(23,7,'Gr No',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(30,7,$id,0,0,"C");
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(20,7,'Roll No',0,0,"L");
$pdf->Cell(25,7,$roll,0,1,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(30,7,'Student Name',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(40,7,$name,0,1,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(30,7,'Father Name ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(40,7,$father,0,1,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(30,7,'Date Of Birth',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(25,7,$dateofbirth,0,0,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(35,7,'Addmission Date',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(25,7,$addmission_date,0,1,"L");

$pdf->SetX($pdf->GetX() - 218);
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(30,7,'Class',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(25,7,$class,0,0,"L");
$pdf->SetFont('Symbol','BU',11);
$pdf->Cell(35,7,'Section ',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(25,7,$section,0,1,"L");	
$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(30,7,'Branch Name',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(40,7,$branch_name,0,1,"L");
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(30,7,'Contact No',0,0,"L");
$pdf->SetFont('Symbol','U',11);
$pdf->Cell(40,7,$contact,0,1,"L");

$pdf->Cell(40,2,'',0,1,"L");
$pdf->SetX($pdf->GetX() - 218);
$pdf->Cell(175,0,'',1,1,"L",1,1);

$pdf->Cell(16,2,'',0,1);
$pdf->SetFont('Symbol','BU',11);
$pdf->SetX($pdf->GetX() - 150);
$pdf->SetFillColor(239, 240, 242);
$pdf->Cell(35,6,'Previous History',1,1,'C',1);
$pdf->SetFont('Symbol','B',9);
	$pdf->Cell(16,2,'',0,1);
$pdf->SetX($pdf->GetX() - 219);
$pdf->Cell(112,6,'A c a d e m i c',1,0,'C',1);$pdf->Cell(65,6,'A t t e n d a n c e',1,1,'C',1);
	$pdf->SetFont('Symbol','B',10);
$pdf->SetX($pdf->GetX() - 219);
$pdf->Cell(23,7,'Class',1,0,'C',1);
$pdf->Cell(21,7,'Section ',1,0,'C',1);
$pdf->Cell(19,7,'From',1,0,'C',1);
$pdf->Cell(16,7,'To',1,0,'C',1);
$pdf->Cell(16,7,'Last %',1,0,'C',1);
$pdf->Cell(17,7,'Mark',1,0,'C',1);
$pdf->Cell(17,7,'Present',1,0,'C',1);
$pdf->Cell(16,7,'Leaves',1,0,'C',1);
$pdf->Cell(16,7,'% ',1,0,'C',1);
$pdf->Cell(16,7,'Late',1,1,'C',1);

$pdf->Cell(16,2,'',0,1,'C');
$pdf->SetFont('Symbol','U',8);
$pdf->SetX($pdf->GetX() - 219);
$pdf->Cell(23,5,$class,1,0,'C');
$pdf->Cell(21,5,$section,1,0,'C');
$pdf->Cell(19,5,$from_date,1,0,'C');
$pdf->Cell(16,5,$to_date,1,0,'C');
$pdf->Cell(16,5,$last_percentage,1,0,'C');
$pdf->Cell(17,5,'',1,0,'C');
$pdf->Cell(17,5,'',1,0,'C');
$pdf->Cell(16,5,'',1,0,'C');
$pdf->Cell(16,5,'',1,0,'C');
$pdf->Cell(16,5,'',1,1,'C');


$pdf->output();
							
		 }
							
						}

?>
