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
  include('include/menu_new.php');
  ?>
  <!--sidebar End-->
  
  <div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Campus Management System
       
      </h1>
     
    </section><br><br>
 <link rel="stylesheet" href="include/main.css">

  <div id="wrapper">
	<div class="main-content">
		
		<div class="row small-spacing">
		<?php
		$sm = mysqli_query($conn, "select distinct c.m_id,c.menu_title,c.status,c.sequence_id,c.menu_link,a.user_id,a.menu_id from main_menu c,allot_main_menu a 
where c.status='Y' and c.m_id=a.menu_id and a.user_id = '$userid' order by sequence_id ASC");
		
		 while(($rows_sm = mysqli_fetch_array($sm)) != false) 
		{
			$menu = $rows_sm['menu_title'];
			$link = $rows_sm['menu_link'];
			$id = $rows_sm['m_id'];
			
		if($link == ""){
			
		
		?>
		
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content">
					<a href="home?mid=<?php echo base64_encode($id); ?>"><div class="statistics-box with-icon">
						<i class="ico fa fa-clone text-inverse"></i>
						<h4 class="counter text-inverse"><?php echo $menu; ?></h4>
						
					</div>
					</a>
				</div>
				
			</div>	
			<?php
			}

			else
			{
				?>
				
				<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content">
					<a href="<?php echo $link; ?>"><div class="statistics-box with-icon">
						<i class="ico fa fa-clone text-inverse"></i>
						<h4 class="counter text-inverse"><?php echo $menu; ?></h4>
						
					</div>
					</a>
				</div>
				
			</div>
		
		<?php
			}
		}
			?>
			
		</div>
		

		
		<!-- /.row small-spacing -->
	
		
	</div>
	<!-- /.main-content -->
</div>
	
	
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
