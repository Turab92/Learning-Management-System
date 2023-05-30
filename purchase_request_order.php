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
$pagename="Purchase Order (With Request)";
auth_user($pagename,$userid);
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
<script>
			
function show_detail(str,str1) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","ajax_purchase_request_order.php?q="+str+"&branch="+str1,true);
  xmlhttp.send();
}
</script>

						<script>
			
function show_request(str) {
  if (str=="") {
    document.getElementById("txtHint2").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint2").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","ajax_purchase_request_order_2.php?q="+str,true);
  xmlhttp.send();
}
</script>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Purchase Order (With Request)</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			 
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch" onchange="show_request(this.value)">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select branch_id,branch_name from school_branches where active = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$branch_id=$k['branch_id'];
								 $branch_name=$k['branch_name'];
								echo "<option value='$branch_id' >$branch_name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				
				</div>
				 
				<div id="txtHint2"></div>
				
				<div id="txtHint"></div>
						
              </div>
              <!-- /.box-body -->
             
            </form>
          </div>
		 
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	<div align="center">
						<div id="request_order"></div>
							</div>
	
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
  
<script>
	////
	function create_order(branch_id,request_id,supplier_id) {
    
var payment_terms = document.getElementById("payment_terms").value;
var po_type = document.getElementById("po_type").value;	
var remarks = document.getElementById("remarks").value;
var priority = document.getElementById("priority").value;
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","save_purchase_request_order.php?branch_id="+branch_id+"&request_id="+request_id+
	"&supplier_id="+supplier_id+"&payment_terms="+payment_terms+"&po_type="+po_type+"&remarks="+remarks+"&priority="+priority,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("request_order").innerHTML=xmlhttp.responseText;

	
	if(text != 'Please Fill All The Mandatory Fields')
	{
		document.getElementById("supplier").disabled = true;
		document.getElementById("payment_terms").disabled = true;
		document.getElementById("po_type").disabled = true;
		document.getElementById("remarks").disabled = true;
		document.getElementById("priority").disabled = true;

		document.getElementById("btn").disabled = true;
		
	}
	

  }
  ////

function edit_row(id,tr_no)
{

 var quantity = document.getElementById("quantity"+id).innerHTML;
 
 document.getElementById("quantity"+id).innerHTML="<input type='text' id='quantity_text"+id+"' style='width:175px; height:20px; font-size:12px; ' value='"+quantity+"'>"; 
 
 document.getElementById("edit_button"+id).style.display="none";
 document.getElementById("save_button"+id).style.display="block";
 
}
  
  function save_row(id,tr_no,po_no)
{

 var quantity = document.getElementById("quantity_text"+id).value;


   var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","edit_request_order_detail.php?trno="+tr_no+"&po_no="+po_no+"&quantity="+quantity,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("detail_delete").innerHTML=xmlhttp.responseText;
	
	if(text == "<center>Quantity Updated</center>")
	{
		
		$("#request_order").load("save_purchase_request_order_2.php?po_no="+po_no);
		
var new_quantity = document.getElementById("quantity"+id).innerHTML=quantity;

	    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="none";
		
	}
	
}


function delrow(id,tr_no,po_no)
{

   var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","delete_request_order_detail.php?trno="+tr_no+"&po_no="+po_no,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("detail_delete").innerHTML=xmlhttp.responseText;
	
	if(text == 'Detail Deleted')
	{
	
	var row = document.getElementById('row'+id);
	row.parentNode.removeChild(row);
	
	}
	
}


function save()
{
  alert('Order Saved');	
  location.reload();
  
}

  
</script>
  <!--javascript End-->
</body>
</html>
