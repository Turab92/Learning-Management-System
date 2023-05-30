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
$pagename="Documents";
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
        <!-- left column -->
       
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6 col-md-offset-3">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Student Document</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" >
              <div class="box-body">
			
			  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">G.R No</label>

                  <div class="col-sm-6">
                    <input type="number" class="form-control" id="grno" name="grno" placeholder="Enter Student G.R No">
                  </div>
                </div>
             
				</div>
             
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
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
			if(isset($_POST["submit"])){
												
			$grno = $_POST['grno'];
			
			$fetch_emp = mysqli_query($conn,"SELECT `STUDENT_ID`,`APPLICANT_NAME` FROM `student_current_status` WHERE `STUDENT_ID` ='$grno'");
			$erow=mysqli_fetch_array($fetch_emp);
					 
			?>		 
					 
	<section class="content">
      <div class="row">
        <!-- left column -->
       
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Document</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Student ID</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="stdid" name="stdid" value="<?php echo $erow['STUDENT_ID']; ?>" readonly>
                  </div>
                </div>
				   <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Select Document</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="document" id="document">
                    <option value=''>Select</option>
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
				
				
				</div>
				
				 <div class="col-sm-6">
					<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Student Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="stdname" name="stdname" value="<?php echo $erow['APPLICANT_NAME']; ?>" readonly>
                  </div>
                </div>
				
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Attachment</label>

                  <div class="col-sm-6">
                    <input type="file" name="image" id="image" class="form-control">
                  </div>
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
		 
          <!-- /.box -->
    
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
			
	 <?php
			}
				student_document_setup()
		  ?>
	
	
	
	 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
  

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Document Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Description</th>
				  <th>Doc Attachment</th>
                  <th>Student Name</th>
				   <th>Branch Name</th>
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
            $fetch_emp = mysqli_query($conn,"SELECT sd.std_doc_id, d.doc_name, sd.Img_loc, scs.APPLICANT_NAME,sb.branch_name FROM `student_doc_attached` as sd JOIN documents as d on sd.doc_id=d.doc_id JOIN student_current_status as scs on sd.student_id= scs.STUDENT_ID JOIN school_branches as sb on scs.BRANCH_ID= sb.branch_id order by sd.std_doc_id desc");
            foreach($fetch_emp as $emp)
            {
                $std_doc_id=$emp['std_doc_id'];
                $doc_name=$emp['doc_name'];
				 $Img_loc=$emp['Img_loc'];
				 $APPLICANT_NAME=$emp['APPLICANT_NAME'];
                $branch_name=$emp['branch_name'];
             
                ?>
                
                    <td><?php echo $s_no; ?></td>
					 <td><?php echo $doc_name; ?></td>
					  <td><img src='student_document/<?php echo $Img_loc ?>' width='80px;' height='80px;' /></td>
					  <td><?php echo $APPLICANT_NAME; ?></td>
					   <td><?php echo $branch_name; ?></td>
					   
					
					<td><span class='action'><a href='edit_student_doc.php?edit=<?php echo $std_doc_id; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?std_doc_id=<?php echo $std_doc_id; ?>' class='delete show' title='Delete'>X</a></span></td>
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
