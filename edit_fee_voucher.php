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
$pagename="Fee Generate";
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
	<script>
                 function showamount(str) {
                     if (str=="") {
                         document.getElementById("txtHint5").innerHTML="";
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
                             document.getElementById("txtHint5").innerHTML=this.responseText;
                         }
                     }
					 var b = document.getElementById("challan_no").value;
					 var c = document.getElementById("session").value;
					 var d = document.getElementById("student").value;
                     xmlhttp.open("GET","showdetail.php?m="+str+"&cha="+b+"&se="+c+"&st="+d,true);
                     xmlhttp.send();
                 }
             </script>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <?php
				if(isset($_GET['edit'])) {
					 $challan_no = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `fee_voucher_master` as fvm JOIN school_branches as sb on fvm.branch_id=sb.branch_id JOIN sessions_setup as ss on fvm.session_id=ss.SESSION_ID JOIN class_setup_section as csc on fvm.section_id=csc.SECTION_ID JOIN class_setup as cs on fvm.class_id = cs.CLASS_ID JOIN student_current_status as scs on fvm.student_id=scs.STUDENT_ID JOIN banks_setup as bs on fvm.bank_id=bs.BANK_ID JOIN fee_voucher_month as fv on fvm.challan_no=fv.challan_no WHERE fvm.challan_no='$challan_no'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Fee Voucher</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
				 <input type="hidden" class="form-control" id="challan_no" name="challan_no" value="<?php echo $challan_no; ?>" readonly>
				 <input type="hidden" class="form-control" id="session" name="session" value="<?php echo $erow['session_id']; ?>" readonly>
				 <input type="hidden" class="form-control" id="student" name="student" value="<?php echo $erow['student_id']; ?>" readonly>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Branch</label>
                   <div class="col-sm-6">
				 <input type="text" class="form-control" id="branch" name="branch" value="<?php echo $erow['branch_name']; ?>" readonly>
				  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Bank Account No</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="bankid" name="bankid" value="<?php echo $erow['BANK_ACCOUNT_NO']; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Class</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="class" name="class" value="<?php echo $erow['CLASS_DESCRIPTION']; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Section</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="section" name="section" value="<?php echo $erow['SECTION_DESCRIPTION']; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Student</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="student" name="student" value="<?php echo $erow['APPLICANT_NAME']; ?>" readonly>
                  </div>
                </div>
			
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Nature</label>
                   <div class="col-sm-6">
				   <select class="form-control" id="nature" name="nature" onchange="showamount(this.value);" required>
                     <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"SELECT  fvd.nature_id,np.DESCRIPTION FROM `fee_voucher_detail` as fvd JOIN nature_payments as np on fvd.nature_id=np.NATURE_ID WHERE fvd.challan_no='$challan_no'");
							while ($k=mysqli_fetch_array($r)){
								$nature_id=$k['nature_id'];
								 $DESCRIPTION=$k['DESCRIPTION'];
								
								echo "<option value='$nature_id' >$DESCRIPTION</option>";
							}
					?>
					</select>
				  </div>
                </div>
				<div id="txtHint5"></div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Fee Period</label>

                  <div class="col-sm-6">
                    
					<select class="form-control" id="feeperiod" name="feeperiod" required>
                     <option value='<?php echo $erow['fee_month']; ?>'><?php echo $erow['fee_month']; ?></option>
					 <option value='Jan'>Jan</option>
					 <option value='Feb'>Feb</option>
					 <option value='Mar'>Mar</option>
					 <option value='Apr'>Apr</option>
					 <option value='May'>May</option>
					 <option value='Jun'>Jun</option>
					 <option value='Jul'>Jul</option>
					 <option value='Aug'>Aug</option>
					 <option value='Sep'>Sep</option>
					 <option value='Oct'>Oct</option>
					 <option value='Nov'>Nov</option>
					 <option value='Dec'>Dec</option>
					
					</select>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Issue Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="issue" name="issue" value="<?php echo $erow['issue_date']; ?>" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Due Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="due" name="due" value="<?php echo $erow['due_date']; ?>" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Valid Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="valid" name="valid" value="<?php echo $erow['expiry_date']; ?>" required>
                  </div>
                </div>
				<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Select Session</label>
					<div class="col-sm-6">
					<input type="text" class="form-control" id="session" name="session" value="<?php echo $erow['FROM_DATE']."-".$erow['TO_DATE']; ?>" readonly>
					
					</div>
					</div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-6">
                   <textarea name="remark" id="remark" rows="3"  class="form-control"><?php echo $erow['remarks']; ?></textarea>
                  </div>
                </div>
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
			<?php
						if (isset($_POST['btnsub'])) {
							
								$nature = $_POST['nature'];
								$feeperiod = $_POST['feeperiod'];
								$issue = $_POST['issue'];
								$due = $_POST['due'];
								$valid = $_POST['valid'];
								$discount = $_POST['discount'];
								$remark = $_POST['remark'];
								$feeamount = $_POST['feeamount'];
								
								if($discount > $feeamount)
								{
									 echo"<script type='text/javascript'>alert('Discount should be less than Fee Amount');</script>";
								}
								else
								{
									$query="UPDATE `fee_voucher_master` SET `issue_date`='".$issue."',`due_date`='".$due."',`expiry_date`='".$valid."',`is_edit`=1,`remarks`='".$remark."',`edit_date`='".$customized_date."' WHERE challan_no = '$challan_no'";
									$result = $conn->query($query);
									
									$query1="UPDATE `fee_voucher_detail` SET `discount`='".$discount."' WHERE challan_no ='$challan_no' and nature_id ='$nature'";
									$result1 = $conn->query($query1);
									
									$query2="UPDATE `fee_voucher_month` SET `fee_month`='".$feeperiod."' WHERE challan_no ='$challan_no'";
									$result2 = $conn->query($query2);
									 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
									echo "<script>location.href='view_fee_voucher'; </script>";
								}
						}
						?>
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
 

	 <script>
         function selectalll(source) {
             checkboxes = document.getElementsByName('nature[]');
             for(var i=0, n=checkboxes.length;i<n;i++) {
                 checkboxes[i].checked = source.checked;
             }
         }
     </script>
	 <script>
         function selectall(source) {
             checkboxes = document.getElementsByName('student[]');
             for(var i=0, n=checkboxes.length;i<n;i++) {
                 checkboxes[i].checked = source.checked;
             }
         }
     </script>
  <!--javascript End-->
</body>
</html>
