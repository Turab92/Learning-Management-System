<?php
session_start();
require('code128.php');
include ('include/function.php');

 $id1=$_SESSION['name'];
  
$po_no = base64_decode($_GET['id']);	

		
		 $srj="select BARCODE from po_master where po_no = '$po_no' ";
		  $run9=mysqli_query($conn,$srj);
          while(($row = mysqli_fetch_array($run9)) != false) 
			{
				 $barcode3=$row['BARCODE'];
				
			}
		
$r = mysqli_query($conn,"select a.PO_NO,a.PO_DATE,a.supplier_id,a.REMARKS,a.user_id,a.pc_ip,a.sys_date,a.PAYMENT_TERMS,a.req_id,a.APPROVED,a.po_type_id,a.branch_id,a.WITHOUT_REQUEST,b.supplier_id,b.name as SUPPLIER,c.term_id,c.description as PAYMENT_TERMS,d.potype_id,d.POTYPE_NAME,e.branch_id,e.branch_name  from po_master a,supplier_setup b,PAYMENT_TERMS c,potype_setup d,school_branches e where
a.supplier_id = b.supplier_id and a.PAYMENT_TERMS = c.term_id and a.po_type_id = d.potype_id and a.branch_id = e.branch_id
 and a.po_no = '$po_no' order by a.po_no desc ");
	while (($rows = mysqli_fetch_array($r)) != false) {
	
$po_no = $rows['PO_NO'];
$po_date = $rows['PO_DATE'];
$remarks = $rows['REMARKS'];
$is_approved = $rows['APPROVED'];
$supplier = $rows['SUPPLIER'];
$payment_terms = $rows['PAYMENT_TERMS'];
$potype_name = $rows['POTYPE_NAME'];
$branch_name = $rows['branch_name'];
$contractor = $rows['CONTRACTOR'];
$without_request = $rows['WITHOUT_REQUEST'];
	 
	 
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

$pic = 'school.jpg';
      $pdf->Cell(25,5, $pdf->Image($pic,10,5,60),0,0);
	  
	   $pdf-> SetFont("Arial","",12);
    $pdf->Cell(8);
    $pdf->SetX($pdf->GetX() - 210 );
    $pdf-> SetFont("Arial","BU",13);
    $pdf->Cell(25,5,'Purchase Order',0,1);         
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
 
 	$pdf->Ln(10);
 
    $pdf->SetX($pdf->GetX() - 298 );
    $pdf->Cell(30,7,'Order No:',0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,7,$barcode3,0,0,'L');
	
	 $pdf->SetFont('Arial','BU',11);  
    
    $pdf->Cell(25,7,'Order Date:',0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(50,7,ucfirst($po_date),0,0,'L');
 
	 $pdf->SetFont('Arial','BU',11);  
    $pdf->Cell(35,7,'Supplier:',0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(50,7,ucfirst($supplier),0,1,'L');
	
	$pdf->Ln(2);
	
	    $pdf->SetX($pdf->GetX() - 298 );

	
$pdf->SetFont('Arial','BU',11);  	
    $pdf->Cell(25,7,'Branch:',0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(50,7,$branch_name,0,0,'L');
		
$pdf->SetFont('Arial','BU',11);  	
    $pdf->Cell(35,7,'Payment Type:',0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(50,7,$payment_terms,0,1,'L');
		
 $pdf->ln(2);
    	
	    $pdf->SetX($pdf->GetX() - 298 );
$pdf->SetFont('Arial','BU',11);  
    $pdf->Cell(30,7,'PO Type:',0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,7,$potype_name,0,1,'L');
	
	
 $pdf->ln(20);
    

    $pdf-> SetFont("Arial","BU",10);
	
     $pdf->Cell(12,7,'S.No',1,0,'C');
    $pdf->Cell(45,7,'Item Name',1,0,'C');
	$pdf->Cell(30,7,'Rate',1,0,'C');
	$pdf->Cell(40,7,'UOM',1,0,'C');
	$pdf->Cell(30,7,'Quantity',1,0,'C');
	$pdf->Cell(30,7,'Discount',1,0,'C');
		$pdf->Cell(30,7,'Amount',1,0,'C');
			$pdf->MultiCell(60,7,'Remarks',1,'C');

$i=1;
$p=1;    
  
	$r = mysqli_query($conn, "select * from po_detail a , item_setup2 b where a.po_no = '$po_no' and a.item_code = b.item_id "); 
  
	while (($rows = mysqli_fetch_array($r)) != false) {
	
	$po_no = $rows['PO_NO'];
	$uom = $rows['UOM'];
	$quantity = $rows['QUANTITY'];
    $item_name = $rows['ITEM_NAME'];
	$remarks = $rows['REMARKS']; 
	$rate = $rows['RATE'];
    $quantity = $rows['QUANTITY'];
	$discount = $rows['DISCOUNT'];
	$uom_name = $rows['DESCRIPTION'];
	$total = $rate * $quantity - $discount;
	
	$real_amount += $total;
	
             $pdf->SetFont('Arial','',10);
 
              $pdf->Cell(12,8,$i,1,0,'C');             
              $pdf->Cell(45,8,$item_name,1,0,'C');           
			  $pdf->Cell(30,8,number_format($rate),1,0,'C');  
              $pdf->Cell(40,8,$uom_name,1,0,'C');     
              $pdf->Cell(30,8,number_format($quantity),1,0,'C');
              $pdf->Cell(30,8,number_format($discount),1,0,'C');
              $pdf->Cell(30,8,number_format($total),1,0,'C');            
              $pdf->MultiCell(60,8,$remarks,1,1);			
			
$i++;


}

             $pdf->SetFont('Arial','B',11);

              $pdf->Cell(57,8,'Total',1,0,'C');             
              $pdf->Cell(30,8,'',1,0,'C');  
              $pdf->Cell(40,8,'',1,0,'C');     
              $pdf->Cell(30,8,'',1,0,'C');
              $pdf->Cell(30,8,'',1,0,'C');
              $pdf->Cell(30,8,number_format($real_amount),1,0,'C');            
              $pdf->MultiCell(60,8,'',1,1);			


            $pdf->Output();
                

?>