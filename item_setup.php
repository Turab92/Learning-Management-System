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
$pagename="Items Setup";
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
                    <input type="text" class="form-control" id="itemname" name="itemname" placeholder="Name">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Item Code</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="itemcode" name="itemcode" placeholder="Itemcode">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Item Date</label>

                  <div class="col-sm-6">
                    <input type="date" class="form-control" id="itemdate" name="itemdate">
                  </div>
                </div>
				 <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Inspection required</label>
                   <div class="col-sm-6">
				  <select class="form-control" name="inspection" id="inspection">
					<option value=''>Selection Inspection</option>
                    <option value='1'>Y</option>
					<option value='2'>N</option>
                  </select>
				  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Image</label>

                  <div class="col-sm-6">
                    <input type="file" class="form-control" id="image" name="image">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Re Order Value</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="ordervalue" name="ordervalue" placeholder="Re Order Value">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Barcode</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode">
                  </div>
                </div>
				
				</div>
				
				 <div class="col-sm-6">
                <div class="form-group">
                  <label  for="inputPassword3" class="col-sm-3 control-label">Base UOM</label>
                   <div class="col-sm-6">
				  <select class="form-control"  name="uom" id="uom">
                    <option value=''>Select</option>
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
                    <option value=''>Select Class 1</option>
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
                    <option value=''>Select Class 2</option>
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
                    <option value=''>Select Class 3</option>
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
				  <option value=''>Selection Discontinue</option>
                    <option value='1'>Y</option>
					<option value='2'>N</option>
                  </select>
				  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Item Detail</label>

                  <div class="col-sm-6">
                   <textarea class="form-control" required name="itemdetail" ></textarea>
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
		  <?php
				item_setup();
			?>
          <!-- /.box -->
    
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
              <h3 class="box-title">Item Description</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                   <th>Item Name</th>
				    <th>Item Code</th>
					<th>Date</th>
					<th>Image</th>
					<th>Re-Order Value</th>
					 <th>UOM </th>
					<th>Description</th>
					<th>Class1 </th>
					<th>Class2 </th>
					<th>Class3 </th>
					<th>Inspection</th>
				  <th>Edit</th>
                <th>Delete</th>
                </tr>
                </thead>
               
		<tbody>
						 <?php 
		  $i=1;
		  
$select = mysqli_query($conn,"select a.ITEM_ID,a.ITEM_PICTURE,a.ITEM_NAME,a.ITEM_CODE,a.INSPECTION,a.ITEM_DATE,a.RE_ORDER_VALUE,
a.DESCRIPTION,d.DESCRIPTION as UOM_NAME from item_setup2 a, uom_setup d  where 
a.uom_id=d.uom_id  and a.discontinue= '2' ");
while(($row = mysqli_fetch_array($select)) != false)
{             
            $item_id=$row['ITEM_ID'];
			$item_name = $row['ITEM_NAME'];
			$item_code = $row['ITEM_CODE'];
            $item_date=$row['ITEM_DATE'];
			$inspection = $row['INSPECTION'];
            $item_picture=$row['ITEM_PICTURE'];
            $order_val=$row['RE_ORDER_VALUE'];
            $description=$row['DESCRIPTION'];    
            $uom_name=$row['UOM_NAME'];

  if($inspection == 1)
  {
	  $ins = "Yes";
  }
  else
  {
	  $ins = "No";
  }
  
			
			
$select1 = mysqli_query($conn,"select CLASSIC_DETAIL_DESC from item_setup2 a, class_description_detail e where a.class1=e.classic_detail_id and a.item_id = '$item_id'  ");
while(($row1 = mysqli_fetch_array($select1)) != false)
{             
            $item_id1=$row1['CLASSIC_DETAIL_DESC'];
           
} 

$select2 = mysqli_query($conn,"select CLASSIC_DETAIL_DESC from item_setup2 a, class_description_detail e where  a.class2=e.classic_detail_id and 
a.item_id = '$item_id'  ");
while(($row2 = mysqli_fetch_array($select2)) != false)
{             
            $item_id2=$row2['CLASSIC_DETAIL_DESC'];
           
}          

$select3 = mysqli_query($conn,"select CLASSIC_DETAIL_DESC from item_setup2 a, class_description_detail e,classification_description f where  a.class3=e.classic_detail_id and 
a.item_id = '$item_id' ");
while(($row3 = mysqli_fetch_array($select3)) != false)
{             
            $item_id3=$row3['CLASSIC_DETAIL_DESC'];
           
}          
                                     
$enc = base64_encode($item_id);
                                         

?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
										  <td><?php echo $item_name; ?></td>
										<td><?php echo $item_code; ?></td>
                                        <td><?php echo $item_date; ?></td>
                                <td class='center'><img src='item_image/<?php echo $item_picture; ?>' width='70px' height='40px'/></td>
                                        <td><?php echo $order_val; ?></td>
                                         <td><?php echo $uom_name; ?></td>
                                        <td><?php echo $description; ?></td>
                                       
                                          <td><?php echo $item_id1; ?></td>
										   <td><?php echo $item_id2; ?></td> 
										    <td><?php echo $item_id3; ?></td>
											<td><?php echo $ins; ?></td>
											
											<td><span class='action'><a href='edit_item_setup.php?edit=<?php echo $enc; ?>'>Edit</a></span></td>
                    <td><span class='action'><a href='delete.php?item_id=<?php echo $item_id; ?>' class='delete show' title='Delete'>X</a></span></td>





                                    </tr>
                                    <?php

         $i++;  
       }

                                ?>    
                                    
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
