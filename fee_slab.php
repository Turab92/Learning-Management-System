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
$pagename="Fee Slab";
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
                 function shownature(str1) {
                     if (str1=="") {
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
                     xmlhttp.open("GET","shownature.php?n="+str1,true);
                     xmlhttp.send();
                 }
             </script>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Fee Slab</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="">
              <div class="box-body">
			
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Slab ID</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="slabid" name="slabid" >
                  </div>
                </div>
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
				<div class="form-group row">
					<div id="txtHint4"></div>
				</div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Charges Types</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="charges" id="charges" onchange="shownature(this.value);">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select `CHARGE_TYPE_ID`,`CHARGES_DESCRIPTION` from charges_types where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$CHARGE_TYPE_ID=$k['CHARGE_TYPE_ID'];
								 $CHARGES_DESCRIPTION=$k['CHARGES_DESCRIPTION'];
								echo "<option value='$CHARGE_TYPE_ID' >$CHARGES_DESCRIPTION</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				<div class="form-group row">
					<div id="txtHint2"></div>
				</div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Frequency Description</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="frequency" id="frequency">
                    <option value=''>Select</option>
					<?php
							$r=mysqli_query($conn,"select `UNIT_ID`,`DESCRIPTION` from payment_frequency_unit where ACTIVE = 'Y'");
							while ($k=mysqli_fetch_array($r)){
								$UNIT_ID=$k['UNIT_ID'];
								 $DESCRIPTION=$k['DESCRIPTION'];
								echo "<option value='$UNIT_ID' >$DESCRIPTION</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Fee Amount</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="feeamount" name="feeamount" placeholder="Enter some value">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">NO of Installnment</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="installment" name="installment" placeholder="Enter some value">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Start After</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="start" name="start" placeholder="Enter some value">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Due After</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="due" name="due" placeholder="Enter some value">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Sequence</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="sequence" name="sequence" placeholder="Enter some value">
                  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Status</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="status" id="status">
				  <option value="">Status</option>
                    <option value='Y'>Enabled</option>
					<option value='N'>Disabled</option>
                  </select>
				  </div>
                </div>
				
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
         <?php
				charges_setup();
			?>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Fee Slab</h3>
            </div>
            <!-- /.box-header -->
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
  <!--javascript End-->
</body>
</html>
