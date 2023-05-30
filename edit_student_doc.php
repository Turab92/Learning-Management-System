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
				if(isset($_GET['edit'])) {
					 $std_doc_id = $_GET['edit'];
					 $fetch_emp = mysqli_query($conn,"SELECT * FROM `student_doc_attached` as sd JOIN documents as d on sd.doc_id=d.doc_id JOIN student_current_status as scs on sd.student_id= scs.STUDENT_ID JOIN school_branches as sb on scs.BRANCH_ID= sb.branch_id where sd.std_doc_id='$std_doc_id'");
					 $erow=mysqli_fetch_array($fetch_emp);
				}
				?>
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Document</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal"  method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
			
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Student Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="stdname" name="stdname" value="<?php echo $erow['APPLICANT_NAME']; ?>" readonly>
                  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Document</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="document" id="document">
                    <option value='<?php echo $erow['doc_id']; ?>'><?php echo $erow['doc_name']; ?></option>
					<?php
							$r=mysqli_query($conn,"select doc_id,doc_name from documents");
							while ($k=mysqli_fetch_array($r)){
								$doc_id=$k['doc_id'];
								 $doc_name=$k['doc_name'];
								echo "<option value='$doc_id' >$doc_name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Attachment</label>

                  <div class="col-sm-6">
				  <img src='student_document/<?php echo $erow['Img_loc']; ?>' width='80px;' height='80px;' /><br>
                    <input type="file" name="image" id="image" class="form-control">
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
							
							
							$document=$_POST['document'];
							$file_name = $_FILES['image']['name'];
							
							if($file_name == "")
							{
								$query="UPDATE `student_doc_attached` SET `doc_id`='".$document."'   WHERE `std_doc_id` = '$std_doc_id'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='document.php'; </script>";
							}
							else{
							
								$errors= array();
								 $file_name = $_FILES['image']['name'];
								  $file_size =$_FILES['image']['size'];
								  $file_tmp =$_FILES['image']['tmp_name'];
								  $file_type=$_FILES['image']['type'];
								  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
								  
								  $expensions= array("jpeg","jpg","png");
								  
								  if(in_array($file_ext,$expensions)=== false){
									 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
								  }
								  
								  if($file_size > 1000000){
									 $errors[]='File size must be exactely 1000 KB';
								  }
								  
								  if(empty($errors)==true){
									 move_uploaded_file($file_tmp,"student_document/".$file_name);
									 //echo "Success";
								  }else{
									 print_r($errors);
								  }
							
								$query="UPDATE `student_doc_attached` SET `doc_id`='".$document."',`Img_loc`='".$file_name."'   WHERE `std_doc_id` = '$std_doc_id'";
								$result = $conn->query($query);
								 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
								echo "<script>location.href='document.php'; </script>";
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
  <!--javascript End-->
</body>
</html>