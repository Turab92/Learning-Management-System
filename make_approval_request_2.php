<?php
session_start();
include ('include/function.php');

if($_SESSION['name'] ==""){

    echo "<script>alert('You must Login to continue')</script>";
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
$loginuser= $_SESSION['name'];
$usr=mysqli_query($conn,"select * from portal_user WHERE USER_NAME='$loginuser'");
while ($y=mysqli_fetch_array($usr)){
    $userid=$y['user_id'];
    $username=$y['USER_NAME'];
}
//auth
?>
<!DOCTYPE html>
<html>
 <!--layout start-->
  <?php
  include('include/layout.php');
  ?>
  <!--layout End-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!--header start-->
  <?php
  include('include/header.php');
  ?>
  <!--header End-->
  
  <!--sidebar start-->
  <?php
  include('include/sidebar.php');
  ?>
  <!--sidebar End-->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Campus Management System
       
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
     <?php   
	 $po_no = base64_decode($_GET['id']);  

$r = mysqli_query($conn,"select a.PO_NO,a.PO_DATE,a.supplier_id,a.REMARKS,a.user_id,a.pc_ip,a.sys_date,a.PAYMENT_TERMS,a.req_id,a.APPROVED,a.po_type_id,a.branch_id,a.WITHOUT_REQUEST,b.supplier_id,b.name as SUPPLIER,c.term_id,c.description as PAYMENT_TERMS,d.potype_id,d.POTYPE_NAME,e.branch_id,e.branch_name from po_master a,supplier_setup b,PAYMENT_TERMS c,potype_setup d,school_branches e where
a.supplier_id = b.supplier_id and a.PAYMENT_TERMS = c.term_id and a.po_type_id = d.potype_id and a.branch_id = e.branch_id and a.PO_NO = '$po_no' order by a.PO_NO desc ");
	while (($rows = mysqli_fetch_array($r)) != false) {
	
$po_no = $rows['PO_NO'];
$po_date = $rows['PO_DATE'];
$remarks = $rows['REMARKS'];
$is_approved = $rows['APPROVED'];
$supplier = $rows['SUPPLIER'];
$payment_terms = $rows['PAYMENT_TERMS'];
$potype_name = $rows['POTYPE_NAME'];
$branch_name = $rows['branch_name'];
$without_request = $rows['WITHOUT_REQUEST'];
	 
	 
	}

?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Make Approval Request</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Order No</label>

                  <div class="col-sm-6">
                 <input type="text" class="form-control" readonly  value="<?php echo $po_no; ?>" style="font-size:14px;" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Order Date</label>

                  <div class="col-sm-6">
                   <input type="text" class="form-control" readonly  value="<?php echo $po_date; ?>" style="font-size:14px;" />
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Supplier</label>

                  <div class="col-sm-6">
                   <input type="text" class="form-control" readonly  value="<?php echo $supplier; ?>" style="font-size:14px;" />  
                  </div>
                </div>
				</div>
				
				 <div class="col-sm-6">
					<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Branch</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" readonly  value="<?php echo $branch_name; ?>"/>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Payment Terms</label>

                  <div class="col-sm-6">
                   <input type="text" class="form-control" readonly  value="<?php echo $payment_terms; ?>" style="font-size:14px;" />
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Comments</label>

                  <div class="col-sm-6">
                    <textarea class="form-control" id="comments" ></textarea>
                  </div>
                </div>
				</div>
              </div>
              <!-- /.box-body -->
           
            </form>
			<div class="col-md-10">
   
   <?php
   $select_request = mysqli_query($conn,"select * from purchase_order_approval where po_no = '$po_no' ");
   $selected_request_rows = mysqli_num_rows($select_request);
   
   if($selected_request_rows == 0)
   {
	   ?>
	
  <div align="center">
   <button class="btn btn-primary" onclick="show();" id="btn_request" > Request</button>
   </div>   
	   <?php
   }
   else
   {
	   ?>
	   
  <div align="center">
   <button class="btn btn-primary" onclick="show();" id="btn_request" disabled > Request</button>
   </div>
	   <?php
   }
   
   ?>
   
  
    <br>
<p align="center" id="wait" style="display:none;">Please Wait</p>
  
  <div id="d1"></div>

  <script>
  function show()
  {
	  document.getElementById("wait").style.display="block";
	      setTimeout("insert_record()", 1000);  // 5 seconds
  }


  function insert_record()
  {
	
var comments = document.getElementById("comments").value;
  var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","script_order_request.php?po_no="+<?php echo $po_no; ?>+"&&comments="+document.getElementById("comments").value,false);
	xmlhttp.send(null);
	
   var text =	document.getElementById("d1").innerHTML=xmlhttp.responseText;

document.getElementById("wait").style.display="none";
	document.getElementById("btn").disabled = true;

   
  }
  </script>
  
 </div>
 <br><br><br><br>
          </div>
		
		
		<div class="box-content">
					
					<div class="card">
			
			<div id="load"></div>
			
			</div>
				
				<!-- /.box-content -->
				</div>
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

	
	
  </div>
 <!--Footer start-->
  <?php
  include('include/footer.php');
  ?>
  <!--Footer End-->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!--javascript start-->
  <?php
  include('include/javascript.php');
  ?>
  <script type="text/javascript">
$(document).ready(function(){
      doRefresh();
    });

    function doRefresh(){
        $("#load").load("order_approval_script.php?po_no="+<?php echo $po_no;?>);
    }
    $(function() {
        setInterval(doRefresh, 2000);
    });
</script>
  <!--javascript End-->
</body>
</html>
