<?php 
include ('include/function.php');


$class_check = $_POST['class_check'];
$section_check = $_POST['section_check'];
$student_check = $_POST['student_check'];

require('code128.php');



if($class_check == 1 && $section_check == 1 && $student_check == 1)
{

	$pdf=new PDF_Code128();
	
$pdf->AddPage();
$logo = 'rcslogo1.jpg';
	

$class_id = $_POST['class'];
$section_id = $_POST['section'];
$student_id = $_POST['student'];
$branch_id = $_POST['branch'];

foreach($student_id as $students)
{
 $sql="select a.student_id,a.applicant_name,a.father_name,a.img_loc,a.left_date,a.rf_id,a.branch_id,b.student_id,b.class_id,b.section_id,b.active,
  c.class_id,c.class_description,d.section_id,d.section_description,e.student_id,e.bearer_name,e.active
   from student_current_status a,student_current_class b,class_setup c,class_setup_section d ,student_current_bearer e where b.STUDENT_ID = '$students' AND b.Class_Id = '$class_id' AND b.SECTION_ID = '$section_id' and a.left_date is null and a.student_id = e.student_id and e.active = 'Y'
    AND a.IMG_LOC IS NOT NULL and a.student_id = b.student_id and b.class_id = c.class_id and b.section_id = d.section_id and b.active = 'Y' and a.branch_id = '$branch_id' ";
        		$run=mysqli_query($conn,$sql);
        		
				
				 while(($row = mysqli_fetch_array($run)) != false) 
				 {										
									         
        			$id=$row['student_id'];
                    $name=$row['applicant_name'];
					$father_name=$row['father_name'];
					$class_name=$row['class_description'];
					$img=$row['img_loc'];
					$bearer_name=$row['bearer_name'];
					$rf_id=$row['rf_id'];
					
					$query = "update student_current_bearer set is_print = 1 where student_id = '$id'";
					$update = mysqli_query($conn,$query);
					
									 									 
$pdf->ln(20);		 

$pdf->Cell(95 ,70,'',1, 0);
$pdf->Cell(95 ,70,'',1, 0);


$pdf->Code128(120, $pdf->GetY() + 62,$rf_id,50,8);

$pdf->SetFont("Symbol","B",18);

$pdf->SetX($pdf->GetX() - 190);
$pdf->Cell( 95 ,16, $pdf->Image("assets/images/".$logo, 12, $pdf->GetY() +1, 32.78).$pdf->Image("assets/images/".$logo, 65, $pdf->GetY() + 1, 32.78), 1, 0);

	$pdf->Cell( 95 ,16, $pdf->Image("assets/images/".$logo, 107, $pdf->GetY() + 1, 32.78).$pdf->Image("assets/images/".$logo, 158, $pdf->GetY() + 1, 32.78), 1, 1);

$pdf->ln(3);

$pdf->SetX($pdf->GetX() - 145);

$pdf->Cell( 27 ,35, 
 $pdf->Image("student_images/".$img,75, $pdf->GetY(), 27)
, 1, 0);
  $pdf->SetX($pdf->GetX() - 302);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     Roll No :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(38,8,$id,'0',0);


  $pdf->SetX($pdf->GetX() - 175);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(37,8,'     Date Of Issue :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(58,8,$today = date("j F, Y"),'0',1);
	
	$pdf->SetX($pdf->GetX() - 0);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     Name :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(73,8,$name,'0',0);


 $pdf->SetX($pdf->GetX() - 210);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(37,8,"     Bearer's Name :",'0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(58,8,$bearer_name,'0',1);


	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     F.Name :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(73,8,$father_name,'0',0);


$pdf->SetX($pdf->GetX() - 210);
	$pdf->Cell(95,8,'','0',1);

	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     Class :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(14,8,$class_name,'0',0);

$pdf->SetX($pdf->GetX() - 145);
    $pdf->SetFont("Symbol","",9);
	$pdf->Cell(37,9,"_________________",'0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(58,9,'_______________________','0',1);

	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(26,9,'     Date Of Issue :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(16,9,$today,'0',0);

$pdf->SetX($pdf->GetX() - 153);


	$pdf->SetFont("Symbol","B",9);
	$pdf->Cell(35,5,"Attested",'0',0,'C');
	$pdf->Cell(40,5,'Signature Of Parents','0',1,'C');
$pdf->Cell(95,4,'','0',1,"C");
	
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(95,9,'Real Core Solutions : Tariq Road Near Jheel Park','1',0,"C");

$pdf->SetX($pdf->GetX() - 210);
	
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(95,9,'','1',0,"C");


	$pdf->ln(5);	


} 
}
$pdf->output();

}
else if($class_check == 1 && $section_check == 1 )
{
	 $class_id = $_POST['class'];
	 $section_id = $_POST['section'];
	 $branch_id = $_POST['branch'];

$query = "select a.student_id,a.applicant_name,a.father_name,a.img_loc,a.left_date,a.rf_id,a.branch_id,b.student_id,b.class_id,b.section_id,b.active,
  c.class_id,c.class_description,d.section_id,d.section_description,e.student_id,e.bearer_name,e.active,e.is_print
   from student_current_status a,student_current_class b,class_setup c,class_setup_section d , student_current_bearer e where b.Class_Id = '$class_id' and b.section_id = '$section_id' and a.student_id = e.student_id and e.active = 'Y' 
   and a.left_date is null AND a.IMG_LOC IS NOT NULL and a.student_id = b.student_id and b.class_id = c.class_id and b.section_id = d.section_id and b.active = 'Y' and e.is_print is null and a.branch_id = '$branch_id' ";
	$run=mysqli_query($conn,$query);
        		
				$numrows = mysqli_fetch_all($run,$conn);
	
	if($numrows==0){
	
echo "<script>alert('All Bearer Cards Are Printed Of This Section')</script>";
		echo "<script>window.open('card','_self')</script>";
	}
	else
	{
		
			 $pdf=new PDF_Code128();
	
$pdf->AddPage();
$logo = 'rcslogo1.jpg';
	
	
		
	
	 
	   $sql="select a.student_id,a.applicant_name,a.father_name,a.img_loc,a.left_date,a.rf_id,a.branch_id,b.student_id,b.class_id,b.section_id,b.active,
  c.class_id,c.class_description,d.section_id,d.section_description,e.student_id,e.bearer_name,e.active,e.is_print
   from student_current_status a,student_current_class b,class_setup c,class_setup_section d , student_current_bearer e where b.Class_Id = '$class_id' and b.section_id = '$section_id' and a.student_id = e.student_id and e.active = 'Y' 
   and a.left_date is null AND a.IMG_LOC IS NOT NULL and a.student_id = b.student_id and b.class_id = c.class_id and b.section_id = d.section_id and b.active = 'Y' and e.is_print is null and a.branch_id = '$branch_id' ";
        		$run=mysqli_query($conn,$sql);
        		
				 while(($row = mysqli_fetch_array($run)) != false) 
				 {										
									         
        			$id=$row['student_id'];
                    $name=$row['applicant_name'];
					$father_name=$row['father_name'];
					$class_name=$row['class_description'];
					$img=$row['img_loc'];
					$bearer_name=$row['bearer_name'];
					$rf_id=$row['rf_id'];
						
					$query = "update student_current_bearer set is_print = 1 where student_id = '$id'";
					$update = mysqli_query($conn,$query);
					
$pdf->ln(20);			 

$pdf->Cell(95 ,70,'',1, 0);
$pdf->Cell(95 ,70,'',1, 0);


$pdf->Code128(120, $pdf->GetY() + 62,$rf_id,50,8);


$pdf->SetFont("Symbol","B",18);

$pdf->SetX($pdf->GetX() - 190);
$pdf->Cell( 95 ,16, $pdf->Image("assets/images/".$logo, 12, $pdf->GetY() +1, 40.78).$pdf->Image("assets/images/".$logo, 65, $pdf->GetY() + 1, 40.78), 1, 0);

	$pdf->Cell( 95 ,16, $pdf->Image("assets/images/".$logo, 107, $pdf->GetY() + 1, 40.78).$pdf->Image("assets/images/".$logo, 158, $pdf->GetY() + 1, 40.78), 1, 1);

$pdf->ln(3);

$pdf->SetX($pdf->GetX() - 145);

$pdf->Cell( 27 ,35, 
 $pdf->Image("student_images/".$img,75, $pdf->GetY(), 27)
, 1, 0);
  $pdf->SetX($pdf->GetX() - 302);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     Roll No :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(38,8,$id,'0',0);


  $pdf->SetX($pdf->GetX() - 175);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(37,8,'     Date Of Issue :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(58,8,$today = date("j F, Y"),'0',1);
	
	$pdf->SetX($pdf->GetX() - 0);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     Name :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(73,8,$name,'0',0);


 $pdf->SetX($pdf->GetX() - 210);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(37,8,"     Bearer's Name :",'0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(58,8,$bearer_name,'0',1);


	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     F.Name :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(73,8,$father_name,'0',0);


$pdf->SetX($pdf->GetX() - 210);
	$pdf->Cell(95,8,'','0',1);

	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     Class :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(14,8,$class_name,'0',0);

$pdf->SetX($pdf->GetX() - 145);
    $pdf->SetFont("Symbol","",9);
	$pdf->Cell(37,9,"_________________",'0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(58,9,'_______________________','0',1);

	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(26,9,'     Date Of Issue :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(16,9,$today,'0',0);

$pdf->SetX($pdf->GetX() - 153);


	$pdf->SetFont("Symbol","B",9);
	$pdf->Cell(35,5,"Attested",'0',0,'C');
	$pdf->Cell(40,5,'Signature Of Parents','0',1,'C');
$pdf->Cell(95,4,'','0',1,"C");
	
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(95,9,'Real Core Solutions : Tariq Road Near Jheel Park','1',0,"C");

$pdf->SetX($pdf->GetX() - 210);

	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(95,9,'','1',0,"C");


	 $pdf->ln();
									 }
	}
}
else if($class_check == 1)
{

 $class_id = $_POST['class'];
 $branch_id = $_POST['branch'];

	
$query = "select a.student_id,a.applicant_name,a.father_name,a.img_loc,a.left_date,a.rf_id,a.branch_id,b.student_id,b.class_id,b.section_id,b.active,
  c.class_id,c.class_description,d.section_id,d.section_description,e.student_id,e.bearer_name,e.active,e.is_print
   from student_current_status a,student_current_class b,class_setup c,class_setup_section d ,student_current_bearer e where b.Class_Id = '$class_id' and a.left_date is null and a.student_id = e.student_id and e.active = 'Y' 
    AND a.IMG_LOC IS NOT NULL and a.student_id = b.student_id and b.class_id = c.class_id and b.section_id = d.section_id and b.active = 'Y' and e.is_print is null and a.branch_id = '$branch_id' ";
	$run=mysqli_query($conn,$query);
        		
				$numrows = mysqli_fetch_all($run,$conn);
	
	if($numrows==0){
	
echo "<script>alert('All Bearer Cards Are Printed Of This Class')</script>";
		echo "<script>window.open('card','_self')</script>";
	}
	else
	{
		
		 
  $pdf=new PDF_Code128();
	
$pdf->AddPage();
$logo = 'rcslogo1.jpg';
	
		

 
  $sql="select a.student_id,a.applicant_name,a.father_name,a.img_loc,a.left_date,a.rf_id,a.branch_id,b.student_id,b.class_id,b.section_id,b.active,
  c.class_id,c.class_description,d.section_id,d.section_description,e.student_id,e.bearer_name,e.active
   from student_current_status a,student_current_class b,class_setup c,class_setup_section d ,student_current_bearer e where b.Class_Id = '$class_id' and a.left_date is null and a.student_id = e.student_id and e.active = 'Y' 
    AND a.IMG_LOC IS NOT NULL and a.student_id = b.student_id and b.class_id = c.class_id and b.section_id = d.section_id and b.active = 'Y' and a.branch_id = '$branch_id' ";
        		$run=mysqli_query($conn,$sql);
        		
				 while(($row = mysqli_fetch_array($run)) != false) 
				 {										
									         
        			$id=$row['student_id'];
                    $name=$row['applicant_name'];
					$father_name=$row['father_name'];
					$class_name=$row['class_description'];
					$img=$row['img_loc'];
					$bearer_name=$row['bearer_name'];
					$rf_id=$row['rf_id'];
					
					$query = "update student_current_bearer set is_print = 1 where student_id = '$id'";
					$update = mysqli_query($conn,$query);
					
									 									 
$pdf->ln(10);			 

$pdf->Cell(95 ,70,'',1, 0);
$pdf->Cell(95 ,70,'',1, 0);


$pdf->Code128(120, $pdf->GetY() + 62,$rf_id,50,8);




$pdf->SetX($pdf->GetX() - 190);
$pdf->Cell( 95 ,16, $pdf->Image("assets/images/".$logo, 12, $pdf->GetY() +1, 40.78).$pdf->Image("assets/images/".$logo, 65, $pdf->GetY() + 1, 40.78), 1, 0);

	$pdf->Cell( 95 ,16, $pdf->Image("assets/images/".$logo, 107, $pdf->GetY() + 1, 40.78).$pdf->Image("assets/images/".$logo, 158, $pdf->GetY() + 1, 40.78), 1, 1);

$pdf->ln(3);

$pdf->SetX($pdf->GetX() - 145);

$pdf->Cell( 27 ,35, 
 $pdf->Image("student_images/".$img,75, $pdf->GetY(), 27)
, 1, 0);
  $pdf->SetX($pdf->GetX() - 302);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     Roll No :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(38,8,$id,'0',0);


  $pdf->SetX($pdf->GetX() - 175);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(37,8,'     Date Of Issue :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(58,8,$today = date("j F, Y"),'0',1);
	
	$pdf->SetX($pdf->GetX() - 0);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     Name :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(73,8,$name,'0',0);


 $pdf->SetX($pdf->GetX() - 210);
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(37,8,"     Bearer's Name :",'0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(58,8,$bearer_name,'0',1);


	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     F.Name :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(73,8,$father_name,'0',0);


$pdf->SetX($pdf->GetX() - 210);
	$pdf->Cell(95,8,'','0',1);

	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(22,8,'     Class :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(14,8,$class_name,'0',0);

$pdf->SetX($pdf->GetX() - 145);
    $pdf->SetFont("Symbol","",9);
	$pdf->Cell(37,9,"_________________",'0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(58,9,'_______________________','0',1);

	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(26,9,'     Date Of Issue :','0',0);
	$pdf->SetFont("Symbol","U",9);
	$pdf->Cell(16,9,$today,'0',0);

$pdf->SetX($pdf->GetX() - 153);


	$pdf->SetFont("Symbol","B",9);
	$pdf->Cell(35,5,"Attested",'0',0,'C');
	$pdf->Cell(40,5,'Signature Of Parents','0',1,'C');
$pdf->Cell(95,4,'','0',1,"C");
	
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(95,9,'Real Core Solutions : Tariq Road Near Jheel Park','1',0,"C");

$pdf->SetX($pdf->GetX() - 210);
	
	$pdf->SetFont("Symbol","",9);
	$pdf->Cell(95,9,'','1',0,"C");


	 $pdf->ln();


									 }
} 

 
}

$pdf->output();
								 

      // $sql="select * from student_current_status where STUDENT_ID = '$ids' AND IMG_LOC IS NOT NULL";
        		// $run=oci_parse($conn,$sql);
        		// oci_execute($run);
									 // while(($row = oci_fetch_array($run, OCI_ASSOC)) != false) 
									 // {										
									         
        			// $id=$row['STUDENT_ID'];
                    // $name=$row['APPLICANT_NAME'];
					// $father_name=$row['FATHER_NAME'];
					// $class=$row['CLASS_ID'];
					// $img=$row['IMG_LOC'];
					
									
      // $sql="select class_description from class_setup where class_id = '$class'";
        		// $run=oci_parse($conn,$sql);
        		// oci_execute($run);
									 // while(($row = oci_fetch_array($run, OCI_ASSOC)) != false) 
									 // {										
				// $class_name = $row['CLASS_DESCRIPTION'];
									 // }
									 									 
// $pdf->ln(2);		 

// $pdf->Cell(95 ,70,'',1, 0);
// $pdf->Cell(95 ,70,'',1, 0);


// $pdf->Code128(120, $pdf->GetY() + 62,$id,50,8);


// $pdf->SetFont("Symbol","B",18);
// $pdf->setFillColor(249, 248, 237); 
// $pdf->SetX($pdf->GetX() - 190);
// $pdf->Cell( 95 ,16, $pdf->Image("assets/images/".$logo, 12, $pdf->GetY() +1, 40.78).$pdf->Image("assets/images/".$logo, 65, $pdf->GetY() + 1, 40.78), 1, 0);

	// $pdf->Cell( 95 ,16, $pdf->Image("assets/images/".$logo, 107, $pdf->GetY() + 1, 40.78).$pdf->Image("assets/images/".$logo, 158, $pdf->GetY() + 1, 40.78), 1, 1);

// $pdf->ln(3);

// $pdf->SetX($pdf->GetX() - 145);

// $pdf->Cell( 27 ,35, 
 // $pdf->Image("student_images/".$img,75, $pdf->GetY(), 27)
// , 1, 0);
  // $pdf->SetX($pdf->GetX() - 302);
	// $pdf->SetFont("Symbol","",9);
	// $pdf->Cell(22,8,'     Roll No :','0',0);
	// $pdf->SetFont("Symbol","U",9);
	// $pdf->Cell(38,8,$id,'0',0);


  // $pdf->SetX($pdf->GetX() - 175);
	// $pdf->SetFont("Symbol","",9);
	// $pdf->Cell(37,8,'     Date Of Issue :','0',0);
	// $pdf->SetFont("Symbol","U",9);
	// $pdf->Cell(58,8,$today = date("j F, Y"),'0',1);
	
	// $pdf->SetX($pdf->GetX() - 0);
	// $pdf->SetFont("Symbol","",9);
	// $pdf->Cell(22,8,'     Name :','0',0);
	// $pdf->SetFont("Symbol","U",9);
	// $pdf->Cell(73,8,$name,'0',0);


 // $pdf->SetX($pdf->GetX() - 210);
	// $pdf->SetFont("Symbol","",9);
	// $pdf->Cell(37,8,"     Bearer's Name :",'0',0);
	// $pdf->SetFont("Symbol","U",9);
	// $pdf->Cell(58,8,$father_name,'0',1);


	// $pdf->SetFont("Symbol","",9);
	// $pdf->Cell(22,8,'     F.Name :','0',0);
	// $pdf->SetFont("Symbol","U",9);
	// $pdf->Cell(73,8,$father_name,'0',0);


// $pdf->SetX($pdf->GetX() - 210);
	// $pdf->Cell(95,8,'','0',1);

	// $pdf->SetFont("Symbol","",9);
	// $pdf->Cell(22,8,'     Class :','0',0);
	// $pdf->SetFont("Symbol","U",9);
	// $pdf->Cell(14,8,$class_name,'0',0);

// $pdf->SetX($pdf->GetX() - 145);
    // $pdf->SetFont("Symbol","",9);
	// $pdf->Cell(37,9,"_________________",'0',0);
	// $pdf->SetFont("Symbol","U",9);
	// $pdf->Cell(58,9,'_______________________','0',1);

	// $pdf->SetFont("Symbol","",9);
	// $pdf->Cell(26,9,'     Date Of Issue :','0',0);
	// $pdf->SetFont("Symbol","U",9);
	// $pdf->Cell(16,9,$today,'0',0);

// $pdf->SetX($pdf->GetX() - 153);


	// $pdf->SetFont("Symbol","B",9);
	// $pdf->Cell(35,5,"Attested",'0',0,'C');
	// $pdf->Cell(40,5,'Signature Of Parents','0',1,'C');
// $pdf->Cell(95,4,'','0',1,"C");
	// $pdf->setFillColor(239, 242, 239); 
	// $pdf->SetFont("Symbol","",9);
	// $pdf->Cell(95,9,'Real Core Solutions : Tariq Road Near Jheel Park','1',0,"C");

// $pdf->SetX($pdf->GetX() - 210);
	// $pdf->setFillColor(249, 248, 237); 
	// $pdf->SetFont("Symbol","",9);
	// $pdf->Cell(95,9,'','1',0,"C");


	 // $pdf->ln();


// $pdf->SetFont("Arial","B",18);
// $pdf->setFillColor(249, 248, 237); 
//$pdf->Cell(95,20,$pdf->Image("assets/images/".$logo,12, $size, 40, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false).
//$pdf->Image("assets/images/".$logo,65, $size, 40, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false),'1',0);

//$pdf->Cell(95,20,$pdf->Image("assets/images/".$logo,112, $size, 40, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false).
//$pdf->Image("assets/images/".$logo,160, $size, 40, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false),'1',1);

// $pdf->Cell( 95 ,20, $pdf->Image("assets/images/".$logo, 12, $pdf->GetY(), 40.78).$pdf->Image("assets/images/".$logo, 65, $pdf->GetY(), 40.78), 1, 0);

// $pdf->Cell( 95 ,20, $pdf->Image("assets/images/".$logo, 112, $pdf->GetY(), 40.78).$pdf->Image("assets/images/".$logo, 160, $pdf->GetY(), 40.78), 1, 1);




// $pdf->SetFont("Arial","",9);
// $pdf->Cell(22,12,'   Roll No :','1',0);
// $pdf->SetFont("Arial","U",9);
// $pdf->Cell(38,12,'  '.$id.'  ','1',0);

// $pdf->Cell( 33 ,36, 
 // $pdf->Image("student_images/".$img,70, $pdf->GetY(), 27)
// , 1, 0);

// $pdf->Cell( 2 ,36, '', 0, 0);

// $pdf->SetFont("Arial","",9);
// $pdf->Cell(37,12,'   Date Of Issue :','1',0,'',1);
// $pdf->SetFont("Arial","U",9);
// $pdf->Cell(58,12,'     '.$today = date("j F, Y").'    ','1',1,'',1);

// $pdf->SetFont("Arial","",9);
// $pdf->Cell(22,12,'   Name :','0',0);
// $pdf->SetFont("Arial","U",9);
// $pdf->Cell(73,12,'  '.$name.'  ','0',0);

// $pdf->SetFont("Arial","",9);
// $pdf->Cell(37,12,"   Bearer's Name :",'1',0,'',1);
// $pdf->SetFont("Arial","U",9);
// $pdf->Cell(58,12,'     '.$father_name.'    ','1',1,'',1);


// $pdf->SetFont("Arial","",9);
// $pdf->Cell(22,12,'   F.Name :','0',0);
// $pdf->SetFont("Arial","U",9);
// $pdf->Cell(73,12,'  '.$father_name.'  ','0',0);


// $pdf->Cell(95,12,'','1',1,'',1);



// $pdf->SetFont("Arial","",9);
// $pdf->Cell(22,12,'   Class :','0',0);
// $pdf->SetFont("Arial","U",9);
// $pdf->Cell(22,12,'  '.$class_name.'  ','0',0);

// $pdf->SetFont("Arial","",9);
// $pdf->Cell(22,12,'Date Of Issue :','0',0);
// $pdf->SetFont("Arial","U",9);
// $pdf->Cell(29,12,'  '.$today.'','0',0);

// $pdf->SetFont("Arial","",9);
// $pdf->Cell(37,12,"  _________________",'1',0,'',1);
// $pdf->SetFont("Arial","U",9);
// $pdf->Cell(58,12,'________________________________','1',1,'',1);

// $pdf->setFillColor(239, 242, 239); 
// $pdf->SetFont("Arial","",9);
// $pdf->Cell(95,10,'Real Core Solutions : Tariq Road Near Jheel Park','1',0,"C",1);


// $pdf->setFillColor(249, 248, 237); 
// $pdf->SetFont("Arial","B",9);
// $pdf->Cell(37,10,"  Attested    ",'1',0,'',1);
// $pdf->Cell(58,10,'  Signature Of Parent And Guardian   ','1',1,'',1);

// $pdf->ln();
// $size += 90;
// } 
// $pdf->output();

// ?>
								 







