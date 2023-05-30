<?php
include ('include/function.php');
require 'PHPMailer/PHPMailerAutoLoad.php';
require('code128.php');
 session_start();
 $id1=$_SESSION['name'];

$sql = mysqli_query($conn, "select c.user_id,c.branch_id from portal_user c where user_name='$id1'");
		
		 while(($rows_sql = mysqli_fetch_array($sql)) != false) 
		{
	
 $u_id=$rows_sql['user_id'];

		}
		
 $request_id = $_GET['request_id'];
 
 $report_name = "Purchase Request";
 
 
	$select_branch_id = mysqli_query($conn,"select branch_id from purchase_request_master where req_id = '$request_id' ");
	while($s = mysqli_fetch_array($select_branch_id))
	{
		$branch_id = $s['branch_id'];
	}

	
 
 $comments = $_GET['comments'];
 
 $sql = "INSERT INTO PURCHASE_REQUEST_APPROVAL(REQ_ID,COMMENTS,REQUESTED_ON,SENT_BY) VALUES ('$request_id','$comments','$customized_date','$u_id')";
	   $compiled = mysqli_query($conn, $sql);
	
	if($compiled){
		echo "<center>Request Sent</center>";
////

		 $srj="select barcode from purchase_request_master where req_id = '$request_id' ";
		  $run9=mysqli_query($conn,$srj);
          while(($row = mysqli_fetch_array($run9)) != false) 
			{
				 $barcode3=$row['barcode'];
				
			}
		
		$raw= "select * from purchase_request_master a , supplier_setup b , portal_user c ,school_branches d 
where a.req_id = '$request_id' and b.supplier_id  = a.req_from and a.user_id = c.user_id and d.branch_id = a.branch_id ";
            $smack=mysqli_query($conn,$raw);
             while(($r = mysqli_fetch_array($smack)) != false) 
			{
				   $req_date = $r['REQ_DATE'];
				   $remarks = $r['REMARKS'];
				   $request_from = $r['NAME'];
				   $branch_name = $r['branch_name'];
			}


		 
class PDF extends FPDF
{


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
	function footer()
{
      $this->SetY(-15);
		$this->SetFont('Arial','B','10');
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	  
		
	}
}


$pdf = new PDF('P','cm','A4');
$pdf = new PDF_Code128();		


$pdf->SetTopMargin(25);
$pdf->AddPage('L');
$pdf->AliasNbPages();
 $pdf->SetFont('Arial','',12);

$pic = 'mainlogo.png';
    



      $pdf->Cell(25,5, $pdf->Image($pic,10,5,60),0,0);
	  
	   $pdf-> SetFont("Arial","",12);
    $pdf->Cell(8);
    $pdf->SetX($pdf->GetX() - 210 );
    $pdf-> SetFont("Arial","BU",13);
    $pdf->Cell(25,5,'Purchase Request',0,1);         
    $pdf->ln(3);

	  
    $pdf->SetFont('Arial','BU',11);
    $pdf->SetX($pdf->GetX() - 95 );
    $pdf->Cell(40,7,'Generated By:',0,0,'C');
    $pdf->SetFont('Arial','',11);
    $pdf->SetX($pdf->GetX() - 5 );
    $pdf->Cell(26,7,$id1,0,1,'C');

    $pdf->SetFont('Arial','BU',11);
    $pdf->SetX($pdf->GetX() - 100 );
    $pdf->Cell(40,7,'Sys Date:',0,0,'C');
    $pdf->SetFont('Arial','',11);

    $pdf->Cell(26,7,$time,0,1,'C');
	
	
    
	$pdf->ln(7);
 $pdf->Cell(2);
$pdf->Code128(217, $pdf->GetY() -6,$barcode3,50,10);
 $pdf->SetFont('Arial','BU',11);  
    $pdf->SetX($pdf->GetX() -300 );
    $pdf->Cell(40,7,'Branch Name:',0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(60,7,ucfirst($branch_name),0,0,'L');
	
	 $pdf->SetFont('Arial','BU',11);  
    
    $pdf->Cell(40,7,'Request Date:',0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,7,ucfirst($req_date),0,1,'L');
 $pdf->Cell(2);
	 $pdf->SetFont('Arial','BU',11);  
    $pdf->SetX($pdf->GetX() -300 );
    $pdf->Cell(40,7,'Request From:',0,0,'L');
    $pdf->SetFont('Arial','',10);

    $pdf->Cell(60,7,ucfirst($request_from),0,0,'L');


$pdf->SetFont('Arial','BU',11);  
    $pdf->Cell(40,7,'Remarks:',0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,7,$remarks,0,1,'L');
 $pdf->ln(15);
    

    $pdf-> SetFont("Arial","BU",10);
	     $pdf->Cell(12,7,'S.No',1,0,'C');
    $pdf->Cell(45,7,'Item',1,0,'C');
    $pdf->Cell(40,7,'UOM',1,0,'C');
	$pdf->Cell(30,7,'Rate',1,0,'C');
    $pdf->Cell(30,7,'Quantity',1,0,'C');
	    $pdf->Cell(30,7,'Discount',1,0,'C');
	$pdf->Cell(30,7,'Amount',1,0,'C');
	$pdf->Cell(60,7,'Remarks',1,1,'C');

$i=1;
$p=1;    
  
$r = mysqli_query($conn, "select * from purchase_request_detail a , item_setup2 b where a.req_id = '$request_id' and a.item_code = b.item_id "); 
  
	while (($rows = mysqli_fetch_array($r)) != false) {
	
	$req_id = $rows['REQ_ID'];
	$uom = $rows['UOM'];
	$quantity = $rows['QUANTITY'];
    $item_name = $rows['ITEM_NAME'];   
    $rate = $rows['RATE'];
	$discount = $rows['DISCOUNT'];
	$total_amount = $rate * $quantity - $discount;
	$remarks = $rows['REMARKS'];

$real_amount += $total_amount;	

             $pdf->SetFont('Arial','',10);
// $pdf->Cell(30);			 
$pdf->Cell(12,8,$i,1,0,'C');             
              $pdf->Cell(45,8,$item_name,1,0,'C');           
              $pdf->Cell(40,8,$uom,1,0,'C');     
			$pdf->Cell(30,8,number_format($rate),1,0,'C');
              $pdf->Cell(30,8,number_format($quantity),1,0,'C');
$pdf->Cell(30,8,number_format($discount),1,0,'C');
$pdf->Cell(30,8,number_format($total_amount),1,0,'C');
$pdf->MultiCell(60,8,$remarks,1,1);
            
$i++;


}

             $pdf->SetFont('Arial','B',11);

              $pdf->Cell(57,8,'Total',1,0,'C');             
              $pdf->Cell(40,8,'',1,0,'C');     
			$pdf->Cell(30,8,'',1,0,'C');
              $pdf->Cell(30,8,'',1,0,'C');
$pdf->Cell(30,8,'',1,0,'C');
$pdf->Cell(30,8,number_format($real_amount),1,0,'C');
$pdf->MultiCell(60,8,'',1,1);
            

  $pdfdoc = $pdf->Output('','S');

  $approved = 'Y';
  $disapproved = 'N';
  
  $select_mail = mysqli_query($conn,"select * from assign_email where branch_id = '$branch_id' and report_name = '$report_name' ");
  while($row = mysqli_fetch_array($select_mail))
  {
     $email = $row['EMAIL'];
     $user_id = $row['USER_ID'];	 
 
     $enc_req_id = base64_encode($request_id);
	 $enc_user_id = base64_encode($user_id);
 
$mail = new PHPMailer();

$mail->Host = "smtp.gmail.com";

//$mail->isSMTP();

$mail->SMTPAuth = true;

$mail->Username = "bilalrock24061997@gmail.com";
$mail->Password = "mob!l1nkK";
$mail->SMTPSecure = "tsl";
$mail->Port = 587;
$mail->isHTML(true);
$mail->Subject = 'Purchase Request Approval ';
$mail->Body = "$comments <br> <br> Pdf Document <br>
Please Click On This Link If You Approve This Request
<br>
103.205.176.185/kreip/sms/request_approval.php?id=$enc_req_id&&approved=$approved&&u_id=$enc_user_id
<br>
Else
<br>	
	Click On This Link For Not Approving
	<br>
	103.205.176.185/kreip/sms/request_approval.php?id=$enc_req_id&&approved=$disapproved&&u_id=$enc_user_id
	";//$email_body."<br><br>".$email_footer."<br><br>".$EMAIL_SPECIAL_NOTE;
$mail->setFrom('abc@gmail.com','Bilal Aamir');
$mail->addAddress($email);
$mail->addStringAttachment($pdfdoc,'purchase_request.pdf');

  }
// $mail->addReplyTo($from_email,$from_person);
				if($mail->send())
{
	echo "<center>Mail Sent </center>";
}
else
{
	echo "Cannot Sent";
}




	/////	
	}
	else
	{
		
	}	
	
 
?>

