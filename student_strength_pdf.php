<?php	
include ('include/function.php');
require 'pdf/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Symbol','',12);

$user = $_POST['user'];

$class = $_POST['class'];
$branch = $_POST['branch'];

$logo = 'assets/images/rcslogo1.jpg';

$pdf->Cell(50,21,$pdf->Image($logo, 14, $pdf->GetY() + 1, 40.78),0,0,"C");

$pdf->Cell(80,6,'Education Management System',0,0,"L");
$pdf->SetFont('Symbol','',9);
$pdf->Cell(15,6,'',0,0,"L");
$pdf->Cell(80,6,'Report=> student_strength_pdf',0,1,"L");
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
$pdf->Cell(80,6,'Date : '.strtoupper($time),0,0,"L");
$pdf->ln();

$pdf->SetFont("Symbol","BU",11);
$pdf->SetFillColor(227, 232, 237);

$pdf->Cell(60,8,'Student Strength Summary',0,1);

$pdf->Cell(70,8,'Class wise & Male / Female wise',0,1);
$pdf->ln();
$pdf->SetFont("Symbol","",11);
$pdf->Cell(10,0,'',0,0);

$pdf->Cell(25,5,'Class',1,0,'C',1);
$pdf->Cell(30,5,'Section',1,0,'C',1);
$pdf->Cell(25,5,'Male',1,0,'C',1);
$pdf->Cell(25,5,'Female',1,0,'C',1);
$pdf->Cell(25,5,'Total',1,1,'C',1);


foreach($class as $arrays)
{
    $sql="select a.CLASS_ID,a.CLASS_DESCRIPTION,a.active,b.CLASS_ID,b.branch_id from class_setup a, class_branch_setup b where b.branch_id = '$branch' and b.CLASS_ID = '$arrays' and a.active = 'Y'  and a.CLASS_ID = b.CLASS_ID order by a.CLASS_ID asc";
        		$run=mysqli_query($conn,$sql);
        		
					 while(($row = mysqli_fetch_array($run)) != false) 
					{	
					$class_id = $row['CLASS_ID'];
					 $class_name = $row['CLASS_DESCRIPTION'];
					 
		$box = 8;			


 $query="select b.class_id,a.branch_id,
       get_class_desc(b.class_id) Class,
       b.section_id,
       get_section_desc(b.section_id) Section,
       decode(a.gender, 'Male', count(a.gender), 0) Male,
       decode(a.gender, 'Female', count(a.gender),0) Female
  from student_current_status a, student_current_class b
where a.student_id = b.student_id
   and nvl(b.active, 'N') = 'Y'
   and a.student_status = 'Student'
   and b.class_id = '$class_id' and a.branch_id = '$branch'
/*and (b.class_id=:clid or :clid='0')
   and (b.section_id=:sid or :sid='0')*/
group by b.class_id, b.section_id, a.gender , a.branch_id ";
        		$select=mysqli_query($conn,$query);
        		
									 while(($row1 = mysqli_fetch_array($select)) != false) 
									 {		
$box+=5;
									 }
$pdf->SetFont("Symbol","",9);

$pdf->Cell(10,0,'',0,0);

$pdf->Cell(130,$box,'   '.$class_name,1,0);
$pdf->SetX($pdf->GetX() - 105);

$query="select b.class_id,a.branch_id,
       get_class_desc(b.class_id) Class,
       b.section_id,
       get_section_desc(b.section_id) Section,
       decode(a.gender, 'Male', count(a.gender), 0) Male,
       decode(a.gender, 'Female', count(a.gender),0) Female
  from student_current_status a, student_current_class b
where a.student_id = b.student_id
   and nvl(b.active, 'N') = 'Y'
   and a.student_status = 'Student'
   and b.class_id = '$class_id' and a.branch_id = '$branch'
/*and (b.class_id=:clid or :clid='0')
   and (b.section_id=:sid or :sid='0')*/
group by b.class_id, b.section_id, a.gender , a.branch_id";
        		$select=mysqli_query($conn,$query);
        		
				 $total_male = 0;
								 $total_female = 0;
									 while(($row1 = mysqli_fetch_array($select)) != false) 
									 {		

								
								 
							$section = $row1['SECTION'];	
                            $male = $row1['MALE'];
                            $female = $row1['FEMALE'];   							
									 
$pdf->Cell(30,5,$section,1,0,'C');$pdf->Cell(25,5,$male,1,0,'C');
$pdf->Cell(25,5,$female,1,0,'C');$pdf->Cell(25,5,$total=$male+$female,1,1,'C');
$pdf->SetX($pdf->GetX() - 175);

						$total_male += $male;	
                         $total_female += $female;								

									}
									
	

$pdf->Cell(0,3,'',0,1,'C');

$pdf->SetFont("Symbol","",11);
$pdf->SetX($pdf->GetX() + 35);
$pdf->Cell(30,5,'Sub-Total',1,0,'C',1);$pdf->Cell(25,5,$total_male,1,0,'C',1);$pdf->Cell(25,5,$total_female,1,0,'C',1);
$pdf->Cell(25,5,$total_student=$total_male+$total_female,1,1,'C',1);

$grand_total_male += $total_male;
$grand_total_female += $total_female;

}
}

$pdf->ln();
$pdf->Cell(10,0,'',0,0);
$pdf->Cell(55,5,'Grand Total',1,0,'C',1);$pdf->Cell(25,5,$grand_total_male,1,0,'C',1);$pdf->Cell(25,5,$grand_total_female,1,0,'C',1);
$pdf->Cell(25,5,$grand_total_student=$grand_total_male+$grand_total_female,1,1,'C',1);


$pdf->output();

?>