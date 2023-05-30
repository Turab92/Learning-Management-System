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

 
if(isset($_GET['edit']))
		{
			 $item_id = base64_decode($_GET['edit']);

 $query1 = mysqli_query($conn,"select e.CLASSIC_DETAIL_DESC,e.CLASSIC_DETAIL_ID from item_setup2 a, class_description_detail e where  a.class1=e.CLASSIC_DETAIL_ID and a.ITEM_ID='$item_id'");
       
while(($row12 = mysqli_fetch_array($query1)) != false)
{             
	 $item_idd1=$row12['CLASSIC_DETAIL_ID'];
	 $item_id1=$row12['CLASSIC_DETAIL_DESC'];
           
}

	$query2 = mysqli_query($conn,"select e.CLASSIC_DETAIL_DESC,e.CLASSIC_DETAIL_ID from item_setup2 a, class_description_detail e where  a.class2=e.CLASSIC_DETAIL_ID and a.ITEM_ID='$item_id' ");
            
						
while(($row22 = mysqli_fetch_array($query2)) != false)
{              $item_idd2=$row22['CLASSIC_DETAIL_ID'];
            $item_id2=$row22['CLASSIC_DETAIL_DESC'];
           
}          

$query3 = mysqli_query($conn,"select e.CLASSIC_DETAIL_DESC,e.CLASSIC_DETAIL_ID from item_setup2 a, class_description_detail e,classification_description f where  a.class3=e.CLASSIC_DETAIL_ID and a.ITEM_ID='$item_id' ");


while(($row3 = mysqli_fetch_array($query3)) != false)
{             
            $item_idd3=$row3['CLASSIC_DETAIL_ID'];
            $item_id3=$row3['CLASSIC_DETAIL_DESC'];
           
}          

$query = mysqli_query($conn,"select * from item_setup2 where ITEM_ID = '$item_id'");

while(($row89 = mysqli_fetch_array($query)) != false)
{             
				  
				  $item_id11=$row89['ITEM_ID'];
				   $item_code=$row89['ITEM_CODE'];
			      $item_name=$row89['ITEM_NAME'];
				  $item_date=$row89['ITEM_DATE'];
				  $item_picture=$row89['ITEM_PICTURE'];
				  $order_val=$row89['RE_ORDER_VALUE'];
				  $description=$row89['DESCRIPTION'];    
			      $uom_id=$row89['UOM_ID'];
      			  $barcode=$row89['BARCODE'];
      			  $ins=$row89['INSPECTION'];
				  $dis=$row89['DISCONTINUE'];

	
				  	
				  		 
		 if($ins=='1'){
			 
			 $ins2="Y";
		 }
		 else{
			 $ins2="N";
			 
		 }
		 if($dis=='1'){
			 
			 $dis2="Y";
		 }
		 else{
			 $dis2="N";
			 
		 }

		}

$select_uom = mysqli_query($conn,"select * from uom_setup where UOM_ID = '$uom_id' ");
while($row = mysqli_fetch_array($select_uom))
{
	$uom_id = $row['UOM_ID'];
	$uom_name = $row['DESCRIPTION'];
	
}
		
		}		
 
 ?>
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Item Setup</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
              <div class="box-body">
			  <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Item Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="itemname" name="itemname" value="<?php echo $item_name; ?>">
                  </div>
                </div>
					<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Item Code</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="itemcode" name="itemcode" value="<?php echo $item_code; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Item Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="itemdate" name="itemdate" value="<?php echo $item_date; ?>">
                  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Inspection required</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="inspection" id="inspection">
					<option value='<?php echo $ins; ?>'><?php echo $ins2; ?></option>
                    <option value='1'>Y</option>
					<option value='2'>N</option>
                  </select>
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Image</label>

                  <div class="col-sm-6">
				  <img src='item_image/<?php echo $item_picture;  ?>' width='80px;' height='80px;' />
                    <input type="file" class="form-control" id="image" name="image">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Re Order Value</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="ordervalue" name="ordervalue" value="<?php echo $order_val; ?>">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Barcode</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="barcode" name="barcode" value="<?php echo $barcode; ?>">
                  </div>
                </div>
				
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Base UOM</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="uom" id="uom">
                    <option value='<?php echo $uom_id; ?>'><?php echo $uom_name; ?></option>
					<?php
							$r=mysqli_query($conn,"select * from uom_setup");
							while ($k=mysqli_fetch_array($r)){
								$UOM_CODE=$k['UOM_ID'];
								 $DESCRIPTION=$k['DESCRIPTION'];
								echo "<option value='$UOM_CODE' >$DESCRIPTION</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Class 1</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="class1" id="class1">
                    <option value='<?php echo $item_idd1; ?>'><?php echo $item_id1; ?></option>
					<?php
							$r=mysqli_query($conn,"select * from classification_description a , class_description_detail b where a.classic_id=b.classic_id and a.classic_id=1");
							while ($k=mysqli_fetch_array($r)){
								$id=$k['CLASSIC_DETAIL_ID'];
								 $name=$k['CLASSIC_DETAIL_DESC'];
								echo "<option value='$id' >$name</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Class 2</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="class2" id="class2">
                    <option value='<?php echo $item_idd2;?>'><?php echo $item_id2; ?></option>
					<?php
							$r=mysqli_query($conn,"select * from classification_description a , class_description_detail b where a.classic_id=b.classic_id and a.classic_id=2");
							while ($k=mysqli_fetch_array($r)){
								$id2=$k['CLASSIC_DETAIL_ID'];
								 $name2=$k['CLASSIC_DETAIL_DESC'];
								echo "<option value='$id2' >$name2</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Class 3</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="class3" id="class3">
                    <option value='<?php echo $item_idd3;?>'><?php echo $item_id3; ?></option>
					<?php
							$r=mysqli_query($conn,"select * from classification_description a , class_description_detail b where a.classic_id=b.classic_id and a.classic_id=3");
							while ($k=mysqli_fetch_array($r)){
								$id3=$k['CLASSIC_DETAIL_ID'];
								 $name3=$k['CLASSIC_DETAIL_DESC'];
								echo "<option value='$id3' >$name3</option>";
							}
					?>
                  </select>
				  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Discontinue</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="discontinue" id="discontinue">
				  <option value='<?php echo $dis; ?>'><?php echo $dis2; ?></option>
                    <option value='1'>Y</option>
					<option value='2'>N</option>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Item Detail</label>

                  <div class="col-sm-6">
                   <textarea class="form-control" required name="itemdetail" ><?php echo $description; ?></textarea>
                  </div>
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
							
									
							$itemname = $_POST['itemname'];
							$itemcode = $_POST['itemcode'];
							$itemdate = $_POST['itemdate'];
							$inspection=$_POST['inspection'];
							$ordervalue = $_POST['ordervalue'];
							$barcode = $_POST['barcode'];
							$uom=$_POST['uom'];
							$class1 = $_POST['class1'];
							$class2 = $_POST['class2'];
							$class3=$_POST['class3'];
							$discontinue = $_POST['discontinue'];
							$itemdetail = $_POST['itemdetail'];
							$file_name = $_FILES['image']['name'];
							
							$r2 = mysqli_query($conn, "select * from item_setup2 where ITEM_CODE='$itemcode'" ); 
	
							$count=mysqli_num_rows($r2);
	
	
							if($count == 0){
							
									if($file_name == "")
										{
											
											$query="UPDATE `item_setup2` SET `ITEM_NAME`='".$itemname."',`ITEM_CODE`='".$itemcode."',`ITEM_DATE`='".$itemdate."',`RE_ORDER_VALUE`='".$ordervalue."',`BARCODE`='".$barcode."',`DESCRIPTION`='".$itemdetail."',`UOM_ID`='".$uom."',`CLASS1`='".$class1."',`CLASS2`='".$class2."',`CLASS3`='".$class3."',`INSPECTION`='".$inspection."',`DISCONTINUE`='".$discontinue."'   WHERE `ITEM_ID` = '$item_id'";
											 $result = $conn->query($query);
											   
											  echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
											  echo "<script>location.href='item_setup'; </script>";
													
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
											 move_uploaded_file($file_tmp,"item_image/".$file_name);
											 //echo "Success";
										  }else{
											 print_r($errors);
										  }
										  
											  $query="UPDATE `item_setup2` SET `ITEM_NAME`='".$itemname."',`ITEM_CODE`='".$itemcode."',`ITEM_DATE`='".$itemdate."',`RE_ORDER_VALUE`='".$ordervalue."',`BARCODE`='".$barcode."',`DESCRIPTION`='".$itemdetail."',`UOM_ID`='".$uom."',`CLASS1`='".$class1."',`CLASS2`='".$class2."',`CLASS3`='".$class3."',`INSPECTION`='".$inspection."',`DISCONTINUE`='".$discontinue."',`ITEM_PICTURE`='".$file_name."'   WHERE `ITEM_ID` = '$item_id'";
												 $result = $conn->query($query);
											   
											 echo"<script type='text/javascript'>alert('Record Successfully Updated');</script>";
											  echo "<script>location.href='item_setup'; </script>";
											
										}
							}
							else
								{
									 echo "<script>alert('Itemcode Already Existed')</script>
										 <script>window.open('item_setup','_self')</script>";
									

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
