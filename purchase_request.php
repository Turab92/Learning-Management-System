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
$pagename="Purchase Request";
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
  <?php

	 $random=rand();
$u=mysqli_query($conn,"select * from purchase_request_master WHERE STATUS=null");
$u_count=mysqli_num_rows($u);
if($u_count==0){
    $r=mysqli_query($conn,"insert into purchase_request_master(REQ_DATE,USER_ID,PC_IP,RANDOM_ID) VALUES ('$customized_date','$userid','$ip','$random')");
    $getid=mysqli_query($conn,"select REQ_ID from purchase_request_master WHERE random_id='$random'");
    while ($k=mysqli_fetch_array($getid)){
        $purchaserequestid=$k['REQ_ID'];
    }
}
else{
    while($k=mysqli_fetch_array($u)){
        $purchaserequestid=$k['REQ_ID'];
    }
}
?>
<script>
function showLocation(str) {
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
  xmlhttp.open("GET","ajax_item_uom.php?z="+str,true);
  xmlhttp.send();
}
function show_branch(str) {
  if (str=="") {
    document.getElementById("txtbranch").innerHTML="";
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
      document.getElementById("txtbranch").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","ajax_purchase_request.php?id="+str,true);
  xmlhttp.send();
}

 </script>

        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Purchase Request</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" onkeypress="return event.keyCode != 13;" onsubmit="return false">
              <div class="box-body">
			
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch" onchange="show_branch(this.value)">
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
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Purchase Request ID </label>
                   <div class="col-md-6">
						<input type="text" class="form-control" value=" <?php echo $purchaserequestid;  ?>" id="payment" name="pri" readonly />
					</div>
                </div>
				<input type="hidden" class="form-control" value=" <?php echo $purchaserequestid;  ?>" id="payment1" name="pri1" readonly />
				</div>
				 <div class="col-sm-6">
				 	<div class="form-group">
								<label for="inputPassword3" class="col-sm-3 control-label">Remarks </label>
																<div class="col-md-6">
									  <textarea class="form-control" name="remarks" cols="5" rows="5" id="remarks"></textarea>	</div></div>
						
					
				</div>
				<div id="txtbranch"></div>
              </div>
             
            </form>
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
      refreshTable();
    });
    function refreshTable(){
        $.ajax({
        type: "GET",
        url: "gettable4.php",
        data: {
          simplestring: "<?php echo $purchaserequestid; ?>",
         
        },
        success: function(result){
			$("#tableHolder").html(result);
          //  alert(result);
		  //setTimeout(result, 1000);
        }
		
    });
	setTimeout(refreshTable, 1000);
    }

	function slab() {
		
		var pay = document.getElementById("payment1").value;
				var item = document.getElementById("remarks1").value;
		
    var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","inc11.php?payment="+document.getElementById("payment1").value+"&uom="+document.getElementById("uom").value+"&item="+document.getElementById("item").value+"&quantity="+document.getElementById("quantity").value+"&remarks1="+document.getElementById("remarks1").value+"&rate="+document.getElementById("rate").value+"&discount="+document.getElementById("discount").value,false);
	xmlhttp.send(null);
	
	document.getElementById("d1").innerHTML=xmlhttp.responseText;
	document.getElementById('item').value= " " ;
	document.getElementById('quantity').value= " " ;
	document.getElementById('remarks1').value= " " ;
	document.getElementById('rate').value= " " ;
	document.getElementById('discount').value= " " ;

  }
  function save() {

    var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","inc12.php?payment="+document.getElementById("payment").value+"&branch="+document.getElementById("branch").value+"&remark="
	+document.getElementById('remarks').value+"&request="
	
	+document.getElementById('request').value,false);
	xmlhttp.send(null);

	
alert("Record Saved");

	
	location.reload('purchase_request.php');


	
	document.getElementById("d2").innerHTML=xmlhttp.responseText;
	// document.getElementById('class').value= " " ;
	// document.getElementById('a9').value= " " ;
	
  }



</script>
  <!--javascript End-->
</body>
</html>
