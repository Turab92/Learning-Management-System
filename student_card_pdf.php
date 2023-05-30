<?php

include ('include/function.php');
require('code128.php');



$class_check = $_POST['class_check'];
$section_check = $_POST['section_check'];
$student_check = $_POST['student_check'];

if($class_check == 1 && $section_check == 1 && $student_check == 1)
{
	$pdf=new PDF_Code128();
$pdf->AddPage();
$pdf->SetFont('Symbol','',10);


$logo = 'assets/images/rcslogo1.jpg';

	
	 $class_check = $_POST['class'];
	 $section_check = $_POST['section'];
	 $student_check = $_POST['students'];
	 $branch = $_POST['branch'];
	 
	 foreach($student_check as $students)
	 {
	 $sql=" select a.student_id,a.applicant_name,a.father_name,a.img_loc,a.left_date,a.rf_id,b.student_current_class,b.student_id,b.class_id,b.section_id,b.roll_no,b.active,
  c.class_id,c.class_description,d.section_id,d.section_description
   from student_current_status a,student_current_class b,class_setup c,class_setup_section d where b.Class_Id = '$class_check' and b.section_id = '$section_check' and b.student_id = '$students' and a.left_date is null
    and a.student_id = b.student_id and b.class_id = c.class_id and b.section_id = d.section_id and b.active = 'Y' ";
        		$run=mysqli_query($conn,$sql);
        		
				 while(($row = mysqli_fetch_array($run)) != false) 
				 {										
					
					$student_class = $row['student_current_class'];
        			$id=$row['roll_no'];
					$rf_id = $row['rf_id'];
					
                    $name=$row['applicant_name'];
					$father_name=$row['father_name'];
					$class=$row['class_description'];
					//$img=$row['img_loc'];
					
					$query = "update student_current_class set is_print = 1 where student_current_class = '$student_class'";
					$update = mysqli_query($conn,$query);
					
					

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

//$pdf->Cell( 27 ,35, 
 //$pdf->Image("student_images/".$img,75, $pdf->GetY(), 27)
//, 1, 0);


$pdf->SetX($pdf->GetX() - 302);
$pdf->Cell(25 ,7,'Roll No :',0, 0);
$pdf->SetFont("Symbol","",9);
$pdf->Cell(34 ,7,$id,0, 1,'L');

$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,8,'Name :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$name,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,8,'Father Name :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$father_name,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,7,'Class :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,7,$class,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->Cell(25 ,8,'Date-Of-Issue :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$today = date("j F, Y"),0, 1,'L');



$pdf->SetX($pdf->GetX() - 210);

$pdf->Cell(95 ,8,'Real Core Solutions',1, 1,'C');
}
	 }	
}
else if($class_check == 1 && $section_check == 1 )
{
	
	
	 $class_check = $_POST['class'];
	 $section_check = $_POST['section'];
	 $branch = $_POST['branch'];
	 
	 $query = " select a.student_id,a.applicant_name,a.father_name,a.img_loc,a.left_date,a.rf_id,a.branch_id,b.student_current_class,b.student_id,b.class_id,b.section_id,b.roll_no,b.is_print,b.active,
  c.class_id,c.class_description,d.section_id,d.section_description
   from student_current_status a,student_current_class b,class_setup c,class_setup_section d where b.Class_Id = '$class_check' and b.section_id = '$section_check' and a.left_date is null
    AND a.IMG_LOC IS NOT NULL and b.is_print IS NULL and b.active = 'Y' and  a.student_id = b.student_id and b.class_id = c.class_id and b.section_id = d.section_id and a.branch_id = '$branch'";
	$run=mysqli_query($conn,$query);
        		
				$numrows = mysqli_fetch_all($run,$conn);
	
	if($numrows==0){
	
echo "<script>alert('All Students Cards Are Printed Of This Section')</script>";
		echo "<script>window.open('student_card','_self')</script>";
	}
	else
	{
		
		$pdf=new PDF_Code128();
$pdf->AddPage();
$pdf->SetFont('Symbol','',10);


$logo = 'assets/images/rcslogo1.jpg';

		
	
		$sql="  select a.student_id,a.applicant_name,a.father_name,a.img_loc,a.left_date,a.rf_id,a.branch_id,b.student_current_class,b.student_id,b.class_id,b.section_id,b.roll_no,b.is_print,b.active,
  c.class_id,c.class_description,d.section_id,d.section_description
   from student_current_status a,student_current_class b,class_setup c,class_setup_section d where b.Class_Id = '$class_check' and b.section_id = '$section_check' and a.left_date is null
    AND a.IMG_LOC IS NOT NULL and b.is_print IS NULL and b.active = 'Y' and  a.student_id = b.student_id and b.class_id = c.class_id and b.section_id = d.section_id and a.branch_id = '$branch'";
        		$run=mysqli_query($conn,$sql);
        		
				 while(($row = mysqli_fetch_array($run)) != false) 
				 {										
					$student_class = $row['student_current_class'];				         
        			$id=$row['roll_no'];
                    $name=$row['applicant_name'];
					$father_name=$row['father_name'];
					$class=$row['class_description'];
					$img=$row['img_loc'];
					$rf_id = $row['rf_id'];

					$query = "update student_current_class set is_print = 1 where student_current_class = '$student_class'";
					$update = mysqli_query($conn,$query);
					
					
	$pdf->ln(20);
$pdf->Cell(95 ,65,'',1, 0);
$pdf->Cell(95 ,65,'',1, 0);
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 190);
$pdf->Cell(95 ,16, $pdf->Image($logo, 12, $pdf->GetY() + 1, 40.78).$pdf->Image($logo, 65, $pdf->GetY() + 1, 40.78),1, 0);


$pdf->Code128(125, $pdf->GetY() + 50,$rf_id,50,12);



$pdf->SetX($pdf->GetX() - 0);
$pdf->Cell(95 ,16,$pdf->Image($logo, 110, $pdf->GetY() + 15, 85.78),0, 1);


$pdf->ln(3);

$pdf->SetX($pdf->GetX() - 145);

$pdf->Cell( 27 ,35, 
 $pdf->Image("student_images/".$img,75, $pdf->GetY(), 27)
, 1, 0);


$pdf->SetX($pdf->GetX() - 302);
$pdf->Cell(25 ,7,'Roll No :',0, 0);
$pdf->SetFont("Symbol","",9);
$pdf->Cell(34 ,7,$id,0, 1,'L');

$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,8,'Name :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$name,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,8,'Father Name :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$father_name,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,7,'Class :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,7,$class,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->Cell(25 ,8,'Date-Of-Issue :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$today = date("j F, Y"),0, 1,'L');



$pdf->SetX($pdf->GetX() - 210);

$pdf->Cell(95 ,8,'Real Core Solutions',1, 1,'C');
}
		
	}
	
}
else if($class_check == 1)
{
	 $class_check = $_POST['class'];
	 $branch = $_POST['branch'];
	
	 $query = "select a.student_id,a.applicant_name,a.father_name,a.img_loc,a.left_date,a.branch_id,b.student_current_class,b.student_id,b.class_id,b.section_id,b.roll_no,b.is_print,b.active,
  c.class_id,c.class_description,d.section_id,d.section_description
   from student_current_status a,student_current_class b,class_setup c,class_setup_section d where b.Class_Id = '$class_check' and a.left_date is null
    AND a.IMG_LOC IS NOT NULL and b.is_print IS NULL and a.student_id = b.student_id and b.class_id = c.class_id and b.section_id = d.section_id and b.active = 'Y' and a.branch_id = '$branch'";
	$run=mysqli_query($conn,$query);
        		
				$numrows = mysqli_fetch_all($run,$conn);
	
	if($numrows==0){
	
	echo "<script>alert('All Students Cards Are Printed Of This Class')</script>";
		echo "<script>window.open('student_card','_self')</script>";
		
	}
else{
	
	$pdf=new PDF_Code128();
$pdf->AddPage();
$pdf->SetFont('Symbol','',10);


$logo = 'assets/images/rcslogo1.jpg';

	
	
	
	$sql="select a.student_id,a.applicant_name,a.father_name,a.img_loc,a.left_date,a.rf_id,a.branch_id,b.student_current_class,b.student_id,b.class_id,b.section_id,b.roll_no,b.is_print,b.active,
  c.class_id,c.class_description,d.section_id,d.section_description
   from student_current_status a,student_current_class b,class_setup c,class_setup_section d where b.Class_Id = '$class_check' and a.left_date is null
    AND a.IMG_LOC IS NOT NULL and b.is_print IS NULL and a.student_id = b.student_id and b.class_id = c.class_id and b.section_id = d.section_id and b.active = 'Y' and a.branch_id = '$branch'";
        		$run=mysqli_query($conn,$sql);
        		
				 while(($row = mysqli_fetch_array($run)) != false) 
				 {										
					$student_class = $row['student_current_class'];				         
        			$id=$row['roll_no'];
                    $name=$row['applicant_name'];
					$father_name=$row['father_name'];
					$class=$row['class_description'];
					$img=$row['img_loc'];
					$rf_id = $row['rf_id'];
					
					$query = "update student_current_class set is_print = 1 where student_current_class = '$student_class'";
					$update = mysqli_query($conn,$query);
					

	$pdf->ln(20);
$pdf->Cell(95 ,65,'',1, 0);
$pdf->Cell(95 ,65,'',1, 0);
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 190);
$pdf->Cell(95 ,16, $pdf->Image($logo, 12, $pdf->GetY() + 1, 40.78).$pdf->Image($logo, 65, $pdf->GetY() + 1, 40.78),1, 0);


$pdf->Code128(125, $pdf->GetY() + 50,$rf_id,50,12);



$pdf->SetX($pdf->GetX() - 0);
$pdf->Cell(95 ,16,$pdf->Image($logo, 110, $pdf->GetY() + 15, 85.78),0, 1);


$pdf->ln(3);

$pdf->SetX($pdf->GetX() - 145);

$pdf->Cell( 27 ,35, 
 $pdf->Image("student_images/".$img,75, $pdf->GetY(), 27)
, 1, 0);


$pdf->SetX($pdf->GetX() - 302);
$pdf->Cell(25 ,7,'Roll No :',0, 0);
$pdf->SetFont("Symbol","",9);
$pdf->Cell(34 ,7,$id,0, 1,'L');

$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,8,'Name :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$name,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,8,'Father Name :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$father_name,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->SetX($pdf->GetX() - 210);
$pdf->Cell(25 ,7,'Class :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,7,$class,0, 1,'L');
$pdf->SetFont("Symbol","",9);
$pdf->Cell(25 ,8,'Date-Of-Issue :',0, 0);
$pdf->SetFont("Symbol","",9);	
$pdf->Cell(34 ,8,$today = date("j F, Y"),0, 1,'L');



$pdf->SetX($pdf->GetX() - 210);

$pdf->Cell(95 ,8,'Real Core Solutions',1, 1,'C');

}
	
}

	
}


$pdf->output();

 ?>
		