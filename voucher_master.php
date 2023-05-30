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
$pagename="Vouchers";
auth_user($pagename,$userid);

$select_vno = mysqli_query($conn,"select max(VNO) as v_no from v_master");
      
while($r = mysqli_fetch_array($select_vno))	
{
	$v_no = $r['v_no'];
	echo $vno=$v_no+1;
	
}	
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
			
function show_project(str) {
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
  xmlhttp.open("GET","ajax_voucher.php?q="+str,true);
  xmlhttp.send();
}
function show_fiscal(str,str1) {
  if (str=="") {
    document.getElementById("txtHint1").innerHTML="";
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
      document.getElementById("txtHint1").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","ajax_voucher_2.php?prj="+str+"&&com="+str1,true);
  xmlhttp.send();
}
function show_head_code(str,str1,str2,str3,str4,str5) {
  if (str=="") {
    document.getElementById("txt2").innerHTML="";
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
      document.getElementById("txt2").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","ajax_voucher_3.php?code="+str+"&&prj="+str1+"&&com="+str2+"&&fiscal_year="+str3+"&&v_type="+str4+"&&vno="+str5,true);
  xmlhttp.send();
}
</script>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Voucher Master</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST">
              <div class="box-body">
			  <div class="col-sm-4">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Company</label>

                  <div class="col-sm-8">
                 	<select name="company" id="company" class="form-control"  required onchange="show_project(this.value)" >
						<option value="">Select Company</option>
						
						<?php
						$select_company = mysqli_query($conn,"select * from comp_info order by company_id desc");
						
						while($r = mysqli_fetch_array($select_company))
						{
							$company_id = $r['COMPANY_ID'];
							$company_name = $r['COMP_NAME'];
							?>
						<option value="<?php echo $company_id; ?>"><?php echo $company_name; ?></option>
							<?php
						}
						
						?>
						</select>
                  </div>
                </div>
				<div id="txtHint">Select Company For Project</div>
				<div id="txtHint1"></div>
				
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Voucher Type</label>

                  <div class="col-sm-8">
                 	<select name="v_type" id="v_type" class="form-control"  required>
						<option value="">Select Voucher</option>
						
						<?php
						$select_company = mysqli_query($conn,"select * from voucher_types ");
						
						while($r = mysqli_fetch_array($select_company))
						{
							$VOUCHER_TYPE_ID = $r['VOUCHER_TYPE_ID'];
							$DESCRIPTION = $r['DESCRIPTION'];
							?>
						<option value="<?php echo $VOUCHER_TYPE_ID; ?>"><?php echo $DESCRIPTION; ?></option>
							<?php
						}
						
						?>
						</select>
                  </div>
                </div>
              
				</div>
				
				 <div class="col-sm-4">
				 <div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Voucher No</label>

					  <div class="col-sm-8">
						<input type="text" class="form-control" id="voucher_no" name="v_no" value="<?php echo $vno; ?>" readonly>
					  </div>
					</div>
				  <div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Voucher Date</label>

					  <div class="col-sm-8">
						<input type="date" class="form-control" id="v_date" name="v_date"  >
					  </div>
					</div>
					<div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Cheque No</label>

					  <div class="col-sm-8">
						<input type="text" class="form-control" id="cheque_no" name="cheque_no"  >
					  </div>
					</div>
					<div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Cheque date</label>

					  <div class="col-sm-8">
						<input type="date" class="form-control" id="cheque_date" name="cheque_date"  >
					  </div>
					</div>
					
					
				</div>
				 <div class="col-sm-4">
				 <div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Received By</label>

					  <div class="col-sm-8">
						<input type="text" class="form-control" id="receive_by" name="receive_by" placeholder="Received By" >
					  </div>
					</div>
				  <div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Source</label>

					  <div class="col-sm-8">
						<input type="text" class="form-control" id="source" name="source"  readonly>
					  </div>
					</div>
					
					
					<div class="form-group">
					  <label for="inputPassword3" class="col-sm-3 control-label">Remark</label>

					  <div class="col-sm-8">
					  <textarea name="remarks" id="remarks" rows="4" class="form-control"></textarea>
						
					  </div>
					</div>
					
				</div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btn" id="btn" onclick="v_master();" class="btn btn-info pull-right">Create Voucher</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		 
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
	  
		

      <!-- /.row -->
    </section>
    <!-- /.content -->
	<div id="voucher"></div>
						
													<div id="voucher_detail"></div>
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
	function v_master() {
    var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","savevoucher.php?company="+document.getElementById("company").value+"&project="+document.getElementById("project").value+
	"&fiscal_year="+document.getElementById("fiscal_year").value+"&v_type="+document.getElementById("v_type").value+"&v_date="+document.getElementById("v_date").value+"&cheque_no="+document.getElementById("cheque_no").value+"&cheque_date="+document.getElementById("cheque_date").value+"&receive_by="+document.getElementById("receive_by").value+"&remarks="+document.getElementById("remarks").value,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("voucher").innerHTML=xmlhttp.responseText;

	var voucher_no = document.getElementById("vouch_no").value;
	
	document.getElementById("voucher_no").value = voucher_no;
	
	if(text != 'Please Fill All The Mandatory Fields')
	{

alert('Voucher Master Created');

document.getElementById("company").disabled = true;
		document.getElementById("project").disabled = true;
		document.getElementById("fiscal_year").disabled = true;
		document.getElementById("v_type").disabled = true;
		document.getElementById("v_date").disabled = true;
		document.getElementById("cheque_no").disabled = true;
		document.getElementById("cheque_date").disabled = true;
		document.getElementById("receive_by").disabled = true;
		document.getElementById("remarks").disabled = true;
		document.getElementById("btn").disabled = true;
		
	}
	
	
	
  }
  ////

function call(id)
{
alert(id);

 var chart_head_code=document.getElementById("chart_head_code"+id).innerHTML;
 var chart_acc_code=document.getElementById("chart_acc_code"+id).innerHTML;
 var chart_acc_desc=document.getElementById("chart_acc_desc"+id).innerHTML;
 var debit=document.getElementById("debit"+id).innerHTML;
 var credit=document.getElementById("credit"+id).innerHTML;
 
 document.getElementById("debit"+id).innerHTML="<input type='text' id='debit_text"+id+"' class='form-control' value='"+debit+"'>";
 document.getElementById("credit"+id).innerHTML="<input type='text' id='credit_text"+id+"' class='form-control' value='"+credit+"'>"; 
 
 document.getElementById("edit_button"+id).style.display="none";
 document.getElementById("save_button"+id).style.display="block";
 
}
  
  function save_row(id)
{

alert(id);

 var debit=document.getElementById("debit_text"+id).value;
 var credit=document.getElementById("credit_text"+id).value;

     document.getElementById("debit"+id).innerHTML=debit;
	document.getElementById("credit"+id).innerHTML=credit;

	    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="none";
 
}

function add_detail(project_id,company_id,fiscal_year,vno,v_type)
{


if(document.getElementById("debit").value == '' && document.getElementById("credit").value == '')
{
	alert("Please Fill Debit Or Credit Field");
}
else if(document.getElementById("debit").value != '' && document.getElementById("credit").value != '')
{
	alert("Please Fill Debit Or Credit Field");
}
else
{
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","savevoucher_2.php?project="+project_id+"&&company="+company_id+"&&fiscal="+fiscal_year+"&&vno="+vno+"&&v_type="+v_type
	+"&&head_code="+document.getElementById('head_code').value+"&&chart_acc_desc="+document.getElementById("chart_acc_desc").value+"&&acc_code="+
	document.getElementById("acc_code").value+"&&debit="+document.getElementById("debit").value+"&&credit="+document.getElementById("credit").value+"&&acc_detail_type="+document.getElementById("acc_detail_type").value+"&&acc_type="+document.getElementById("acc_type").value+"&&remarks="+document.getElementById("remarks_details").value+"&&supplier_type="+document.getElementById("supplier_type").value,false);
	xmlhttp.send(null);
	

	var text = document.getElementById("voucher_detail").innerHTML=xmlhttp.responseText;
	 	document.getElementById("btn_post").disabled = true;
}
	
}

function delrow(id,company_id,project_id,fiscal_year_id,chart_acc_code)
{

    var vno = document.getElementById("voucher_no").value;
	var vtype = document.getElementById("v_type").value;
	
    var head_code = document.getElementById("head_code"+id).innerHTML;
    var debit = document.getElementById("debit"+id).innerHTML;	
	var credit = document.getElementById("credit"+id).innerHTML;	
	
var total_debit = document.getElementById("total_debit").innerHTML;
var total_credit = document.getElementById("total_credit").innerHTML;
	
	var new_total_debit = total_debit - debit;
	var new_total_credit = total_credit - credit;
	
 document.getElementById("total_debit").innerHTML = new_total_debit;
 document.getElementById("total_credit").innerHTML = new_total_credit;
 
var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","delvoucherdetail.php?vno="+vno+"&vtype="+vtype+"&head_code="+head_code+"&chart_acc_code="+chart_acc_code+"&company="
	+company_id+"&project="+project_id+"&fiscal_year="+fiscal_year_id,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("voucher_delete").innerHTML=xmlhttp.responseText;
	
	if(text == 'Detail Deleted')
	{
	
        $("#voucher_detail").load("voucher_detail_2.php?vno="+vno+"&vtype="+vtype+"&company="+company_id+"&project="+project_id+"&fiscal_year="+fiscal_year_id);
	
	var row = document.getElementById('row'+id);
	row.parentNode.removeChild(row);
	
	}
	
}

//
function post(vno,v_type,project_id,company_id,fiscal_year)
{
	
var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","post_voucher.php?vno="+vno+"&v_type="+v_type+"&company="+company_id+"&project="+project_id+"&fiscal_year="+fiscal_year,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("post_voucher").innerHTML=xmlhttp.responseText;
	alert(text);
	
		document.getElementById("btn_post").disabled = true;
	
	
}

function voucher_post(company_id,project_id,fiscal_year,vno,v_type)
{

	
var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","post_voucher.php?vno="+vno+"&v_type="+v_type+"&company="+company_id+"&project="+project_id+"&fiscal_year="+fiscal_year,false);
	xmlhttp.send(null);
	
	var text = document.getElementById("post_voucher").innerHTML=xmlhttp.responseText;
	alert(text);

location.reload();	

}


function save(company_id,project_id,fiscal_year_id,v_no,v_type)
{
 
 
var total_debit = document.getElementById("total_debit").innerHTML;
var total_credit = document.getElementById("total_credit").innerHTML; 


if(total_credit == 0 && total_debit == 0 )
{
	alert('Invalid Voucher Details');
return;	
}
else if(total_debit == total_credit)
 {


		alert('Voucher Saved');
		location.reload();
	
 }
 else
 {
	 alert('Sorry ! Debit And Credit Total Not Matched');
 }
 
}

function saved(company_id,project_id,fiscal_year_id,v_no,v_type)
{
 
 
var total_debit = document.getElementById("total_debit").innerHTML;
var total_credit = document.getElementById("total_credit").innerHTML; 

if(total_credit == 0 && total_debit == 0 )
{
	alert('Invalid Voucher Details');
return;	
}
else if(total_debit == total_credit)
 {

		alert('Voucher Saved');
       	document.getElementById("btn_post").disabled = false;
			
 }
 else
 {
	 alert('Sorry ! Debit And Credit Total Not Matched');
 }
 
}


  
</script>
  <!--javascript End-->
</body>
</html>
