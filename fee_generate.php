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

    <!-- Main content -->
    <section class="content">
      <div class="row">
         <script>
                 function showclass(str) {
                     if (str=="") {
                         document.getElementById("txtHint4").innerHTML="";
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
                             document.getElementById("txtHint4").innerHTML=this.responseText;
                         }
                     }
                     xmlhttp.open("GET","showclasses.php?m="+str,true);
                     xmlhttp.send();
                 }
             </script>
			<script>
				function showSection(str,str1) {
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
				  xmlhttp.open("GET","ajax_show_section.php?q="+str+"&&a="+str1,true);
				  xmlhttp.send();
				}
				</script>
				<script>
					function showStudent(str,str1,str2) {
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
					  xmlhttp.open("GET","showstudent.php?q="+str+"&&a="+str1+"&&c="+str2,true);
					  xmlhttp.send();
					}
					</script>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Fee Generate</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			 
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="branch" id="branch" onchange="showclass(this.value);">
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
				
					<div id="txtHint4"></div>
				
					<div id="txtHint1"></div>
					<div id="txtHint"></div>
			
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Nature</label>
                   <div class="col-sm-6">
				    <button type="button" class="btn btn-default btn-sm " data-toggle="dropdown"> Select <span class="caret"></span></button>
				  <ul class="dropdown-menu" >
					  <div style="height:200px; overflow:auto;" >
					  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" onClick="selectalll(this)" / >&nbsp;&nbsp;&nbsp;Select All</li>
					  <?php

					 $r=mysqli_query($conn,'SELECT `NATURE_ID`,`DESCRIPTION` FROM `nature_payments` WHERE `ACTIVE` = "Y"');
					  foreach($r as $cat)
					  {
						  ?>

						  <li>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="nature[]" value="<?php echo $cat['NATURE_ID'];  ?>"/>&nbsp;&nbsp;&nbsp;<?php echo $cat['DESCRIPTION'];  ?></li>
						  <?php
					  }
					  ?>
                   </div>
                   </ul>
				  </div>
                </div>
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Fee Period</label>

                  <div class="col-sm-6">
                    
					<select class="form-control" id="feeperiod" name="feeperiod" required>
                     <option value=''>Select</option>
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
                    <input type="date" class="form-control" id="issue" name="issue" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Due Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="due" name="due" required>
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Valid Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="valid" name="valid" required>
                  </div>
                </div>
				<div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Select Session</label>
					<div class="col-sm-6">
					<select class="form-control" id="session" name="session" required>
                     <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select SESSION_ID, FROM_DATE, TO_DATE  from sessions_setup where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$SESSION_ID=$k['SESSION_ID'];
								 $FROM_DATE=$k['FROM_DATE'];
								 $TO_DATE=$k['TO_DATE'];
								  $session_date=$FROM_DATE."-".$TO_DATE;
								echo "<option value='$SESSION_ID' >$session_date</option>";
							}
					?>
					</select>
					</div>
					</div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Remarks</label>

                  <div class="col-sm-6">
                   <textarea name="remark" id="remark" rows="3"  class="form-control"></textarea>
                  </div>
                </div>
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
			<form action="fees_slip_pdf.php" target="_blank" method="POST">
                      <div align="center">
					 
                           <input type="submit" class="btn btn-primary"  style="width:80px;" value="Print" />                     <!-- /.panel -->
                       </div>
						<br>
			</form>
          </div>
         <?php
				fee_voucher_setup();
			?>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	 <!-- Main content 
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Fee Slab</h3>
            </div>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
				  <th>Description</th>
				  <th>Royality Percent</th>
				  <th>Royality Fix</th>
				  <th>Active</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"SELECT CHARGE_TYPE_ID, CHARGES_DESCRIPTION, ACTIVE, ROYALITY_PERCENT, ROYALITY_FIX FROM `charges_types` order by CHARGE_TYPE_ID desc");
            foreach($fetch_emp as $emp)
            {
                $CHARGE_TYPE_ID=$emp['CHARGE_TYPE_ID'];
                $CHARGES_DESCRIPTION=$emp['CHARGES_DESCRIPTION'];
				 $ROYALITY_PERCENT=$emp['ROYALITY_PERCENT'];
                $ROYALITY_FIX=$emp['ROYALITY_FIX'];
				 $ACTIVE=$emp['ACTIVE'];
                
                ?>
                
                    <td><?php echo $s_no; ?></td>
					<td><?php echo $CHARGES_DESCRIPTION; ?></td>
					 <td><?php echo $ROYALITY_PERCENT; ?></td>
					<td><?php echo $ROYALITY_FIX; ?></td>
					 <td><?php echo $ACTIVE; ?></td>
					
					
					 
					   
					
					<td><span class='action'><a href='edit_charges.php?edit=<?php echo $CHARGE_TYPE_ID; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?CHARGE_TYPE_ID=<?php echo $CHARGE_TYPE_ID; ?>' class='delete show' title='Delete'>X</a></span></td>
           </tr>
                <?php $s_no++; }?>
                

            </tbody>
              </table>
            </div>
       
          </div>
       
        </div>
  
      </div>
  
    </section>
    content -->
	
	
	
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
