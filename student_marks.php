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
$pagename="Student Marks";
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
	function showSection(str,str1) {
	  if (str=="") {
		document.getElementById("txtHint3").innerHTML="";
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
		  document.getElementById("txtHint3").innerHTML=this.responseText;
		}
	  }
	  xmlhttp.open("GET","ajax_show_section.php?q="+str+"&&a="+str1,true);
	  xmlhttp.send();
	}
	</script>

		
		<script>
function showClass(str) {
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
  xmlhttp.open("GET","campus_leaving_ajax1.php?q="+str,true);
  xmlhttp.send();
}
</script>

<script>
	function showStudent(str,str1,str2) {
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
	  xmlhttp.open("GET","showstd.php?q="+str+"&&a="+str1+"&&c="+str2,true);
	  xmlhttp.send();
	}
	</script>
    <!-- Main content -->
    <section class="content">
      <div class="row">
	
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Class Wise Student Marks</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="GET" action="">
              <div class="box-body">
			
			    <div class="form-group">
					<label  for="inputPassword3" class="col-sm-3 control-label">Select Branch</label>
					<div class="col-sm-6">
					 <select class="form-control"  name="branch" id="branch" onchange="showClass(this.value);">
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
					
					<div id="txtHint2"></div>	
					
							<div id="txtHint"></div>	
							<div id="txtHint3"></div>	
							<div id="txtHint1"></div>	
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsub" class="btn btn-info pull-right">Submit</button>
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
	<?php
				if(isset($_GET['btnsub']))
				{
					
					$branch=$_GET['branch'];
					$class=$_GET['class'];
					$section=$_GET['section'];
					$student=$_GET['student'];
					
					$sub=mysqli_query($conn,"SELECT csa.assign_sub_id, csa.class_id, csa.subject_id,s.sub_name FROM `class_subject_assign` as csa JOIN subjects as s on csa.subject_id=s.sub_id WHERE csa.class_id ='$class'");
					
					
				
				?>
	
	 <!-- Main content -->
    <section class="content">
      <div class="row">
	
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Class Wise Student Marks</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="">
              <div class="box-body">
			  <?php
			 foreach($sub as $emp)
            {
				$subject_id=$emp['subject_id'];
				$sub_name=$emp['sub_name'];
				
				$sub=mysqli_query($conn,"SELECT  `total_marks`, `passing_marks` FROM `class_subject_marks` WHERE class_id = '$class' and subject_id = '$subject_id'");
					while ($k=mysqli_fetch_array($sub))
					{
						$total_marks=$k['total_marks'];
						 $passing_marks=$k['passing_marks'];
					}
			?>
					<div class="form-group">
					<label  for="inputPassword3" class="col-sm-1 control-label">Subject:</label>
					<div class="col-sm-4">
					 <input type="text" class="form-control" name="name" value="<?php echo $sub_name; ?>" readonly>
					  <input type="hidden" class="form-control" name="subject[]" value="<?php echo $subject_id; ?>">
					</div>
					<label  for="inputPassword3" class="col-sm-2 control-label">Obtained Marks:</label>
					<div class="col-sm-3">
					 <input type="text" class="form-control" id="obtain"  name="obtain[]" required>
					 <input type="text" class="form-control" id="passing"  name="passing[]" value="<?php echo $passing_marks;?>" required>
					</div>
					<label  for="inputPassword3" class="col-sm-2 control-label" id="demo"></label>
					 
					<input type="hidden" class="form-control" id="branch" name="branch" value="<?php echo $branch; ?>">
					<input type="hidden" class="form-control" id="class" name="class" value="<?php echo $class; ?>">
					<input type="hidden" class="form-control" id="section" name="section" value="<?php echo $section; ?>">
					<input type="hidden" class="form-control" id="student" name="student" value="<?php echo $student; ?>">
					</div>
					
					
			<?php
			}
			?>
			</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="btnsave" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		  <?php
			//subject_marks();
		  ?>
		  
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
	   <script type="text/javascript">
							 var obtained = $("input[id='obtained']").map(function(){return $(this).val();}).get();
							 var passed = $("input[id='passing']").map(function(){return $(this).val();}).get();
							 //for (var i = 0, iLen = passed.length; i < iLen; i++) 
							 //{
							  // alert(passed[i].value);
  
							 if (obtained <= passed[i])
							 {
								document.getElementById("demo").innerHTML = "PASS";
							 }
							 else
							 {
								 document.getElementById("demo").innerHTML = "FAILED";
							 }
//						}
						</script>
				
      <!-- /.row -->
    </section>
    <!-- /.content -->
	<?php
				}
	?>
	
		 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Subject Marks Detail</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Class</th>
				  <th>Subject</th>
                  <th>Total Marks</th>
				  <th>Passing Marks</th>
                  <th>Edit</th>
				  
                 
                  
                </tr>
                </thead>
                <tbody>
					<tr>
            <?php
            
            $s_no=1;
            $total=0;
            $con=0;
            $fetch_emp = mysqli_query($conn,"SELECT csm.cs_mark_id, c.CLASS_DESCRIPTION, s.sub_name, csm.total_marks, csm.passing_marks FROM `class_subject_marks` as csm JOIN class_setup as c on csm.class_id=c.CLASS_ID JOIN subjects as s on csm.subject_id=s.sub_id order by csm.cs_mark_id desc");
            foreach($fetch_emp as $emp)
            {
                $cs_mark_id=$emp['cs_mark_id'];
				$CLASS_DESCRIPTION=$emp['CLASS_DESCRIPTION'];
                $sub_name=$emp['sub_name'];
				$total_marks=$emp['total_marks'];
                $passing_marks=$emp['passing_marks'];
				
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $CLASS_DESCRIPTION; ?></td>
					  <td><?php echo $sub_name; ?></td>
					  <td><?php echo $total_marks; ?></td>
					 <td><?php echo $passing_marks; ?></td>
					 
					   
					
					<td><span class='action'><a href='edit_subject_mark.php?edit=<?php echo $cs_mark_id; ?>'>Edit</a></span></td>
                    <!--<td><span class='action'><a href='delete.php?brand_id=<?php echo $cs_mark_id; ?>' class='delete show' title='Delete'>X</a></span></td>-->
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
